<?php
/**
 * Created by PhpStorm.
 * User: Tom
 * Date: 17.10.2018
 * Time: 22:24
 */

namespace Cart;

require_once 'Helpers\ICartToString\ICartToString.php';

use Helpers\Cart\ICartToString;

abstract class ICart
{
    /**
     * @var array $products
     */
    protected $products = [];
    protected $id;

    public function __construct($id)
    {
        $this->id = $id;
    }

    /**
     * @return array
     */
    public function getProducts(): array
    {
        return $this->products;
    }

    /**
     * @param array $products
     */
    public function setProducts(array $products): void
    {
        $this->products = $products;
    }

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
     * @param ICartToString $method
     * @return string
     */
    public function print(ICartToString $method)
    {
        return $method->toString($this);
    }

}