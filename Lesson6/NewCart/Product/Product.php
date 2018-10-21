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

    /**
     * @param int $id
     * @param string $name
     * @param float $price
     * @param float $discount
     * @param int $amount
     */
    public function __construct($id, $name, $price, $discount = 0.0, $amount = 0)
    {
        $this->initDiscountTrait();

        $this->setId($id);
        $this->setName($name);
        $this->setPrice($price);
        $this->setDiscount($discount);
        $this->setAmount($amount);
    }

    public function discountedPriceToString()
    {
        $price = $this->discountedPriceOne();

        return $price.'x'.$this->amount.'='.$this->discountedPriceAll();
    }

    public function discountedPriceOne()
    {
        return $this->applyDiscount($this->price);
    }

    public function discountedPriceAll()
    {
        $price = $this->discountedPriceOne();

        return $price * $this->amount;
    }

    public function fullPriceToString()
    {
        $price = $this->fullPriceOne();

        return $price.'x'.$this->amount.'='.$this->fullPriceAll();
    }

    public function fullPriceOne()
    {
        return $this->price;
    }

    public function fullPriceAll()
    {
        $price = $this->fullPriceOne();

        return $price * $this->amount;
    }
}
