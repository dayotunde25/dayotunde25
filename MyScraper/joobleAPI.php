<?php
$con = mysqli_connect("localhost", "root", "", "job_portal");

$st = mysqli_prepare($con, 'INSERT INTO scraped_jobs(job_url, company_name, linkedin_company_url_cleaned, job_title, job_location, posted_date, description) VALUES (?, ?, ?, ?, ?, ?, ?)');
mysqli_stmt_bind_param($st,'ssssssss',  $job_url, $company_name, $linkedin_company_url_cleaned, $job_title, $job_location, $posted_date, $description);

$url = "https://jooble.org/api/";
$key = "cb0fefe9-6b4c-44c3-b438-e9e682546c48";

//create request object
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url."".$key);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, '{ "keywords": "", "location": "US"}');
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));

// receive server response ...
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$server_output = curl_exec ($ch);
$err = curl_error($curl);
curl_close ($ch);
//$data = file_get_contents($server_output);
 $array = json_decode($server_output, true);
foreach($array['jobs'] as $key=>$value){ 
   $job_url = $value["link"]; 
   $linkedin_company_url_cleaned = $value["source"]; 
   $company_name = $value["company"];
   $job_title = $value["title"];
   $job_location = $value["location"];
   $posted_date = $value["updated"];
   $description = $value["snippet"];
	mysqli_stmt_execute($st);
}


?>