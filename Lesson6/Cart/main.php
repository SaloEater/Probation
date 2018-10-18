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
require_once 'Cart\Helpers\CartDB.php';

use Cart\Cart;
use Helpers\Cart\CartDB;
use Helpers\Cart\CartToStringWithDiscountedPrice;
use Helpers\Product\ProductDB;
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

echo 'Cart contains '.$cart->getProductsAmount().' items'.PHP_EOL;


$cart->addOne($product2);

$cartdb = new CartDB();
$cartdb->save($cart);

echo 'After save: '.PHP_EOL.$cart->toString(new CartToStringWithDiscountedPrice()).PHP_EOL;

$product2->setPrice(100);

$cart = $cartdb->load();

echo 'After load: '.PHP_EOL.$cart->toString(new CartToStringWithDiscountedPrice()).PHP_EOL;