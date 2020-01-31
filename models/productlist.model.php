<?php
class ProductList extends MainModel {
    private $query;
    public function __construct($api, $limit = null) {
        parent::__construct($api);
        if(isset($limit)) {
            $this->query['limit'] = $limit;
        }
    }

    public function best() {
        $this->query['sort'] = 'bestof';
    }
    public function getProducts() {
        $list = $this->api->get('products', $this->query);
        var_dump($list);
        return $list;
    }
}