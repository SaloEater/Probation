<?php
/**
 * Created by PhpStorm.
 * User: Tom
 * Date: 18.10.2018
 * Time: 11:33
 */

namespace Helpers\Cart;

require_once __DIR__.'\..\..\..\Table\TableTrait.php';
require_once __DIR__.'\..\..\..\Table\FakeTable.php';

use Helpers\Table\FakeTable;
use Helpers\Table\TableTrait;

class SelloutDB
{
    use TableTrait;

    public function __construct()
    {
        $this->setDB(new FakeTable());
        $this->setTable('sellout');
    }

    /**
     * @return float
     */
    public function get()
    {
        return $this->getByID(0);
    }
}