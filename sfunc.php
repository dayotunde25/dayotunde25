<!doctype html>
<html lang="en">
<?php 
include 'constants/settings.php'; 
include 'constants/check-login.php';
?>
<head>

	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<title>Project Jobs - Job Search Engine</title>
	<meta name="description" content="Online Job Management / Job Search Engine" />
	<meta name="keywords" content="job, work, resume, applicants, application, employee, employer, hire, hiring, human resource management, hr, online job management, company, worker, career, recruiting, recruitment" />
	<meta name="author" content="BwireSoft">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<meta property="og:image" content="http://<?php echo "$actual_link"; ?>/images/banner.jpg" />
    <meta property="og:image:secure_url" content="https://<?php echo "$actual_link"; ?>/images/banner.jpg" />
    <meta property="og:image:type" content="image/jpeg" />
    <meta property="og:image:width" content="500" />
    <meta property="og:image:height" content="300" />
    <meta property="og:image:alt" content="Project Jobs" />
    <meta property="og:description" content="Online Job Management / Job Search Engine" />

	<link rel="shortcut icon" href="images/ico/favicon.png">


	<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css" media="screen">	
	<link href="css/animate.css" rel="stylesheet">
	<link href="css/main.css" rel="stylesheet">
	<link href="css/component.css" rel="stylesheet">
	
	<link rel="stylesheet" href="icons/linearicons/style.css">
	<link rel="stylesheet" href="icons/font-awesome/css/font-awesome.min.css">
	<link rel="stylesheet" href="icons/simple-line-icons/css/simple-line-icons.css">
	<link rel="stylesheet" href="icons/ionicons/css/ionicons.css">
	<link rel="stylesheet" href="icons/pe-icon-7-stroke/css/pe-icon-7-stroke.css">
	<link rel="stylesheet" href="icons/rivolicons/style.css">
	<link rel="stylesheet" href="icons/flaticon-line-icon-set/flaticon-line-icon-set.css">
	<link rel="stylesheet" href="icons/flaticon-streamline-outline/flaticon-streamline-outline.css">
	<link rel="stylesheet" href="icons/flaticon-thick-icons/flaticon-thick.css">
	<link rel="stylesheet" href="icons/flaticon-ventures/flaticon-ventures.css">

	<link href="css/style.css" rel="stylesheet">

	
</head>

  <style>
  
    .autofit2 {
	height:70px;
	width:400px;
    object-fit:cover; 
  }
  
      .autofit3 {
	height:80px;
	width:100px;
    object-fit:cover; 
  }
  

  </style>
<body class="not-transparent-header">

<div class="container-wrapper">

  <header id="header">

    <nav class="navbar navbar-default navbar-fixed-top navbar-sticky-function">

      <div class="container">
        
        <div class="logo-wrapper">
          <div class="logo">
            <a href="./"><img src="images/logo.png" alt="Logo" /></a>
          </div>
        </div>
        
        <div id="navbar" class="navbar-nav-wrapper navbar-arrow">
        
          <ul class="nav navbar-nav" id="responsive-menu">
          
            <li>
            
              <a href="./">Home</a>
              
            </li>
            
            <li>
              <a href="job-list.php">Job List</a>

            </li>
            
            <li>
              <a href="employers.php">Employers</a>
            </li>
            
            <li>
              <a href="employees.php">Employees</a>
            </li>
            <li>
              <a href="search.php">Search Other Jobs</a>
            </li>
            
            <li>
              <a href="contact.php">Contact Us</a>
            </li>

          </ul>
      
        </div>

        <div class="nav-mini-wrapper">
          <ul class="nav-mini sign-in">
          <?php
          if ($user_online == true) {
          print '
              <li><a href="logout.php">logout</a></li>
            <li><a href="'.$myrole.'">Profile</a></li>';
          }else{
          print '
            <li><a href="login.php">login</a></li>
            <li><a data-toggle="modal" href="#registerModal">register</a></li>';						
          }
          
          ?>

          </ul>
        </div>
      
      </div>
      
      <div id="slicknav-mobile"></div>
      
    </nav>

			
		</header>
    <?php 
$con = mysqli_connect("localhost", "root", "", "job_portal");
if($con){ 
	echo "Connected Successfully"; 
} else{
die("connection failed".mysqli_connect_error()); }
         $query = $_GET['query'];
         $sql = "SELECT * FROM scraped_jobs WHERE job_title LIKE '%$query%' OR description LIKE '%$query%' OR job_location LIKE '%$query%'";
          if($result = mysqli_query($con, $sql)){
            if(mysqli_num_rows($result) > 0){
                  echo "<h2>Your Result</h2><br>";
                    while($row = mysqli_fetch_array($result)){ 
?>

                      <div class="content">
											<div>
											
												<div class="row">
												
													<div class="col-sm-7 col-md-8">
													
														<h4 class="heading"><?php echo $row['job_title']; ?></h4>
                            <div class="meta-div clearfix mb-25">
															<span>at <a href="<?php echo $row['company_url']; ?>"><?php echo $row['company_name']; ?></a></span>
														</div>
                            <p class="texing character_limit"><?php echo $row['description']; ?></p>
													</div>
													
													<div class="col-sm-5 col-md-4">
                          <div class="meta-div clearfix mb-25">
															<span> <a href='<?php echo $row['job_url']; ?>' target='blank'> APPLY NOW</a></span>
														</div>
														<ul class="meta-list">
															<li>
																<span>Country:</span>
																<?php echo $row['job_location']; ?>
															</li>
															<li>
																<span>Posted Date:</span>
																<?php echo $row['posted_date']; ?>
															</li>
														</ul>
													</div>
													
												</div>
											
											</div>
                      </div>
  </div>
                      
                  <?php 
                   }
                  
        // Close result set
                 mysqli_free_result($result);
           } else{
        echo "No records matching your query were found.";
    }
}

 ?>
 <footer class="footer-wrapper">
			
      <div class="main-footer">
      
        <div class="container">
        
          <div class="row">
          
            <div class="col-sm-12 col-md-9">
            
              <div class="row">
              
                <div class="col-sm-6 col-md-4">
                
                  <div class="footer-about-us">
                    <h5 class="footer-title">About Project Jobs</h5>
                    <p>Project Jobs is a Job Search Engine, online job management system developed by N/CS/20/2904 for his project in 2022.</p>
                  
                  </div>

                </div>
                
                <div class="col-sm-6 col-md-5 mt-30-xs">
                  <h5 class="footer-title">Quick Links</h5>
                  <ul class="footer-menu clearfix">
                    <li><a href="./">Home</a></li>
                    <li><a href="job-list.php">Job List</a></li>
                    <li><a href="employers.php">Employers</a></li>
                    <li><a href="employees.php">Employees</a></li>
                    <li><a href="contact.php">Contact Us</a></li>
                    <li><a href="#">Go to top</a></li>

                  </ul>
                
                </div>

              </div>

            </div>
            
            <div class="col-sm-12 col-md-3 mt-30-sm">
            
              <h5 class="footer-title">Project Jobs Contact</h5>
              
              <p>Address : Federal Polytechnic Ilaro.</p>
              <p>Email : <a href="mailto:dayotunde25@gmail.com">dayotunde25@gmail.com</a></p>
              <p>Phone : <a href="tel:+2349033150460">+2349033150460</a></p>
              

            </div>

            
          </div>
          
        </div>
        
      </div>
      
      <div class="bottom-footer">
      
        <div class="container">
        
          <div class="row">
          
            <div class="col-sm-4 col-md-4">
        
              <p class="copy-right">&#169; Copyright <?php echo date('Y'); ?> Moscool Software</p>
              
            </div>
            
            <div class="col-sm-4 col-md-4">
            
              <ul class="bottom-footer-menu">
                <li><a >Developed by N/CS/20/2904</a></li>
              </ul>
            
            </div>
            
            <div class="col-sm-4 col-md-4">
              <ul class="bottom-footer-menu for-social">
                <li><a href="<?php echo "$tw"; ?>"><i class="ri ri-twitter" data-toggle="tooltip" data-placement="top" title="twitter"></i></a></li>
                <li><a href="<?php echo "$fb"; ?>"><i class="ri ri-facebook" data-toggle="tooltip" data-placement="top" title="facebook"></i></a></li>
                <li><a href="<?php echo "$ig"; ?>"><i class="ri ri-instagram" data-toggle="tooltip" data-placement="top" title="instagram"></i></a></li>
              </ul>
            </div>
          
          </div>

        </div>
        
      </div>
    
    </footer>
    
  </div>


</div> 
<div id="back-to-top">
 <a href="#"><i class="ion-ios-arrow-up"></i></a>
</div>

<script type="text/javascript" src="js/jquery-1.11.3.min.js"></script>
<script type="text/javascript" src="js/jquery-migrate-1.2.1.min.js"></script>
<script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>
<script type="text/javascript" src="js/bootstrap-modalmanager.js"></script>
<script type="text/javascript" src="js/bootstrap-modal.js"></script>
<script type="text/javascript" src="js/smoothscroll.js"></script>
<script type="text/javascript" src="js/jquery.easing.1.3.js"></script>
<script type="text/javascript" src="js/jquery.waypoints.min.js"></script>
<script type="text/javascript" src="js/wow.min.js"></script>
<script type="text/javascript" src="js/jquery.slicknav.min.js"></script>
<script type="text/javascript" src="js/jquery.placeholder.min.js"></script>
<script type="text/javascript" src="js/bootstrap-tokenfield.js"></script>
<script type="text/javascript" src="js/typeahead.bundle.min.js"></script>
<script type="text/javascript" src="js/bootstrap3-wysihtml5.min.js"></script>
<script type="text/javascript" src="js/bootstrap-select.min.js"></script>
<script type="text/javascript" src="js/jquery-filestyle.min.js"></script>
<script type="text/javascript" src="js/bootstrap-select.js"></script>
<script type="text/javascript" src="js/ion.rangeSlider.min.js"></script>
<script type="text/javascript" src="js/handlebars.min.js"></script>
<script type="text/javascript" src="js/jquery.countimator.js"></script>
<script type="text/javascript" src="js/jquery.countimator.wheel.js"></script>
<script type="text/javascript" src="js/slick.min.js"></script>
<script type="text/javascript" src="js/easy-ticker.js"></script>
<script type="text/javascript" src="js/jquery.introLoader.min.js"></script>
<script type="text/javascript" src="js/jquery.responsivegrid.js"></script>
<script type="text/javascript" src="js/customs.js"></script>


</body>


</html>
