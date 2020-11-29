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



    $igResponse = $fb->get('/' . $pageId . '/?fields=instagram_business_account', $pageAccessToken);
    $igResponseBody = $igResponse->getDecodedBody();
    echo json_encode($igResponseBody);die;

} catch (Throwable $ex) {
    echo 'Error: ' . $ex->getMessage();
}

