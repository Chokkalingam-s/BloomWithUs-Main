<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>BloomWithUs</title>
    <link rel="icon" href="assets/img/logo.png" type="image/x-icon">
    <meta content="" name="description">
    <meta content="" name="keywords">

     <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Inter:wght@100;200;300;400;500;600;700;800;900&family=Nunito:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,200;1,300;1,400;1,500;1,600;1,700;1,800&display=swap" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="assets/vendor/aos/aos.css" rel="stylesheet">
    <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
    <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
    <!-- Main CSS File -->
    <link href="assets/css/main.css" rel="stylesheet">
    <!-- Bootstrap CSS -->
     <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- select2 CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
    <style>
          body {
            background-color: #f8f9fa;
        }
        .container-wrapper {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            width: 100%;
        }
        main {
            flex: 1;
            display: flex;
            justify-content: center;
        }
        footer {
            flex-shrink: 0;
            background: #f8f9fa;
        }
        .container {
            max-width: 90vw;
            margin-top: 50px;
        }    
        .badge-container {
            margin-top: 10px;
        }
        .badge {
            margin: 2px;
            padding: 0.5%;
            font-size: medium;
        }
        .table td, .table th {
            vertical-align: middle;
        }
        .section1{
            background-color: #DFD3C3;
        }
        .section2{
            background-color: #ede1d5; 
        }
        .disease-select{
            width: 50vw;
        }
        .therapy-select {
            min-width: 18vw;
            width: 18vw;
        }
        #optSelect {
            width: 25vw;
        }
        .sos-checkbox-cell {
        text-align: center; 
        vertical-align: middle; 
        padding: 0; 
        }
        .sos-checkbox-wrapper {
        display: flex;
        justify-content: center; 
        align-items: center; 
        height: 100%;
        }
        .sos-checkbox {
        width: 5%; 
        height: 3%;
        margin-left: 0.5%;
        }
        .sos-highlight td {
            background-color:  #f8c4cc;
            color: red;
        }
        .row{
            margin-top: -1.1% !important;
            margin-bottom: -1.1% !important;
        }
        .patient-photo {
            display: flex;
            justify-content: center;
            align-items: center;
            border: 1px solid #ddd;
            height: 200px;
        }
        .add-photo-btn {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 100px;
            height: 110px;
            border: 2px dashed #007bff;
            color: #007bff;
            cursor: pointer;
            font-size: 24px;
            background-color: white;
            position: relative;
        }
        .add-photo-btn input[type="file"] {
            position: absolute;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
            opacity: 0;
            cursor: pointer;
        }
     
        .passport-photo {
            width: 110px;
            height: 130px;
            object-fit: cover;
            display: none;
        }
        
        .thermed{
            margin: 2% 0;
        }
        
        .mfp {
           margin-bottom: 3%;
        }

        .cm3{
            max-width: 22% !important;
        }
.heading{
    font-weight: bold;
}

.index-page::-webkit-scrollbar { 
    display: none;  /* Safari and Chrome */
}

.modal::-webkit-scrollbar { 
    display: none;  /* Safari and Chrome */
}

.print-btn {
    margin-left: 60%;
}

.img{
            margin: 0;
            height: 60vh;
            width: 100vw;
            background-image: url("assets/img/p_bg.jpg");
            background-repeat: no-repeat;
            background-size: cover;
            background-position: center;
            object-fit: cover;
}

.content{
    margin-left: 55%;
    margin-top: 10%;
}

.content label{
    font-size: larger;
    font-weight: 700;

    margin-bottom: 2%;
}

.content1{
    margin-left: 11%;
}

.badge-danger{
    background-color: #ddd;
    color: red !important;
    border-radius: 0% !important;
}

    </style>
</head>

<body class="index-page">
         <!-- Custom Alert Modal -->
                <div class="modal fade" id="customAlertModal" tabindex="-1" aria-labelledby="customAlertLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="customAlertLabel">BloomWithUs</h5>
                                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body" id="customAlertMessage">
                                <!-- Dynamic alert message will be injected here -->
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
<div class="container-wrapper">
            <header id="header" class="header d-flex align-items-center fixed-top">
                <div class="container-fluid container-xl position-relative d-flex align-items-center">
                    <a href="index.html" class="logo d-flex align-items-center me-auto">
                    <img src="assets/img/logo.png" alt="Logo">
                        <h1 class="sitename">BloomWithUs</h1>
                    </a>
                    <nav id="navmenu" class="navmenu">
                        <ul>
                        <li><a href="admin_dashboard.php">Home</a></li>
                        <li><a href="admin_dashboard.php#AddPost">Add Post</a></li>
                        <li><a href="prescription.php" class="active">Prescription</a></li>
                        <li><a href="stats.php">Statistics</a></li>
                        <li><a href="logout.php" style="color: red;">Logout</a></li>
                        </ul>
                        <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
                    </nav>
                    <a class="btn-getstarted" href="appointment.php">Appointments</a>
                </div>
            </header>

    <main class="main img"  style="margin-top: 10vh;">
    <div class="container mt-5">
        <div class="content">
    <h1>Prescription</h1>
    <div class="content1">
    <form method="GET" action="">
        <div class="form-group mt-5">
            <label for="uniqueIdSearch"><i>Unique ID based Prescription</i></label>
            <input type="text" class="form-control w-50" id="uniqueIdSearch" name="unique_id" placeholder="Paste Unique ID" onkeyup="this.form.submit()">  
        </div>
    </form>
  <div style="display:none;">
      <form method="GET" action="" id="uniqueIdForm">
    <div class="form-group mt-5">
        <label for="uniqueIdSearch1">Unique ID based Prescription</label>
        <input type="text" class="form-control" id="uniqueIdSearch1" placeholder="Paste Unique ID">  
    </div>
    <button type="button" class="btn btn-primary" onclick="submitForm('unique_id1')">Submit as ID1</button>
    <button type="button" class="btn btn-secondary" onclick="submitForm('unique_id2')">Submit as ID2</button>
</form>
</div>
</div>
</div>

    </div>
       <!-- Save Prescription Modal -->


        <!-- Patient Prescription Modal -->
              <div class="patientpres">
              <?php
                include 'p.php';
                ?>

              </div>



    </main>
    <footer id="footer" class="footer position-relative light-background">
    <div class="container copyright text-center mt-4">
      <p style="display: flex; justify-content: center;">©<span>Copyright</span> <strong class="px-1 sitename">BloomWithUs</strong><span>All Rights Reserved</span></p>
      <div class="credits">
        Designed From <a href="https://rudraksha.org.in/" target="_blank"> Rudraksha Welfare Foundation <a href="https://www.linkedin.com/in/chokkalingam2005/" target="_blank"><i class="bi bi-person-workspace"></i></a></a>
      </div>
    </div>
  </footer>
    </div>
    
    <!-- Scroll Top -->
    <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
    <!-- Preloader -->
    <div id="preloader"></div>
    <!-- Vendor JS Files -->
    <script src="assets/vendor/aos/aos.js"></script>
    <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
    <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>

    <!-- Main JS File -->
    <script src="assets/js/main.js"></script>
    <script src="assets/js/customAlert.js"></script>
    
    <!-- script -->

       <!-- jQuery -->
       <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
       <!-- Bootstrap JS -->
       <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
       <!-- select2 JS -->
       <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>

       <script src="assets/js/p.js"></script>
       <script src="assets/js/p1.js"></script> 
       <script src="assets/js/p2.js"></script> 

       <script>
function submitForm(uniqueIdName) {
    // Ensure the input value is included as a hidden input with the correct name
    var uniqueIdValue = document.getElementById('hiddenUniqueId').value;
    var hiddenInput = document.createElement('input');
    hiddenInput.type = 'hidden';
    hiddenInput.name = uniqueIdName;
    hiddenInput.value = uniqueIdValue;

    // Append the hidden input to the form
    var form = document.getElementById('uniqueIdForm');
    form.appendChild(hiddenInput);

    // Submit the form
    form.submit();
}
</script>
</body>
</html>
