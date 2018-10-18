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

use Discount\DiscountTrait;
use Helpers\Cart\ICartToString;
use Helpers\Cart\LoyaltyCard;
use Helpers\Cart\Sellout;
use Product\IProduct;

class Cart extends ICart
{
    use DiscountTrait;

    /**
     * @var LoyaltyCard $loyaltyCard
     */
    private $loyaltyCard;

    public function __construct()
    {
        $this->initDiscountTrait();
        $this->setDiscountName('cart');
    }

    /**
     * @param IProduct $product
     * @param int $amount
     */
    public function addSome($product, $amount = 0)
    {
        for ($i = 0; $i < $amount; $i++) {
            $this->addOne($product);
        }
    }

    /**
     * @param IProduct $product
     */
    public function addOne($product)
    {
        $this->initializeDependent($product);
        $this->products[] = $product;
    }

    /**
     * @param IProduct $product
     */
    public function remove($product)
    {
        /**
         * @var IProduct $item
         */
        foreach ($this->products as $index => $item) {
            if ($item->getId() == $product->getId()) {
                $this->whoDepends->remove($item);
                unset($this->products[$index]);
            }
        }
    }

    /**
     * @param IProduct $product
     */
    public function removeAll($product)
    {
        /**
         * @var IProduct $item
         */
        foreach ($this->products as $index => $item) {
            if ($item->getName() == $product->getName()) {
                $this->whoDepends->remove($item);
                unset($this->products[$index]);
            }
        }
    }

    /**
     * @param int $index
     */
    public function removeByIndex($index)
    {
        if ($index < count($this->products)) {
            $this->whoDepends->remove($this->products[$index]);
            unset($this->products[$index]);
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
        $this->refreshSellout();
        $this->refreshLoyaltyCard();

        return $method->toString($this);
    }

    public function refreshSellout()
    {
        (new Sellout())->apply($this);
    }

    public function refreshLoyaltyCard()
    {
        $this->loyaltyCard->apply($this);
    }

}