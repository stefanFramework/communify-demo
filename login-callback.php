<?php

session_start();

require_once 'fb-config.php';

try {
    $appId = '689168135341289';
    $helper = $fb->getRedirectLoginHelper();
    $accessToken = $helper->getAccessToken();

    if (empty($accessToken)) {
        if ($helper->getError()) {
            header('HTTP/1.0 401 Unauthorized');
            echo "Error: " . $helper->getError() . "\n";
            echo "Error Code: " . $helper->getErrorCode() . "\n";
            echo "Error Reason: " . $helper->getErrorReason() . "\n";
            echo "Error Description: " . $helper->getErrorDescription() . "\n";
        } else {
            header('HTTP/1.0 400 Bad Request');
            echo 'Bad request';
        }
        die;
    }


    // Login directo
    echo '<h3>Acceso Token</h3>';
    var_dump($accessToken->getValue());


    // Controlador de cliente de OAuth 2.0, para gestionar los accesos
    $oAuth2Client = $fb->getOAuth2Client();

    $tokenMetadata = $oAuth2Client->debugToken($accessToken);
    echo '<h3>Metadata</h3>';
    $scopes = $tokenMetadata->getScopes();
    echo json_encode($scopes);

    $tokenMetadata->validateAppId($appId);
    $tokenMetadata->validateExpiration();

    if (! $accessToken->isLongLived()) {
        // Cambiando uno de corta duración a una de larga duración
        $accessToken = $oAuth2Client->getLongLivedAccessToken($accessToken);
        echo '<h3>Long-lived</h3>';
        var_dump($accessToken->getValue());
    } else {
        echo '<h3>Ya era LongLived</h3>';
    }

    echo '<a href="login.php">Back</a>';

} catch (Throwable $ex) {
    echo 'Error: ' . $ex->getMessage();
}

