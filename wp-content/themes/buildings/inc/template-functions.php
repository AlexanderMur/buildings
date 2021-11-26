<?php

use Buildings\Options;
use Buildings\Theme;

function options($option = null) {

    if ($option) {
        return Options::instance()->get($option);
    } else {
        return Options::instance();
    }
}
function theme() {
    return Theme::instance();
}

/**
 * Return the quarter for a timestamp.
 * @param $date
 * @return int
 */
function getQuarterByDate($date){
    $curMonth = date_parse($date)['month'];
    return ceil($curMonth/3);
}
function getQuarterAndYear($date) {
    $q = getQuarterByDate($date);
    $year = date_parse($date)['year'];
    return $q . ' кв. ' . $year;
}
