<?php
use Facebook\Facebook;
use Facebook\Exceptions\FacebookResponseException;
use Facebook\Exceptions\FacebookSDKException;

require_once __DIR__ . '/vendor/autoload.php'; // change path as needed

// Esto es de member berries
$appId = '689168135341289';
$appSecret = '791137d03afb563aac59f5f779c0f4aa';
$graphVersion = 'v8.0';

$fb = new Facebook([
    'app_id' => $appId,
    'app_secret' => $appSecret,
    'default_graph_version' => $graphVersion,
]);

//$helper = $fb->getRedirectLoginHelper();