<?php
/**
 * Created by PhpStorm.
 * User: Tom
 * Date: 02.10.2018
 * Time: 13:02
 */

class Human
{
    /**
     * @var array[] $counter
     */
    public static $counter;

    /**
     * @var string $surname
     */
    protected $surname;

    /**
     * @var string $name
     */
    protected $name;

    /**
     * @var string $patronymic
     */
    protected $patronymic;

    /**
     * @var int $age
     */
    protected $age;

    /**
     * @return string
     */
    public static function getAmount()
    {
        $output = '';

        foreach (self::$counter as $key => $value) {
            $output .= $key.': '.$value.PHP_EOL;
        }

        return $output;
    }

    /**
     * @param string $surname
     * @param string $name
     * @param string $partonymic
     * @param int $age
     */
    public function __construct($surname, $name, $partonymic, $age)
    {
        $this->surname = $surname;
        $this->name = $name;
        $this->patronymic = $partonymic;
        $this->age = $age;
        self::register(self::class);
    }

    public function __destruct()
    {
        self::unregister(self::class);
    }

    protected function register($className)
    {
        if (!isset(self::$counter[$className])) {
            self::$counter[$className] = 0;
        }
        self::$counter[$className]++;
    }

    protected function unregister($className)
    {
        if (isset(self::$counter[$className])) {
            self::$counter[$className]--;
        }
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getSurname()
    {
        return $this->surname;
    }

    /**
     * @param string $surname
     */
    public function setSurname($surname)
    {
        $this->surname = $surname;
    }

    /**
     * @return string
     */
    public function getPatronymic()
    {
        return $this->patronymic;
    }

    /**
     * @param string $patronymic
     */
    public function setPatronymic($patronymic)
    {
        $this->patronymic = $patronymic;
    }

    /**
     * @return int
     */
    public function getAge()
    {
        return $this->age;
    }

    /**
     * @param int $age
     */
    public function setAge($age)
    {
        $this->age = $age;
    }
}
