<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<script>
// Set the date we're counting down to
var countDownDate = new Date("Jun 24, 2018 20:00:00").getTime();

// Update the count down every 1 second
var x = setInterval(function() {

    // Get todays date and time
    var now = new Date().getTime();
    
    // Find the distance between now an the count down date
    var distance = countDownDate - now;
    
    // Time calculations for days, hours, minutes and seconds
    var days = Math.floor(distance / (1000 * 60 * 60 * 24));
    var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
    var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
    var seconds = Math.floor((distance % (1000 * 60)) / 1000);
    
    // Output the result in an element with id="content"
    document.getElementById("counterMundial").innerHTML = days + "d " + hours + "g "
    + minutes + "m " + seconds + "s ";
    
    // If the count down is over, write some text 
    if (distance < 0) {
        clearInterval(x);
        document.getElementById("counterMundial").innerHTML = "Rozpoczęło się!";
    }
}, 1000);
</script>
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
                <p class="dailyInfoDayNum">[dailyInfoDay]</p>
                <p class="dailyInfoMonth">[dailyInfoMonth]</p>
                <p class="dailyInfoDayOfTheWeek">[dayOfWeek]</p>
                <p></p>
            </div>
            <div id="dailyInfoText">
                <div class="sunriseBox">
                    <img src="http://moris.pw/img/sunrise.png"> 
                    <p class="sunriseText">Wschód:<br /> [sunriseTime]</p>
                </div>
                <div class="sunsetBox">
                    <img src="http://moris.pw/img/sunset.png">
                    <p class="sunsetText">Zachód:<br /> [sunsetTime]</p>
                </div>
                
                <hr style="width: 100%;" />
                <p style="margin-top: 10px; margin-left: 11px;">[dailyInfoWeekOfYear] tydzień roku</p>
                <p style="margin-left: 11px;">[dailyInfoDayOfYear] dzień roku</p>
            </div>
        </div>
    </div>
    
    <div class="bar">
        <p>Dzisiejsze wydarzenia:</p>
    </div>
    <div class="content">
        [events]
        [moveableEvents]
    </div>
    
    <div class="bar">
        <p>Nadchodzące wydarzenia:</p>
    </div>
    <div class="content">
        [upcomingEvents]
    </div>

</div>
</body>
</head>
</html>
