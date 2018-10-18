<?php
/**
 * Created by PhpStorm.
 * User: Tom
 * Date: 17.10.2018
 * Time: 21:58
 */

namespace Helpers\Product;

require_once __DIR__.'\..\..\Table\TableTrait.php';
require_once __DIR__.'\..\..\Table\FakeTable.php';

use Helpers\Table\FakeTable;
use Helpers\Table\TableTrait;

class ProductDB
{
    use TableTrait;

    public function __construct()
    {
        $this->setDB(new FakeTable());
        $this->setTable('products');
    }
}