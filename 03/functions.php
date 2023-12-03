<?php

/**
 * @param string $row
 * @return int[]
 */
function getPartNumbersFromSameLine(string $row): array
{
    $result = [];

    $matchesFront = [];
    $patternFront = '/[^.\d]\d+/';
    preg_match_all($patternFront, $row, $matchesFront);

    $matchesBack = [];
    $patternBack = '/\d+[^.\d]/';
    preg_match_all($patternBack, $row, $matchesBack);

    if (!empty($matchesFront)) {
        $result = array_map(
            function(string $string) {
                return substr($string, 1);
            },
            $matchesFront[0]
        );
    }

    if (!empty($matchesBack)) {
        $result = array_merge(
            array_map(
                function(string $string) {
                    return substr($string, 0, -1);
                },
                $matchesBack[0]
            ),
            $result
        );
    }

    return $result;
}

/**
 * @param string $numberRow
 * @param string $partsRow
 * @return int[]
 */
function getPartNumbersFromOtherLine(string $numberRow, string $partsRow): array
{
    $result = [];

    $partPositions = getPartIndexes($partsRow);
    $numberPositions = getNumberIndexes($numberRow);

    if (empty($partPositions) || empty($numberPositions)) {
        return [];
    }

    foreach ($numberPositions as $numberPosition) {
        foreach ($partPositions as $partPosition) {

            if ($partPosition >= $numberPosition['minIndex'] -1 && $partPosition <= $numberPosition['maxIndex'] + 1) {
                $result[] = $numberPosition['value'];
            }
        }
    }

    return $result;
}

/**
 * @param string $inputRow
 * @return int[]
 */
function getPartIndexes(string $inputRow): array
{
    $result = [];
    $inputArray = str_split($inputRow);

    foreach ($inputArray as $key => $value) {
        if (preg_match('/[^a-zA-Z0-9_.]/', $value)) {
            $result[] = $key;
        }
    }
    return $result;
}

/**
 * @param string $inputRow
 * @return array [minIndex => int, maxIndex => int, value => int]
 */
function getNumberIndexes(string $inputRow): array
{
    // aufgegeben !

}