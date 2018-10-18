<?php
/**
 * Created by PhpStorm.
 * User: Tom
 * Date: 17.10.2018
 * Time: 22:16
 */

require_once 'Table\FakeDBFiller.php';
require_once 'Cart\Cart.php';
require_once 'Product\Product.php';
require_once 'Product\Helpers\ProductDB.php';
require_once 'Product\Helpers\IProductToString\ProductToStringWithDiscountedPrice.php';
require_once 'Product\Helpers\IProductToString\ProductToStringWithFullPrice.php';
require_once 'Cart\Helpers\ICartToString\CartToStringWithFullPrice.php';
require_once 'Cart\Helpers\ICartToString\CartToStringWithDiscountedPrice.php';

use Cart\Cart;
use Helpers\Cart\CartToStringWithDiscountedPrice;
use Helpers\Product\ProductDB;
use Helpers\Product\ProductToStringWithDiscountedPrice;
use Helpers\Product\ProductToStringWithFullPrice;
use Helpers\Table\FakeDBFiller;
use Product\Product;


FakeDBFiller::fillDB();

/**
 * @var Cart $cart
 */
$cart = new Cart();

$productDB = new ProductDB();
/**
 * @var Product $product0
 */
$product0 = $productDB->getByID(0);
/**
 * @var Product $product1
 */
$product1 = $productDB->getByID(1);
/**
 * @var Product $product2
 */
$product2 = $productDB->getByID(2);

echo $product0->toString(new ProductToStringWithFullPrice()).PHP_EOL;
echo $product2->toString(new ProductToStringWithDiscountedPrice()).PHP_EOL;

$cart->addSome($product1, 5);

echo $cart->toString(new CartToStringWithDiscountedPrice()).PHP_EOL;

echo 'Cart contains '.$cart->getProductsAmount().' items';

/* Применим распродажу */

$cart->updateAnotherDiscount('shop', 50);

$cart->addOne($product2);

echo $cart->toString(new CartToStringWithDiscountedPrice()).PHP_EOL;
