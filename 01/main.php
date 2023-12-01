<?php

$rows = file('input_01.txt');

$parsedRows = [];
$coordinates = [];

foreach ($rows as $row) {
    $parsedRows[] = filter_var($row, FILTER_SANITIZE_NUMBER_INT);
}

foreach ($parsedRows as $parsedRow) {
    if ($parsedRow <= 9) {
        $coordinates[] = $parsedRow . $parsedRow;
    }

    if ($parsedRow > 9 && $parsedRow <= 99) {
        $coordinates[] = $parsedRow;
    }

    if ($parsedRow > 99) {
        $coordinates[] = substr($parsedRow, 0, 1). substr($parsedRow, -1);
    }
}

$sum_01 = array_sum($coordinates);
echo  'Answer for 01_01: '. $sum_01;
