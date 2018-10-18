<?php
/**
 * Created by PhpStorm.
 * User: Tom
 * Date: 18.10.2018
 * Time: 9:01
 */

namespace Discount;

require_once 'WhoDepends.php';

trait DiscountTrait
{

    /**
     * @var float $discount
     */
    protected $discount;
    /**
     * @var string $discountOwnerName
     */
    private $discountOwnerName;
    /**
     * @var WhoDepends $whoDepends
     */
    private $whoDepends;
    /**
     * @var array $influencedDiscounts
     */
    private $influencedDiscounts;

    /**
     * @return string
     */
    public function getDiscountName(): string
    {
        return $this->discountOwnerName;
    }

    /**
     * @param string $name
     */
    public function setDiscountName(string $name): void
    {
        $this->discountOwnerName = $name;
    }

    public function initDiscountTrait()
    {
        $this->whoDepends = new WhoDepends();
        $this->influencedDiscounts = [];
    }

    /**
     * @return WhoDepends
     */
    public function getWhoDepends(): WhoDepends
    {
        return $this->whoDepends;
    }

    /**
     * @param string $name
     * @param float $discount
     */
    public function updateAnotherDiscount($name, $discount)
    {
        $this->influencedDiscounts[$name] = $discount;
        $this->whoDepends->updateDiscount($name, $discount);
    }

    /**
     * @param string $name
     */
    public function resetAnotherDiscount($name)
    {
        $this->influencedDiscounts[$name] = 0;
        $this->whoDepends->updateDiscount($name, 0);
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
        $this->whoDepends->updateDiscount($this->discountOwnerName, $discount);
    }

    /**
     * @param object $product
     */
    public function initializeDependent($product)
    {
        $this->whoDepends->add($product);
        $product->updateAnotherDiscount($this->discountOwnerName, $this->discount);
        foreach ($this->influencedDiscounts as $index => $discount) {
            $product->updateAnotherDiscount($index, $discount);
        }
    }

}