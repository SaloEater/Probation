<?php
/**
 * Created by PhpStorm.
 * User: Tom
 * Date: 02.10.2018
 * Time: 13:08
 */

require_once 'worrker.php';

class Manager extends Worrker
{
    protected $employees;


    /**
     * @var array[]
     */
    public static $counter = [];

    public function constructor()
    {
        parent::constructor();
        $this->employees = [];
        if(!isset(self::$counter['Manager']))self::$counter['Manager'] = 0;
        self::$counter['Manager']++;
        parent::Register('Manager');
    }

    public function __destruct()
    {
        self::$counter['Manager']--;
    }

    public static function create()
    {
        $instance = new self();
        $instance->constructor();
        return $instance;
    }

    public function Apply(Human $human)
    {
        parent::Apply($human);
        return $this;
    }

    public function AddEmployer(Worrker $employer)
    {
        $this->employees[] = $employer;
        return $this;
    }

    public function RemoveEmployer($surname)
    {
        $removed = false;
        foreach($this->employees as $employee)
        {
            if($employee->surname==$surname)
            {
                $removed = true;
                unset($employee);
                break;
            }
        }
        return $removed;
    }

    public function GetEmployerSurnames()
    {
        if($this->employees == [])return [];

        $output = '';

        foreach($this->employees as $employee)
        {
            $output .= $employee->surname . PHP_EOL;
        }

        return $output;
    }

    public function GetEmployers()
    {
        return $this->employees;
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
        parent::Register('Manager');
    }
}