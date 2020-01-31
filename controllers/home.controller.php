<?php
class HomeController {
    public function loadHomePage(ProductList &$productlist) {
        $productlist->best();
    }
}