<?php

use Abraham\TwitterOAuth\TwitterOAuth;

require_once '../vendor/autoload.php';

require 'config.php';

if (!session_id()) {
    session_start();
}

$oauth_verifier = filter_input(INPUT_GET, 'oauth_verifier');

if (empty($oauth_verifier) ||
    empty($_SESSION['oauth_token']) ||
    empty($_SESSION['oauth_token_secret'])
) {
    // something's missing, go and login again
    header('Location: ' . URL_LOGIN);
}

try {
    // connect with application token
    $connection = new TwitterOAuth(
        CONSUMER_KEY,
        CONSUMER_SECRET,
        $_SESSION['oauth_token'],
        $_SESSION['oauth_token_secret']
    );

    // request user token
    $token = $connection->oauth(
        'oauth/access_token', [
            'oauth_verifier' => $oauth_verifier
        ]
    );

    $twitter = new TwitterOAuth(
        CONSUMER_KEY,
        CONSUMER_SECRET,
        $token['oauth_token'],
        $token['oauth_token_secret']
    );

    $status = $twitter->post(
        "statuses/update", [
            "status" => "This is my message: " . rand(123456,999999)
        ]
    );

    if (!empty($status->errors)) {
        $error = $status->errors[0];
        $message = $error->message;
        $code = $error->code;
        throw new Exception($message, $code);
    }

    echo ('Created new status with #' . $status->id . PHP_EOL);
} catch (Throwable $ex) {
    echo 'Error: ' . $ex->getMessage();
}



