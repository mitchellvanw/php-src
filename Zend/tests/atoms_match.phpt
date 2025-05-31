--TEST--
Atoms: Match expression support
--FILE--
<?php

function processStatus($status) {
    return match($status) {
        :pending => 'Processing pending request',
        :success => 'Request completed successfully',
        :error => 'Request failed with error',
        :timeout => 'Request timed out',
        default => 'Unknown status'
    };
}

// Test match with atoms
var_dump(processStatus(:pending));
var_dump(processStatus(:success));
var_dump(processStatus(:error));
var_dump(processStatus(:timeout));
var_dump(processStatus(:unknown));

// Test match with multiple cases
function getColor($status) {
    return match($status) {
        :active, :running, :online => 'green',
        :pending, :waiting => 'yellow',
        :error, :failed, :offline => 'red',
        default => 'gray'
    };
}

var_dump(getColor(:active));
var_dump(getColor(:running));
var_dump(getColor(:pending));
var_dump(getColor(:error));
var_dump(getColor(:failed));
var_dump(getColor(:unknown));

// Test complex match
function handleApiResponse($response) {
    return match([$response[:status], $response[:type] ?? :default]) {
        [:success, :user] => 'User operation successful',
        [:success, :admin] => 'Admin operation successful',
        [:error, :user] => 'User operation failed',
        [:error, :admin] => 'Admin operation failed',
        default => 'Unknown response type'
    };
}

var_dump(handleApiResponse([:status => :success, :type => :user]));
var_dump(handleApiResponse([:status => :error, :type => :admin]));
var_dump(handleApiResponse([:status => :pending]));

?>
--EXPECT--
string(25) "Processing pending request"
string(29) "Request completed successfully"
string(24) "Request failed with error"
string(17) "Request timed out"
string(14) "Unknown status"
string(5) "green"
string(5) "green"
string(6) "yellow"
string(3) "red"
string(3) "red"
string(4) "gray"
string(26) "User operation successful"
string(22) "Admin operation failed"
string(21) "Unknown response type"