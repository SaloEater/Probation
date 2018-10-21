<?php
/**
 * Created by PhpStorm.
 * User: Tom
 * Date: 17.10.2018
 * Time: 22:56
 */

namespace Helpers\Cart;


require_once __DIR__.'\..\..\ICart.php';

use Cart\ICart;

abstract class ICartToString
{
    /**
     * @param ICart $cart
     * @return string
     */
    abstract public function toString($cart);
}