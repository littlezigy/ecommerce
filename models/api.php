<?php
class API extends Env{
    private $env;
    private $base_url;
    //$curl was static before. I changed it to just a private var
    //I think it's from a bug I was having with the api obj
    private $curl;

    public function __construct($curl=null) {
        $this->base_url = parent::env()->getbaseurl();
        //$this->user = $this->base_url . $this->user;
        $this->curl = $curl;
    }

    public function post(String $resource, Array $payload) {
        $url = $this->base_url . $resource;
        $this->curl->post($url, $payload);
        var_dump($this->curl);
    }

    public function get(String $resource, Array $query) {
        $url = $this->base_url . $resource;
        $this->curl->get($url, $query);
        return $this->returnResponseBody();
    }

    private function returnResponseBody() {
        $response = (json_decode($this->curl->responseBody, true));
        if(array_key_exists('success', $response)) {
            echo "Success!!!!";
            return $response['data'];
        }
    }
}