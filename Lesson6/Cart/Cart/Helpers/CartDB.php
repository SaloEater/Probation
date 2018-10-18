<?php
/**
 * Created by PhpStorm.
 * User: Tom
 * Date: 17.10.2018
 * Time: 22:32
 */

namespace Helpers\Cart;

require_once __DIR__.'\..\ICart.php';
require_once __DIR__.'\..\..\Table\TableTrait.php';
require_once __DIR__.'\..\..\Table\FakeTable.php';

use Cart\ICart;
use Helpers\Table\FakeTable;
use Helpers\Table\TableTrait;

class CartDB
{
    /*
     * save, load with db
     */
    use TableTrait;

    public function __construct()
    {
        $this->setDB(new FakeTable());
        $this->setTable('cart');
    }

    /**
     * @param ICart $cart
     */
    public function save($cart)
    {
        $this->writeWithID(0, $cart);
    }

    /**
     * @return ICart
     */
    public function load()
    {
        return $this->getByID(0);
    }
}