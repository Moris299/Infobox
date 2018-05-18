<?php
$tpl->set("dailyInfo", "{$dailyInfo->getDailyInfo()}");
$tpl->set("dailyInfoDay", "{$dailyInfo->getDayNum()}");
$tpl->set("dailyInfoMonth", "{$dailyInfo->getMonth()}");
$tpl->set("dailyInfoWeekOfYear", "{$dailyInfo->getWeekOfYear()}");
$tpl->set("dailyInfoDayOfYear", "{$dailyInfo->getDayOfYear()}");
$tpl->set("sunriseTime", "{$dailyInfo->getSunriseTime()}");
$tpl->set("sunsetTime", "{$dailyInfo->getSunsetTime()}");
$tpl->set("dayOfWeek", "{$dailyInfo->getDayOfWeek()}");

$tpl->set("birthdays", "{$birthdays->getTodaysBirthdays()}");
$tpl->set("events", "{$events->getTodaysEvents()}");
$tpl->set("moveableEvents", "{$moveableEvents->getMoveableEvents()}");
$tpl->set("upcomingEvents", "{$events->getUpcomingImportantEvents()}");

echo $tpl->output();