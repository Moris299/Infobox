<?php
namespace generating;

class events 
{
    private $database = null;
    private $monthTranslations = array(1 => 'stycznia', 'lutego', 'marca', 'kwietnia', 'maja', 'czerwca', 'lipca', 'sierpnia', 'września', 'października', 'listopada', 'grudnia'); 
    private $mysqlDatetime;
    private $currentDay;
    private $currentMonth;
    private $currentYear;

    public function __construct($database) 
    {
        $this->database = $database;
        $this->mysqlDatetime = date("Y-m-d H:i:s");
        $this->currentDay = date("d");	
        $this->currentMonth = date("m");
        $this->currentYear = date("Y");
    }
    
    public function countTodaysEvents() 
    {
        $sth = $this->database->prepare("SELECT * FROM events WHERE MONTH(date) = '$this->currentMonth' AND DAY(date) = '$this->currentDay'");
        $sth->execute();
        
        return $sth->rowCount();
    }
    public function countUpcomingImportantEvernts() 
    {
        $sth = $this->database->prepare("SELECT * 
		FROM  events 
		WHERE  DATE_ADD(date, 
		INTERVAL YEAR(CURDATE())-YEAR(date)
		+ IF(DAYOFYEAR(CURDATE()) >= DAYOFYEAR(date),1,0)
		YEAR) 
		BETWEEN CURDATE() AND DATE_ADD(CURDATE(), INTERVAL 14 DAY) AND important = 1 ORDER BY `date` ASC; ");
        $sth->execute();
        
        return $sth->rowCount();
    }
    
    public function getTodaysEvents()
    {
        if($this->countTodaysEvents() > 0) {
            $sth = $this->database->prepare("SELECT * FROM events WHERE MONTH(date) = '$this->currentMonth' AND DAY(date) = '$this->currentDay'");
            $sth->execute();
            $drawHR = $this->countTodaysEvents() - 1;
            
            $result = $sth->fetchAll();
            $count = 0;
            while(!is_null($result["$count"])) {
                $eventDate = date("Y", strtotime($result["$count"]['date']));
                $eventElapsedYears = $this->currentYear - $eventDate;
                
                $return .= '<p  style="margin-left: 6px; margin-right: 6px;">';
                if(strlen($result["$count"]['alt']) > 0) {
                    $return .= $result["$count"]['alt'];
                } else {
                    $return .= $result["$count"]['name'];
                }
    
                if($result["$count"]['display_year'] > 0) {
                    $return .= $eventElapsedYears;
    				if($eventElapsedYears == 1) {
    				    $return .= ' rok temu';
    				}
    				if($eventElapsedYears > 1 && $eventElapsedYears < 5) {
                        $return .= ' lata temu';
    				}
    				if($eventElapsedYears >= 5) {
    				    $return .= ' lat temu';
    				}
                }
                if($drawHR > 0) {
                    $return .= '<hr style="width: 100%;">';
                    $drawHR--;
                }
                $return .= '</p>';
                $count++;
            }
            return $return;
        } else {
            return 'Brak wydarzeń';
        }
    }
    
    public function getUpcomingImportantEvents()
    {
        //TODO:
        //if no upcoming events in 2 weeks, get firstly event 
        
        $sth = $this->database->prepare("SELECT * 
		FROM  events 
		WHERE  DATE_ADD(date, 
		INTERVAL YEAR(CURDATE())-YEAR(date)
		+ IF(DAYOFYEAR(CURDATE()) >= DAYOFYEAR(date),1,0)
		YEAR) 
		BETWEEN CURDATE() AND DATE_ADD(CURDATE(), INTERVAL 14 DAY) AND important = 1 ORDER BY `date` ASC; ");
        $sth->execute();
        
        $result = $sth->fetchAll();
        $count = 0;
        while(!is_null($result["$count"])) {
            $eventDateYear = date("Y", strtotime($result["$count"]['date']));
            $eventElapsedYears = $this->currentYear - $eventDateYear;
            $eventDateDay = date("j", strtotime($result["$count"]['date']));
            $eventDateMonth = date("n", strtotime($result["$count"]['date']));
            
            $return .= '<p  style="margin-left: 6px; margin-right: 6px;">';
            if(strlen($result["$count"]['alt']) > 0) {
                $return .= "$eventDateDay" . ' ' . $this->monthTranslations["$eventDateMonth"] . ' - ' . $result["$count"]['alt'];
            } else {
                $return .= "$eventDateDay" . ' ' . $this->monthTranslations["$eventDateMonth"] . ' - ' . $result["$count"]['name'];
            }
            $return .= '</p>';
            $count++;
        }
        return $return;
    }
    
}