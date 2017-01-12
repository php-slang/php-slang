#!/usr/bin/env php
<?php

$inputFile = $argv[1];
$percentage = min(100, max(0, (int) $argv[2]));

if (!file_exists($inputFile)) {
    throw new InvalidArgumentException('Invalid input file provided');
}

if (!$percentage) {
    throw new InvalidArgumentException('An integer checked percentage must be given as second parameter');
}

$mutationLog = json_decode(file_get_contents($inputFile), true);

if (!array_key_exists('covered_score', $mutationLog['summary'])) {
    throw new \UnexpectedValueException('Could not find "mutation_coverage" in summary');
}

$mutationCoverage = $mutationLog['summary']['covered_score'];

if ($mutationCoverage < $percentage) {
    echo 'Mutation coverage is ' . $mutationCoverage . '%, which is below the accepted ' . $percentage . '%' . PHP_EOL;
    exit(1);
}

echo 'Mutation coverage is ' . $mutationCoverage . '% - OK!' . PHP_EOL;
