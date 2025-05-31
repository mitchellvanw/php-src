--TEST--
Atoms: Error handling
--FILE--
<?php

// Test invalid atom names
try {
    atom('');
    echo "Should not reach here\n";
} catch (ValueError $e) {
    var_dump("Empty string rejected");
}

try {
    atom('123invalid');
    echo "Should not reach here\n";
} catch (ValueError $e) {
    var_dump("Invalid identifier rejected");
}

// Test with null
try {
    atom(null);
    echo "Should not reach here\n";
} catch (TypeError $e) {
    var_dump("Null rejected");
}

// Test with non-string
try {
    atom(123);
    echo "Should not reach here\n";
} catch (TypeError $e) {
    var_dump("Non-string rejected");
}

// Test string() function with non-atom
try {
    string("not an atom");
    echo "Should not reach here\n";
} catch (TypeError $e) {
    var_dump("string() rejects non-atom");
}

try {
    string(123);
    echo "Should not reach here\n";
} catch (TypeError $e) {
    var_dump("string() rejects integer");
}

// Test atom_exists with invalid input
try {
    atom_exists(null);
    echo "Should not reach here\n";
} catch (TypeError $e) {
    var_dump("atom_exists rejects null");
}

try {
    atom_exists(123);
    echo "Should not reach here\n";
} catch (TypeError $e) {
    var_dump("atom_exists rejects integer");
}

?>
--EXPECT--
string(20) "Empty string rejected"
string(26) "Invalid identifier rejected"
string(13) "Null rejected"
string(18) "Non-string rejected"
string(26) "string() rejects non-atom"
string(24) "string() rejects integer"
string(24) "atom_exists rejects null"
string(27) "atom_exists rejects integer"