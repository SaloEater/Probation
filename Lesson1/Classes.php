<?php
/**
 * Created by PhpStorm.
 * User: Tom
 * Date: 27.09.2018
 * Time: 14:46
 */

require_once 'Humans/human.php';
require_once 'Humans/student.php';
require_once 'Humans/worrker.php';
require_once 'Humans/manager.php';

//TODO Understand parent to child assigning

//TODO Replace back _ functions and add constructor to traits

$simpleHuman = Human::create()->setAge(15)->setName('Igor')->setSurname('Ogurec');

$simpleStudent = Student::create()->Apply($simpleHuman)->AddMathMark(5)->SetCourseNum(2);
echo 'Student received this mark today: ' . PHP_EOL . $simpleStudent->GetMarksString() . PHP_EOL;
$simpleWorker = Worrker::create()->Apply($simpleHuman)->SetSalary(5000)->Pay('30.09.2018')->PaySalary('29.09.2018', 5500);
echo 'Worker ' . $simpleWorker->getSurname() . ' asked for salary list: ' . PHP_EOL. $simpleWorker->GetSalaryList() . PHP_EOL;
$anotherSimpleWorker = Worrker::create()->Apply($simpleHuman)->setName('Nikita')->SetSalary(5000)->Pay('30.09.2018');

$simpleManager = Manager::create()->setAge(32)->setName('Vasya')->setSurname('Omega')->SetSalary(25000);
$simpleManager->AddEmployer($simpleWorker)->AddEmployer($anotherSimpleWorker);
echo 'Manager ' . $simpleManager->getSurname() . ' has these workers: ' . PHP_EOL.$simpleManager->GetEmployerSurnames() . PHP_EOL;

echo 'Already had beed created next classes: ' .PHP_EOL. Worrker::GetAmount() . PHP_EOL;


?>