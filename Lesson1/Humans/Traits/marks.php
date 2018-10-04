<?php
/**
 * Created by PhpStorm.
 * User: Tom
 * Date: 02.10.2018
 * Time: 13:16
 */

trait Marks
{
    private $math = 'mathematica',
        $phys = 'physical',
        $econ = 'economy';
    private $marksList;

    protected $_parent;

    protected function SetMarksParent($_parent)
    {
        $this->_parent = $_parent;
    }

    public function constructor()
    {
        $this->marksList = [];
    }

    public function getMarksList() : array
    {
        return $this->marksList;
    }

    public function AddMathMark($value)
    {
        $this->marksList[] = [$this->math => $value];
        return $this->_parent;
    }

    public function AddPhysMark($value)
    {
        $this->marksList[] = [$this->phys => $value];
        return $this->_parent;
    }

    public function AddEconomyMark($value)
    {
        $this->marksList[] = [$this->econ => $value];
        return $this->_parent;
    }

}

?>