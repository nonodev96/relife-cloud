<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

function dateToMySql($date_spanish) {
    $return_string = "";
    $explode_date_spanish = explode(" ", $date_spanish);
    $year_number = $explode_date_spanish[5];
    $name_month = $explode_date_spanish[3];
    $day_number = $explode_date_spanish[1];
    $hour_minute_number = $explode_date_spanish[8];
    switch ($name_month) {
        case "Enero":
            $month_number = "01";
            break;
        case "Febrero":
            $month_number = "02";
            break;
        case "Marzo":
            $month_number = "03";
            break;
        case "Abril":
            $month_number = "04";
            break;
        case "Mayo":
            $month_number = "05";
            break;
        case "Junio":
            $month_number = "06";
            break;
        case "Julio":
            $month_number = "07";
            break;
        case "Agosto":
            $month_number = "08";
            break;
        case "Septiembre":
            $month_number = "09";
            break;
        case "Octubre":
            $month_number = "10";
            break;
        case "Noviembre":
            $month_number = "11";
            break;
        case "Diciembre":
            $month_number = "12";
            break;
    }
    $return_string = $year_number . "-" . $month_number . "-" . $day_number . " " . $hour_minute_number . ":00"; 
    return $return_string;
}
?>