<?php

error_reporting(E_ALL); ini_set('display_errors', TRUE);

$input = 'xxxx';

$output = $input |> trim(...);

$output = $input |> fn (string $string) => str_replace(' ', '-', $string);

//$output = $input |> str_replace(' ', '-', ?);

$output = $input
    |> trim(...)
    |> fn(string $string) => str_replace(' ', '-', $string)
    |> fn(string $string) => str_replace(['.', '/', '…'], '', $string)
    |> strtolower(...);

echo '<h1>|' . htmlspecialchars($output) . '|</h1>';

die('<code>' . sha1(microtime()) . '</code>');

