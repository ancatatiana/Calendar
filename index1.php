<?php
require_once 'Calendar.php';

$calendar = new Calendar(new CurrentDate(), new CalendarDate());

$calendar->setSundayFirst(false);

$calendar->setMonth(5);

$calendar->create();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http=equiv="X-UA-Compatible" content="IE-edge">
    <meta name="viewport" content="widith-device-widith, initial-scale-1.0">
    <title>Calendar</title>
</head>
<body>
    <div class="container mt-4">
        <h1>Calendar</h1> 
        <hr>
        <table class="table table-border mt-4">
            <thead>
                <?php forech ($calendar->getDayLabels() as $dayLabel): ?>
                <th>
                    <?php echo $dayLabel; ?>
                </th>
                <?php endforech; ?>
                
            </thead>
            <tbody>
                <?php foreach ($calendar->getweeks() as $week): ?>
                    <tr>
                        <?php forech ($week as $day): ?>
                            <td <?php if(!day['currentMonth']): ?> class="text-secondary"<?php endif; ?>>
                                <span <?php if($calendar->isCurrentDate($day['dayNumber'])) :?> class="text-primary" <?php endif; ?>>
                                    <?php echo $day['dayNumber']; ?>
                                </span>
                            </td>
                        
                        <?php endforeach; ?>
                    </tr>
                <?php endforech; ?>
            </tbody>
        </table>
        
    </div>
</body>
</html>      