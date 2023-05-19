<?php 
$con = mysqli_connect("localhost", "root", "", "jobs");
if($con){ 
	echo "Connected Successfully"; 
} else{
die("connection failed".mysqli_connect_error());
}
?>
<!DOCTYPE html> 
<html xmlns="http://www.w3.org/1999/xhtml"> 
<head> <title>Search</title> 
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>
<body> 
     <?php
         $query = $_GET['query'];
         $sql = "SELECT * FROM scraped_jobs WHERE job_title LIKE '%$query%' OR description LIKE '%$query%' OR job_location LIKE '%$query%'";
          if($result = mysqli_query($con, $sql)){
            if(mysqli_num_rows($result) > 0){
                  echo "<h2>Your Result</h2><br>";
                    while($row = mysqli_fetch_array($result)){
                      echo "<fieldset width='50px' style='background-color:gray'>";
                      echo "<p>" . $row['job_title'] . "</p><br>";
                      echo "<p>" . $row['company_name'] . "</p><br>";
                      echo "<a href='" . $row['job_url'] . "' target='blank'>Apply Now</a><br>";
                      echo "<p>" . $row['job_location'] . "</p>";
               
                      echo "</fieldset>";
                    }
                  echo " ";
        // Close result set
                 mysqli_free_result($result);
           } else{
        echo "No records matching your query were found.";
    }
}

 ?>
</body>
</html>