<?php
/**
 * Created by PhpStorm.
 * User: Tom
 * Date: 27.09.2018
 * Time: 14:46
 */

require_once 'human.php';
require_once 'student.php';
require_once 'worrker.php';
require_once 'manager.php';

/**
 * @var string output
 */
$output = '';

/**
 * @var Human $simpleHuman
 */
$simpleHuman = new Human('Lazarev', 'Danil', 'D', 20);

/**
 * @var Student $simpleHuman
 */
$simpleStudent = new Student('Petrov', 'Simple', 'Human', 19);
$simpleStudent->addMathMark(5);
$simpleStudent->SetCourseNum(2);
$output .= 'Student ' . $simpleStudent->getSurname() . ' received this mark today: ' .
    PHP_EOL . $simpleStudent->GetMarksString() . PHP_EOL;

/**
 * @var Worrker $simpleHuman
 */
$simpleWorker = new Worrker('Korobei', 'Fast', 'Human', 25);
$simpleWorker->setSalary(5000);
$simpleWorker->Pay('30.09.2018');
$simpleWorker->PaySalary('29.09.2018', 5500);
$output .= 'Worker ' . $simpleWorker->getSurname() . ' asked for salary list: ' .
    PHP_EOL. $simpleWorker->GetSalaryList() . PHP_EOL;

/**
 * @var Worrker $anotherSimpleWorker
 */
$anotherSimpleWorker = new Worrker('Vasechkin', 'Clever', 'Human', 25);
$anotherSimpleWorker->setName('Nikita');
$anotherSimpleWorker->setSalary(5000);
$anotherSimpleWorker->Pay('30.09.2018');

/**
 * @var Manager $simpleManager
 */
$simpleManager = new Manager('Natruly', 'Dumb', 'Human', 49);
$simpleManager->setAge(32);
$simpleManager->setName('Vasya');
$simpleManager->setSurname('Omega');
$simpleManager->setSalary(25000);
$simpleManager->AddEmployer($simpleWorker);
$simpleManager->AddEmployer($anotherSimpleWorker);
$output .= 'Manager ' . $simpleManager->getSurname() . ' has these workers: ' .
    PHP_EOL.$simpleManager->GetEmployerSurnames() . PHP_EOL;

$output .= 'Already had beed created next Worrker classes: ' .PHP_EOL. Worrker::getAmount() . PHP_EOL;

file_put_contents('output.txt', $output);

?>