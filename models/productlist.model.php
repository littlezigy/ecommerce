<?php
class ProductList extends MainModel {
    private $query;

    public function __construct($api, $limit = 10){
        parent::__construct($api);
        $this->query['limit'] = $limit;
    }

    public function best() {
        $this->query['sort'] = 'bestof';
    }

    public function getProducts() {
        $list = $this->api->get('products', $this->query);
        foreach($list as &$product) {
            if($product['shortdesc_'] == '') {
                $product['shortdesc_'] = "This is a great product judging by the fact that it is in this category";
            }
            if(!array_key_exists('image', $product)) {
                $product['image'] = "/images/matchstick_model.jpg";
            }
        }
        return $list;
    }
}