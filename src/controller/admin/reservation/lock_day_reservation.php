<?php

if (isset($_GET['date'])) {

    $date = htmlspecialchars($_GET['date']);
    $start_date = $date . " 00:00:00";
    $end_date = $date . " 23:59:59";
    $is_day_already_blocked = false;

    $lock_day = get_all_lock_time();
    foreach ($lock_day as $lock) {
        if ($lock['date_debut'] <= $start_date && $lock['date_fin'] >= $end_date) {
            $is_day_already_blocked = true;
            break;
        }
    }

    if($is_day_already_blocked){
        remove_lock_day_reservation($start_date, $end_date);
    }
    elseif (check_lock_reservation($start_date, $end_date) == 0){
        add_lock_day_reservation($start_date,$end_date);
    }

    header('Location: /admin/reservation');


}