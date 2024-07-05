
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
            max-width: 800px;
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
        }

        .calendar-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1rem;
        }

        .modal-body {
            max-height: calc(100vh - 200px);
            overflow-y: auto;
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
                            <li><a href="index.php">Home</a></li>
                            <li><a href="admin_dashboard.php" >Add Post</a></li>
                            <li><a href="admin_dashboard.php#ManagePost">Manage Post</a></li>
                            <li><a href="logout.php">Logout</a></li>
                        </ul>
                        <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
                    </nav>
                    <a class="btn-getstarted" href="appointment.php">View Appointments</a>
                </div>
            </header>
            <main class="main" style="margin-top: 13vh;">
    <div class="container mt-5">
        <h2 class="mb-4">Appointment Calendar</h2>
        <div class="calendar-header">
        <button id="prevMonthBtn" class="btn btn-outline-secondary">Previous</button>
    <h2 id="currentMonth" class="mb-0"></h2>
    <button id="nextMonthBtn" class="btn btn-outline-secondary">Next</button>
                  
        </div>
        <div class="calendar" id="adminCalendar">
            <!-- Days will be dynamically added here -->
        </div>
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
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Reserve Appointment Modal -->
    <div class="modal fade" id="reserveAppointmentModal" tabindex="-1" aria-labelledby="reserveAppointmentModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="reserveAppointmentModalLabel">Reserve Appointment</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="reserveAppointmentForm" action="reserve_appointment.php" method="POST">
                        <div class="form-group">
                            <label for="uniqueId">Enter Patient Unique ID:</label>
                            <input type="text" class="form-control" id="uniqueId" name="unique_id" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Reserve Appointment</button>
                    </form>
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
    <script src="assets/vendor/aos/aos.js"></script>
    <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
    <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>

    <!-- Main JS File -->
    <script src="assets/js/main.js"></script>

   <script>
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
        }
    }

    function getMonthName(month) {
        const monthNames = ['January', 'February', 'March', 'April', 'May', 'June',
                            'July', 'August', 'September', 'October', 'November', 'December'];
        return monthNames[month];
    }

    // Function to fetch appointments for a specific date
    function fetchAppointments(date, dayElement) {
        const formattedDate = date.toISOString().split('T')[0];
        fetch(`fetch_appointments.php?date=${formattedDate}`)
            .then(response => response.json())
            .then(data => {
                data.forEach(appointment => {
                    const appointmentTime = appointment.time_slot;
                    const uniqueId = appointment.unique_id;

                    const appointmentElement = document.createElement('div');
                    appointmentElement.textContent = `${appointmentTime} (${uniqueId})`;
                    appointmentElement.classList.add('booked');
                    appointmentElement.setAttribute('data-toggle', 'modal');
                    appointmentElement.setAttribute('data-target', '#appointmentDetailsModal');
                    appointmentElement.addEventListener('click', function () {
                        showAppointmentDetails(uniqueId);
                    });
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
                    <p><strong>Unique-ID:</strong>${ data.unique_id}</p>
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

    renderCalendar(currentDisplayedDate);
});

   </script>
</body>

</html>
