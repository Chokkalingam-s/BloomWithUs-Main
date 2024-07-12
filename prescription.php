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
            background-color: #F7F9F7;
        }
        .section2{
            background-color: #F1F5F2;
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
    <div class="modal-dialog modal-lg" style="max-width: 90%;margin-left:5%;height: 95vh;margin-top:2vh;">
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
                    <div class="row">
                        <div class="col-3 section1" >
                            <div class="row h-20 appointment_details">
                               <!--- Appointment details automatic render bruh -->
                            </div>
                            <div class="row h-80 old_prescription">
                             
                            </div>
                        </div>
                        <div class="col-5 section2">
                        <div class="form-group">
                            <label for="key-therapies"><h4>Key Therapies</h4></label>
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

                        <div class="form-group">
                            <label for="diseases"><h4>Diseases</h4></label>
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


                        <h4>Medicine Table</h4>
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
                                        <td><input type="text" class="form-control"></td>
                                        <td><input type="number" class="form-control"></td>
                                        <td><input type="number" class="form-control"></td>
                                        <td>
                                            <select class="form-control">
                                                <option>Before Meal</option>
                                                <option>After Meal</option>
                                            </select>
                                        </td>
                                        <td>
                                            <input type="checkbox" class="form-control sos-checkbox">
                                        </td>
                                        <td>
                                            <button type="button" class="btn btn-success save-btn">Save</button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                             

                        </div>
                        <div class="col-4 section3">
                              <div class="future_appointments">

                              </div>
                            <div class="form-group">
                                    <label for="notes"><h4>Notes</h4></label>
                                    <textarea class="form-control" name="notes" id="notes" rows="5"></textarea>
                                </div>
                        </div>
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
    const urlParams = new URLSearchParams(window.location.search);
    const uniqueId = urlParams.get('unique_id');
    if (uniqueId){
        // Fetch appointment details for section 1 and 3
        fetch(`get_appointment_details.php?unique_id=${uniqueId}`)
            .then(response => response.json())
            .then(data => {
                if (data.message) {
                    console.error('Appointment not found');
                } else {
                    $('.appointment_details').html(`
                        <div class="row">
                            <div class="col-12">
                                 <p><strong>Name: ${data.patient_first_name} ${data.patient_last_name} </strong></p>
                            </div>
                            <div class="col-4">
                                <p><strong>Age:</strong> ${data.age}</p> 
                            </div>
                            <div class="col-8">
                                <p><strong>Gender:</strong> ${data.gender}</p> 
                            </div>
                            <p><strong>Profession:</strong> ${data.profession}</p>
                            <p><strong>Phone Number:</strong> ${data.phone_number}</p>
                        </div>
                    `);

                    // Display previous appointments
                    let previousAppointmentsHtml = '<h5>Previous Appointments</h5>';
                    if (data.previous_appointments.length > 0) {
                        data.previous_appointments.forEach(appointment => {
                            previousAppointmentsHtml += `<p>${appointment.appointment_date} - ${appointment.time_slot}</p>`;
                        });
                    } else {
                        previousAppointmentsHtml += '<p>No previous appointments</p>';
                    }

                    // Display future appointments
                    let futureAppointmentsHtml = '<h5>Upcoming Appointments</h5>';
                    if (data.future_appointments.length > 0) {
                        data.future_appointments.forEach(appointment => {
                            futureAppointmentsHtml += `<p>${appointment.appointment_date} - ${appointment.time_slot}</p>`;
                        });
                    } else {
                        futureAppointmentsHtml += '<p>No future appointments</p>';
                    }

                    $('.future_appointments').html(`
                        ${previousAppointmentsHtml}
                        ${futureAppointmentsHtml}
                    `);
                }
            })
            .catch(error => console.error('Error fetching appointment details:', error));

                // Function to update badges based on selected options
                function updateBadges(selectElementId, badgeContainerId, selectedItems) {
                    const selectedOptions = $(`#${selectElementId} option:selected`);
                    const badgeContainer = $(`#${badgeContainerId}`);
                    badgeContainer.empty();

                    selectedOptions.each(function() {
                        const badge = $('<span>').addClass('badge badge-success').text($(this).text());
                        badgeContainer.append(badge);
                    });
                }

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

                // Select key therapies and diseases based on fetched data
                const selectedTherapies = patient.key_therapies ? patient.key_therapies.split(', ') : [];
                const selectedDiseases = patient.diseases ? patient.diseases.split(', ') : [];
                $('#key-therapies').val(selectedTherapies);
                $('#diseases').val(selectedDiseases);

                 // Update key therapies badges
                 updateBadges('key-therapies', 'key-therapies-badges', patient.key_therapies);

                    // Update diseases badges
                    updateBadges('diseases', 'diseases-badges', patient.diseases);

                $('#prescriptionModal').modal('show');
            }
        });
    }

         // Handle form submission
    $('#prescriptionModal form').on('submit', function(event) {
        event.preventDefault();

        // Serialize form data including key therapies and diseases
        const keyTherapies = $('#key-therapies').val().join(', ');
        const diseases = $('#diseases').val().join(', ');
        const formData = $(this).serialize() + `&key_therapies=${encodeURIComponent(keyTherapies)}&diseases=${encodeURIComponent(diseases)}`;

        // Send data to save_prescription.php using AJAX
        $.post('save_prescription.php', formData, function(response) {
            showCustomAlert(response);
            $('#prescriptionModal').modal('hide');
        });
    });

          //save_prescription
   
});





function createTableRow(data) {
            const row = $('<tr>');
            row.append($('<td>').text(data.medicineName));
            row.append($('<td>').text(data.noOfTimes));
            row.append($('<td>').text(data.quantity));
            row.append($('<td>').text(data.meal));
            const sos = $('<td>').text(data.sos ? 'Yes' : 'No');
            if (data.sos) {
                sos.addClass('table-danger');
            }
            row.append(sos);
            const options = $('<td>');
            const editBtn = $('<button>').addClass('btn btn-warning').text('Edit');
            const deleteBtn = $('<button>').addClass('btn btn-danger').text('Delete');
            options.append(editBtn).append(deleteBtn);
            row.append(options);
            return row;
        }

        function clearInputFields() {
            $('#medicine-table-body input[type="text"], #medicine-table-body input[type="number"]').val('');
            $('#medicine-table-body select').val('Before Meal');
            $('#medicine-table-body i=nput[type="checkbox"]').prop('checked', false);
        }

        $(document).on('click', '.save-btn', function() {
            const row = $(this).closest('tr');
            const data = {
                medicineName: row.find('input[type="text"]').val(),
                noOfTimes: row.find('input[type="number"]').eq(0).val(),
                quantity: row.find('input[type="number"]').eq(1).val(),
                meal: row.find('select').val(),
                sos: row.find('input[type="checkbox"]').is(':checked')
            };

            const newRow = createTableRow(data);
            $('#medicine-table-body').append(newRow);

            clearInputFields();
        });

</script>
   
</body>

</html>
