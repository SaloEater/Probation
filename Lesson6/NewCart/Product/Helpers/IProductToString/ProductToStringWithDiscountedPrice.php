<?php
/**
 * Created by PhpStorm.
 * User: Tom
 * Date: 17.10.2018
 * Time: 21:27
 */

namespace Helpers\Product;

require_once __DIR__.'\..\..\Product.php';

use Product\Product;

class ProductToStringWithDiscountedPrice extends IProductToString
{
    /**
     * @param Product $product
     * @return string
     */
    public function toString($product)
    {
        /**
         * @var string $output
         */
        $output = '';

        $output .= '> '.$product->getId().PHP_EOL;
        $output .= 'Name: '.$product->getName().PHP_EOL;
        if ($product->getTotalDiscount() > 0) {
            $output .= 'Is under '.$product->discountToString().' discount'.PHP_EOL.
                'with new price: '.$product->discountedPriceToString();
        } else {
            $output .= 'Price: '.$product->fullPriceToString();
        }

        $output .= PHP_EOL;

        return $output;
    }

}