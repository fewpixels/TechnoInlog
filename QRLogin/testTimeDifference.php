<?php
$timestamp1 = strtotime('2023-03-29 08:10:41');
$timestamp2 = strtotime('2023-03-29 11:55:48');

$date1 = new DateTime();
$date1->setTimestamp($timestamp1);

$date2 = new DateTime();
$date2->setTimestamp($timestamp2);

if ($date1->format('Y-m-d') === $date2->format('Y-m-d')) {
    $interval = $date1->diff($date2);
    $hour_diff = $interval->h;
    echo "Hour difference: $hour_diff";
    echo gettype($hour_diff);
} else {
    echo "Timestamps are not on the same date.";
}
?>