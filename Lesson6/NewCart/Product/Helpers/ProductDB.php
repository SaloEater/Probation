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
require_once __DIR__.'\..\Product.php';

use Helpers\Table\FakeTable;
use Helpers\Table\TableTrait;
use Product\Product;

class ProductDB
{
    use TableTrait;

    public function __construct()
    {
        $this->setDB(new FakeTable());
        $this->setTable('products');
    }

    /**
     * @param $id
     * @return Product
     */
    public function formFromID($id)
    {
        /**
         * @var array $config
         */
        $config = $this->getByID($id);
        /**
         * @var Product $product ;
         */
        $product = null;

        if (count($config) == 2) {
            $product = new Product($id, $config['name'], $config['price']);
        } elseif (count($config) == 3) {
            $product = new Product($id, $config['name'], $config['price'], $config['discount']);
        } elseif (count($config) == 4) {
            $product = new Product($id, $config['name'], $config['price'], $config['discount'], $config['amount']);
        }

        return $product;
    }

    /**
     * @param Product $product
     */
    public function save($product)
    {
        $config = [
            'name' => $product->getName(),
            'price' => $product->getPrice(),
        ];
        if ($product->getDiscount() > 0) {
            $config['discount'] = $product->getDiscount();
            if ($product->getAmount() > 1) {
                $config['amount'] = $product->getAmount();
            }
        }
        $this->writeWithID($product->getId(), $config);
    }

}