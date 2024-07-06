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

        .calendar .day-name,
        .calendar .date {
            background-color: #f8f9fa;
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
    </style>
</head>

<body class="index-page">
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
                                <h5 class="modal-title" id="appointmentModalLabel">Book Appointment</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form id="appointmentForm" action="book_appointment.php" method="POST">
                                    <input type="hidden" name="appointment_date" id="appointmentDate">
                                    <input type="hidden" name="time_slot" id="timeSlot">

                                    <!-- Slot selection near date -->
                                    <div class="mb-3">
                                        <label for="selectedDate" class="form-label">Selected Date</label>
                                        <input type="text" class="form-control" id="selectedDate" name="selected_date" readonly>
                                    </div>

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
                                    
                                    <!-- Rest of the form fields -->
                                    <!-- (First Name and Last Name side by side) -->
                                    <div class="row mb-3">
                                        <div class="col">
                                            <label for="firstName" class="form-label">First Name</label>
                                            <input type="text" class="form-control" id="firstName" name="first_name" required>
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
                                    <p>Patient Details</p>
                                        <div class="col">
                                            <label for="patientFirstName" class="form-label">First Name</label>
                                            <input type="text" class="form-control" id="patientFirstName" name="patient_first_name" required>
                                        </div>
                                        <div class="col">
                                            <label for="patientLastName" class="form-label">Last Name</label>
                                            <input type="text" class="form-control" id="patientLastName" name="patient_last_name" required>
                                        </div>
                                    </div>

                                    <!-- (Relation and Profession side by side) -->
                                    <div class="row mb-3">
                                        <div class="col">
                                            <label for="relation" class="form-label">Relation</label>
                                            <input type="text" class="form-control" id="relation" name="relation_to_patient">
                                        </div>
                                        <div class="col">
                                            <label for="profession" class="form-label">Profession</label>
                                            <input type="text" class="form-control" id="profession" name="profession" required>
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
                                            <label for="phoneNumber" class="form-label">Phone Number</label>
                                            <input type="tel" class="form-control" id="phoneNumber" name="phone_number" required>
                                        </div>
                                        <div class="col">
                                            <label for="patientNumber" class="form-label">Patient Number</label>
                                            <input type="text" class="form-control" id="patientNumber" name="patient_number" required>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label for="email" class="form-label">Email</label>
                                        <input type="email" class="form-control" id="email" name="email" required>
                                    </div>

                                    <button type="submit" class="btn btn-primary" style="background-color: #388da8;">Submit</button>
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
                    Designed by <a href="https://rudraksha.org.in/" target="_blank"> Rudraksha</a>
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
            const appointmentDate = `${year}-${String(month + 1).padStart(2, '0')}-${String(day).padStart(2, '0')}`;
            document.getElementById('appointmentDate').value = appointmentDate;
            document.getElementById('selectedDate').value = appointmentDate;

            // Fetch booked slots for the selected date
            fetchBookedSlots(appointmentDate);

            const appointmentModal = new bootstrap.Modal(document.getElementById('appointmentModal'));
            appointmentModal.show();
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

            document.getElementById('patientFirstName').value = isChecked ? firstName : '';
            document.getElementById('patientLastName').value = isChecked ? lastName : '';
            document.getElementById('relation').value = isChecked ? 'Myself' : '';

            if (isChecked) {
                document.getElementById('phoneNumber').addEventListener('input', syncPhoneNumber);
            } else {
                document.getElementById('phoneNumber').removeEventListener('input', syncPhoneNumber);
                document.getElementById('patientNumber').value = '';
            }
        });

        // Function to sync phone number fields
        function syncPhoneNumber() {
            const phoneNumber = document.getElementById('phoneNumber').value;
            if (document.getElementById('selfCheckbox').checked) {
                document.getElementById('patientNumber').value = phoneNumber;
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
            fetch('book_appointment.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    const appointmentID = data.appointmentID;
                    alert(`Appointment booked successfully! Your Appointment ID is: ${appointmentID}. Please note it down.`);
                    const appointmentModal = bootstrap.Modal.getInstance(document.getElementById('appointmentModal'));
                    appointmentModal.hide();
                    renderCalendar();
                } else {
                    alert('Error booking appointment. Please try again.');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Error booking appointment. Please try again.');
            });
        });

        // Initial render
        renderCalendar();
    </script>
</body>

</html>
