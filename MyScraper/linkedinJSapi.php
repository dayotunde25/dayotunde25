<?php
include_once("./simple_html_dom.php");
$html_p=$_POST['data'];
//$html_f=file_get_contents('./json.txt');
$con = new mysqli("localhost", "root", "");
if($con->select_db("job_portal")){
    //echo "connected";
};

$db_data=[
    'jobTitle'=>[],
    'company'=>[],
    'location'=>[],
    'link'=>[]
];

$html=str_get_html($html_p);

foreach($html->find("li") as $e){
    foreach($e->find('h3.base-search-card__title') as $el){
        $db_data['jobTitle'][]=$el->plaintext;
    };

    foreach($e->find('h4.base-search-card__subtitle') as $el){
        $db_data['company'][]=$el->plaintext;
    };

    foreach($e->find('span.job-search-card__location') as $el){
        $db_data['location'][]=$el->plaintext;
    };

    foreach($e->find('a.base-card__full-link') as $el){
        $db_data['link'][]=$el->href;
    };
};

for ($i=0;$i<count($db_data['jobTitle']);$i++){
    $job_url = $db_data['link'][$i];  
    $company_name = $db_data['company'][$i];
    $job_title = $db_data['jobTitle'][$i];
    $location = $db_data['location'][$i];
    $query="INSERT INTO scraped_jobs(job_url, company_name, job_title, job_location) VALUES ('$job_url', '$company_name', '$job_title', '$location')";
    $con->query($query);
}