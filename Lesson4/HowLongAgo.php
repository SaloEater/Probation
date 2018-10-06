<?php
/**
 * Created by PhpStorm.
 * User: Tom
 * Date: 06.10.2018
 * Time: 11:53
 */

/**
 * @param DateTime $date
 * @return string
 */
function CountInterval($date)
{
    /*
     * @var $interval DateInterval
     */
    $now = new DateTime('NOW', new DateTimeZone('Europe/London'));

    $interval = $date->diff($now);

    if ($interval->y > 0) {
        $passed =  $interval->y.' year(s)'.PHP_EOL;
    } elseif ($interval->m > 0) {
        $passed =  $interval->m.' month(s)'.PHP_EOL;
    } elseif ($interval->d > 0) {
        $passed =  $interval->d.' day(s)'.PHP_EOL;
    } elseif ($interval->h > 0) {
        $passed =  $interval->h.' hour(s)'.PHP_EOL;
    } elseif ($interval->i > 0) {
        $passed =  $interval->i.' minute(s)'.PHP_EOL;
    } elseif ($interval->s > 0) {
        $passed =  $interval->s.' second(s)'.PHP_EOL;
    } else {
        $passed = ' Right now' . PHP_EOL;
    }


    return $passed;
}

$passed = CountInterval(new DateTime('22.03.1998T00:00:00'));
echo $passed . PHP_EOL;
