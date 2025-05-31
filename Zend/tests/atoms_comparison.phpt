--TEST--
Atoms: Comparison operations
--FILE--
<?php

$atom1 = :test;
$atom2 = :test;
$atom3 = :other;

// Identity comparison
var_dump($atom1 === $atom2);
var_dump($atom1 === $atom3);
var_dump($atom1 !== $atom3);

// Equality comparison
var_dump($atom1 == $atom2);
var_dump($atom1 == $atom3);
var_dump($atom1 != $atom3);

// Comparison with strings
var_dump($atom1 === "test");
var_dump($atom1 == "test");

// Comparison with other types
var_dump($atom1 === 123);
var_dump($atom1 == 123);
var_dump($atom1 === null);
var_dump($atom1 == null);

// Different atoms
var_dump(:success === :success);
var_dump(:success === :error);
var_dump(:success !== :error);

?>
--EXPECT--
bool(true)
bool(false)
bool(true)
bool(true)
bool(false)
bool(true)
bool(false)
bool(false)
bool(false)
bool(false)
bool(false)
bool(false)
bool(true)
bool(false)
bool(true)