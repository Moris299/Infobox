<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<link rel="stylesheet" type="text/css" href="http://moris.pw/infoboxStyle.css?version=4">
<meta http-equiv="content-type" content="text/html; charset=utf-8">
</head>
<body>
<div id="main">

    <div class="bar">
        <p>Info:</p>
    </div>
    <div class="content" style="padding: 0px;">
        <div id="dailyInfoContainer">
            <div id="dailyInfoCalendar"> 
                <p class="dailyInfoDayNum">[@dailyInfoDay]</p>
                <p class="dailyInfoMonth">[@dailyInfoMonth]</p>
                <p class="dailyInfoDayOfTheWeek">[@dayOfWeek]</p>
                <p></p>
            </div>
            <div id="dailyInfoText">
                <div class="sunriseBox">
                    <img src="/infobox/img/sunrise.png"> 
                    <p class="sunriseText">Wschód:<br /> [@sunriseTime]</p>
                </div>
                <div class="sunsetBox">
                    <img src="/infobox/img/sunset.png">
                    <p class="sunsetText">Zachód:<br /> [@sunsetTime]</p>
                </div>
                
                <hr style="width: 100%;" />
                <p style="margin-top: 10px; margin-left: 11px;">[@dailyInfoWeekOfYear] tydzień roku</p>
                <p style="margin-left: 11px;">[@dailyInfoDayOfYear] dzień roku</p>
            </div>
        </div>
    </div>
	
	<div class="bar3">
        <p>Dzisiaj urodziny obchodzi:</p>
    </div>
    <div class="content4">
        [@birthdays]
    </div>
    
    <div class="bar">
        <p>Dzisiejsze wydarzenia:</p>
    </div>
    <div class="content">
        [@events]
        [@moveableEvents]
    </div>
    
    <div class="bar">
        <p>Nadchodzące wydarzenia:</p>
    </div>
    <div class="content">
        [@upcomingEvents]
    </div>

</div>
</body>
</head>
</html>
