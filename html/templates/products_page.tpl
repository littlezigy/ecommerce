<p class  = 'title text-center'><?=$title?></p>

<div id = 'products'>
<?php foreach ($products as $product) {
    include __DIR__ . "/partials/product_card1.tpl";
}?>
</div>

<style>
div#products {
    display: flex;
    flex-wrap: wrap;
}
</style>