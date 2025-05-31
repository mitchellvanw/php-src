--TEST--
Atoms: var_export functionality
--FILE--
<?php

// Test var_export with single atom
$atom = :test;
var_export($atom);
echo "\n";

// Test var_export with array containing atoms
$array = [
    :name => 'John',
    :status => :active,
    :permissions => [:read, :write]
];

var_export($array);
echo "\n";

// Test var_export with nested structure
$config = [
    :database => [
        :host => 'localhost',
        :type => :mysql
    ],
    :cache => :enabled
];

var_export($config);
echo "\n";

// Test var_dump with atoms
var_dump(:simple);
var_dump([:key => :value]);

?>
--EXPECT--
:test
array (
  'name' => 'John',
  'status' => :active,
  'permissions' => 
  array (
    0 => :read,
    1 => :write,
  ),
)
array (
  'database' => 
  array (
    'host' => 'localhost',
    'type' => :mysql,
  ),
  'cache' => :enabled,
)
atom(:simple)
array(1) {
  ["key"]=>
  atom(:value)
}