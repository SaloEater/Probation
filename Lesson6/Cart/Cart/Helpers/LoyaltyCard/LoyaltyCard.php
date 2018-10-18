<?php
/**
 * Created by PhpStorm.
 * User: Tom
 * Date: 18.10.2018
 * Time: 11:59
 */

namespace Helpers\Cart;

require_once __DIR__.'\..\..\Cart.php';
require_once 'LoyaltyCardDB.php';

use Cart\Cart;

class LoyaltyCard
{
    /**
     * @param Cart $cart
     */
    public function apply($cart)
    {
        $cart->setDiscount((new LoyaltyCardDB())->get());
    }
}