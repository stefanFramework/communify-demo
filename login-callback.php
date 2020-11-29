<?php

if (!session_id()) {
    session_start();
}

require_once 'fb-config.php';

try {

    $helper = $fb->getRedirectLoginHelper();
    $accessToken = $helper->getAccessToken();

    if (empty($accessToken)) {

        if (empty($helper->getError())) {
            header('HTTP/1.0 400 Bad Request');
            echo 'Bad request';
            die;
        }

        header('HTTP/1.0 401 Unauthorized');
        echo "Error: " . $helper->getError() . "\n";
        echo "Error Code: " . $helper->getErrorCode() . "\n";
        echo "Error Reason: " . $helper->getErrorReason() . "\n";
        echo "Error Description: " . $helper->getErrorDescription() . "\n";
        die;
    }

    // Controlador de cliente de OAuth 2.0, para gestionar los accesos
    $oAuth2Client = $fb->getOAuth2Client();

    $tokenMetadata = $oAuth2Client->debugToken($accessToken);
    $tokenMetadata->validateExpiration();

    if (! $accessToken->isLongLived()) {
        // Cambiando uno de corta duración a una de larga duración
        $accessToken = $oAuth2Client->getLongLivedAccessToken($accessToken);
    }

    $userId = $tokenMetadata->getUserId();
    $userAccessToken = $accessToken->getValue();
    $userScopes = $tokenMetadata->getScopes();

    echo 'User: ' . $userId;
    echo '<hr>';
    echo 'User Access Token: ' . $userAccessToken;
    echo '<hr>';
    echo json_encode($userScopes);

    $_SESSION['fb_user_id'] = $userId;
    $_SESSION['fb_user_access_token'] = $userAccessToken;

    echo '<hr><a href="login.php">Back</a>';
    echo '<hr><a href="post_to_page.php">Post to page</a>';

} catch (Throwable $ex) {
    echo 'Error: ' . $ex->getMessage();
}

