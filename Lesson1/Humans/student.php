<?php
/**
 * Created by PhpStorm.
 * User: Tom
 * Date: 02.10.2018
 * Time: 13:07
 */

require_once 'human.php';
require_once 'Traits/course.php';
require_once 'Traits/marks.php';

class Student extends Human
{
    use Marks;
    use Course;

    public static $counter = [];

    public function constructor()
    {
        parent::constructor();
        $this->SetCourseParent($this);
        $this->SetMarksParent($this);
        if(!isset(self::$counter['Student']))self::$counter['Student'] = 0;
        self::$counter['Student']++;
        parent::Register('Student');
    }

    public function __destruct()
    {
        self::$counter['Student']++;
    }

    public static function create()
    {
        $instance = new self();
        $instance->constructor();
        return $instance;
    }

    public function SetCourseNum($num)
    {
        $this->SetNum($num);
        return $this;
    }

    public function Apply(Human $human)
    {
        parent::Apply($human);
        return $this;
    }

    public function SetCourseType(string $type)
    {
        $this->SetType($type);
        return $this;
    }

    public function GetMarks()
    {
        return $this->getMarksList();
    }

    public static function GetAmount()
    {
        $output = '';

        foreach(self::$counter as $key=>$value)
        {
            $output .= $key . ': ' . $value . PHP_EOL;
        }
        return $output;
    }

    public  function Register($className)
    {
        if(!isset(self::$counter[$className]))self::$counter[$className] = 0;
        self::$counter[$className]++;
        parent::Register($className);
    }

    public function GetMarksString()
    {
        $output = '';
        foreach ($this->GetMarks() as $innerArray)
        {
            foreach ($innerArray as $key=>$value)
                $output .= $key . ' - ' . $value . PHP_EOL;
        }
        return $output;
    }

}

?>