<?php
/**
 * Created by PhpStorm.
 * User: Tom
 * Date: 05.10.2018
 * Time: 22:23
 */

/*
 * @var $date string
 */
$date = '2018-09-17 14:05:59';

/*
 * @var $transformDate DateTime
 */
$transformDate = DateTime::createFromFormat('Y-m-d H:i:s', $date);

echo date('d F Y, G часов i минут s секунд', $transformDate->getTimestamp());
