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
        }
        .table td, .table th {
            vertical-align: middle;
        }
        .section1 ,.section3{
            background-color: #D4DBD3;
        }
        .section2{
            background-color: #DAE0DA ;

        }
        .disease-select{
            width: 50vw;
        }
        .therapy-select {
            width: 50vw;
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
        }

        .row{
            margin-top: -1.1% !important;
            margin-bottom: -1.1% !important;
        }

        .patient-photo {
            display: flex;
            align-items: center;
            justify-content: center;
            border: 1px solid #ddd;
            padding: 10px;
            height: 200px;
        }

        .add-photo-btn {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 100px;
            height: 100px;
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
            width: 100px;
            height: 100px;
            object-fit: cover;
            display: none;
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
    <h2>Prescription!</h2>
    <form method="GET" action="">
        <div class="form-group">
            <label for="uniqueIdSearch">Unique ID based Prescription</label>
            <input type="text" class="form-control" id="uniqueIdSearch" name="unique_id" placeholder="Paste Unique ID" onkeyup="this.form.submit()">
         
        </div>
    </form>
    </div>


<!-- Prescription Modal -->
<div class="modal fade" id="prescriptionModal" tabindex="-1" aria-labelledby="prescriptionModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg mt-0 " style="max-width: 100%;max-height: 100vh;">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="prescriptionModalLabel">Prescription for <span id="modalUniqueId"></span></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST">
                <div class="modal-body" style="background-color: #E7EBE6;">
                    <input type="hidden" name="unique_id" id="hiddenUniqueId">
                    <div class="row">
                        <div class="col-md-3 section1">
                            <div class="row appointment_details pt-1">
                                <!-- Appointment details automatic render -->
                            </div>

                            <div class="patient_photo row">
                                <div class="col-md-6 d-flex justify-content-center align-items-center mt-2">
                                    <div class="add-photo-btn">
                                        +
                                        <input type="file" id="upload-photo" accept="image/*" onchange="displayPhoto(event)">
                                    </div>
                                    <img id="patient-photo" class="passport-photo" alt="Patient Photo">
                                </div>
                            </div>

                            <div class="row  old_prescription"  >
                                <div class="form-check ml-4 " style="margin-top:16%;">
                                    <input class="form-check-input  border-success " type="checkbox" id="oldPrescriptionAvailable">
                                    <label class="form-check-label" for="oldPrescriptionAvailable">
                                        Old Prescription Available
                                    </label>
                                </div>
                                <div class="mt-3 d-none" id="oldPrescriptionForm">
                                    <div class="mb-3">
                                        <label for="doctorName" class="form-label">Doctor Name</label>
                                        <input type="text" class="form-control" id="doctorName" name="doctor_name" placeholder="Past Doctor's name">
                                    </div>
                                    <div class="mb-3">
                                        <label for="timeDuration" class="form-label">Time Duration Treated</label>
                                        <input type="text" class="form-control" id="timeDuration" name="time_duration" placeholder="Time duration treated">
                                    </div>
                                    <div class="mb-3">
                                        <label for="medicineTook" class="form-label">Medicine Took</label>
                                        <textarea class="form-control" id="medicineTook" name="medicine_took" rows="2" placeholder="Previous Medication"></textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label for="prescriptionImage" class="form-label">Attachment of Image (old prescription image)</label>
                                        <input type="file" class="form-control" id="prescriptionImage" name="prescription_image">
                                    </div>
                                </div>
                                <!-- Display Old Prescription Details -->
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-12" id="oldPrescriptionDetails">
                                            <!-- Old prescription details will be injected here if available -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-9 section2">
                            <h2 class="my-3"> <strong> Diagnosis </strong></h2>
                        <div class="form-group">
                            <label for="diseases"><h4>Diseases</h4></label><br>
                            <select id="diseases" class="form-control disease-select" multiple="multiple">
                                <option>Major Depressive Disorder (MDD)</option>
                                <option>Generalized Anxiety Disorder (GAD)</option>
                                <option>Panic Disorder</option>
                                <option>Social Anxiety Disorder</option>
                                <option>Post-Traumatic Stress Disorder (PTSD)</option>
                                <option>Obsessive-Compulsive Disorder (OCD)</option>
                                <option>Acute Stress Disorder</option>
                                <option>Others</option>
                            </select>
                            <div id="diseases-badges" class="badge-container"></div>
                        </div>
                        <div class="form-group pt-1">
                            <label for="key-therapies"><h4>Therapies</h4></label><br>
                            <select id="key-therapies" class="form-control therapy-select" multiple="multiple">
                                <option>Cognitive behavioural therapy</option>
                                <option>Relaxation therapy</option>
                                <option>Behavioural therapy</option>
                                <option>Art therapy</option>
                                <option>Interpersonal therapy</option>
                                <option>Emotion focused therapy</option>
                                <option>Family therapy</option>
                            </select>
                            <div id="key-therapies-badges" class="badge-container"></div>
                        </div>

                        <h4><strong>Medicine</strong></h4>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Medicine</th>
                                        <th>Times/day</th>
                                        <th>Dose(mg)</th>
                                        <th>B/A Meal</th>
                                        <th>SOS</th>
                                        <th>Options</th>
                                    </tr>
                                </thead>
                                <tbody id="medicine-table-body">
                                    <tr>
                                        <td><input type="text" name="medicine" class="form-control"></td>
                                        <td><input type="text" name="times_per_day" class="form-control"></td>
                                        <td><input type="number" name="dose" class="form-control"></td>
                                        <td>
                                            <select name="before_after_meal" class="form-control">
                                                <option>Before Meal</option>
                                                <option>After Meal</option>
                                            </select>
                                        </td>
                                        <td class="sos-checkbox-cell">
                                        <div class="sos-checkbox-wrapper">
                                            <input type="checkbox" name="sos" class="form-check-input sos-checkbox">
                                        </div>
                                        </td>
                                        <td>
                                            <button type="button" id="save-medicine-btn" class="btn btn-success save-btn">Save</button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>

                            <h4><strong>Therapies</strong></h4>
                            <table class="table mt-2">
                                <thead>
                                    <tr>
                                        <th>Therapies</th>
                                        <th>Times/day</th>
                                        <th>B/A Meal</th>
                                        <th>SOS</th>
                                        <th>Options</th>
                                    </tr>
                                </thead>
                                <tbody id="therapies-table-body">
                                    <tr>
                                        <td><input type="text" name="therapies" class="form-control"></td>
                                        <td><input type="text" name="therapies_times_per_day" class="form-control"></td>
                                        <td>
                                            <select name="therapies_before_after_meal" class="form-control">
                                                <option>Before Meal</option>
                                                <option>After Meal</option>
                                            </select>
                                        </td>
                                        <td class="sos-checkbox-cell">
                                        <div class="sos-checkbox-wrapper">
                                            <input type="checkbox" name="therapies_sos" class="form-check-input sos-checkbox">
                                        </div>
                                        </td>
                                        <td>
                                            <button type="button" id="save-therapies-btn" class="btn btn-success therapies-save-btn">Save</button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>

                        
                               <div class="row "> 
                              <div class="past_appointments pt-1 col-6 my-5">

                              </div>
                              <div class="future_appointments pt-1 col-6 my-5">

                              </div>
                              </div>
                              <div class="row">
                            <div class="form-group col-6">
                                    <label for="notes"><h4 style="color:#282924;"><strong>Patient Remarks</strong></h4></label>
                                    <textarea class="form-control" name="notes" id="notes" rows="5"></textarea>
                                </div>
                                <div class="form-group col-6">
                                    <label for="notes2"><h4 style="color:#282924;"><strong>Personal Remarks</strong></h4></label>
                                    <textarea class="form-control" name="notes2" id="notes2" rows="5"></textarea>
                                </div>
                                </div>
                                </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-dark w-50 mx-auto" >Save</button>
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
    <script src="assets/js/customAlert.js"></script>
    <!-- script -->

       <!-- jQuery -->
       <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
       <!-- Bootstrap JS -->
       <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
       <!-- select2 JS -->
       <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>

    <script>
        function displayPhoto(event) {
            const photo = document.getElementById('patient-photo');
            const addButton = document.querySelector('.add-photo-btn');
            photo.src = URL.createObjectURL(event.target.files[0]);
            photo.style.display = 'block';
            addButton.style.display = 'none';
        }

   $(document).ready(function() {
    const urlParams = new URLSearchParams(window.location.search);
    const uniqueId = urlParams.get('unique_id');
    if (uniqueId){
        $('#oldPrescriptionAvailable').change(function() {
            if ($(this).is(':checked')) {
                $('#oldPrescriptionForm').removeClass('d-none');
            } else {
                $('#oldPrescriptionForm').addClass('d-none');
            }
        });
        // Fetch appointment details for section 1 and 3
        fetch(`get_appointment_details.php?unique_id=${uniqueId}`)
            .then(response => response.json())
            .then(data => {
                if (data.message) {
                    console.error('Appointment not found');
                } else {
                    $('.appointment_details').html(`
                        <div class="row" >
                            <div class="col-12" style="margin-top: 5%;">
                                 <p style="font-size:1.2em;"><strong>Name: ${data.patient_first_name} ${data.patient_last_name} </strong></p>
                                 <p>${uniqueId}</p>
                            </div>
                            <div class="col-4">
                                <p><strong>Age:</strong> ${data.age}</p> 
                            </div>
                            <div class="col-8">
                                <p><strong>Gender:</strong> ${data.gender}</p> 
                            </div>
                            <div class="col-12">
                            <p><strong>Profession:</strong> ${data.profession}</p>
                            <p><strong>Phone Number:</strong> ${data.phone_number}</p>
                             </div>
                        </div>
                    `);

                    // Display previous appointments
                    let previousAppointmentsHtml = '<h4 style="color:#282924;"><strong>Previous Appointments</strong></h4>';
                    if (data.previous_appointments.length > 0) {
                        data.previous_appointments.forEach(appointment => {
                            previousAppointmentsHtml += `<p>${appointment.appointment_date} - ${appointment.time_slot}</p>`;
                        });
                    } else {
                        previousAppointmentsHtml += '<p>No previous appointments</p>';
                    }

                    // Display future appointments
                    let futureAppointmentsHtml = '<h4 style="color:#282924;"><strong>Upcoming Appointments</strong></h4>';
                    if (data.future_appointments.length > 0) {
                        data.future_appointments.forEach(appointment => {
                            futureAppointmentsHtml += `<p>${appointment.appointment_date} - ${appointment.time_slot}</p>`;
                        });
                    } else {
                        futureAppointmentsHtml += '<p>No future appointments</p>';
                    }

                    $('.past_appointments').html(`
                        ${previousAppointmentsHtml}
                    `);

                    $('.future_appointments').html(`
                        ${futureAppointmentsHtml}
                    `);
                }
            })
            .catch(error => console.error('Error fetching appointment details:', error));

                // Function to update badges based on selected options
                        // Initialize select2 for disease
                        $('.disease-select').select2({
                            tags: true,
                            tokenSeparators: [',', ' ']
                        });

                        // Initialize select2 for therapy
                        $('.therapy-select').select2({
                            tags: true,
                            tokenSeparators: [',', ' ']
                        });
        function updateBadges(selectElementId, badgeContainerId, selectedItems) {
                const selectedOptions = $(`#${selectElementId} option:selected`);
                const badgeContainer = $(`#${badgeContainerId}`);
                badgeContainer.empty();

                selectedOptions.each(function() {
                    const badge = $('<span>').addClass('badge badge-success').text($(this).text());
                    badgeContainer.append(badge);
                });

                // Handle dynamically added items not in options
                selectedItems.forEach(item => {
                    if (!selectedOptions.filter(function() { return $(this).text() === item; }).length) {
                        const badge = $('<span>').addClass('badge badge-success').text(item);
                        badgeContainer.append(badge);
                    }
                });
                }

 

    
        // AJAX request to fetch medicine data
        $.ajax({
            url: 'fetch_medicine.php',
            type: 'GET',
            data: { unique_id: uniqueId }, // Send unique_id as parameter if needed
            dataType: 'json', // Expect JSON response
            success: function(response) {
                if (response.success) {
                    const medicines = response.data;
         
                    // Append new rows
                    medicines.forEach(medicine => {
                        const rowHtml = `
                            <tr data-id="${medicine.unique_id}"
                                data-name="${medicine.medicine_name}"
                                data-times="${medicine.times_per_day}"
                                data-dose="${medicine.dose_mg}"
                                data-sos="${medicine.sos ? '1' : '0'}"
                                class="${medicine.sos ? 'sos-highlight' : ''}">
                                <td>${medicine.medicine_name}</td>
                                <td>${medicine.times_per_day}</td>
                                <td>${medicine.dose_mg}</td>
                                <td>${medicine.before_after_meal}</td>
                                <td>${medicine.sos ? 'Yes' : 'No'}</td>
                                <td>
                                    <button type="button" class="btn btn-danger delete-medicine-btn">Delete</button>
                                </td>
                            </tr>
                        `;
                        $('#medicine-table-body').append(rowHtml);
                    });
                } else {
                    console.error('Failed to fetch medicine data:', response.message);
                }
            },
            error: function(xhr, status, error) {
                console.error('Error fetching medicine data:', error);
            }
        });

        $.ajax({
            url: 'fetch_therapies.php',
            type: 'GET',
            data: { unique_id: uniqueId }, // Send unique_id as parameter if needed
            dataType: 'json', // Expect JSON response
            success: function(response) {
                if (response.success) {
                    const therapies = response.data;
         
                    // Append new rows
                    therapies.forEach(therapie => {
                        const rowHtml = `
                            <tr data-id="${therapie.unique_id}"
                                data-name="${therapie.therapies_name}"
                                data-times="${therapie.times_per_day}"
                                data-sos="${therapie.sos ? '1' : '0'}"
                                class="${therapie.sos ? 'sos-highlight' : ''}">
                                <td>${therapie.therapies_name}</td>
                                <td>${therapie.times_per_day}</td>
                                <td>${therapie.before_after_meal}</td>
                                <td>${therapie.sos ? 'Yes' : 'No'}</td>
                                <td>
                                    <button type="button" class="btn btn-danger delete-therapies-btn">Delete</button>
                                </td>
                            </tr>
                        `;
                        $('#therapies-table-body').append(rowHtml);
                    });
                } else {
                    console.error('Failed to fetch therapies data:', response.message);
                }
            },
            error: function(xhr, status, error) {
                console.error('Error fetching therapies data:', error);
            }
        });


        $('#medicine-table-body').on('click', '.delete-medicine-btn', function() {
                var medicineRow = $(this).closest('tr');
                var medicineName = medicineRow.data('name');
                var timesPerDay = medicineRow.data('times');
                var doseMg = medicineRow.data('dose');
                var sos = medicineRow.data('sos');
                var unique_Id = uniqueId;

                // Confirm deletion
                if (confirm('Are you sure you want to delete ' + medicineName+'?')) {
                    // AJAX call to delete from database
                    $.ajax({
                        url: 'delete_medicine.php',
                        method: 'POST',
                        data: {
                            unique_id: unique_Id ,
                            medicine_name: medicineName,
                            times_per_day: timesPerDay,
                            dose_mg: doseMg,
                            sos: sos
                        },
                        success: function(response) {
                            // Remove the row from the table if deletion is successful
                            if (response == 'success') {
                                medicineRow.remove();
                                showCustomAlert('Medicine deleted successfully.');
                            } else {
                                showCustomAlert('Failed to delete medicine.');
                            }
                        },
                        error: function() {
                            alert('Error deleting medicine.');
                        }
                    });
                }
            });

            $('#therapies-table-body').on('click', '.delete-therapies-btn', function() {
                var therapiesRow = $(this).closest('tr');
                var therapiesName = therapiesRow.data('name');
                var timesPerDay = therapiesRow.data('times');
                var sos = therapiesRow.data('sos');
                var unique_Id = uniqueId;

                // Confirm deletion
                if (confirm('Are you sure you want to delete ' + therapiesName +'?')) {
                    // AJAX call to delete from database
                    $.ajax({
                        url: 'delete_therapies.php',
                        method: 'POST',
                        data: {
                            unique_id: unique_Id ,
                            therapies_name: therapiesName,
                            times_per_day: timesPerDay,
                            sos: sos
                        },
                        success: function(response) {
                            // Remove the row from the table if deletion is successful
                            if (response == 'success') {
                                therapiesRow.remove();
                                showCustomAlert('Therapies deleted successfully.');
                            } else {
                                showCustomAlert('Failed to delete therapies.');
                            }
                        },
                        error: function() {
                            alert('Error deleting therapies.');
                        }
                    });
                }
            });


        // Fetch old prescription details
        $.ajax({
                url: 'get_old_prescription.php',
                type: 'GET',
                data: { unique_id: uniqueId },
                success: function(data) {
                    console.log('Response from server:', data); // Add this line
                    const oldPrescription = JSON.parse(data);
                    console.log('Parsed data:', oldPrescription); // Add this line

                    if (oldPrescription.message) {
                        console.error('Old prescription not found');
                    } else {
                        $('#doctorName').val(oldPrescription.doctor_name);
                        $('#timeDuration').val(oldPrescription.time_duration);
                        $('#medicineTook').val(oldPrescription.medicine_took);

                        const oldPrescriptionHtml = `
                            <h5>Old Prescription Details</h5>
                            <p><strong>Doctor Name:</strong> ${oldPrescription.doctor_name}</p>
                            <p><strong>Time Duration Treated:</strong> ${oldPrescription.time_duration}</p>
                            <p><strong>Medicine Took:</strong> ${oldPrescription.medicine_took}</p>
                                <p><strong>Image:</strong> 
                    <a href="${oldPrescription.prescription_image}" target="_blank" class="btn btn-light" style="background-color: #765341; color: white;">
                        View Image
                    </a>
                </p>
                        `;
                        $('#oldPrescriptionDetails').html(oldPrescriptionHtml);
                    }
                },
                error: function(error) {
                    console.error('Error fetching old prescription details:', error);
                }
            });


                // Handle form submission
                $('#prescriptionModal form').on('submit', function(event) {
                    event.preventDefault();
                    // Serialize form data for key therapies and diseases
                        const keyTherapies = $('#key-therapies').val().join(', ');
                        const diseases = $('#diseases').val().join(', ');

                        const formData = new FormData(this);
                        formData.append('medicineData', JSON.stringify(medicineDataArray));
                        formData.append('therapiesData', JSON.stringify(therapiesDataArray));
                        formData.append('key_therapies', keyTherapies);
                        formData.append('diseases', diseases);

                    $.ajax({
                        url: 'save_prescription.php',
                        type: 'POST',
                        data: formData,
                        contentType: false,
                        processData: false,
                        success: function(response) {
                            showCustomAlert(response);
                            $('#prescriptionModal').modal('hide');
                        },
                        error: function(error) {
                            console.error('Error saving prescription:', error);
                        }
                    });
                });
            




            // Update badges on change
            $('#key-therapies').change(function() {
                updateBadges('key-therapies', 'key-therapies-badges', $(this).val());
            });

            // Event listener for disease selection change
            $('#diseases').change(function() {
                updateBadges('diseases', 'diseases-badges', $(this).val());
            });

        // Fetch prescription details
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
                $('#notes2').val(patient.notes2);

                // Select key therapies and diseases based on fetched data
                const selectedTherapies = patient.key_therapies ? patient.key_therapies.split(', ') : [];
                const selectedDiseases = patient.diseases ? patient.diseases.split(', ') : [];
                $('#key-therapies').val(selectedTherapies);
                $('#diseases').val(selectedDiseases);

                // Update key therapies badges
                updateBadges('key-therapies', 'key-therapies-badges', selectedTherapies);

                // Update diseases badges
                updateBadges('diseases', 'diseases-badges', selectedDiseases);

                        $('#prescriptionModal').modal('show');
                    }
                });
            }
        
        });

        function createTableRow(data) {
                    const row = $('<tr>');
                    row.append($('<td>').text(data.medicineName));
                    row.append($('<td>').text(data.noOfTimes));
                    row.append($('<td>').text(data.quantity));
                    row.append($('<td>').text(data.meal));
                    const sos = $('<td>').text(data.sos ? 'Yes' : 'No');
                    if (data.sos) {
                        row.addClass('table-danger');
                    }
                    row.append(sos);
                    const options = $('<td>');
                    const deleteBtn = $('<button>').addClass('btn btn-danger delete').text('Delete');
                    options.append(deleteBtn);
                    row.append(options);
                    return row;
                }

                function clearInputFields() {
                    $('#medicine-table-body input[type="text"], #medicine-table-body input[type="number"]').val('');
                    $('#medicine-table-body select').val('Before Meal');
                    $('#medicine-table-body input[type="checkbox"]').prop('checked', false);
                }

                const medicineDataArray = [];
                $(document).on('click', '.save-btn', function() {
                    const row = $(this).closest('tr');
                    const data = {
                        medicineName: row.find('input[type="text"]').eq(0).val(),
                        noOfTimes: row.find('input[type="text"]').eq(1).val(),
                        quantity: row.find('input[type="number"]').eq(0).val(),
                        meal: row.find('select').val(),
                        sos: row.find('input[type="checkbox"]').is(':checked')
                    };
                    medicineDataArray.push(data);

                    const newRow = createTableRow(data);
                    $('#medicine-table-body').append(newRow);
                    clearInputFields();
                });

                        $(document).on('click', '.delete', function() {
                    const row = $(this).closest('tr');
                    const index = row.index(); 
                    row.remove(); 
                    medicineDataArray.splice(index, 1);
                });

                // therapies
                function createTableRow1(data) {
                    const row = $('<tr>');
                    row.append($('<td>').text(data.therapiesName));
                    row.append($('<td>').text(data.noOfTimes));
                    row.append($('<td>').text(data.meal));
                    const sos = $('<td>').text(data.sos ? 'Yes' : 'No');
                    if (data.sos) {
                        row.addClass('table-danger');
                    }
                    row.append(sos);
                    const options = $('<td>');
                    const deleteBtn = $('<button>').addClass('btn btn-danger therapies-delete').text('Delete');
                    options.append(deleteBtn);
                    row.append(options);
                    return row;
                }

                function clearInputFields1() {
                    $('#therapies-table-body input[type="text"], #medicine-table-body input[type="number"]').val('');
                    $('#therapies-table-body select').val('Before Meal');
                    $('#therapies-table-body input[type="checkbox"]').prop('checked', false);
                }

                const therapiesDataArray = [];
                $(document).on('click', '.therapies-save-btn', function() {
                    const row = $(this).closest('tr');
                    const data = {
                        therapiesName: row.find('input[type="text"]').eq(0).val(),
                        noOfTimes: row.find('input[type="text"]').eq(1).val(),
                        meal: row.find('select').val(),
                        sos: row.find('input[type="checkbox"]').is(':checked')
                    };
                    therapiesDataArray.push(data);

                    const newRow = createTableRow1(data);
                    $('#therapies-table-body').append(newRow);
                    clearInputFields1();
                });

                        $(document).on('click', '.therapies-delete', function() {
                    const row = $(this).closest('tr');
                    const index = row.index(); 
                    row.remove(); 
                    therapiesDataArray.splice(index, 1);
                });
</script>
</body>
</html>
