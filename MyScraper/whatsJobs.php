<?php
// Set parameters
$parameters = array(
            'publisher' => 3805,
            'user_ip' => '129.205.121.186',
            'user_agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/106.0.0.0 Safari/537.36',
            'keyword' => 'nigeria', 
);

// Create curl resource
$curl = curl_init();

// Set URL
curl_setopt($curl, CURLOPT_URL, 'https://api.whatjobs.com/api/v1/jobs.xml?publisher=3805&user_ip=129.205.121.186&user_agent=Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/106.0.0.0 Safari/537.36&keyword=sales&location=london&limit=&page=');

// Return the transfer as a string
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

// Exec and return the response
$response = curl_exec($curl);

// Close curl resource
curl_close($curl);

// Dump the response
var_dump($response);
?>