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

    public function constructor()
    {
        $this->surname = '';
        $this->name = '';
        $this->patronymic = '';
        $this->age = -1;
    }

    public static function create()
    {
        $instance = new self();
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

}

class Student extends Human
{
    private $course,
        $marks;

    public function constructor()
    {
        parent::constructor();
        $this->marks = new Marks();
        $this->course = Course::create();
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
}

class Worrker extends Human
{
    private $salary,
            $payedSalary;

    public function constructor()
    {
        parent::constructor();
        $this->salary = 0;
        $this->payedSalary = [];
    }

    public static function create()
    {
        $instance = new self();
        $instance->constructor();
        return $instance;
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
        foreach ($this->payedSalary as $key => $value)
        {
            $output .= $key . ':' . $this->payedSalary[$key] . PHP_EOL;
        }
        return $output;
    }
}

class Manager extends Worrker
{
    private $employees;

    public function constructor()
    {
        parent::constructor();
        $this->employees = [];
    }

    public static function create()
    {
        $instance = new self();
        $instance->constructor();
        return $instance;
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
            $output .= $employee . PHP_EOL;
        }

        return $output;
    }

    public function GetEmployers()
    {
        return $this->employees;
    }
}

// TODO Наполнение
// TODO Подсчет всех объектов (через стат. переменные? Оо)

?>