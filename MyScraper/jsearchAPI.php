<?php
$con = mysqli_connect("localhost", "root", "", "job_portal");
$st = mysqli_prepare($con, 'INSERT INTO scraped_jobs(job_url, company_name, job_title, description, job_location, posted_date) VALUES (?, ?, ?, ?, ?, ?)');
mysqli_stmt_bind_param($st,'ssssss',  $job_url, $company_name, $job_title, $description, $job_location, $posted_date);

$curl = curl_init();

curl_setopt_array($curl, [
	CURLOPT_URL => "https://jsearch.p.rapidapi.com/search?query=nigeria&num_pages=1",
	CURLOPT_RETURNTRANSFER => true,
	CURLOPT_FOLLOWLOCATION => true,
	CURLOPT_ENCODING => "",
	CURLOPT_MAXREDIRS => 10,
	CURLOPT_TIMEOUT => 30,
	CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	CURLOPT_CUSTOMREQUEST => "GET",
	CURLOPT_HTTPHEADER => [
		"X-RapidAPI-Host: jsearch.p.rapidapi.com",
		"X-RapidAPI-Key: your rapidapi key"
	],
]);

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);
$data = file_get_contents($response,true);
$joba = json_decode($data, true); 

foreach($joba['data'] as $key=>$value){ 
   $job_url = $value["job_apply_link"];  
   $company_name = $value["employer_name"];
   $job_title = $value["job_title"];
   $description = $value["job_description"];
   $job_location = $value['job_country'].$value['job_city'];
   $posted_date = $value['job_posted_at_datetime_utc'];
	mysqli_stmt_execute($st);
}

?>
