<?php

function capy_puzzle_captcha_verify($privatekey, $challengekey, $answer) {
    $url = 'https://www.capy.me/puzzle/verify/';
    $data = array(
        'capy_privatekey' => $privatekey,
        'capy_challengekey' => $challengekey,
        'capy_answer' => $answer,
        'capy_ip_address' => get_ipaddress(),
    );
    $options = array('http' => array(
        'method' => 'POST',
        'content' => http_build_query($data),
    ));
    $content = explode("\n", file_get_contents($url, false, stream_context_create($options)));
    $result = $content[0] == 'true' ? TRUE : FALSE;
    $message = '';
    switch ($content[1]) {
        case 'incorrect-answer':
            $message = 'The CAPTCHA answer was wrong.';
            break;
        case 'is-not-active':
            $message = 'Time runs up. Try to solve CAPTCHA again';
            break;
        default:
            $result = TRUE;
            $message = 'Unknown error was occured.';
    }
    return array($result, $message);
}

function get_ipaddress() {
    if (getenv('HTTP_CLIENT_IP'))
        return getenv('HTTP_CLIENT_IP');
    else if(getenv('HTTP_X_FORWARDED_FOR'))
        return getenv('HTTP_X_FORWARDED_FOR');
    else if(getenv('HTTP_X_FORWARDED'))
        return getenv('HTTP_X_FORWARDED');
    else if(getenv('HTTP_FORWARDED_FOR'))
        return getenv('HTTP_FORWARDED_FOR');
    else if(getenv('HTTP_FORWARDED'))
       return getenv('HTTP_FORWARDED');
    else if(getenv('REMOTE_ADDR'))
        return getenv('REMOTE_ADDR');
    else
        return 'UNKNOWN';
}
?>
