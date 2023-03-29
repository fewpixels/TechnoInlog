<?php
$timestamp1 = strtotime('2023-03-27 10:30:00');
$timestamp2 = strtotime('2023-03-27 13:45:00');

$date1 = new DateTime();
$date1->setTimestamp($timestamp1);

$date2 = new DateTime();
$date2->setTimestamp($timestamp2);

if ($date1->format('Y-m-d') === $date2->format('Y-m-d')) {
    $interval = $date1->diff($date2);
    $hour_diff = $interval->i;
    echo "Hour difference: $hour_diff";
    echo gettype($hour_diff);
} else {
    echo "Timestamps are not on the same date.";
}
?>