<?php
/**
 * Created by PhpStorm.
 * User: Tom
 * Date: 17.10.2018
 * Time: 23:05
 */

namespace Helpers\Cart;

require_once __DIR__.'\..\..\ICart.php';

use Cart\ICart;

abstract class ICartValue
{
    /**
     * @param ICart $cart
     * @return float
     */
    abstract public function countValue($cart);
}