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
    /**
     * @var array[]
     */
    public static $counter = [];
    /**
     * @var array $employees
     */
    protected $employees;

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
        parent::__construct($surname, $name, $partonymic, $age);
        $this->constructAction();
    }

    private function constructAction()
    {
        $this->employees = [];
        self::register(self::class);
    }

    public function __destruct()
    {
        self::unregister(self::class);
    }

    /**
     * @param Worrker $employer
     */
    public function addEmployer($employer)
    {
        $this->employees[] = $employer;
    }

    /**
     * @param string $surname
     * @return bool
     */
    public function removeEmployer($surname)
    {
        $removed = false;
        foreach ($this->employees as $employee) {
            if ($employee->surname == $surname) {
                $removed = true;
                unset($employee);
                break;
            }
        }

        return $removed;
    }

    /**
     * @return string
     */
    public function getEmployerSurnames()
    {
        if ($this->employees == []) {
            return '';
        }

        $output = '';

        foreach ($this->employees as $employee) {
            $output .= $employee->surname.PHP_EOL;
        }

        return $output;
    }

    /**
     * @return array
     */
    public function getEmployers()
    {
        return $this->employees;
    }

    protected function register($className)
    {
        if (!isset(self::$counter[$className])) {
            self::$counter[$className] = 0;
        }
        self::$counter[$className]++;
        parent::register($className);
    }

    protected function unregister($className)
    {
        if (isset(self::$counter[$className])) {
            self::$counter[$className]--;
        }
        parent::unregister($className);
    }
}