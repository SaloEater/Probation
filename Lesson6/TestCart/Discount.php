<?php
/**
 * Created by PhpStorm.
 * User: Tom
 * Date: 16.10.2018
 * Time: 18:52
 */

namespace TestCart;

trait Discountable
{
    /**
     * @var array $discount
     */
    private $discounts;

    public function __construct()
    {
        $this->applyOwnDiscount(0);
    }

    public function applyOwnDiscount($value)
    {
        $this->applyDiscount('self', $value);
    }

    /**
     * @param string $name
     * @param float $value
     */
    public function applyDiscount($name, $value)
    {
        $this->discounts[$name] = $value;
    }

    /**
     * @return array
     */
    public function getDiscounts()
    {
        return $this->discounts;
    }

    public function resetOwnDiscount()
    {
        $this->applyOwnDiscount(0);
    }

    /**
     * @return string
     */
    public function getDiscountValue()
    {
        $output = '';
        $i = 1;
        foreach ($this->discounts as $discount) {
            if ($discount == 0) {
                $i++;
                continue;
            }
            if (count($this->discounts) == $i) {
                $output .= $discount.'%';
            } else {
                $output .= $discount.'% and ';
            }
            $i++;
        }

        return $output;
    }

    /**
     * @param float $price
     * @return float
     */
    public function getDiscountedPrice($price)
    {
        foreach ($this->discounts as $discount) {
            $price = $price * (1 - $discount / 100);
        }

        return $price;
    }

}