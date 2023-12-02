<?php

$rows = file('input_02.txt');

$maxRed = 12;
$maxGreen = 13;
$maxBlue = 14;

$possibleGameIds = [];
$powerOfdGameSets = [];

foreach($rows as $row) {
    $substrings = explode(':', $row);
    $game = $substrings[0];
    $subSetsOfCubes = explode(';', $substrings[1]);
    $isGamePossible = true;

    $minimalRed = 0;
    $minimalGreen = 0;
    $minimalBlue = 0;

    foreach ($subSetsOfCubes as $subSet) {
        $inputRed = 0;
        $inputGreen = 0;
        $inputBlue = 0;

        if (str_contains($subSet, 'red')) {
            preg_match('/(\d+)\s*red/', $subSet, $number);
            $inputRed = $number[1];

            $minimalRed = max($number[1], $minimalRed);

        }

        if (str_contains($subSet, 'blue')) {
            preg_match('/(\d+)\s*blue/', $subSet, $number);
            $inputBlue = $number[1];

            $minimalBlue = max($number[1], $minimalBlue);
        }

        if (str_contains($subSet, 'green')) {
            preg_match('/(\d+)\s*green/', $subSet, $number);
            $inputGreen = $number[1];

            $minimalGreen = max($number[1], $minimalGreen);
        }

        if ($inputRed > $maxRed || $inputBlue > $maxBlue || $inputGreen > $maxGreen) {
            $isGamePossible = false;
        }
    }

    if ($isGamePossible) {
        preg_match('/Game*\s(\d+)/', $game, $number);
        $possibleGameIds[] = $number[1];
    }

    $powerOfdGameSets[] = $minimalRed * $minimalGreen * $minimalBlue;
}

$result_01 = array_sum($possibleGameIds);
echo 'Answer for 02_01: '. $result_01;
echo '<br>';

$result_02 = array_sum($powerOfdGameSets);
echo 'Answer for 02_02: '. $result_02;

