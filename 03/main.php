<?php

include 'functions.php';

$rows = file('input_03.txt', FILE_IGNORE_NEW_LINES);
$previousRow = null;
$currentRow = [];
$partNumbers = [];
$count = 0;

foreach($rows as $row) {
    if ($previousRow === null) {
        $previousRow = $row;
        continue;
    }
    $currentRow = $row;

    $numbersSameLine = getPartNumbersFromSameLine($row);

    $numbersFromAbove = getPartNumbersFromOtherLine($previousRow, $currentRow);
    $numbersFromBelow = getPartNumbersFromOtherLine($currentRow, $previousRow);

    $partNumbers[] = array_merge($numbersSameLine, $numbersFromAbove, $numbersFromBelow);

    $count++;
    $previousRow = $row;
}

$result = array_sum(array_merge(...$partNumbers));
echo 'Answer for 03_01: '. $result;

echo 'Answer for=3_02: '. getGearRatioSum($rows);