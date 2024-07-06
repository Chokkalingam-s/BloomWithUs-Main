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
    <link rel="icon" href="http://bloomwithus.co.in/logo.png" type="image/x-icon">
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

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
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
            align-items: center;
        }
        footer {
            flex-shrink: 0;
            background: #f8f9fa;
        }

        .container {
            max-width: 90vw;
            margin-top: 50px;
        }

        .calendar {
            display: grid;
            grid-template-columns: repeat(7, 1fr);
            gap: 5px;
            margin-bottom: 1rem;
        }

        .calendar div {
            padding: 10px;
            background-color: #fff;
            text-align: center;
            border: 1px solid #ddd;
            position: relative;
            cursor: pointer;
        }

        .calendar .day {
            cursor: pointer;
        }
        .calendar .booked {
            background-color: #28a745;
            color: #fff;
            font-size: 0.5rem;
            margin-top: 0.2rem; /* Space between appointments */
            border-radius: 0.5rem; /* Slightly rounded corners */
            text-align: left; /* Align text to the left */
            white-space: nowrap; /* Prevent wrapping */
            overflow: hidden; /* Hide overflow */
            display: flex;
            flex-direction: column;
        }

        .calendar .booked .appointment-time {
            font-weight: bold; /* Bold for emphasis */
            font-size: 0.7rem; /* Larger font size for time */
            display: block; /* Ensure single-line display */
            overflow: hidden; /* Ensure it stays on one line */
            text-overflow: ellipsis; /* Add ellipsis if it overflows */
            background-color: #28a745;
        }

        .calendar .booked .unique-id {
            font-size: 0.6rem; /* Smaller font size for ID */
            font-weight: bold;
            color: black; /* Light grey color */
            display: block; /* Ensure single-line display */
            overflow: hidden; /* Ensure it stays on one line */
            text-overflow: ellipsis; /* Add ellipsis if it overflows */
            margin-top: 0.1rem; /* Slight margin to separate from time */
            background-color: #83E3A8;
        }
        .calendar-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1rem;
        }

        .btn-link {
            color: #007bff;
            text-decoration: none;
            background: none;
            border: none;
            cursor: pointer;
        }

        .btn-link:hover {
            text-decoration: underline;
            color:#28a745;
        }

        .modal-body {
            max-height: calc(100vh - 200px);
            overflow-y: auto;
        }
        .day{
            font-weight:500;
            display: block;
        } 
        .btn-sm {
            display: block;
            width: 90%;
            margin-left: 5%;
        }      

    </style>
</head>

<body class="index-page">
<div class="container-wrapper">
            <header id="header" class="header d-flex align-items-center fixed-top">
                <div class="container-fluid container-xl position-relative d-flex align-items-center">
                    <a href="index.html" class="logo d-flex align-items-center me-auto">
                        <img src="http://bloomwithus.co.in/logo.png" alt="">
                        <h1 class="sitename">BloomWithUs</h1>
                    </a>
                    <nav id="navmenu" class="navmenu">
                        <ul>
                        <li><a href="admin_dashboard.php">Home</a></li>
                        <li><a href="admin_dashboard.php#AddPost">Add Post</a></li>
                        <li><a href="admin_dashboard.php#ManagePost">Manage Post</a></li>
                        <li><a href="logout.php" style="color: red;">Logout</a></li>
                        </ul>
                        <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
                    </nav>
                    <a class="btn-getstarted" href="appointment.php">View Appointments</a>
                </div>
            </header>
            <main class="main" style="margin-top: 10vh;">
    <div class="container mt-3">
        <h2 class="mb-4 text-center" style="color:#388da8;">Appointment Calendar</h2>
        <div class="calendar-header">
            <button id="prevMonthBtn" class="btn btn-outline-secondary">Previous</button>
            <h2 id="currentMonth" class="mb-0"></h2>
            <button id="nextMonthBtn" class="btn btn-outline-secondary">Next</button>
        </div>
        <div class="calendar" id="adminCalendar">
            <!-- Days will be dynamically added here -->
        </div>
    

    <!-- Appointment Details Modal -->
    <div class="modal fade" id="appointmentDetailsModal" tabindex="-1" aria-labelledby="appointmentDetailsModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="appointmentDetailsModalLabel">Appointment Details</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="appointmentDetailsBody">
                    <!-- Appointment details will be dynamically added here -->
                </div>
               
                    <button type="button" class="btn btn-secondary" style="width:80%; margin-left: 10%;" data-dismiss="modal">Close</button>
                
            </div>
        </div>
    </div>

    <!-- Reservation Modal -->
<div class="modal fade" id="reservationModal" tabindex="-1" aria-labelledby="reservationModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="reservationModalLabel">Reserve Appointment</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="reservationForm" action="save_reservation.php" method="POST">
                    <div class="form-group">
                        <label for="reservationDate">Date</label>
                        <input type="text" class="form-control" id="reservationDate" name="reservationDate" readonly>
                    </div>
                    <div class="form-group">
                        <label for="reservationTimeSlot">Available Time Slots</label>
                        <select class="form-control" id="reservationTimeSlot" name="reservationTimeSlot"></select>
                    </div>
                    <div class="form-group">
                        <label for="reservationPatientId">Patient Unique ID</label>
                        <input type="text" class="form-control" id="reservationPatientId" name="reservationPatientId" placeholder="Enter Patient Unique ID">
                    </div>
                    <div id="patientDetails" style="display: none;">
                        <hr>
                        <div class="form-group">
                            <label for="reservationFirstName">First Name</label>
                            <input type="text" class="form-control" id="reservationFirstName" name="reservationFirstName" readonly>
                        </div>
                        <div class="form-group">
                            <label for="reservationLastName">Last Name</label>
                            <input type="text" class="form-control" id="reservationLastName" name="reservationLastName" readonly>
                        </div>
                        <div class="form-group">
                            <label for="reservationPatientFirstName">Patient First Name</label>
                            <input type="text" class="form-control" id="reservationPatientFirstName" name="reservationPatientFirstName" readonly>
                        </div>
                        <div class="form-group">
                            <label for="reservationPatientLastName">Patient Last Name</label>
                            <input type="text" class="form-control" id="reservationPatientLastName" name="reservationPatientLastName" readonly>
                        </div>
                        <div class="form-group">
                            <label for="reservationRelation">Relation</label>
                            <input type="text" class="form-control" id="reservationRelation" name="reservationRelation" readonly>
                        </div>
                        <div class="form-group">
                            <label for="reservationProfession">Profession</label>
                            <input type="text" class="form-control" id="reservationProfession" name="reservationProfession" readonly>
                        </div>
                        <div class="form-group">
                            <label for="reservationDOB">Date of Birth</label>
                            <input type="text" class="form-control" id="reservationDOB" name="reservationDOB" readonly>
                        </div>
                        <div class="form-group">
                            <label for="reservationAge">Age</label>
                            <input type="text" class="form-control" id="reservationAge" name="reservationAge" readonly>
                        </div>
                        <div class="form-group">
                            <label for="reservationGender">Gender</label>
                            <input type="text" class="form-control" id="reservationGender" name="reservationGender" readonly>
                        </div>
                        <div class="form-group">
                            <label for="reservationPhoneNumber">Phone Number</label>
                            <input type="text" class="form-control" id="reservationPhoneNumber" name="reservationPhoneNumber" readonly>
                        </div>
                        <div class="form-group">
                            <label for="reservationPatientNumber">Patient Number</label>
                            <input type="text" class="form-control" id="reservationPatientNumber" name="reservationPatientNumber" readonly>
                        </div>
                        <div class="form-group">
                            <label for="reservationEmail">Email</label>
                            <input type="text" class="form-control" id="reservationEmail" name="reservationEmail" readonly>
                        </div>
                    </div>
                    <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save Reservation</button>
            </div>
                </form>
            </div>
           
        </div>
    </div>
</div>



    </div>

    </main>
    <footer id="footer" class="footer position-relative light-background">
            <div class="container copyright text-center mt-4">
                <p style="display: flex; justify-content: center;">©<span>Copyright</span> <strong class="px-1 sitename">BloomWithUs</strong><span>All Rights Reserved</span></p>
                <div class="credits">
                    Designed From <a href="https://rudraksha.org.in/" target="_blank"> Rudraksha</a>
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

   <script>

        // Function to copy text to clipboard
        function copyToClipboard(text) {
            navigator.clipboard.writeText(text).then(() => {
                alert('Unique-ID copied to clipboard!');
            }).catch(err => {
                console.error('Error copying to clipboard:', err);
                alert('Failed to copy Unique-ID. Sorry.');
            });
        }
    document.addEventListener('DOMContentLoaded', function () {
    const adminCalendar = document.getElementById('adminCalendar');
    const prevMonthBtn = document.getElementById('prevMonthBtn');
    const nextMonthBtn = document.getElementById('nextMonthBtn');
    const currentMonthDisplay = document.getElementById('currentMonth');

    let currentDisplayedDate = new Date();

    function renderCalendar(date) {
        // Clear existing calendar
        adminCalendar.innerHTML = '';

        const year = date.getFullYear();
        const month = date.getMonth();

        const firstDay = new Date(year, month, 1);
        const lastDay = new Date(year, month + 1, 0);
        const daysInMonth = lastDay.getDate();
        const startDay = firstDay.getDay();

        const dayNames = ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'];

        // Display current month and year
        currentMonthDisplay.textContent = `${getMonthName(month)} ${year}`;

        // Create day name headers
        dayNames.forEach(day => {
            const dayNameElement = document.createElement('div');
            dayNameElement.textContent = day;
            dayNameElement.classList.add('day');
            adminCalendar.appendChild(dayNameElement);
        });

        // Add empty placeholders for days before the 1st day of the month
        for (let i = 0; i < startDay; i++) {
            adminCalendar.appendChild(document.createElement('div'));
        }

        // Loop through each day in the month
        for (let day = 1; day <= daysInMonth; day++) {
            const dayElement = document.createElement('div');
            dayElement.textContent = day;
            dayElement.classList.add('day');

            // Fetch appointments for this day
            fetchAppointments(new Date(year, month, day), dayElement);

            adminCalendar.appendChild(dayElement);
            // In your existing renderCalendar function, after appending dayElement
            const reserveButton = document.createElement('button');
            reserveButton.classList.add('btn', 'btn-outline-secondary', 'btn-sm', 'mt-10');
            reserveButton.textContent = 'Reserve';
            reserveButton.setAttribute('data-toggle', 'modal');
            reserveButton.setAttribute('data-target', '#reservationModal');
            reserveButton.addEventListener('click', function () {
                openReservationModal(year, month, day);
            });
            dayElement.appendChild(reserveButton);

        }
    }

    function getMonthName(month) {
        const monthNames = ['January', 'February', 'March', 'April', 'May', 'June',
                            'July', 'August', 'September', 'October', 'November', 'December'];
        return monthNames[month];
    }

    // Function to fetch appointments for a specific date
    function fetchAppointments(date, dayElement) {
    const year = date.getFullYear();
    const month = date.getMonth();
    const day = date.getDate();

    // Format the date in YYYY-MM-DD for the fetch request
    const formattedDate = `${year}-${(month + 1).toString().padStart(2, '0')}-${day.toString().padStart(2, '0')}`;

    fetch(`fetch_appointments.php?date=${formattedDate}`)
        .then(response => response.json())
        .then(data => {
            data.forEach(appointment => {
                // Parse the appointment date from the response (adjust for timezone if necessary)
                const appointmentDate = new Date(appointment.appointment_date);
                const appointmentTime = appointment.time_slot;
                const uniqueId = appointment.unique_id;

                // Create appointment element and append to dayElement
                    const appointmentElement = document.createElement('div');
                    appointmentElement.classList.add('booked');
                    appointmentElement.setAttribute('data-toggle', 'modal');
                    appointmentElement.setAttribute('data-target', '#appointmentDetailsModal');
                    appointmentElement.addEventListener('click', function () {
                        showAppointmentDetails(uniqueId);
                    });

                    const appointmentTimeElement = document.createElement('span');
                    appointmentTimeElement.classList.add('appointment-time');
                    appointmentTimeElement.textContent = appointmentTime;

                    const uniqueIdElement = document.createElement('span');
                    uniqueIdElement.classList.add('unique-id');
                    uniqueIdElement.textContent = uniqueId;

                    appointmentElement.appendChild(appointmentTimeElement);
                    appointmentElement.appendChild(uniqueIdElement);

                    dayElement.appendChild(appointmentElement);

            });
        })
        .catch(error => console.error('Error fetching appointments:', error));
}


    // Function to show appointment details in modal
    function showAppointmentDetails(uniqueId) {
        fetch(`get_appointment_details.php?unique_id=${uniqueId}`)
            .then(response => response.json())
            .then(data => {
                const appointmentDetailsBody = document.getElementById('appointmentDetailsBody');
                appointmentDetailsBody.innerHTML = `
                      <p><strong>UniqueID:</strong> 
                    ${data.unique_id} 
                    <br>
                    <button class="btn btn-link" onclick="copyToClipboard('${data.unique_id}')">
                        <i class="bi bi-copy" >Copy Unique Id</i>
                    </button>
                </p>
                    <p><strong>Name:</strong> ${data.first_name} ${data.last_name}</p>
                    <p><strong>Patient Name:</strong> ${data.patient_first_name} ${data.patient_last_name}</p>
                    <p><strong>Relation:</strong> ${data.relation_to_patient}</p>
                    <p><strong>Appointment Date:</strong> ${data.appointment_date}</p>
                    <p><strong>Time Slot:</strong> ${data.time_slot}</p>
                    <p><strong>Profession:</strong> ${data.profession}</p>
                    <p><strong>DOB:</strong> ${data.dob}</p>
                    <p><strong>Age:</strong> ${data.age}</p>
                    <p><strong>Gender:</strong> ${data.gender}</p>
                    <p><strong>Phone Number:</strong> ${data.phone_number}</p>
                    <p><strong>Patient Phone Number:</strong> ${data.patient_number}</p>
                    <p><strong>Email:</strong> ${data.email}</p>
                `;
                $('#appointmentDetailsModal').modal('show');
            })
            .catch(error => console.error('Error fetching appointment details:', error));
    }



    // Event listeners for navigation buttons
    prevMonthBtn.addEventListener('click', function () {
        currentDisplayedDate.setMonth(currentDisplayedDate.getMonth() - 1);
        renderCalendar(currentDisplayedDate);
    });
    nextMonthBtn.addEventListener('click', function () {
        currentDisplayedDate.setMonth(currentDisplayedDate.getMonth() + 1);
        renderCalendar(currentDisplayedDate);
    });

    function openReservationModal(year, month, day) {
    const formattedDate = `${year}-${(month + 1).toString().padStart(2, '0')}-${day.toString().padStart(2, '0')}`;
    document.getElementById('reservationDate').value = formattedDate; 
    // Fetch booked time slots
    fetch(`fetch_available_slots.php?date=${formattedDate}`)
        .then(response => response.json())
        .then(bookedSlots => {
            const allSlots = [
                '10:00 AM To 10:30 AM',
                '10:30 AM To 11:00 AM',
                '11:00 AM To 11:30 AM',
                '11:30 AM To 12:00 PM',
                '12:00 PM To 12:30 PM',
                '12:30 PM To 01:00 PM',
                '02:00 PM To 02:30 PM',
                '02:30 PM To 03:00 PM',
                '03:00 PM To 03:30 PM',
                '03:30 PM To 04:00 PM',
                '04:00 PM To 04:30 PM',
                '04:30 PM To 05:00 PM',
                '05:00 PM To 05:30 PM',
                '05:30 PM To 06:00 PM',
            ];
            const availableSlots = allSlots.filter(slot => !bookedSlots.includes(slot));
            const timeSlotSelect = document.getElementById('reservationTimeSlot');
            timeSlotSelect.innerHTML = '';
            availableSlots.forEach(slot => {
                const option = document.createElement('option');
                option.value = slot;
                option.textContent = slot;
                timeSlotSelect.appendChild(option);
            });
        })
        .catch(error => console.error('Error fetching time slots:', error));
    // Clear patient details
    document.getElementById('reservationPatientId').value = '';
    document.getElementById('patientDetails').style.display = 'none';
}



// Event listener for patient ID input
document.getElementById('reservationPatientId').addEventListener('input', function() {
    const uniqueId = this.value;
    if (uniqueId.length >= 3) {
        fetch(`fetch_patient_details.php?unique_id=${uniqueId}`)
            .then(response => response.json())
            .then(data => {
                if (Object.keys(data).length > 0) {
                    document.getElementById('reservationFirstName').value = data.first_name;
                    document.getElementById('reservationLastName').value = data.last_name;
                    document.getElementById('reservationPatientFirstName').value = data.patient_first_name;
                    document.getElementById('reservationPatientLastName').value = data.patient_last_name;
                    document.getElementById('reservationRelation').value = data.relation_to_patient;
                    document.getElementById('reservationProfession').value = data.profession;
                    document.getElementById('reservationDOB').value = data.dob;
                    document.getElementById('reservationAge').value = data.age;
                    document.getElementById('reservationGender').value = data.gender;
                    document.getElementById('reservationPhoneNumber').value = data.phone_number;
                    document.getElementById('reservationPatientNumber').value = data.patient_number;
                    document.getElementById('reservationEmail').value = data.email;
                    document.getElementById('patientDetails').style.display = 'block';
                } else {
                    document.getElementById('patientDetails').style.display = 'none';
                }
            })
            .catch(error => console.error('Error fetching patient details:', error));
    } else {
        document.getElementById('patientDetails').style.display = 'none';
    }
});

// Handle form submission on admin side
const reservationForm = document.getElementById('reservationForm');
reservationForm.addEventListener('submit', function(e) {
    e.preventDefault();
    
    const formData = new FormData(reservationForm);

    fetch('save_reservation.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            const appointmentID = data.appointmentID;
            const reservationDate = data.reservationDate;
            alert(`Appointment for ${appointmentID} Reserved successfully on ${reservationDate}!`);
            location.reload();
            renderCalendar(currentDisplayedDate);
        } else {
            alert('Failed to reserve appointment. Please try again.');
        }
    })
   
});
    renderCalendar(currentDisplayedDate);
});

   </script>
</body>

</html>
