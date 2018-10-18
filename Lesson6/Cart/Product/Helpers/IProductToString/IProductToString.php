<?php
/**
 * Created by PhpStorm.
 * User: Tom
 * Date: 17.10.2018
 * Time: 21:26
 */

namespace Helpers\Product;

require_once __DIR__.'\..\..\IProduct.php';

use Product\IProduct;

abstract class IProductToString
{

    /**
     * @param IProduct $product
     * @return string
     */
    abstract public function toString($product);
}