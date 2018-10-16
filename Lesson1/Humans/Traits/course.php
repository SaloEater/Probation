<?php
/**
 * Created by PhpStorm.
 * User: Tom
 * Date: 02.10.2018
 * Time: 13:12
 */

trait Course
{

    private $FULLTIME = 'fulltime';

    private $EXTRAMURAL='extramural';

    /**
     * @var int $num
     */
    private $num;

    /**
     * @var string $type
     */
    private $type;

    public function __construct()
    {
        $this->num = 1;
        $this->type = $this->FULLTIME;
    }

    /**
     * @param int $num
     */
    public function setCourseNum($num)
    {
        $this->num = $num;
    }

    public function setFulltimeType()
    {
        $this->type = $this->FULLTIME;
    }

    public function setExtramuralType()
    {
        $this->type = $this->EXTRAMURAL;
    }
}