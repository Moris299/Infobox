<?php 
namespace generating;

class dailyInfo 
{
    private $translationDay = array('Mon' => 'poniedziałek', 'Tue' => 'wtorek', 'Wed' => 'środa', 'Thu' => 'czwartek', 'Fri' => 'piątek', 'Sat' => 'sobota', 'Sun' => 'niedziela');
    private $monthTranslations = array(1 => 'Stycznia', 'Lutego', 'Marca', 'Kwietnia', 'Maja', 'Czerwca', 'Lipca', 'Sierpnia', 'Września', 'Października', 'Listopada', 'Grudnia'); 
    private $sunTime;
    
    public function __construct() 
    {
         $this->sunTime = file_get_contents('http://moris.pw/infobox/generating/CRON/sunriseAndSunsetTimes.txt');
    }
    
    public function getDailyInfo() 
    {
        return 'Dziś jest ' . $this->translationDay[date("D")] . ', ' . date("j") . ' maja ' . date("Y") . 'r. <br>' 
        . 'Jest to ' . date("z") . ' dzień roku.' 
        . '<br> Pozostało ' . (365 - date("z")) . ' dni do końca roku. <br>'
        . 'Aktualnie trwa ' . date("W") . ' tydzień roku.';
    } 
    
    public function getDayNum() 
    {
        return date("j");
    }
    
    public function getMonth() 
    {
        return $this->monthTranslations[date("n")];
    }
    
    public function getDayOfWeek() 
    {
         return $this->translationDay[date("D")];
    }
    
    public function getDayOfYear() 
    {
        return date("z");
    }
    
    public function getWeekOfYear() 
    {
        return date("W");
    }
    
    //TODO: czas letni i zimowy, aktualnie na sztywno letni (Daylight saving time set now)
    public function getSunriseTime() 
    {
        $jsonData = json_decode($this->sunTime);
        $sunriseTimeUTC = strtotime($jsonData->results->sunrise);
        $sunriseTime = date("H:i", $sunriseTimeUTC + 2 * 3600);

        return $sunriseTime;
    }
    
    public function getSunsetTime() 
    {
        $jsonData = json_decode($this->sunTime);
        $sunsetTimeUTC = strtotime($jsonData->results->sunset);
        $sunsetTime = date("H:i", $sunsetTimeUTC + 2 * 3600);

        return $sunsetTime;
    }
    
}