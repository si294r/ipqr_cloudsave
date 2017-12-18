<?php

$iservice = $IS_DEVELOPMENT == true ? "igettime-dev".$BUILD_TYPE : "igettime";

$result = file_get_contents($url_static_time.'?'.$iservice, null, stream_context_create(
        array(
            'http' => array(
                'method' => 'POST',
                'header' => 'Content-Type: application/json'. "\r\n"
                . 'x-api-key: ' . X_API_KEY_TOKEN . "\r\n"
                . 'Content-Length: ' . strlen('{}') . "\r\n",
                'content' => '{}'
            )
        )
    )
);

$result = json_decode($result, true);
    
try {
    $data['time'] = gmdate('Y-m-d H:i:s', (time() - strtotime($result['update_time'])) + strtotime($result['server_time']));
} catch (Exception $ex) {
    $data['time'] = gmdate('Y-m-d H:i:s');
}
$data['timestamp'] = strtotime($data['time']);
return $data;
    

