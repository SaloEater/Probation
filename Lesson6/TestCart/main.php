<?php
/**
 * Created by PhpStorm.
 * User: Tom
 * Date: 15.10.2018
 * Time: 22:13
 */

namespace TestCart;

include 'Product.php';
include 'Shop.php';

/*Fill fakedb*/

/*Products*/

/**
 * @var Product[] $fakeProducts
 */
$fakeProducts = [];

$fakeProducts[] = (new ProductCreator())->createProduct(0, 'First', 10);
$fakeProducts[] = (new ProductCreator())->createProduct(1, 'Second', 20, 10);
$fakeProducts[] = (new ProductCreator())->createProduct(2, 'Third', 50);

ITable::updateFakebase('products', $fakeProducts);


/* Test functions */

/**
 * @var Shop $shop
 */
$shop = new Shop(new ShopOutput());
$shop->fill((new ProductDB())->all());

$shop->printProducts(true);

$cart = $shop->getCart();

$cart->add($shop->getProductByIndex(0));

$shop->saveCart();
echo PHP_EOL . 'Cart with 1 item saved to db' . PHP_EOL;

$cart->add($shop->getProductByIndex(1));

echo PHP_EOL . 'One product added to cart' . PHP_EOL;
$shop->printCart(true);

$shop->loadCart();
echo PHP_EOL . 'Cart loaded from db'. PHP_EOL;
$shop->printCart(true);

echo PHP_EOL . 'Add 10% discount to shop and 5% to cart' . PHP_EOL;
$shop->setDiscount(10);
$cart->setDiscount(5);

$shop->printCart(false);

$shop->getProductByIndex(0)->setDiscount(10);
echo PHP_EOL . 'Add 10% discount to first item in cart' . PHP_EOL;
$shop->printCart(false);
