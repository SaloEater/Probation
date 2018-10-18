<?php
/**
 * Created by PhpStorm.
 * User: Tom
 * Date: 18.10.2018
 * Time: 9:29
 */

namespace Discount;

class WhoDepends
{
    /**
     * @var \SplObjectStorage $dependent
     */
    private $dependent;

    public function __construct()
    {
        $this->dependent = new \SplObjectStorage();
    }

    public function add($item)
    {
        $this->dependent->attach($item);
    }

    public function remove($item)
    {
        $this->dependent->detach($item);
    }

    /**
     * @param string $name
     * @param float $discount
     */
    public function updateDiscount($name, $discount)
    {
        foreach ($this->dependent as $item) {
            $item->updateAnotherDiscount($name, $discount);
        }
    }
}