<?php
// Consumer Key and Consumer Secret from your Safaricom Daraja API app
$consumer_key = 'ZhLM13xefk0MJGGtxPPTxnvtRXAnCnwQJq8GACOSGHDH2vXq';
$consumer_secret = 'ZL6tUmkwOa2a6twWRppjk9Mk2syG725XbAFymGWTZ8lrlAkNjFo3UzjwW7bCTGzl';

// Define the endpoint URL to obtain the access token
$endpoint_url = 'https://sandbox.safaricom.co.ke/oauth/v1/generate?grant_type=client_credentials';

// Combine the consumer key and consumer secret to form the authorization header
$credentials = base64_encode($consumer_key . ':' . $consumer_secret);

// cURL initialization
$curl = curl_init($endpoint_url);

// Set cURL options
curl_setopt($curl, CURLOPT_HTTPHEADER, array('Authorization: Basic ' . $credentials)); // Authorization header
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true); // Return response instead of outputting it
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false); // Skip SSL certificate verification (for sandbox)

// Execute the request and fetch the response
$response = curl_exec($curl);

// Check for any cURL errors
if ($response === false) {
    echo 'Curl error: ' . curl_error($curl);
} else {
    // Log the raw response for debugging
    echo "Raw Response: " . $response . "<br>";

    // Decode the JSON response
    $json_response = json_decode($response);

    // Check if decoding was successful and if the access_token exists
    if (isset($json_response->access_token)) {
        // Access and display the access token
        echo "Access Token: " . $json_response->access_token;
    } else {
        // Log error if the access_token is not present
        echo "Error: Failed to retrieve access token. Response: " . $response;
    }
}

// Close cURL resource
curl_close($curl);
?>