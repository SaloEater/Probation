<?php
/**
 * Created by PhpStorm.
 * User: Tom
 * Date: 17.10.2018
 * Time: 21:26
 */

namespace Helpers\Product;

require_once __DIR__.'\..\..\Product.php';

use Product\Product;

class ProductToStringWithFullPrice extends IProductToString
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
        $output .= 'Price: '.$product->fullPriceToString();

        return $output;
    }

}