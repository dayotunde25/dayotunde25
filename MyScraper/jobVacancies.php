<?php

$con = mysqli_connect("localhost", "root", "", "job_portal");

$st = mysqli_prepare($con, 'INSERT INTO scraped_jobs(job_url, job_title) VALUES (?, ?)');
mysqli_stmt_bind_param($st,'ss',  $job_url, $job_title);


$curl = curl_init();

curl_setopt_array($curl, [
	CURLOPT_URL => "https://job-vacancies.p.rapidapi.com/vacancies",
	CURLOPT_RETURNTRANSFER => true,
	CURLOPT_FOLLOWLOCATION => true,
	CURLOPT_ENCODING => "",
	CURLOPT_MAXREDIRS => 10,
	CURLOPT_TIMEOUT => 30,
	CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	CURLOPT_CUSTOMREQUEST => "GET",
	CURLOPT_HTTPHEADER => [
		"X-RapidAPI-Host: job-vacancies.p.rapidapi.com",
		"X-RapidAPI-Key: b85e43b376msh24baf6ffbcfeeb3p14438ajsn3a55fc11c03d"
	],
]);

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);
$joba = json_decode($response, true); 

foreach($joba as $key=>$value){  
   $job_title = $value["title"];
   $job_url = $value["url"];
	mysqli_stmt_execute($st);
}
?>