<?php
//GENERAL FUNCTIONS

get_products_bestof() {
    $ch = curl_init($api . '/user/personalize');
    $headers = [];
    curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
    curl_setopt($ch, CURLOPT_COOKIE, $_SESSION['cookies']);
    curl_setopt($ch, CURLOPT_HEADERFUNCTION,
                    function($curl, $header) use (&$headers) {
                        $len = strlen($header);
                        $header = explode(':', $header, 2);
                        if(count($header)<2) {
                            return $len;}
                        $headers[strtolower(trim($header[0]))][] = trim($header[1]);
                        return $len;
                    });

    $personalized  = curl_exec($ch); 
    curl_close($ch);
    
    $personalized = json_decode($personalized);
    if(!isset($personalized->success)) {
        $_SESSION = array();
        session_destroy();
    }
    $bestproducts = $personalized->data->best;
}