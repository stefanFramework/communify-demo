<?php

use Abraham\TwitterOAuth\TwitterOAuth;

require_once '../vendor/autoload.php';

require 'config.php';

try {
    $twitter = new TwitterOAuth(
        CONSUMER_KEY,
        CONSUMER_SECRET,
        CODESAL_OAUTH_TOKEN,
        CODESAL_OAUTH_TOKEN_SECRET
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

