<?php
/**
 * Created by PhpStorm.
 * User: Tom
 * Date: 02.10.2018
 * Time: 13:16
 */

trait Marks
{
    private $math = 'mathematica';
    private $phys = 'physical';
    private $econ = 'economy';
    private $marksList;

    public function __construct()
    {
        $this->marksList = [];
    }

    /**
     * @return array
     */
    public function getMarksList()
    {
        return $this->marksList;
    }

    /**
     * @param int $value
     */
    public function addMathMark($value)
    {
        $this->marksList[] = [$this->math => $value];
    }

    /**
     * @param int $value
     */
    public function addPhysMark($value)
    {
        $this->marksList[] = [$this->phys => $value];
    }

    /**
     * @param int $value
     */
    public function addEconomyMark($value)
    {
        $this->marksList[] = [$this->econ => $value];
    }

}

?>