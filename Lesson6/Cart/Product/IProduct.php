<?php
/**
 * Created by PhpStorm.
 * User: Tom
 * Date: 17.10.2018
 * Time: 20:56
 */

namespace Product;

require_once 'Helpers\IProductToString\IProductToString.php';
require_once __DIR__.'\..\Discount\DiscountTrait.php';

use Discount\DiscountTrait;
use Helpers\Product\IProductToString;

class IProduct
{
    use DiscountTrait;
    /**
     * @var int $id
     */
    private $id;

    /**
     * @var string $name
     */
    private $name;

    /**
     * @var float $price
     */
    private $price;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return float
     */
    public function getPrice(): float
    {
        return $this->price;
    }

    /**
     * @param float $price
     */
    public function setPrice($price): void
    {
        $this->price = $price;
    }

    /**
     * @param IProductToString $method
     * @return string
     */
    public function toString($method)
    {
        return $method->toString($this);
    }
}