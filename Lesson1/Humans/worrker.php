<?php
/**
 * Created by PhpStorm.
 * User: Tom
 * Date: 02.10.2018
 * Time: 13:08
 */

require_once 'human.php';
require_once 'Traits/payable.php';

class Worrker extends Human
{
    use payable;

    public static $counter = [];

    public function constructor()
    {
        parent::constructor();
        $this->SetPayableParent($this);
        $this->salary = 0;
        $this->payedSalary = [];
        if(!isset(self::$counter['Worrker']))self::$counter['Worrker'] = 0;
        self::$counter['Worrker']++;
        parent::Register('Worrker');
    }

    public function __destruct()
    {
        self::$counter['Worrker']--;
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

    public static function GetAmount() : string
    {
        $output = '';

        foreach(self::$counter as $key=>$value)
        {
            $output .= $key . ': ' . $value . PHP_EOL;
        }
        return $output;
    }

    public function Register($className)
    {
        if(!isset(self::$counter[$className]))self::$counter[$className] = 0;
        self::$counter[$className]++;
        parent::Register($className);
    }
}