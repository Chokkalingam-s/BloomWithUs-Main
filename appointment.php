<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - BloomWithUs</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <style>
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

        .modal-body {
            max-height: calc(100vh - 200px);
            overflow-y: auto;
        }
    </style>
</head>

<body>
    <div class="container">
        <h2 class="mb-4">Appointment Calendar</h2>
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

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
    document.addEventListener('DOMContentLoaded', function () {
        const adminCalendar = document.getElementById('adminCalendar');

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

        function showAppointmentDetails(uniqueId) {
            fetch(`get_appointment_details.php?unique_id=${uniqueId}`)
                .then(response => response.json())
                .then(data => {
                    const appointmentDetailsBody = document.getElementById('appointmentDetailsBody');
                    appointmentDetailsBody.innerHTML = `
                        <p><strong>Unique ID:</strong> ${data.unique_id}</p>
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

        renderCalendar(new Date());
    });
</script>
</body>

</html>
