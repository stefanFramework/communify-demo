<?php
use Facebook\Facebook;
use Facebook\Exceptions\FacebookResponseException;
use Facebook\Exceptions\FacebookSDKException;

require_once __DIR__ . '/vendor/autoload.php'; // change path as needed

$appId = '689168135341289';
$appSecret = '791137d03afb563aac59f5f779c0f4aa';
$accessToken = 'EAAJyy3XlxOkBAFeX9oZAqFsKiyfYgVn93YMtB1rf01ZChduYcqDi3ZB1TquazZBfUFLD4eNiUmUXDJysFkZCGHWresJbxK3MyCmjZBKpql4ZAKRRYnbsE8SYBcuEW9gYBlJmViWu7HtdvOcI8NXA49Y6Ij9QZCl2gONnXZCHoMB7nZAzqeFdZAj1iNUaOjHmsQoaVYZD';
$graphVersion = 'v8.0';


try {
    $fb = new Facebook([
        'app_id' => $appId,
        'app_secret' => $appSecret,
        'default_graph_version' => $graphVersion,
        'default_access_token' => $accessToken, // optional
    ]);

    // Use one of the helper classes to get a Facebook\Authentication\AccessToken entity.
    //   $helper = $fb->getRedirectLoginHelper();
    //   $helper = $fb->getJavaScriptHelper();
    //   $helper = $fb->getCanvasHelper();
    //   $helper = $fb->getPageTabHelper();

    // Get the \Facebook\GraphNodes\GraphUser object for the current user.
    // If you provided a 'default_access_token', the '{access-token}' is optional.
    $response = $fb->get('/me?fields=id,first_name,last_name,name,email');
    $me = $response->getGraphUser();
    echo json_encode($me->asArray());
//    echo 'Logged in as ' . $me->getName();

} catch(FacebookResponseException | FacebookSDKException $ex ) {
    // When Graph returns an error
    echo 'Graph returned an error: ' . $ex->getMessage();
    exit;
} catch(Throwable $ex) {
    echo 'Error: ' . $ex->getMessage();
}
