--TEST--
Atoms: Utility functions
--FILE--
<?php

// Test atom_exists
var_dump(atom_exists('test'));  // Should be false initially
$atom = :test;
var_dump(atom_exists('test'));  // Should be true after creation

// Test with dynamic atoms
var_dump(atom_exists('dynamic'));  // Should be false
$dynamic = atom('dynamic');
var_dump(atom_exists('dynamic'));  // Should be true

// Test get_defined_atoms
$initial_count = count(get_defined_atoms());

$atom1 = :first;
$atom2 = :second; 
$atom3 = atom('third');

$atoms = get_defined_atoms();
$new_count = count($atoms);

var_dump($new_count > $initial_count);
var_dump(in_array('first', $atoms));
var_dump(in_array('second', $atoms));
var_dump(in_array('third', $atoms));
var_dump(in_array('nonexistent', $atoms));

// Test that get_defined_atoms returns strings
foreach (['first', 'second', 'third'] as $name) {
    if (in_array($name, $atoms)) {
        var_dump(is_string($name));
    }
}

// Test atom_exists with invalid input
try {
    atom_exists('');
} catch (ValueError $e) {
    var_dump("ValueError caught for empty string");
}

?>
--EXPECT--
bool(false)
bool(true)
bool(false)
bool(true)
bool(true)
bool(true)
bool(true)
bool(true)
bool(false)
bool(true)
bool(true)
bool(true)
string(32) "ValueError caught for empty string"