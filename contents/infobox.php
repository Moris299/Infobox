<?php
$tpl->generateElement('dailyInfoContainer');
$tpl->generateElement('eventsTodayContainer');

if($events->countUpcomingImportantEvernts > 0) {
    $tpl->generateElement('upcomingImportantEvents');
}

$tpl->setValue("dailyInfo", "{$dailyInfo->getDailyInfo()}");
$tpl->setValue("dailyInfoDay", "{$dailyInfo->getDayNum()}");
$tpl->setValue("dailyInfoMonth", "{$dailyInfo->getMonth()}");
$tpl->setValue("dailyInfoWeekOfYear", "{$dailyInfo->getWeekOfYear()}");
$tpl->setValue("dailyInfoDayOfYear", "{$dailyInfo->getDayOfYear()}");
$tpl->setValue("sunriseTime", "{$dailyInfo->getSunriseTime()}");
$tpl->setValue("sunsetTime", "{$dailyInfo->getSunsetTime()}");
$tpl->setValue("dayOfWeek", "{$dailyInfo->getDayOfWeek()}");

$tpl->setValue("username", "$_GET[u]");

$tpl->setValue("birthdays", "{$birthdays->getTodaysBirthdays()}");
$tpl->setValue("events", "{$events->getTodaysEvents()}");
$tpl->setValue("moveableEvents", "{$moveableEvents->getMoveableEvents()}");
$tpl->setValue("upcomingEvents", "{$events->getUpcomingImportantEvents()}");

$now = time(); // or your date as well
$your_date = strtotime("2018-06-14");
$datediff = $now - $your_date;

$datediff = round($datediff / (60 * 60 * 24));
$datediff = $datediff*(-1);
$tpl->setValue("mistrzostwa", "$datediff dni");

echo $tpl->output();