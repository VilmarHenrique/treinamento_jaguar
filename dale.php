<?php

$lines = file("SPEDFiscal93112282000108.txt");
 
$formatted_array = array();

foreach ($lines as $line) {
  $sanitized_string = str_replace("|", "", $line);
  array_push($formatted_array, substr($line, 1, 4));
}

print_r(array_count_values($formatted_array));


