<?php
/**
 * Created by PhpStorm.
 * User: Tom
 * Date: 16.10.2018
 * Time: 18:52
 */

namespace TestCart;

include 'Cart.php';

class Shop
{
    use Discountable;

    /**
     * @var Cart $cart
     */
    private $cart;

    /**
     * @var Product[] $products
     */
    private $products = [];

    /**
     * @var ShopOutput $shopOutput
     */
    private $shopOutput;

    /**
     * @var ShopEditor $shopEditor
     */
    private $shopEditor;

    public function __construct($shopOutput)
    {
        $this->shopOutput = $shopOutput;
        $this->shopEditor = new ShopEditor();
        $this->cart = new Cart(new CartEditor(), new CartDB());
    }

    /**
     * @param bool $fullprice
     */
    public function printCart($fullprice)
    {
        $this->shopOutput->printCart($this->cart, $fullprice);
    }

    /**
     * @param bool $fullprice
     */
    public function printProducts($fullprice)
    {
        $this->shopOutput->printProducts($this->products, $fullprice);
    }

    /**
     * @param float $discount
     */
    public function setDiscount($discount)
    {
        $this->changeDiscount('shop', $discount);
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
        $this->cart->changeDiscount($name, $value);
    }

    /**
     * @param Product[] $content
     */
    public function fill($content)
    {
        $this->shopEditor->fill($this, $content);
    }

    /**
     * @return Product[]
     */
    public function getProducts(): array
    {
        return $this->products;
    }

    /**
     * @param Product[] $products
     */
    public function setProducts(array $products): void
    {
        $this->products = $products;
    }

    /**
     * @return Cart
     */
    public function getCart(): Cart
    {
        return $this->cart;
    }

    /**
     * @param Cart $cart
     */
    public function setCart(Cart $cart): void
    {
        $this->cart = $cart;
    }

    /**
     * @param int $index
     * @return Product
     */
    public function getProductByIndex($index)
    {
        return $this->products[$index];
    }

    public function saveCart()
    {
        (new ShopCartOperator())->saveCart($this->cart);
    }

    public function loadCart()
    {
        (new ShopCartOperator())->loadCart($this, $this->cart);
    }
}

class ShopCartOperator
{
    /**
     * @param Cart $cart
     */
    public function saveCart($cart)
    {
        $cart->save();
    }

    /**
     * @param Shop $shop
     * @param Cart $cart
     */
    public function loadCart($shop, $cart)
    {
        $shop->setCart($cart->load());
    }
}

class ShopEditor
{
    /**
     * @param Shop $shop
     * @param Product[] $content
     */
    public function fill($shop, $content)
    {
        $shop->setProducts($content);
    }
}

class ShopOutput
{
    /**
     * @param Product[] $products
     * @param bool $fullprice
     */
    public function printProducts($products, $fullprice)
    {
        /**
         * @var string $output
         */
        $output = '';

        /**
         * @var Product $product
         */
        foreach ($products as $product) {
            $output .= $product->toString($fullprice).PHP_EOL;
        }

        echo 'Shop sells these items: '.PHP_EOL.
            $output.PHP_EOL;
    }

    /**
     * @param Cart $cart
     * @param bool $fullprice
     */
    public function printCart($cart, $fullprice)
    {
        echo $cart->toString($fullprice).PHP_EOL;
    }
}

/*
 * Все, что ниже - не нужно читать
 */

class IMenu
{
    /*
     * Умеет выводить и считывать с клавиатуры
     * Cодержит зарегистрированные на какой-то символ меню
     */

    /**
     * @var IMenu[] $registeredMenus
     */
    protected $registeredMenus;

    /**
     * @var string $menu
     */
    protected $menu;

    public function initMenu()
    {
        /**
         * Формируется $menu
         */
    }

    /**
     * @param string[1] $symbol
     * @param IMenu $menu
     */
    public function registerMenu($symbol, $menu)
    {
        $this->registeredMenus[$symbol] = $menu;
    }

    public function printMenu()
    {
        /*
         * Везде свой
         */
        echo $this->menu;
        $this->readSymbol();
    }

    protected function readSymbol()
    {

    }

}

class ShopMenu extends IMenu
{
    /*
     * Отвечает за вывод основного меню магазина
     */

}

class ShopMenuProducts extends ShopMenu
{
    /*
     * Отвечает за работу с продуктами
     */

}

class ShopMenuCart extends ShopMenu
{
    /*
     * Отвечает за работу с корзиной
     */
}