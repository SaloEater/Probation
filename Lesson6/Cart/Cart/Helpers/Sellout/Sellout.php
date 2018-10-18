<?php
/**
 * Created by PhpStorm.
 * User: Tom
 * Date: 18.10.2018
 * Time: 11:48
 */

namespace Helpers\Cart;

require_once __DIR__.'\..\..\Cart.php';
require_once 'SelloutDB.php';

use Cart\Cart;

class Sellout
{
    /**
     * @param Cart $cart
     */
    public function apply($cart)
    {
        $cart->updateAnotherDiscount('shop', (new SelloutDB())->get());
    }
}