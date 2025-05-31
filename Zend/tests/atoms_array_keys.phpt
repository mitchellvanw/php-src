--TEST--
Atoms: Array keys functionality
--FILE--
<?php

// Test basic array operations with atom keys
$array = [
    :name => 'John',
    :age => 30,
    :status => :active
];

// Test array access
var_dump($array[:name]);
var_dump($array[:age]);
var_dump($array[:status]);

// Test isset
var_dump(isset($array[:name]));
var_dump(isset($array[:nonexistent]));

// Test array_key_exists
var_dump(array_key_exists('name', $array));
var_dump(array_key_exists('nonexistent', $array));

// Test dynamic assignment
$array[:email] = 'john@example.com';
var_dump($array[:email]);

// Test unset
unset($array[:age]);
var_dump(isset($array[:age]));

// Test nested arrays
$config = [
    :database => [
        :host => 'localhost',
        :port => 3306,
        :credentials => [
            :username => 'admin',
            :password => 'secret'
        ]
    ],
    :cache => [
        :enabled => true,
        :driver => :redis
    ]
];

var_dump($config[:database][:host]);
var_dump($config[:database][:port]);
var_dump($config[:database][:credentials][:username]);
var_dump($config[:cache][:driver]);

// Test foreach
$simple = [:a => 1, :b => 2, :c => 3];
foreach ($simple as $key => $value) {
    var_dump(string($key) . " => " . $value);
}

?>
--EXPECT--
string(4) "John"
int(30)
string(6) "active"
bool(true)
bool(false)
bool(true)
bool(false)
string(16) "john@example.com"
bool(false)
string(9) "localhost"
int(3306)
string(5) "admin"
string(5) "redis"
string(6) "a => 1"
string(6) "b => 2"
string(6) "c => 3"