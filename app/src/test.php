<?php

declare(strict_types=1);

function get_square(int|float $number): int|float
{
	if (!is_numeric($number)) {
		throw new ValueError("Given argument is not a number");
	}
	return $number ** 2;
}


# echo get_square(9) . "\n";

/*$array = [1, 2, 3, 4];*/
/*array_push($array, ...[5, 6, 7]);*/
/*print_r($array);*/
/*array_shift($array);*/
/*array_pop($array);*/
/*array_unshift($array, 100);*/
/**/
/*foreach ($array as $value) {*/
/*	echo $value . "\n";*/
/*}*/


/*$dict = [*/
/*	"key1" => 1,*/
/*	"key2" => 2*/
/*];*/

/*foreach ($dict as $key => $value) {*/
/*	echo $key . " => " . $value . "\n";*/
/*}*/

# echo key_exists("key3", $dict) . "\n";
# echo in_array(1, $dict) . "\n";
# print_r(array_keys($dict, "1"));
#

$ppl = [];

for ($count = 0; $count < 3; $count++) {
	array_push($ppl, ["name" => "person" . ($count + 1), "age" => rand(12, 30)]);
}

print_r($ppl);

$ppl = array_filter($ppl, function ($var) {
	return $var["age"] > 18 && $var["age"] <= 22;
});

print_r($ppl);
