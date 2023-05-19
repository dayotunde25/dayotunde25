<?php
$con = mysqli_connect("localhost", "root", "", "job_portal");
$st = mysqli_prepare($con, 'INSERT INTO scraped_jobs(job_url, company_name, job_title) VALUES (?, ?, ?)');
mysqli_stmt_bind_param($st,'sss',  $job_url, $company_name, $job_title);
$curl = curl_init();

curl_setopt_array($curl, [
	CURLOPT_URL => "https://usa-jobs-for-it.p.rapidapi.com/FullStack",
	CURLOPT_RETURNTRANSFER => true,
	CURLOPT_FOLLOWLOCATION => true,
	CURLOPT_ENCODING => "",
	CURLOPT_MAXREDIRS => 10,
	CURLOPT_TIMEOUT => 30,
	CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	CURLOPT_CUSTOMREQUEST => "GET",
	CURLOPT_HTTPHEADER => [
		"X-RapidAPI-Host: usa-jobs-for-it.p.rapidapi.com",
		"X-RapidAPI-Key: your rapidapi key"
	],
]);

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);
$data = file_get_contents($response,true);
$joba = json_decode($data, true); 

foreach($joba as $key=>$value){ 
   $job_url = $value["url"];  
   $company_name = $value["source"].'  source';
   $job_title = $value["title"];
	mysqli_stmt_execute($st);
}
if($con && $st){ 
	echo "Connected Successfully"; 
} else{
    die("connection failed".mysqli_connect_error());
}


if ($err) {
	echo "cURL Error #:" . $err;
} else {
	echo $response;
}
