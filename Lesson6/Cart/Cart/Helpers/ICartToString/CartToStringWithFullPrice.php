<?php
/**
 * Created by PhpStorm.
 * User: Tom
 * Date: 17.10.2018
 * Time: 22:59
 */

namespace Helpers\Cart;

require_once __DIR__.'\..\..\Cart.php';
require_once __DIR__.'\..\..\..\Product\Product.php';
require_once __DIR__.'\..\..\..\Product\Helpers\IProductToString\ProductToStringWithFullPrice.php';
require_once 'ICartToString.php';
require_once __DIR__.'\..\ICartValue\CartFullValue.php';

use Cart\Cart;
use Helpers\Product\ProductToStringWithFullPrice;
use Product\IProduct;

class CartToStringWithFullPrice extends ICartToString
{
    /**
     * @param Cart $cart
     * @return string
     */
    public function toString($cart)
    {
        /**
         * @var string $output
         */
        $output = '';

        $output .= 'Cart contains '.$cart->getProductsAmount().' products:'.PHP_EOL;
        /**
         * @var IProduct $product
         */
        foreach ($cart->getProducts() as $product) {
            $output .= $product->toString(new ProductToStringWithFullPrice()).PHP_EOL;
        }

        $discountedPrice = (new CartFullValue())->countValue($cart);

        $output .= 'and it\'s total cost: '.$discountedPrice.PHP_EOL;

        return $output;
    }
}