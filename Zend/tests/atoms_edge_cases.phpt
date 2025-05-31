--TEST--
Atoms: Edge cases and special scenarios
--FILE--
<?php

// Test atoms with underscores and numbers
$atom1 = :test_case;
$atom2 = :item_123;
$atom3 = :_private;

var_dump(string($atom1));
var_dump(string($atom2));
var_dump(string($atom3));

// Test long atom names
$long_atom = :this_is_a_very_long_atom_name_for_testing_purposes;
var_dump(string($long_atom));

// Test atom deduplication across different creation methods
$literal = :dedup_test;
$function_created = atom('dedup_test');
var_dump($literal === $function_created);

// Test in array functions
$array = [:apple, :banana, :cherry];
var_dump(in_array(:banana, $array));
var_dump(in_array(:grape, $array));

// Test array_search
var_dump(array_search(:banana, $array));
var_dump(array_search(:grape, $array));

// Test with array_unique
$duplicates = [:test, :test, :other, :test, :other];
$unique = array_unique($duplicates);
var_dump(count($unique));
foreach ($unique as $atom) {
    var_dump(string($atom));
}

// Test atoms in object properties
class TestClass {
    public $status = :ready;
    private $state = :initialized;
    
    public function getState() {
        return $this->state;
    }
}

$obj = new TestClass();
var_dump($obj->status);
var_dump(string($obj->getState()));

// Test empty array with atom keys
$empty = [];
$empty[:first] = 'value1';
var_dump($empty[:first]);

?>
--EXPECT--
string(9) "test_case"
string(7) "item_123"
string(8) "_private"
string(53) "this_is_a_very_long_atom_name_for_testing_purposes"
bool(true)
bool(true)
bool(false)
int(1)
bool(false)
int(2)
string(4) "test"
string(5) "other"
atom(:ready)
string(11) "initialized"
string(6) "value1"