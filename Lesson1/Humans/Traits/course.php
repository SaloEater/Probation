<?php
/**
 * Created by PhpStorm.
 * User: Tom
 * Date: 02.10.2018
 * Time: 13:12
 */

trait Course
{

    private $fulltime = 'fulltime',
        $extramural='extramural';

    private $num, $type;

    protected $_parent;

    protected function SetCourseParent($_parent)
    {
        $this->_parent = $_parent;
    }

    public function constructor()
    {
        $this->num = 1;
        $this->type = self::fulltime;
    }

    public function setCourseNum($num)
    {
        $this->num = $num;
        return $this->_parent;
    }

    public function setFulltimeType()
    {
        $this->type = $this->fulltime;
        return $this->_parent;
    }

    public function setExtramuralType()
    {
        $this->type = $this->extramural;
        return $this->_parent;
    }
}