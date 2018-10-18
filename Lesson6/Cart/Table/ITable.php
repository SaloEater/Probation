<?php
/**
 * Created by PhpStorm.
 * User: Tom
 * Date: 17.10.2018
 * Time: 22:01
 */

namespace Helpers\Table;

class ITable
{
    protected static $fakedb = [
        'products' => [],
        'cart' => [],
        'sellout' => [],
        'loyaltycard' => [],
    ];

    protected $table;

    /**
     * @param string $table
     * @param mixed $content
     */
    public static function updateFakebase($table, $content)
    {
        self::$fakedb[$table] = $content;
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function readByID($id)
    {
        return null;
    }

    /**
     * @param int $id
     * @param mixed $content
     */
    public function writeWithID($id, $content)
    {
    }

    /**
     * @param mixed $content
     */
    public function write($content)
    {
    }

    /**
     * @param string $table
     */
    public function setTable($table)
    {
        $this->table = $table;
    }

    /**
     * return array
     */
    public function all()
    {
        return [];
    }
}