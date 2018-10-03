<?php
/**
 * Created by PhpStorm.
 * User: Tom
 * Date: 03.10.2018
 * Time: 17:28
 */

trait payable
{
    protected $salary,
        $payedSalary;

    protected $_parent;

    protected function SetPayableParent($_parent)
    {
        $this->_parent = $_parent;
    }

    public function SetSalary(int $salary)
    {
        $this->salary = $salary;
        return $this->_parent;
    }

    public function PaySalary(string $date, int $salary)
    {
        $this->payedSalary[] = [$date=>$salary];
        return $this->_parent;
    }

    public function Pay(string $date)
    {
        $this->payedSalary[] = [$date=>$this->salary];
        return $this->_parent;
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

}