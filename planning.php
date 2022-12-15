<?php

$week_days = [
    'monday',
    'tuesday',
    'wednesday',
    'thursday',
    'friday',
    'saturday',
    'sunday'
];

// $monday_ts = strtotime('monday this week');

// $monday = date('d/m/Y', $monday_ts);

// var_dump($monday);

?>


<table>
    <thead>
        <tr>
            <?php

            foreach ($week_days as $day) {
                $day_ts = strtotime($day . ' this week');
                $day_date = date('d/m/Y', $day_ts);
                echo '<th>' . $day_date . '</th>';
            }


            ?>
        </tr>
    </thead>
    <?php

    for ($i = 8; $i < 18; $i++) {
        
    }
    
    // Hours
    for ($i = 8; $i < 18; $i++) {
        
    }


    ?>
</table>