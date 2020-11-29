<?php

use Facebook\FacebookResponse;

if (!session_id()) {
    session_start();
}

require_once 'fb-config.php';

try {

    if (!isset($_SESSION['fb_user_id']) || !isset($_SESSION['fb_user_access_token'])) {
        throw new Exception('No Token or USER ID provided');
    }

    $userId = $_SESSION['fb_user_id'];
    $userAccessToken = $_SESSION['fb_user_access_token'];

    $response = $fb->get('/' . $userId . '/accounts?access_token=' . $userAccessToken);
    $responseBody = $response->getDecodedBody();
    $data = $responseBody['data'][0];

    $pageId = $data['id'];
    $pageAccessToken = $data['access_token'];

    $params = [
        'message' => 'This is a simple message: ' . rand(123456, 999999)
    ];

    $fb->post('/'. $pageId . '/feed', $params,  $pageAccessToken);
    echo 'Done!';

} catch (Throwable $ex) {
    echo 'Error: ' . $ex->getMessage();
}

