<?php

use Abraham\TwitterOAuth\TwitterOAuth;

require_once '../vendor/autoload.php';

require 'config.php';

if (!session_id()) {
    session_start();
}

try {
    $twitterAuth = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET);

    $requestToken = $twitterAuth->oauth('oauth/request_token', ['oauth_callback' => URL_CALLBACK]);

    // throw exception if something went wrong
    if($twitterAuth->getLastHttpCode() != 200) {
        throw new \Exception('There was a problem performing this request');
    }

    $userAuthenticationToken = $requestToken['oauth_token'];
    $userAuthenticationSecret = $requestToken['oauth_token_secret'];

    // save token of application to session
    $_SESSION['oauth_token'] = $userAuthenticationToken;
    $_SESSION['oauth_token_secret'] = $userAuthenticationSecret;

    // generate the URL to make request to authorize our application
    $url = $twitterAuth->url(
        'oauth/authorize', [
            'oauth_token' => $userAuthenticationToken
        ]
    );

    // and redirect
    header('Location: '. $url);
} catch (Throwable $ex) {
    echo 'ERROR: ' . $ex->getMessage();
}

