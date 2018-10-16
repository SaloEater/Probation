<?php
/**
 * Created by PhpStorm.
 * User: Tom
 * Date: 03.10.2018
 * Time: 17:28
 */

trait payable
{
    protected $salary;
    protected $payedSalary;

    /**
     * @param int $salary
     */
    public function setSalary($salary)
    {
        $this->salary = $salary;
    }

    /**
     * @param string $date
     * @param int $salary
     */
    public function paySalary($date, $salary)
    {
        $this->payedSalary[] = [$date=>$salary];
    }

    /**
     * @param string $date
     */
    public function pay($date)
    {
        $this->payedSalary[] = [$date=>$this->salary];
    }

    /**
     * @return string
     */
    public function getSalaryList()
    {
        if ($this->payedSalary == []) {
            return 'Hadn\'t receive salary yet';
        }
        $output = '';
        foreach ($this->payedSalary as $salaryInfo) {
            foreach ($salaryInfo as $key => $value) {
                $output .= $key . ': ' . $value. PHP_EOL;
            }
        }
        return $output;
    }

}