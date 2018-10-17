<?php
/**
 * Created by PhpStorm.
 * User: Tom
 * Date: 16.10.2018
 * Time: 18:52
 */

namespace TestCart;

class Cart
{
    use Discountable;

    /**
     * @var Product[] $products
     */
    private $products = [];

    /**
     * @var CartEditor $editor
     */
    private $editor;

    /**
     * @var CartDB $db
     */
    private $db;

    /**
     * Cart constructor.
     * @param CartEditor $editor
     * @param CartDB $db
     */
    public function __construct($editor, $db)
    {
        $this->editor = $editor;
        $this->db = $db;
    }

    /**
     * @param int $productID
     */
    public function addWithID($productID)
    {
        $this->products = $this->editor->addWithID($this->products, $productID);
    }

    /**
     * @param Product $product
     */
    public function add($product)
    {
        $this->products = $this->editor->add($this->products, $product);
    }

    /**
     * @param int $productID
     */
    public function removeByID($productID)
    {
        $this->products = $this->editor->removeByID($this->products, $productID);
    }

    /**
     * @param int $index
     */
    public function removeByIndex($index)
    {
        $this->products = $this->editor->removeByIndex($this->products, $index);
    }

    /**
     * @param Product $product
     */
    public function remove($product)
    {
        $this->products = $this->editor->remove($this->products, $product);
    }

    public function save()
    {
        $this->db->save($this);
    }

    /**
     * @param float $fullprice
     * @return string
     */
    public function toString($fullprice)
    {
        return (new CartToString())->formString($this, $fullprice);
    }

    /**
     * @return array
     */
    public function getProducts(): array
    {
        return $this->products;
    }

    /**
     * @return int
     */
    public function getProductsAmount()
    {
        return count($this->products);
    }

    /**
     * @param bool $fullprice
     * @return float
     */
    public function getCartValue($fullprice)
    {
        return (new CartValue())->countValue($this, $fullprice);
    }

    public function load()
    {
        return $this->db->load();
    }

    /**
     * @param float $discount
     */
    public function setDiscount($discount)
    {
        $this->changeDiscount('cart', $discount);
    }

    /**
     * @param string $name
     * @param float $value
     */
    public function changeDiscount($name, $value)
    {
        $this->applyDiscount($name, $value);
        foreach ($this->products as $product) {
            $product->applyDiscount($name, $value);
        }
    }

    public function resetDiscount()
    {
        $this->changeDiscount('cart', 0);
    }
}

class CartValue
{
    /**
     * @param Cart $cart
     * @param bool $fullprice
     * @return float
     */
    public function countValue($cart, $fullprice)
    {
        /**
         * @var float $value
         */
        $value = 0;

        /**
         * @var Product $product
         */
        foreach ($cart->getProducts() as $product) {
            $value += $product->getPrice($fullprice);
        }

        return $value;
    }
}

class CartToString
{
    /**
     * @param Cart $cart
     * @param bool $fullprice
     * @return string
     */
    public function formString($cart, $fullprice)
    {
        /**
         * @var string $output
         */
        $output = '';

        $output .= 'Cart contains '.$cart->getProductsAmount().' products:'.PHP_EOL;
        /**
         * @var Product $product
         */
        foreach ($cart->getProducts() as $product) {
            $output .= $product->toString($fullprice).PHP_EOL;
        }

        $output .= 'and it\'s total cost: '.$cart->getCartValue($fullprice).PHP_EOL;

        return $output;
    }
}

class CartEditor
{
    /*
     * add, remove
     */

    /**
     * @param Product[] $products
     * @param Product $product
     * @return Product[]
     */
    public function add($products, $product)
    {
        $products[] = $product;

        return $products;
    }

    /**
     * @param array $products
     * @param int $productID
     * @return Product[]
     */
    public function addWithID($products, $productID)
    {
        $products[] = (new ProductDB())->getByID($productID);

        return $products;
    }

    /**
     * @param array $products
     * @param Product $product
     * @return Product[]
     */
    public function remove($products, $product)
    {
        /**
         * @var Product $productIterator
         */
        foreach ($products as $productIterator) {
            if ($productIterator->getId() == $product->getId()) {
                unset($productIterator);
                break;
            }
        }

        return $products;
    }

    /**
     * @param array $products
     * @param int $productID
     * @return Product[]
     */
    public function removeByID($products, $productID)
    {
        /**
         * @var Product $product
         */
        foreach ($products as $product) {
            if ($product->getId() == $productID) {
                unset($product);
                break;
            }
        }

        return $products;
    }

    /**
     * @param array $products
     * @param int $index
     * @return Product[]
     */
    public function removeByIndex($products, $index)
    {
        foreach ($products as $i => $item) {
            if ($i == $index) {
                unset($item);
                break;
            }
        }

        return $products;
    }
}

class CartDB
{
    /*
     * save, load with db
     */
    use DBAble;

    public function __construct()
    {
        $this->setDB(new FakeTable());
        $this->setTable('cart');
    }

    /**
     * @param Cart $cart
     */
    public function save($cart)
    {
        $this->writeWithID(0, $cart);
    }

    /**
     * @return Cart
     */
    public function load()
    {
        return $this->getByID(0);
    }
}