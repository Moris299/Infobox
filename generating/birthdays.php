<?php
namespace generating;
class birthdays 
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

    public function countTodaysBirthdays() 
    {
        $sth = $this->database->prepare("SELECT id FROM user WHERE MONTH(birthday) = '$this->currentMonth' AND DAY(birthday) = '$this->currentDay'");
        $sth->execute();
        
        return $sth->rowCount();
    }

    public function getTodaysBirthdays()
    {
        if($this->countTodaysBirthdays() > 0) {
            $sth = $this->database->prepare("SELECT * FROM user WHERE MONTH(birthday) = '$this->currentMonth' AND DAY(birthday) = '$this->currentDay'");
            $sth->execute();
            
            $result = $sth->fetchAll();            
            
            $count = 0;
            while(!is_null($result["$count"])) {
                $userBirthday = $result["$count"]['birthday'];
                $userBirthdayDay = date("j", strtotime($userBirthday));
                $userBirthdayMonth = date("n", strtotime($userBirthday));
                $userAge = $this->currentYear - date("Y", strtotime($userBirthday));
                
                $return .= '<p>';
                $return .= $result["$count"]['name'] . '(' . $userAge . ')';
                $return .= '</p>';
                $count++;
            }
            return $return;
        } else {
            return 'Dzisiaj nikt nie obchodzi urodzin';
        }
    }
    
    public function countUpcomingBirthdays() 
    {
        $sth = $this->database->prepare("
            SELECT * 
			FROM  user 
			WHERE  DATE_ADD(birthday, 
			INTERVAL YEAR(CURDATE())-YEAR(birthday)
			+ IF(DAYOFYEAR(CURDATE()) >= DAYOFYEAR(birthday),1,0)
			YEAR) 
			BETWEEN CURDATE() AND DATE_ADD(CURDATE(), INTERVAL 7 DAY) ORDER BY `birthday` DESC;
        ");
        $sth->execute();
        
        return $sth->rowCount();
    }
    
    public function getUpcomingBirthdays() 
    {
        $sth = $this->database->prepare("
            SELECT * 
			FROM  user 
			WHERE  DATE_ADD(birthday, 
			INTERVAL YEAR(CURDATE())-YEAR(birthday)
			+ IF(DAYOFYEAR(CURDATE()) >= DAYOFYEAR(birthday),1,0)
			YEAR) 
			BETWEEN CURDATE() AND DATE_ADD(CURDATE(), INTERVAL 7 DAY) ORDER BY `birthday` DESC;
        ");
        $sth->execute();
        
        $result = $sth->fetchAll();
        $count = 0;
        while(!is_null($result["$count"])) {
            $userBirthday = $result["$count"]['birthday'];
            $userBirthdayDay = date("j", strtotime($userBirthday));
            $userBirthdayMonth = date("n", strtotime($userBirthday));
            $userAge = $this->currentYear - date("Y", strtotime($userBirthday));
            
            $return .= '<p style="margin-top: 4px; margin-bottom: 1px;">';
            $return .= "$userBirthdayDay" . ' ' . $this->monthTranslations["$userBirthdayMonth"] . ' - ' . $result["$count"]['name'] . '(' . $userAge . ')';
            $return .= '</p>';
            $count++;
        }
        return $return;
    }
}