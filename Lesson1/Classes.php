<?php
/**
 * Created by PhpStorm.
 * User: Tom
 * Date: 27.09.2018
 * Time: 14:46
 */

class Human
{
    protected $surname,
        $name,
        $patronymic,
        $age;
    public static $counter = [];

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

    function setAge($age)
    {
        $this->age = $age;
        return $this;
    }

    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    public function setPatronymic($patronymic)
    {
        $this->patronymic = $patronymic;
        return $this;
    }

    public function setSurname($surname)
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
    }

}

class CourseTypes
{
    const fulltime = 'fulltime',
        extramural='extramural';
}

class MarksTypes
{
    const math = 'math',
        phys = 'phys',
        econ = 'econ';
}

class Course
{
    private $num, $type;

    public function constructor()
    {
        $this->num = 1;
        $this->type = CourseTypes::fulltime;
    }

    public static function create()
    {
        $instance = new self();
        return $instance;
    }

    public function setNum($num)
    {
        $this->num = $num;
        return $this;
    }

    public function setType($type)
    {
        $this->type = $type;
        return $this;
    }
}

class Marks
{
    private $marksList;

    public function constructor()
    {
        $this->marksList = [];
    }

    public function getMarksList()
    {
        return $this->marksList;
    }

    public function AddMark($item, $value)
    {
        $this->marksList[$item] = $value;
        return $this;
    }

    public function __toString()
    {
        $str = '';
        foreach($this->marksList as $key=>$value)
            $str .= $key.' - '.$value . PHP_EOL;
        return $str;
    }

}

class Student extends Human
{
    private $course,
        $marks;

    public static $counter = [];

    public function constructor()
    {
        parent::constructor();
        $this->marks = new Marks();
        $this->course = Course::create();
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
        $this->course->SetNum($num);
        return $this;
    }

    public function Apply(Human $human)
    {
        parent::Apply($human);
        return $this;
    }

    public function SetCourseType($type)
    {
        $this->course->SetType($type);
        return $this;
    }

    public function GetMarks()
    {
        return $this->marks;
    }

    public function AddMark($item, $value)
    {
        $this->marks->AddMark($item, $value);
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
        parent::Register($className);
    }
}

class Worrker extends Human
{
    private $salary,
        $payedSalary;

    public static $counter = [];

    public function constructor()
    {
        parent::constructor();
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

    public function SetSalary($salary)
    {
        $this->salary = $salary;
        return $this;
    }

    public function PaySalary($date, $salary)
    {
        $this->payedSalary[] = [$date=>$salary];
        return $this;
    }

    public function Pay($date)
    {
        $this->payedSalary[] = [$date=>$this->salary];
        return $this;
    }

    public function GetSalaryList()
    {
        if ($this->payedSalary == []) return 'Hadn\'t receive salary yet';
        $output = '';
        foreach ($this->payedSalary as $salaryInfo)
        {
            foreach ($salaryInfo as $key=>$value)
                $output .= $key . ': ' . $value. PHP_EOL;
        }
        return $output;
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
}

class Manager extends Worrker
{
    private $employees;

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

    public function AddEmployer($employer)
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

//TODO Understand parent to child assigning

$simpleHuman = Human::create()->setAge(15)->setName('Igor')->setSurname('Ogurec');

$simpleStudent = Student::create()->Apply($simpleHuman)->AddMark(MarksTypes::math, 5)->SetCourseNum(2);
echo 'Student received this mark today: ' . PHP_EOL . $simpleStudent->GetMarks() . PHP_EOL;
$simpleWorker = Worrker::create()->Apply($simpleHuman)->SetSalary(5000)->Pay('30.09.2018')->PaySalary('29.09.2018', 5500);
echo 'Worker ' . $simpleWorker->getSurname() . ' asked for salary list: ' . PHP_EOL. $simpleWorker->GetSalaryList() . PHP_EOL;
$anotherSimpleWorker = Worrker::create()->Apply($simpleHuman)->setName('Nikita')->SetSalary(5000)->Pay('30.09.2018');

$simpleManager = Manager::create()->setAge(32)->setName('Vasya')->setSurname('Omega')->SetSalary(25000);
$simpleManager->AddEmployer($simpleWorker)->AddEmployer($anotherSimpleWorker);
echo 'Manager ' . $simpleManager->getSurname() . ' has these workers: ' . PHP_EOL.$simpleManager->GetEmployerSurnames() . PHP_EOL;

echo 'Already had beed created next classes: ' .PHP_EOL. Worrker::GetAmount() . PHP_EOL;


?>