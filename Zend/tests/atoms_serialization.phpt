--TEST--
Atoms: Serialization and unserialization
--FILE--
<?php

// Test basic serialization
$atom = :test;
$serialized = serialize($atom);
$unserialized = unserialize($serialized);

var_dump(is_atom($unserialized));
var_dump($atom === $unserialized);
var_dump(string($unserialized));

// Test array with atoms
$array = [
    :status => :success,
    :data => [
        :user => :admin,
        :permissions => [:read, :write, :delete]
    ]
];

$serialized_array = serialize($array);
$unserialized_array = unserialize($serialized_array);

var_dump($array[:status] === $unserialized_array[:status]);
var_dump($array[:data][:user] === $unserialized_array[:data][:user]);
var_dump($array[:data][:permissions][0] === $unserialized_array[:data][:permissions][0]);

// Test complex structure
$config = [
    :environment => :production,
    :services => [
        :database => [
            :type => :mysql,
            :config => [
                :host => 'localhost',
                :port => 3306
            ]
        ],
        :cache => [
            :type => :redis,
            :enabled => true
        ]
    ]
];

$ser_config = serialize($config);
$unser_config = unserialize($ser_config);

var_dump($config[:environment] === $unser_config[:environment]);
var_dump($config[:services][:database][:type] === $unser_config[:services][:database][:type]);
var_dump($config[:services][:cache][:type] === $unser_config[:services][:cache][:type]);

?>
--EXPECT--
bool(true)
bool(true)
string(4) "test"
bool(true)
bool(true)
bool(true)
bool(true)
bool(true)
bool(true)