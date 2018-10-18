<?php
/**
 * Created by PhpStorm.
 * User: Tom
 * Date: 17.10.2018
 * Time: 20:56
 */

namespace Product;

require_once 'IProduct.php';
require_once 'Helpers\IProductToString\IProductToString.php';

class Product extends IProduct
{

    public function __construct($id, $name, $price, $discount = 0)
    {
        $this->initDiscountTrait();

        $this->setId($id);
        $this->setName($name);
        $this->setPrice($price);
        $this->setDiscount($discount);
        $this->setDiscountName('product');
    }
}
