<?php

// Function to fetch messages from the API
function getMessages() {
    // In a real scenario, you might fetch messages from a database or another data source
    // For this example, we'll return some dummy messages
    $messages = array(
        array("ContactNo" => "+919774455163","Message"=>"Hi How are you"),
        array("ContactNo" => "+919863377711","Message"=>"For Marketing...")
    );

    return $messages;
}

// Main entry point of the API
function main() {
    // Check if the request method is GET
    if ($_SERVER['REQUEST_METHOD'] === 'GET') {
        // Fetch messages
        $messages = getMessages();

        // Return messages as JSON
        header('Content-Type: application/json');
        echo json_encode(array("messages" => $messages));
    } else {
        // If the request method is not GET, return an error
        http_response_code(405); // Method Not Allowed
        echo json_encode(array("error" => "Method not allowed"));
    }
}

// Call the main function
main();

?>
