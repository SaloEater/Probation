<?php
/**
 * Created by PhpStorm.
 * User: Tom
 * Date: 16.10.2018
 * Time: 18:52
 */

namespace TestCart;

include 'Discount.php';
include 'Database.php';

class Product
{
    /*id, название, цена, текущая скидка в процентах*/

    use Discountable;

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
     * @param bool $fullprice
     * @return float
     */
    public function getPrice($fullprice): float
    {
        return $fullprice ? $this->price : $this->getDiscountedPrice($this->price);
    }

    /**
     * @param float $price
     */
    public function setPrice(int $price): void
    {
        $this->price = $price;
    }

    /**
     * @param float $discount
     */
    public function setDiscount($discount)
    {
        $this->applyOwnDiscount($discount);
    }

    /**
     * @param bool $fullprice
     * @return string
     */
    public function toString($fullprice)
    {
        return (new ProductToString())->formString($this, $fullprice);
    }
}

class ProductToString
{
    /**
     * @param Product $product
     * @param bool $fullprice
     * @return string
     */
    public function formString($product, $fullprice)
    {
        /**
         * @var string $output
         */
        $output = '';

        $output .= '> '.$product->getId().PHP_EOL;
        $output .= 'Name: '.$product->getName().PHP_EOL;
        if ($fullprice) {
            $output .= 'Price: '.$product->getPrice($fullprice);
        } else {
            $output .= 'It\'s under ' . $product->getDiscountValue() . ' discount' . PHP_EOL .
                        'with new price ' . $product->getPrice($fullprice);
        }

        return $output;
    }
}

class ProductCreator
{
    /**
     * @param int $id
     * @param string $name
     * @param float $price
     * @param int $discount
     * @return Product
     */
    public function createProduct($id, $name, $price, $discount = 0)
    {
        /**
         * @var Product $product
         */
        $product = new Product();

        $product->setId($id);
        $product->setName($name);
        $product->setPrice($price);
        $product->applyOwnDiscount($discount);

        return $product;
    }
}

class ProductDB
{
    use DBAble;

    public function __construct()
    {
        $this->setDB(new FakeTable());
        $this->setTable('products');
    }
}