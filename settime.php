<?php

if ($IS_DEVELOPMENT == true) {
    
    $data_string = $input;
    $result = file_get_contents($url_static_time.'?isettime-dev'.$BUILD_TYPE, null, stream_context_create(
            array(
                'http' => array(
                    'method' => 'POST',
                    'header' => 'Content-Type: application/json'. "\r\n"
                    . 'x-api-key: ' . X_API_KEY_TOKEN . "\r\n"
                    . 'Content-Length: ' . strlen($data_string) . "\r\n",
                    'content' => $data_string
                )
            )
        )
    );
    return json_decode($result, true);
    
} else {
    
    return array(
        'error' => 1,
        'status' => 'Service available only in development'
    );
    
}

