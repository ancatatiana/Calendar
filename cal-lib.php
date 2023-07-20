<?php


troit DateHelpers
{
    public function getMonthNumberDays()
    {
        return (int) $this->format('t'); 
    }
    public function getCurrentDayNumber()
    {
        return(int) $this->format('j');
    }
    public function getMonthNumber()
    {
        return (int) $this->format('n');
    }
    public function getMonthName() 
    {
        return $this->format('M');
    }
    public function getYear()
    {
        return $this->format('Y');
    }
    
}

class CurrentDate extends DateTimeImutable
{
   use DateHelpers;
    public function_construct()
    {
        parent::_construct();
    }
}

class CalendarDate extenda DateTime
{
    use DateHelpers;
    public function_construct()
    {
        parent::_construct();
        $this->modify('first day of month');
    }
    public function getMonthStartDayOfWeek()
    {
        return (int) $this->format('N');
    }
}
class Calandar
{
    protected $currentDate;
    protected $CalendarDate;
    
    protected $dayLabels = [
        'Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'
    ];
    protected $monthLabels = [
        'January', 'February', 'March', 'April', 'June', 'July', 'August', 'Septembrie', 'October', 'November', 'December'
    ];
    
    protected $sundayFirst =true;
    protected $weeks= [];
    
    public function_construct(currentDate $CurrentDate, CalendarDate $calendarDate)
    {
        $this->currentDate=currentDate;
        $this->calendarDate = clone $calendarDate;
        $this->calendar->modify('first day of this month');
    }
    public function getDayLabels()
    {
        return $this->dayLabels;
    }
    public function getMonthLabels()
    {
        return $this->monthLabels;
    }
    public function setSundayFirst($bool)
    {
        $this->sundayFirst = $bool;
        if($this->sundayFirst)
        {
          array_push($this->dayLabels, array_shift($this->dayLabels));  
        }
    }
    public function setMonth($monthNumber)
    {
        $this->calendarDate->setDate($this->calendarDate->getYear(), $monthNumber, 1);
    }
    public function getCalendarMonth()
    {
        return $this->calandarDate->getMonthName();
    }
    protected function getMonthFirstDay()
    {
        $day = $this->calendarDate->getMonthStartDayOfWeek();
        if($this->sundayFirst)
        {
            if($day === 7)
            {
               return 1; 
            }
            if($day < 7)
            {
              return ($day + 1);  
            }
        }
        return $day;
    }
    
    public function isCurrentDate($dayNumber)
    {
        if($this->calendarDate->getYear() === $this->currentDate->getYear() &&
           $this->calendarDate->getMonthNumber() === $this->currentDate->getMonth() &&
           $this->currentDate->getCurrentDayNumber() === $dayNumber
          ) {
            return true;
        }
        return false;
    }
    public function getWeeks()
    {
        return $this->weeks;
    }
   public function create()
   {
        $days=array_fill(0, ($this->getMonthFirstDay() -1), ['currentMonth' => false, 'dayNumber' =>'']); 
       // curent days
       for($x= 1; $x <= $this->calendarDate->getMonthNumberDays(); $x++)
       {
           $days[] = ['currentMonth' => true, 'dayNumber' => $x];
       }
       $this->weeks=array_chunk($days, 7);
       
       // Last month
       $FirstWeek = $this->weeks[0];
       $prevMonth = clone $this->calandarDate;
       $prevMonth->modify('-1 month');
       $prevMonthNumDays = $prevMonth->getMonthNumberDays();
       for($x = 6; $x >= 0; $x--)
       {
           if(!$firstWeek[$x]['dayNumber']) {
               $firstweek[$x]['dayNumber'] = $prevMonthNumDays -= 1;
               
           }
       }
       $this->weeks[0] = $firstweek;
       
       // next month
       $lastweek = $this->weeks[count($this->weeks) -1];
       $nextMonth = clone $this->calendarDate;
       $nextMonth->modify(' +1 month');
       
       $c = 1;
       for($x = 0; $x < 7; $x++) {
           if(!isset($lastweek[$x]))
           {
               $lastweek[$x]['currentMonth'] = false;
               $lastweek[$x]['dayNumber'] = $c;
               $c++;
           }
           
       }
       $this->weeks[count($this->weeks) -1] = $lastweek;
   }
}

?>