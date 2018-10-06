<?php
/**
 * Created by PhpStorm.
 * User: Tom
 * Date: 05.10.2018
 * Time: 22:34
 */


/*
 * @var $dateStr string
 */
$dateStr = '22.03.1998 00:00:00';

/*
 * @var $date DateTime
 */
$date = DateTime::createFromFormat('d.m.Y H:i:s', $dateStr);

/*
 * @var $now DateTime
 */
$now = new DateTime('NOW');
$now->add(new DateInterval('PT3H'));

/*
 * @var $interval DateInterval
 */
$interval = $date->diff($now);

$years = $interval->y;
echo 'Years: ' . $years . PHP_EOL;
$months = $years*12 + $interval->m;
echo 'Months: ' . $months . PHP_EOL;
$days = $interval->days;
echo 'Dayss: ' . $days . PHP_EOL;
$hours = $days*24 + $interval->h;
echo 'Hours: ' . $hours . PHP_EOL;
$minutes = $hours * 60 + $interval->i;
echo 'Minutes: ' . $minutes . PHP_EOL;
$seconds = $minutes * 60 + $interval->s;
echo 'Seconds: ' . $seconds . PHP_EOL;
