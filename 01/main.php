<?php

$rows = file('input_01.txt');

$parsedRows = [];
$coordinates = [];

foreach ($rows as $row) {
    $parsedRows[] = filter_var($row, FILTER_SANITIZE_NUMBER_INT);
}

foreach ($parsedRows as $filterRow) {
    if ($filterRow <= 9) {
        $coordinates[] = $filterRow . $filterRow;
    }

    if ($filterRow > 9 && $filterRow <= 99) {
        $coordinates[] = $filterRow;
    }

    if ($filterRow > 99) {
        $coordinates[] = substr($filterRow, 0, 1). substr($filterRow, -1);
    }
}

$sum_01 = array_sum($coordinates);
echo  'Answer for 01_01: '. $sum_01;
echo '<br/>';

//-------------------------------------------------------------------------------------------------------
$parsedRows = [];
$filterRows = [];
$coordinates = [];

$searchPattern = [
    'one' => 1,
    'two' => 2,
    'three' => 3,
    'four' => 4,
    'five' => 5,
    'six' => 6,
    'seven' => 7,
    'eight' => 8,
    'nine' => 9,
    '1' => 1,
    '2'=> 2,
    '3'=> 3,
    '4' => 4,
    '5' => 5,
    '6' => 6,
    '7' => 7,
    '8' => 8,
    '9' => 9
];

foreach ($rows as $row) {
   $numbersArray = [];

    foreach($searchPattern as $searchString => $number) {
        $firstIndex = strpos($row, $searchString);
        $lastIndex = strrpos($row, $searchString);
        if (is_int($firstIndex)) {
            $numbersArray[$firstIndex] = $number;
        }
        if (is_int($lastIndex)) {
            $numbersArray[$lastIndex] = $number;
        }
    }

    ksort($numbersArray);

    $coordinates[] = reset($numbersArray) . end($numbersArray);
}

$sum_02 = array_sum($coordinates);
echo  'Answer for 01_02: '. $sum_02;