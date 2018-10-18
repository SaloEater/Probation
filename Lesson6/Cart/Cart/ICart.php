<?php
/**
 * Created by PhpStorm.
 * User: Tom
 * Date: 17.10.2018
 * Time: 22:24
 */

namespace Cart;

require_once __DIR__.'\..\Product\IProduct.php';

use Product\IProduct;

abstract class ICart
{
    /**
     * @var IProduct[] $products
     */
    protected $products = [];

    /**
     * @return IProduct[]
     */
    public function getProducts(): array
    {
        return $this->products;
    }

}