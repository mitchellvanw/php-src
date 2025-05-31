--TEST--
Atoms: atom() function
--FILE--
<?php

// Test dynamic atom creation
$atom1 = atom('dynamic');
$atom2 = atom('test');
$atom3 = atom('dynamic'); // Should be same as atom1

var_dump(is_atom($atom1));
var_dump(is_atom($atom2));
var_dump(string($atom1));
var_dump(string($atom2));

// Test identity with dynamic atoms
var_dump($atom1 === $atom3);
var_dump($atom1 === atom('dynamic'));

// Test identity with literal atoms
var_dump($atom2 === :test);
var_dump(atom('hello') === :hello);

// Test with variable names
$name = 'variable';
$atom4 = atom($name);
var_dump(string($atom4));
var_dump($atom4 === :variable);

?>
--EXPECT--
bool(true)
bool(true)
string(7) "dynamic"
string(4) "test"
bool(true)
bool(true)
bool(true)
bool(true)
string(8) "variable"
bool(true)