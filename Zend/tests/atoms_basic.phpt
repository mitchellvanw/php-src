--TEST--
Atoms: Basic functionality
--FILE--
<?php

// Test atom literal creation
$atom1 = :test;
$atom2 = :hello;
$atom3 = :world;

// Test type checking
var_dump(is_atom($atom1));
var_dump(is_atom($atom2));
var_dump(is_atom("string"));
var_dump(is_atom(123));

// Test gettype
var_dump(gettype($atom1));
var_dump(gettype($atom2));

// Test is_scalar
var_dump(is_scalar($atom1));
var_dump(is_scalar($atom2));

// Test string conversion
var_dump(string($atom1));
var_dump(string($atom2));
var_dump(string($atom3));

// Test identity
var_dump($atom1 === :test);
var_dump($atom2 === :hello);
var_dump($atom1 === $atom2);

?>
--EXPECT--
bool(true)
bool(true)
bool(false)
bool(false)
string(4) "atom"
string(4) "atom"
bool(true)
bool(true)
string(4) "test"
string(5) "hello"
string(5) "world"
bool(true)
bool(true)
bool(false)