<?php
/**
 * Created by PhpStorm.
 * User: Tom
 * Date: 17.10.2018
 * Time: 23:06
 */

namespace Helpers\Cart;

require_once __DIR__.'\..\..\Cart.php';
require_once __DIR__.'\..\..\..\Product\Product.php';
require_once 'ICartValue.php';

use Cart\Cart;
use Product\Product;

class CartFullValue extends ICartValue
{
    /**
     * @param Cart $cart
     * @return float
     */
    public function countValue($cart)
    {
        $value = 0;

        /**
         * @var Product $product
         */
        foreach ($cart->getProducts() as $product) {
            $value += $product->getPrice();
        }

        return $value;
    }
}