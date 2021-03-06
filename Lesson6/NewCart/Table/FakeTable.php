<?php
/**
 * Created by PhpStorm.
 * User: Tom
 * Date: 17.10.2018
 * Time: 22:02
 */

namespace Helpers\Table;

require_once 'ITable.php';

class FakeTable extends ITable
{

    /**
     * @param int $id
     * @return mixed
     */
    public function readByID($id)
    {
        /**
         * @var mixed $element
         */
        $element = null;

        foreach (self::$fakedb[$this->table] as $index => $item) {
            if ($index == $id) {
                $element = $item;
                break;
            }
        }

        return $element;
    }

    public function writeWithID($id, $content)
    {
        self::$fakedb[$this->table][$id] = $content;
    }

    public function write($content)
    {
        self::$fakedb[$this->table][] = $content;
    }

    public function all()
    {
        return self::$fakedb[$this->table];
    }

}