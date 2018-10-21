<?php
/**
 * Created by PhpStorm.
 * User: Tom
 * Date: 18.10.2018
 * Time: 9:01
 */

namespace Discount;

trait DiscountTrait
{

    /**
     * @var float $discount
     */
    protected $discount;
    /**
     * @var array $influencedDiscounts
     */
    private $influencedDiscounts;

    public function initDiscountTrait()
    {
        $this->influencedDiscounts = [];
    }

    /**
     * @param string $name
     * @param float $discount
     */
    public function updateAnotherDiscount($name, $discount)
    {
        $this->influencedDiscounts[$name] = $discount;
    }

    /**
     * @return float
     */
    public function getTotalDiscount()
    {
        return $this->discount + array_sum(array_values($this->influencedDiscounts));
    }

    /**
     * @return string
     */
    public function discountToString()
    {
        $output = '';
        if ($this->discount > 0) {
            $output .= $this->discount.'%';

            if (count($this->influencedDiscounts) > 0) {
                $output .= ' and ';
            }
        }

        $output .= implode('%, ', array_values(
            array_filter(
                $this->influencedDiscounts,
                function ($var) {
                    return $var > 0;
                }
            )
        ));

        if (count($this->influencedDiscounts) > 0) {
            $output .= '%';
        }

        return $output;
    }

    /**
     * @param float $price
     * @return float
     */
    public function applyDiscount($price)
    {
        $price *= (1 - $this->getDiscount() / 100);

        foreach ($this->influencedDiscounts as $discount) {
            $price *= (1 - $discount / 100);
        }

        return $price;
    }

    /**
     * @return float
     */
    public function getDiscount(): float
    {
        return $this->discount;
    }

    /**
     * @param float $discount
     */
    public function setDiscount(float $discount): void
    {
        $this->discount = $discount;
    }

}