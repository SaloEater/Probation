<?php
/**
 * Created by PhpStorm.
 * User: Tom
 * Date: 16.10.2018
 * Time: 18:52
 */

namespace TestCart;

trait DBAble
{
    /**
     * @var ITable $db
     */
    private $db;

    /**
     * @param ITable $db
     */
    public function setDB($db)
    {
        $this->db = $db;
    }

    /**
     * @param int $id
     * @param mixed $content
     */
    public function writeWithID($id, $content)
    {
        $this->db->writeWithID($id, $content);
    }

    /**
     * @param string $table
     */
    public function setTable($table)
    {
        $this->db->setTable($table);
    }

    /**
     * @return array
     */
    public function all()
    {
        return $this->db->all();
    }

    /**
     * @param int $id
     * @return mixed
     */
    protected function getByID($id)
    {
        return $this->db->readByID($id);
    }
}

class ITable
{
    protected static $faketable = [
        'products' => [],
        'cart' => [],
    ];
    protected $table;

    /**
     * @param string $table
     * @param mixed $content
     */
    public static function updateFakebase($table, $content)
    {
        self::$faketable[$table] = $content;
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

class MySQLDB extends ITable
{

}

class FakeTable extends ITable
{

    public function readByID($id)
    {
        /**
         * @var mixed $element
         */
        $element = null;

        foreach (self::$faketable[$this->table] as $index => $item) {
            if ($index == $id) {
                $element = $item;
            }
        }

        return $element;
    }

    public function writeWithID($id, $content)
    {
        self::$faketable[$this->table][$id] = clone $content;
    }

    public function write($content)
    {
        self::$faketable[$this->table][] = clone $content;
    }

    public function all()
    {
        return self::$faketable[$this->table];
    }

}