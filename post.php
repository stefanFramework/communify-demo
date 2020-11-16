<?php

require_once 'fb-config.php';

$linkData = [
    'link' => 'http://www.example.com',
    'message' => 'User provided message',
];

$accessToken = 'EAAJyy3XlxOkBABS3AsU3p4vtHaY5UDdi8jAiIvCnLdfgEgOr669u3m6NpDibaXvbt5lXYk7bqSNer8ZCjz5wxi4dnqQdyL4CqxcVhLgZBt6MASV6VWfrYV6TEPoiUZAqw5BxZCf1kTZATCkMkktIofrBlhNPlLZBHe6FNg9yQkDMg2ASejQ9KNiXlCGghXIpYZD';

try {
    // Returns a `Facebook\FacebookResponse` object
    $response = $fb->post('/me/feed', $linkData, $accessToken);
} catch(Facebook\Exceptions\FacebookResponseException $e) {
    echo 'Graph returned an error: ' . $e->getMessage();
    exit;
} catch(Facebook\Exceptions\FacebookSDKException $e) {
    echo 'Facebook SDK returned an error: ' . $e->getMessage();
    exit;
}

$graphNode = $response->getGraphNode();

echo 'Posted with id: ' . $graphNode['id'];