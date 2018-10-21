<?php
/**
 * Created by PhpStorm.
 * User: Tom
 * Date: 17.10.2018
 * Time: 22:41
 */

namespace Cart;

require_once __DIR__.'\..\Product\IProduct.php';
require_once __DIR__.'\..\Discount\DiscountTrait.php';
require_once 'ICart.php';
require_once 'Helpers\Sellout\Sellout.php';
require_once 'Helpers\LoyaltyCard\LoyaltyCard.php';
require_once 'Helpers\CartDB.php';

use Discount\DiscountTrait;
use Helpers\Cart\CartDB;
use Helpers\Cart\ICartToString;
use Helpers\Cart\LoyaltyCard;
use Helpers\Cart\Sellout;
use Helpers\Product\ProductDB;
use Product\Product;

class Cart extends ICart
{
    use DiscountTrait;

    /**
     * @var CartDB $cartDB
     */
    private $cartDB;

    /**
     * @var LoyaltyCard $loyaltyCard
     */
    private $loyaltyCard;

    public function __construct($id = 0)
    {
        parent::__construct($id);
        $this->loyaltyCard = new LoyaltyCard();
        $this->initDiscountTrait();
        $this->cartDB = new CartDB();
    }

    /**
     * @param int $productID
     * @param int $amount
     */
    public function addSome($productID, $amount = 0)
    {
        for ($i = 0; $i < $amount; $i++) {
            $this->addOne($productID);
        }
    }

    /**
     * @param int $productID
     */
    public function addOne($productID)
    {
        if (!isset($this->products[$productID])) {
            $this->products[$productID] = 0;
        }
        $this->products[$productID]++;
    }

    /**
     * @param int $productID
     */
    public function remove($productID)
    {
        unset($this->products[$productID]);
    }

    public function clear()
    {
        foreach ($this->products as $index => $item) {
            unset($this->products[$index]);
        }
    }

    /**
     * @param int $index
     */
    public function removeByIndex($index)
    {
        if ($index < count($this->products)) {
            /**
             * @var int $i
             */
            $i = 0;
            foreach ($this->products as $ind => $value) {
                if ($i == $index) {
                    unset($this->products[$ind]);
                    break;
                }
                $i++;
            }
        }
    }

    /**
     * @return int
     */
    public function getProductsAmount()
    {
        return count($this->products);
    }

    /**
     * @param ICartToString $method
     * @return string
     */
    public function toString($method)
    {
        return $method->toString($this);
    }

    public function getAmountOf($id)
    {
        return $this->products[$id];
    }

    public function getFullPriceProducts()
    {
        /**
         * @var Product[] $products
         */
        $products = [];

        /**
         * @var ProductDB $pDB
         */
        $pDB = new ProductDB();
        foreach ($this->products as $index => $product) {
            $products[] = $pDB->formFromID($index);
            $products[count($this->products) - 1]->setAmount($product);
        }

        return $products;
    }

    public function getDiscountedPriceProducts()
    {
        /**
         * @var Product[] $products
         */
        $products = [];

        /**
         * @var ProductDB $pDB
         */
        $pDB = new ProductDB();
        $sellout = $this->getSellout();
        $loyalty = $this->getLoyaltyCard();
        foreach ($this->products as $index => $product) {
            $products[] = $pDB->formFromID($index);
            $products[count($this->products) - 1]->setAmount($product);
            $products[count($this->products) - 1]->updateAnotherDiscount('sellout', $sellout);
            $products[count($this->products) - 1]->updateAnotherDiscount('loyalty', $loyalty);
        }

        return $products;
    }

    public function getSellout()
    {
        return (new Sellout())->get();
    }

    public function getLoyaltyCard()
    {
        return $this->loyaltyCard->get();
    }

    public function save()
    {
        $this->cartDB->save($this);
    }

    public function load()
    {
        $this->cartDB->load($this);
    }
}