<?php
/**
 * Created by PhpStorm.
 * User: Tom
 * Date: 17.10.2018
 * Time: 22:57
 */

namespace Helpers\Cart;


require_once __DIR__.'\..\..\Cart.php';
require_once __DIR__.'\..\..\..\Product\Product.php';
require_once __DIR__.'\..\..\..\Product\Helpers\IProductToString\ProductToStringWithDiscountedPrice.php';

require_once __DIR__.'\..\ICartValue\CartDiscountedValue.php';

use Cart\Cart;
use Helpers\Product\ProductToStringWithDiscountedPrice;
use Product\IProduct;

class CartToStringWithDiscountedPrice extends ICartToString
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
        foreach ($cart->getDiscountedPriceProducts() as $product) {
            $output .= $product->toString(new ProductToStringWithDiscountedPrice());
        }

        $discountedPrice = (new CartDiscountedValue())->countValue($cart);

        $output .= 'and it\'s total cost: '.$discountedPrice.PHP_EOL;

        return $output;
    }
}