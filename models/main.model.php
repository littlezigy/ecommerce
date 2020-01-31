<?php
class MainModel {
    protected $api;

    public function __construct(API $api) {
        $this->api = $api;
    }
}