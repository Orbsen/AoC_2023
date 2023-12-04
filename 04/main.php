<?php

$cards = file('input_04.txt', FILE_IGNORE_NEW_LINES);

$cardPoints = array_map(
    function (string $card) {
        $count = getAmountOfMatches($card);

        if ($count === 0) {
            return 0;
        } elseif ($count === 1) {
            return 1;
        }

        return pow(2, $count -1);
    },
    $cards,
);

echo 'Answer for 04_01 is: ' . array_sum($cardPoints);
echo '<br>';

// -----------------------------------------------------

$amountOfCardsPerIndex = [];

foreach ($cards as $card) {
    $amountOfCardsPerIndex[] = 1;
}

foreach ($cards as $cardIndex => $cardValue) {
    $count = getAmountOfMatches($cardValue);

    for ($i = 1; $i < $count + 1; $i++) {
        $amountOfCardsPerIndex[$cardIndex + $i] += $amountOfCardsPerIndex[$cardIndex] * 1;
    }
}

echo 'Answer for 04_02 is: ' . array_sum($amountOfCardsPerIndex);

function getAmountOfMatches(string $card): int
{
    $input = explode(':', $card);
    [$winningNumbers, $numbersWeHave] = explode('|', $input[1]);

    preg_match_all('/\d+/', $winningNumbers, $winningNumbers);
    preg_match_all('/\d+/', $numbersWeHave, $numbersWeHave);

    $intersect = array_intersect($winningNumbers[0], $numbersWeHave[0]);

    return count($intersect);
}