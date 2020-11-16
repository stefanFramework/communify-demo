<?php

session_start();

require_once 'fb-config.php';

try {

    $userId = '118148193430831'; // Esta en la metadata
    $accessToken = 'EAAJyy3XlxOkBAAZAgSP2njZCLZBrxgEiQs9gGchUHJqJFNXO32uo2B5njvE4K7pnj7ZAEc9QrfI4XhbmeQ1YqvUM1uAq7s1PWV3Ir8DpubX5Oqs09SoBX00veAGISjgQntGa7IdoVWlBNeXBok1nzARVk1NOz6rnnshHzbc9V4rLBqUTdKTZC';

//
//
//    //$accessToken = $helper->getAccessToken();
//    $response = $fb->get('/' . $userId . '/accounts?access_token=' . $accessToken);
//    $data = $response->getDecodedBody();
//

//
//    $data = $data['data'][0];
//    var_dump($data);
//    die;

//    $pageId = $data['data'][0]['id'];
//    $pageAccessToken = $data['data'][0]['access_token'];

    $params = [
        'link' => 'https://www.google.com.ar/',
        'message' => 'I am using a Fb Graph API to post this'
    ];

    $response = $fb->post('/me/feed', $params, $accessToken);
//    $response = $fb->post('/'. $pageId . '/feed', $params,  $pageAccessToken);
    var_dump($response);
//    $me = $response->getGraphUser();
//    echo json_encode($me->asArray());

} catch (Throwable $ex) {
    echo 'Error: ' . $ex->getMessage();
}

