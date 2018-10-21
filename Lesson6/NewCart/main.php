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
use Helpers\Cart\CartToStringWithDiscountedPrice;
use Helpers\Cart\CartToStringWithFullPrice;
use Helpers\Table\FakeDBFiller;

FakeDBFiller::fillDB();

/**
 * @var Cart $cart
 */
$cart = new Cart();

$cart->addSome(0, 5);

echo $cart->print(new CartToStringWithFullPrice());

$cart->save();

$cart->addSome(0, 2);

echo PHP_EOL.$cart->print(new CartToStringWithDiscountedPrice());

FakeDBFiller::updateSellout(10);
FakeDBFiller::updateLoyaltyCard(10);

$cart->load();

echo PHP_EOL.$cart->print(new CartToStringWithDiscountedPrice());


