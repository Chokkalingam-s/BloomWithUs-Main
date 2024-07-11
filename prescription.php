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

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://getbootstrap.com/docs/5.3/assets/css/docs.css" rel="stylesheet">
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
                        <li><a href="admin_dashboard.php#ManagePost">Manage Post</a></li>
                        <li><a href="prescription.php" class="active">Prescription</a></li>
                        <li><a href="logout.php" style="color: red;">Logout</a></li>
                        </ul>
                        <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
                    </nav>
                    <a class="btn-getstarted" href="appointment.php">Appointments</a>
                </div>
            </header>
    <main class="main" style="margin-top: 11vh;">
    <div class="container mt-5">
    <h2>Prescription Management</h2>
    <form method="GET" action="">
        <div class="form-group">
            <label for="uniqueIdSearch">Unique ID based Prescription</label>
            <input type="text" class="form-control" id="uniqueIdSearch" name="unique_id" placeholder="Paste Unique ID" onkeyup="this.form.submit()">
         
        </div>
    </form>
</div>


<!-- Prescription Modal -->
<div class="modal fade" id="prescriptionModal" tabindex="-1" aria-labelledby="prescriptionModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" style="max-width: 90%;margin-left:5%;">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="prescriptionModalLabel">Prescription for <span id="modalUniqueId"></span></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST">
                <div class="modal-body">
                    <input type="hidden" name="unique_id" id="hiddenUniqueId">
                    <p><strong>Name: </strong><span id="patientName"></span></p>
                    <div class="form-group">
                        <label for="keyTherapies">Key Therapies</label>
                        <div id="keyTherapies" class="mb-3">
                            <span class="badge badge-dark therapy-tag">Cognitive behavioural therapy</span>
                            <span class="badge badge-dark therapy-tag">Relaxation therapy</span>
                            <span class="badge badge-dark therapy-tag">Behavioural therapy</span>
                            <span class="badge badge-dark therapy-tag">Art therapy</span>
                            <span class="badge badge-dark therapy-tag">Interpersonal therapy</span>
                            <span class="badge badge-dark therapy-tag">Emotion focused therapy</span>
                            <span class="badge badge-dark therapy-tag">Family therapy</span>
                            <span class="badge badge-dark therapy-tag">Others</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="medicationPrescribed">Medication Prescribed</label>
                        <textarea class="form-control" name="medication_prescribed" id="medicationPrescribed" rows="3"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="notes">Notes</label>
                        <textarea class="form-control" name="notes" id="notes" rows="5"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
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
    <!-- script -->

    <script>

function showCustomAlert(message) {
            const alertMessageElement = document.getElementById('customAlertMessage');
            alertMessageElement.innerText = message;

            const customAlertModal = new bootstrap.Modal(document.getElementById('customAlertModal'));
            customAlertModal.show();
        }
        document.addEventListener('DOMContentLoaded', function() {
        const customAlertModal = document.getElementById('customAlertModal');

        customAlertModal.addEventListener('hidden.bs.modal', function() {
            location.reload();
        });
    });

$(document).ready(function() {
    // Populate the unique ID search dropdown and handle modal display
    const urlParams = new URLSearchParams(window.location.search);
    const uniqueId = urlParams.get('unique_id');
    if (uniqueId) {
        $.ajax({
            url: 'p_fetch_patient_details.php',
            type: 'GET',
            data: { unique_id: uniqueId },
            success: function(data) {
                const patient = JSON.parse(data);
                $('#modalUniqueId').text(uniqueId);
                $('#hiddenUniqueId').val(uniqueId);
                $('#patientName').text(`${patient.patient_first_name} ${patient.patient_last_name}`);
                $('#medicationPrescribed').val(patient.medication_prescribed);
                $('#notes').val(patient.notes);

                const selectedTherapies = patient.key_therapies ? patient.key_therapies.split(', ') : [];
                $('.therapy-tag').each(function() {
                    const therapy = $(this).text();
                    if (selectedTherapies.includes(therapy)) {
                        $(this).removeClass('badge-dark').addClass('badge-success');
                    } else {
                        $(this).removeClass('badge-success').addClass('badge-dark');
                    }
                });

                $('#prescriptionModal').modal('show');
            }
        });
    }

    $('.therapy-tag').on('click', function() {
        $(this).toggleClass('badge-dark badge-success');
    });

    $('#prescriptionModal form').on('submit', function(event) {
        event.preventDefault();

        const keyTherapies = [];
        $('.therapy-tag.badge-success').each(function() {
            keyTherapies.push($(this).text());
        });

        const formData = $(this).serialize() + '&key_therapies=' + encodeURIComponent(keyTherapies.join(', '));

        $.post('save_prescription.php', formData, function(response) {
            showCustomAlert(response);
            $('#prescriptionModal').modal('hide');
        });
    });
});

</script>
   
</body>

</html>
