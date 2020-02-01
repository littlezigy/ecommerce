<div class = 'products carousel'>
    <div class = 'card product'>
        <img src = '<?=$product['image']?>' class = 'product' />
        <p class = 'text-right price'><?=$currency?> <?= $product['price'] ?></p>
        <p class = 'text-center text-2'><?= $product['productname'] ?></p>
        <p class = 'brand small text-right'><?=$product['brand']?></p>
        <p class = 'stock'><?=$product['qty_available']?> in stock</p>

        <button>Add to cart</button>
    </div>
</div>