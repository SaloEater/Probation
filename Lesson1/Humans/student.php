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

    /**
     * @var array $counter
     */
    public static $counter;

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
        self::register(self::class);
    }

    public function __destruct()
    {
        self::unregister(self::class);
    }

    /**
     * @return string
     */
    public function getMarksString()
    {
        $output = '';
        foreach ($this->getMarks() as $innerArray) {
            foreach ($innerArray as $key => $value) {
                $output .= $key.' - '.$value.PHP_EOL;
            }
        }

        return $output;
    }

    /**
     * @return array
     */
    public function getMarks(): array
    {
        return $this->getMarksList();
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

?>