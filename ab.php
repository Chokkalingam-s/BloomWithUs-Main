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
    <link href="https://fonts.googleapis.com" rel="preconnect">
    <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;400;500;700;900&family=Inter:wght@100;200;300;400;500;600;700;800;900&family=Nunito:wght@200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="assets/vendor/aos/aos.css" rel="stylesheet">
    <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
    <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

    <!-- Main CSS File -->
    <link href="assets/css/main.css" rel="stylesheet">
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
        }

        .calendar .day-name{
            background-color: #77b6ca;
            border: 1px solid #dee2e6;
            padding: 10px;
            text-align: center;
        }
        .calendar .date {
            background-color: #e4feff;
            border: 1px solid #dee2e6;
            padding: 10px;
            text-align: center;
        }

        .calendar .day {
            cursor: pointer;
        }
        .calendar .booked {
            background-color: #dc3545;
            color: #fff;
        }
        .calendar-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1rem;
        }
        .form-check-input{
            border-color: green;
            border-width: 2px;
            box-shadow: 1px 1px;
        }
        .modal-title{
            margin-left: 30%;
            font-weight: bolder;
        }

        #existingUserDropdown {
    width: auto;
    min-width: 70px; 
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
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="customAlertMessage">
                <!-- Dynamic alert message will be injected here -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
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
                        <li><a href="index.php">Home</a></li>
                        <li><a href="index.php#about">About</a></li>
                        <li><a href="index.php#features">Expert</a></li>
                        <li><a href="index.php#services">Sessions</a></li>
                        <li><a href="index.php#contact">Contact</a></li>
                        <li><a href="login.php">Admin</a></li>
                    </ul>
                    <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
                </nav>
                <a class="btn-getstarted" href="ab.php" class="active">Appointment</a>
            </div>
        </header>

        <main class="main" style="margin-top: 13vh;">
            <div class="container mt-5">
                <h2 class="mb-4">Appointment Booking</h2>
                <div class="calendar-header">
                    <button id="prevMonth" class="btn btn-secondary">Previous</button>
                    <h2 id="currentMonth"></h2>
                    <button id="nextMonth" class="btn btn-secondary">Next</button>
                </div>
                <div class="calendar" id="calendar">
                    
                </div>
                <div id="appointmentModal" class="modal fade" tabindex="-1" aria-labelledby="appointmentModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="appointmentModalLabel"><u>Book Appointment</u></h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form id="appointmentForm" action="book_appointment.php" method="POST">
                                    <input type="hidden" name="appointment_date" id="appointmentDate">
                                    <input type="hidden" name="time_slot" id="timeSlot">

                                    
                                    <div class="mb-3 form-group row align-items-center">
                                        <label for="existingUserDropdown" class="col-form-label col-auto" style="color:#79db07;"><b><u>Patient Type: </u></b></label>
                                        <div class="col-auto">
                                            <select class="form-control" id="existingUserDropdown">
                                                <option value="No" selected>New</option>
                                                <option value="Yes">Existing</option>
                                            </select>
                                        </div>
                                    </div>

                                    <!-- Slot selection near date -->
                                     <div class="row">
                                        <div class="col-6">
                                        <div class="mb-3">
                                        <label for="selectedDate" class="form-label">Selected Date</label>
                                        <input type="text" class="form-control" id="selectedDate" name="selected_date" readonly>
                                    </div>

                                        </div>
                                        <div class="col-6">
                                            <!-- Time Slot selection -->
                                    <div class="mb-3">
                                        <label for="timeSlotInput" class="form-label">Time Slot</label>
                                        <select class="form-select" id="timeSlotInput" name="time_slot" required>
                                            <option value="" disabled selected>Select a time slot</option>
                                            <option value="10:00 AM To 10:30 AM">10:00 AM To 10:30 AM</option>
                                            <option value="10:30 AM To 11:00 AM">10:30 AM To 11:00 AM</option>
                                            <option value="11:00 AM To 11:30 AM">11:00 AM To 11:30 AM</option>
                                            <option value="11:30 AM To 12:00 PM">11:30 AM To 12:00 PM</option>
                                            <option value="12:00 PM To 12:30 PM">12:00 PM To 12:30 PM</option>
                                            <option value="12:30 PM To 01:00 PM">12:30 PM To 01:00 PM</option>
                                            <option value="02:00 PM To 02:30 PM">02:00 PM To 02:30 PM</option>
                                            <option value="02:30 PM To 03:00 PM">02:30 PM To 03:00 PM</option>
                                            <option value="03:00 PM To 03:30 PM">03:00 PM To 03:30 PM</option>
                                            <option value="03:30 PM To 04:00 PM">03:30 PM To 04:00 PM</option>
                                            <option value="04:00 PM To 04:30 PM">04:00 PM To 04:30 PM</option>
                                            <option value="04:30 PM To 05:00 PM">04:30 PM To 05:00 PM</option>
                                            <option value="05:00 PM To 05:30 PM">05:00 PM To 05:30 PM</option>
                                            <option value="05:30 PM To 06:00 PM">05:30 PM To 06:00 PM</option>
                                        </select>
                                    </div>
                                            
                                         </div>
                                     </div>
                                   

                                    

                                    
                                    
                                    <!-- Rest of the form fields -->
                                    <!-- (First Name and Last Name side by side) -->
                                    <div id="restOfForm">
                                    <div class="row mb-3">
                                        <div class="col">
                                            <label for="firstName" class="form-label">First Name</label>
                                            <input type="text" class="form-control" id="firstName" name="first_name" required>
                                        </div>
                                        <div class="col">
                                            <label for="middleName" class="form-label">Middle Name</label>
                                            <input type="text" class="form-control" id="middleName" name="middle_name">
                                        </div>
                                        <div class="col">
                                            <label for="lastName" class="form-label">Last Name</label>
                                            <input type="text" class="form-control" id="lastName" name="last_name" required>
                                        </div>
                                    </div>

                                    <!-- Self checkbox -->
                                    <div class="mb-3 form-check">
                                        <input type="checkbox" class="form-check-input" id="selfCheckbox">
                                        <label class="form-check-label" for="selfCheckbox">Appointment for myself</label>
                                    </div>
                                    <!-- Patient First Name and Last Name side by side -->
                                    <div class="row mb-3">
                                    <p><u><strong> Patient Details</strong></u></p>
                                        <div class="col">
                                            <label for="patientFirstName" class="form-label">First Name</label>
                                            <input type="text" class="form-control" id="patientFirstName" name="patient_first_name" required>
                                        </div>
                                        <div class="col">
                                            <label for="patientMiddleName" class="form-label">Middle Name</label>
                                            <input type="text" class="form-control" id="patientMiddleName" name="patient_middle_name" >
                                        </div>
                                        <div class="col">
                                            <label for="patientLastName" class="form-label">Last Name</label>
                                            <input type="text" class="form-control" id="patientLastName" name="patient_last_name" required>
                                        </div>
                                    </div>

                                    <!-- (Relation and Profession side by side) -->
                                    <div class="row mb-3">
                                        <div class="col">
                                            <label for="relation" class="form-label">Patient Relation</label>
                                            <input type="text" class="form-control" id="relation" name="relation_to_patient" placeholder="How You're related to patient">
                                        </div>
                                        <div class="col">
                                            <label for="profession" class="form-label">Profession</label>
                                            <input type="text" class="form-control" id="profession" name="profession" placeholder="Patient Profession" required>
                                        </div>
                                    </div>

                                    <!-- DOB, Age, Gender -->
                                    <div class="row mb-3">
                                    <div class="col-5">
                                        <label for="dob" class="form-label">Date of Birth</label>
                                        <input type="date" class="form-control" id="dob" name="dob" placeholder="YYYY-MM-DD" required>
                                    </div>

                                        <div class="col-3">
                                            <label for="age" class="form-label">Age</label>
                                            <input type="number" class="form-control" id="age" name="age" required>
                                        </div>
                                        <div class="col-4">
                                            <label for="gender" class="form-label">Gender</label>
                                            <select class="form-select" id="gender" name="gender" required>
                                                <option value="Male">Male</option>
                                                <option value="Female">Female</option>
                                                <option value="Other">Other</option>
                                            </select>
                                        </div>
                                    </div>

                                    <!-- Phone Number, Patient Number, Email -->
                                    <div class="row mb-3">
                                    <div class="col">
                                            <label for="patientNumber" class="form-label">Phone Number</label>
                                            <input type="text" class="form-control" id="patientNumber" name="patient_number" placeholder="Patient Number" required>
                                        </div>
                                        <div class="col">
                                            <label for="phoneNumber" class="form-label">Alternate Number</label>
                                            <input type="tel" class="form-control" id="phoneNumber" name="phone_number"  required>
                                        </div>

                                    </div>
                                    <div class="mb-3">
                                        <label for="email" class="form-label">Email</label>
                                        <input type="email" class="form-control" id="email" name="email" required>
                                    </div>

                                    
                                </div>
                                <div id="newForm" style="display: none;">
                                    <div class="row mb-3">
                                    <p><u><strong>Patient Details</strong></u></p>
                                        <div class="col">
                                            <label for="firstName1" class="form-label">First Name</label>
                                            <input type="text" class="form-control" id="firstName1" name="first_name1" >
                                        </div>
                                        <div class="col">
                                            <label for="lastName1" class="form-label">Last Name</label>
                                            <input type="text" class="form-control" id="lastName1" name="last_name1" >
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <label for="phoneNumber1" class="form-label">Phone Number</label>
                                        <input type="tel" class="form-control" id="phoneNumber1" name="phone_number1" ><br/>
                                    </div>

                                    <div class="form-group" style="display:none;">
                                        <label for="uniqueIdInput">Unique ID</label>
                                        <input type="text" id="uniqueIdInput" class="form-control" readonly>
                                        <input type="hidden" id="uniqueIdHidden" name="unique_id">
                                    </div>

                                    <div id="uniqueIdDisplay" class="alert alert-info mt-1" style="display: none;">
                                        <strong><u>Unique ID: </u></strong><span id="uniqueId"></span>
                                    </div>


                                    <div id="futureAppointmentsDisplay" class="alert alert-info" style="display: none;">
                                        <strong><u>Future Appointments:</u></strong>
                                        <ul id="futureAppointmentsList"></ul>
                                    </div>

                                    <div id="appointmentActions" style="display: none;">
                                        <label for="emergency" class="form-label my-2">
                                        <span style="color:red;"><strong> <u>This is an Emergency Appointment?</u> </strong></span><span class="ml-2"><input type="checkbox"  class="form-check-input  ml-2" id="emergencyStatus" name="emergency"> </span>
                                        </label>
                                    </div>

                                </div>
                                <button type="submit" class="btn btn-primary mt-2" style="background-color: #388da8; width:100%;">Submit</button>
                               
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
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/vendor/aos/aos.js"></script>
    <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
    <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
    <!-- Main JS File -->
    <script src="assets/js/main.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Calendar Script -->
    <script>
document.addEventListener('DOMContentLoaded', function() {
    const firstName = document.getElementById('firstName1');
    const lastName = document.getElementById('lastName1');
    const phoneNumber = document.getElementById('phoneNumber1');
    const uniqueIdDisplay = document.getElementById('uniqueIdDisplay');
    const uniqueIdSpan = document.getElementById('uniqueId');
    const futureAppointmentsDisplay = document.getElementById('futureAppointmentsDisplay');
    const futureAppointmentsList = document.getElementById('futureAppointmentsList');
    const appointmentActions = document.getElementById('appointmentActions');
    const emergencyStatus = document.getElementById('emergencyStatus');
    const bookAppointmentButton = document.getElementById('bookAppointmentButton');

    const uniqueIdInput = document.getElementById('uniqueIdInput');
    const uniqueIdHidden = document.getElementById('uniqueIdHidden');

    async function fetchPatientDetails() {
        const fName = firstName.value.trim();
        const lName = lastName.value.trim();
        const phone = phoneNumber.value.trim();

        if (fName && lName && phone.length === 10) {
            try {
                const response = await fetch('patient_details.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({ firstName: fName, lastName: lName, phoneNumber: phone })
                });

                if (!response.ok) {
                    throw new Error('Network response was not ok ' + response.statusText);
                }

                const data = await response.json();

                if (data.unique_id) {
                    uniqueIdInput.value = data.unique_id;
                uniqueIdHidden.value = data.unique_id;
                uniqueIdSpan.textContent = data.unique_id;
                uniqueIdDisplay.style.display = 'block';

                    futureAppointmentsList.innerHTML = '';
                    data.future_appointments.forEach(appointment => {
                        const listItem = document.createElement('li');
                        listItem.textContent = `${appointment.appointment_date} - ${appointment.time_slot}`;
                        futureAppointmentsList.appendChild(listItem);
                    });
                    futureAppointmentsDisplay.style.display = 'block';
                    appointmentActions.style.display = 'block';
                } else {
                    uniqueIdDisplay.style.display = 'none';
                    futureAppointmentsDisplay.style.display = 'none';
                    appointmentActions.style.display = 'none';
                }
            } catch (error) {
                console.error('Error fetching data:', error);
                uniqueIdDisplay.style.display = 'none';
                futureAppointmentsDisplay.style.display = 'none';
                appointmentActions.style.display = 'none';
            }
        } else {
            uniqueIdDisplay.style.display = 'none';
            futureAppointmentsDisplay.style.display = 'none';
            appointmentActions.style.display = 'none';
        }
    }

    [firstName, lastName, phoneNumber].forEach(input => {
        input.addEventListener('input', fetchPatientDetails);
    });
});



document.getElementById('existingUserDropdown').addEventListener('change', function () {
    const selectedValue = this.value;
    const restOfForm = document.getElementById('restOfForm');
    const newForm = document.getElementById('newForm');
    const requiredFields = ['firstName', 'lastName', 'phoneNumber', 'patientFirstName', 'patientLastName', 'profession', 'dob', 'age', 'gender', 'patientNumber', 'email'];

    if (selectedValue === 'Yes') {
        restOfForm.style.display = 'none';
        newForm.style.display = 'block';
        requiredFields.forEach(field => document.getElementById(field).removeAttribute('required'));
    } else {
        restOfForm.style.display = 'block';
        newForm.style.display = 'none';
        requiredFields.forEach(field => document.getElementById(field).setAttribute('required', 'true'));
    }
});
         function showCustomAlert(message) {
         const alertMessageElement = document.getElementById('customAlertMessage');
         alertMessageElement.innerText = message;

         const customAlertModal = new bootstrap.Modal(document.getElementById('customAlertModal'));
         customAlertModal.show();
     }
        // JavaScript for calendar and modal form
        let currentDate = new Date();

        // Render calendar
        function renderCalendar() {
            const calendar = document.getElementById('calendar');
            calendar.innerHTML = ''; // Clear previous calendar

            // Day names
            const dayNames = ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'];
            dayNames.forEach(day => {
                const dayNameElement = document.createElement('div');
                dayNameElement.classList.add('day-name');
                dayNameElement.textContent = day;
                calendar.appendChild(dayNameElement);
            });

            // Get the current year and month
            const year = currentDate.getFullYear();
            const month = currentDate.getMonth();

            // Set current month title
            const currentMonth = document.getElementById('currentMonth');
            currentMonth.textContent = currentDate.toLocaleDateString('default', { month: 'long', year: 'numeric' });

            // Get the first day of the month
            const firstDay = new Date(year, month, 1).getDay();
            const daysInMonth = new Date(year, month + 1, 0).getDate();

            // Add blank days for the first week
            for (let i = 0; i < firstDay; i++) {
                const blankDay = document.createElement('div');
                calendar.appendChild(blankDay);
            }

            // Add days of the month
            for (let day = 1; day <= daysInMonth; day++) {
                const dateElement = document.createElement('div');
                dateElement.classList.add('date');
                dateElement.textContent = day;
                dateElement.addEventListener('click', () => openAppointmentModal(year, month, day));
                calendar.appendChild(dateElement);
            }
        }

        // Navigate months
        document.getElementById('prevMonth').addEventListener('click', () => {
            currentDate.setMonth(currentDate.getMonth() - 1);
            renderCalendar();
        });

        document.getElementById('nextMonth').addEventListener('click', () => {
            currentDate.setMonth(currentDate.getMonth() + 1);
            renderCalendar();
        });

        // Open appointment modal with selected date
        function openAppointmentModal(year, month, day) {
        // Get today's date at midnight (start of the day)
        const currentDate = new Date();
        currentDate.setHours(0, 0, 0, 0);

        // Create a new date for the selected day
        const selectedDate = new Date(year, month, day);
        selectedDate.setHours(0, 0, 0, 0);

        // Compare the selected date with today's date
        if (selectedDate.getTime() >= currentDate.getTime()) {
            // Date is today or in the future
            const appointmentDate = `${year}-${String(month + 1).padStart(2, '0')}-${String(day).padStart(2, '0')}`;
            document.getElementById('appointmentDate').value = appointmentDate;
            document.getElementById('selectedDate').value = appointmentDate;

            // Fetch booked slots for the selected date
            fetchBookedSlots(appointmentDate);

            const appointmentModal = new bootstrap.Modal(document.getElementById('appointmentModal'));
            appointmentModal.show();
        } else {
            // Optionally, show an alert or message for past dates
            showCustomAlert("Yesterday is Behind Us.. \n Appointments are for the Days to come.\n Try Booking for future dates!");
        }
    }

        // Fetch booked slots and update available slots
        function fetchBookedSlots(date) {
            fetch(`book_appointment.php?date=${date}`)
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        const bookedSlots = data.bookedSlots;
                        const timeSlotSelect = document.getElementById('timeSlotInput');

                        // Clear existing options
                        while (timeSlotSelect.options.length > 1) {
                            timeSlotSelect.remove(1);
                        }

                        // Predefined time slots
                        const timeSlots = [
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
                            '05:30 PM To 06:00 PM'
                        ];

                        // Add available time slots to select
                        timeSlots.forEach(slot => {
                            if (!bookedSlots.includes(slot)) {
                                const option = document.createElement('option');
                                option.value = slot;
                                option.textContent = slot;
                                timeSlotSelect.appendChild(option);
                            }
                        });
                    } else {
                        console.error('Error fetching booked slots:', data.error);
                    }
                })
                .catch(error => {
                    console.error('Error fetching booked slots:', error);
                });
        }

        // Sync fields if "Self" checkbox is checked
        document.getElementById('selfCheckbox').addEventListener('change', function () {
            const isChecked = this.checked;
            const firstName = document.getElementById('firstName').value;
            const lastName = document.getElementById('lastName').value;
            const middleName = document.getElementById('middleName').value;

            document.getElementById('patientFirstName').value = isChecked ? firstName : '';
            document.getElementById('patientLastName').value = isChecked ? lastName : '';
            document.getElementById('patientMiddleName').value = isChecked ? middleName : '';
            document.getElementById('relation').value = isChecked ? 'Myself' : '';

            if (isChecked) {
                document.getElementById('patientNumber').addEventListener('input', syncPhoneNumber);
            } else {
                document.getElementById('patientNumber').removeEventListener('input', syncPhoneNumber);
                document.getElementById('phoneNumber').value = '';
            }
        });

        // Function to sync phone number fields
        function syncPhoneNumber() {
            const patientNumber = document.getElementById('patientNumber').value;
            if (document.getElementById('selfCheckbox').checked) {
                document.getElementById('phoneNumber').value = patientNumber;
            }
        }

        // Calculate age from date of birth
        document.getElementById('dob').addEventListener('input', function () {
            const dob = new Date(this.value);
            const age = new Date().getFullYear() - dob.getFullYear();
            document.getElementById('age').value = age;
        });

        // Handle form submission
        const appointmentForm = document.getElementById('appointmentForm');
        appointmentForm.addEventListener('submit', function(e) {
            e.preventDefault();
  
            const formData = new FormData(appointmentForm);
            for (const [key, value] of formData.entries()) {
    console.log(`${key}: ${value}`);
}
            fetch('book_appointment.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    const appointmentID = data.appointmentID;
                    showCustomAlert(`🎉 Appointment booked successfully! 🎉

Your Appointment ID is: ${appointmentID} Please note it down for future reference.

📋 Kindly bring any previous prescriptions if you have consulted another doctor regarding any psychological issues. This will help us provide you with the best care possible. 😊`);
 const appointmentModal = bootstrap.Modal.getInstance(document.getElementById('appointmentModal'));
                    appointmentModal.hide();
                    renderCalendar();
                } else {
                    showCustomAlert('Error booking appointment. Please try again.');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                showCustomAlert('Error booking appointment. Please try again.');
            });
        });

        // Initial render
        renderCalendar();
    </script>
</body>

</html>
