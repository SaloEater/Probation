<?php
/**
 * Created by PhpStorm.
 * User: Tom
 * Date: 17.10.2018
 * Time: 22:17
 */

namespace Helpers\Table;

require_once 'ITable.php';
require_once __DIR__.'\..\Product\Product.php';

use Product\Product;

class FakeDBFiller
{
    public static function fillDB()
    {
        $fakeProducts = [];

        $fakeProducts[] = new Product(0, 'First', 5);
        $fakeProducts[] = new Product(1, 'Second', 10, 10);
        $fakeProducts[] = new Product(2, 'Third', 50);

        ITable::updateFakebase('products', $fakeProducts);

        ITable::updateFakebase('sellout', [35]);

        ITable::updateFakebase('loyaltycard', [15]);
    }
}