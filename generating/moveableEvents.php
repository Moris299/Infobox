<?php
/*
******
FORMAT:
-----------
IF TYPE 1:
in database ('date' column):
x,y,z
mean:
x - day of week (1 - monday, 7 - sunday...)
y - numeric respresentation of week in month (1 - first week, 2 - second, ... l - last )
z - in which month (1 = January...)

examples:
"6, 2, 5" mean "second Saturday in May"
"1, 2, 9" mean "last Tuesday in September"
-----------
IF TYPE 2:


-----------

******
*/
namespace generating;
class moveableEvents
{
    private $database = null;
    private $monthTranslations = array(1 => 'stycznia', 'lutego', 'marca', 'kwietnia', 'maja', 'czerwca', 'lipca', 'sierpnia', 'września', 'października', 'listopada', 'grudnia'); 
    private $mysqlDatetime;
    private $currentDay;
    private $currentMonth;
    private $currentYear;
    private $currentNumericDayOfWeek;
    private $firstDayOfMonth;
    private $numericCurrentWeek;
    private $lastDayOfMonth;

    public function __construct($database) 
    {
        $this->database = $database;
        $this->mysqlDatetime = date("Y-m-d H:i:s");
        $this->currentDay = date("d");	
        $this->currentMonth = date("n");
        $this->currentYear = date("Y");
        $this->currentNumericDayOfWeek = date("N");
        $this->firstDayOfMonth = date("Y") . '-' . date("m") . '-' . '1';
        $this->lastDayOfMonth = date("t");
		$this->numericDayOfFirstWeek = date('N', strtotime("$this->firstDayOfMonth"));
    }
    
    public function getFormattedDate() 
    {
        //formatting current day to "x,y,z" (type 1)
        if($this->currentDay > $this->lastDayOfMonth - 7) {
            return $this->currentNumericDayOfWeek . ',' . 'l' . '.' . $this->currentMonth;
        } else {
            $this->numericCurrentWeek = floor($this->currentDay / 7) + 1;
            return $this->currentNumericDayOfWeek . ',' . $this->numericCurrentWeek . ',' . $this->currentMonth;
        }
    }
    
    public function countMoveableEvents()
    {
        $sth = $this->database->prepare("SELECT * FROM `moveableEvents` WHERE `date` = '{$this->getFormattedDate()}'");
        $sth->execute();

        return $sth->rowCount();
    }
    
    public function getMoveableEvents() 
    {
        $sth = $this->database->prepare("SELECT * FROM `moveableEvents` WHERE `date` = '{$this->getFormattedDate()}'");
        $sth->execute();
        
        $result = $sth->fetchAll();
        $count = 0;
        while(!is_null($result["$count"]))
        {
            $return .= '<p  style="margin-left: 6px; margin-right: 6px;">* ';
            $return .= $result["$count"]['name'];
            $return .= '</p>';
            $count++;
        }
        return $return;

    }
    
}
