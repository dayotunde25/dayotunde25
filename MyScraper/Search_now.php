
<?php
/* Attempt MySQL server connection. Assuming you are running MySQL
server with default setting (user 'root' with no password) */
$link = mysqli_connect("localhost", "root", "", "jobs");
 
// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
 
// Attempt select query execution
$sql = "SELECT * FROM `scraped_jobs` WHERE `job_url` LIKE '%manager%' OR `job_title` LIKE '%manager%'";
if($result = mysqli_query($link, $sql)){
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
} else{
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
}
 
// Close connection
mysqli_close($link);
?>