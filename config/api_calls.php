<?php

function apipost($path, $data) {
    $resourceurl = $baseurl . "/" . $path;
    return curl_api($resourceurl, 'POST', $data);
}

function curl_api($url, $method='GET', $data, $query) {
    $headers = [];
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
    
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                    'Content-Type: application/json',
                    'Content-Length: '. strlen($jsonstr))
                );
    switch($method) {
        case 'post':
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
            break;
        case 'patch':
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PATCH");
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
            break;
        case "delete":
            curl_delete($query);
            break;
        default: 
            break;
    }
    curl_setopt($ch, CURLOPT_HEADERFUNCTION, get_curl_headers);

    return curl_exec($ch);
}

$get_curl_headers = function($curl, $header_) use (&$headers) {
    $len = strlen($header_);
    $header_ = explode(':', $header_, 2);
    if(count($header_)<2) {
        return $len;}
    $headers[strtolower(trim($header_[0]))][] = trim($header_[1]);
    if(count($header_) === 2) {
        $headername = strtolower($header_[0]);
        if($headername === 'set-cookie') {
            $cookies = $header_[1];
            $_SESSION['cookies'] = $cookies;
        }
    }
    return $len;
}
?>