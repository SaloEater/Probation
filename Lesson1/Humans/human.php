<?php
/**
 * Created by PhpStorm.
 * User: Tom
 * Date: 02.10.2018
 * Time: 13:02
 */

class Human
{
    protected $surname,
        $name,
        $patronymic,
        $age;

    /**
     * @var array[]
     */
    public static $counter;

    public function constructor()
    {
        $this->surname = '';
        $this->name = '';
        $this->patronymic = '';
        $this->age = -1;
        if(!isset(self::$counter['Human']))self::$counter['Human'] = 0;
        self::$counter['Human']++;
    }

    public function __destruct()
    {
        self::$counter['Human']++;
    }

    public static function create()
    {
        $instance = new self();
        $instance->constructor();
        return $instance;
    }

    public function getAge()
    {
        return $this->age;
    }

    public function getPatronymic()
    {
        return $this->patronymic;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getSurname()
    {
        return $this->surname;
    }

    function setAge(int $age)
    {
        $this->age = $age;
        return $this;
    }

    public function setName(string $name)
    {
        $this->name = $name;
        return $this;
    }

    public function setPatronymic(string $patronymic)
    {
        $this->patronymic = $patronymic;
        return $this;
    }

    public function setSurname(string $surname)
    {
        $this->surname = $surname;
        return $this;
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
    }

    public function Apply(Human $human)
    {
        $this->name = $human->getName();
        $this->surname = $human->getSurname();
        $this->patronymic = $human->getPatronymic();
        $this->age = $human->getAge();
        return $this;
    }

}
