<?php
/**
 * Created by PhpStorm.
 * User: Tom
 * Date: 17.10.2018
 * Time: 22:04
 */

namespace Helpers\Table;

require_once 'ITable.php';

trait TableTrait
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
    public function getByID($id)
    {
        return $this->db->readByID($id);
    }
}