<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prescription Management</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <style>
        .modal-lg {
            max-width: 80%;
        }
    </style>
</head>
<body>
<div class="container mt-5">
    <h2>Prescription Management</h2>
    <form method="GET" action="">
        <div class="form-group">
            <label for="uniqueIdSearch">Search by Unique ID</label>
            <input type="text" class="form-control" id="uniqueIdSearch" name="unique_id" placeholder="Enter Unique ID" onkeyup="this.form.submit()">
            <div id="uniqueIdDropdown" class="dropdown-menu">
                <?php
                // Fetch unique IDs matching the search term
                if (isset($_GET['unique_id'])) {
                    $searchTerm = $_GET['unique_id'];
                    $servername = "localhost";
                    $username = "root";
                    $password = "";
                    $dbname = "bloom";

                    $conn = new mysqli($servername, $username, $password, $dbname);

                    if ($conn->connect_error) {
                        die("Connection failed: " . $conn->connect_error);
                    }

                    $sql = "SELECT DISTINCT unique_id FROM appointments WHERE unique_id LIKE '%$searchTerm%'";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo '<a class="dropdown-item" href="?unique_id=' . $row['unique_id'] . '">' . $row['unique_id'] . '</a>';
                        }
                    } else {
                        echo '<a class="dropdown-item">No results</a>';
                    }

                    $conn->close();
                }
                ?>
            </div>
        </div>
    </form>
</div>


<!-- Prescription Modal -->
<div class="modal fade" id="prescriptionModal" tabindex="-1" aria-labelledby="prescriptionModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
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
                            <span class="badge badge-secondary therapy-tag">Cognitive behavioural therapy</span>
                            <span class="badge badge-secondary therapy-tag">Relaxation therapy</span>
                            <span class="badge badge-secondary therapy-tag">Behavioural therapy</span>
                            <span class="badge badge-secondary therapy-tag">Art therapy</span>
                            <span class="badge badge-secondary therapy-tag">Interpersonal therapy</span>
                            <span class="badge badge-secondary therapy-tag">Emotion focused therapy</span>
                            <span class="badge badge-secondary therapy-tag">Family therapy</span>
                            <span class="badge badge-secondary therapy-tag">Others</span>
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



<script>
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
                        $(this).removeClass('badge-secondary').addClass('badge-success');
                    } else {
                        $(this).removeClass('badge-success').addClass('badge-secondary');
                    }
                });

                $('#prescriptionModal').modal('show');
            }
        });
    }

    $('.therapy-tag').on('click', function() {
        $(this).toggleClass('badge-secondary badge-success');
    });

    $('#prescriptionModal form').on('submit', function(event) {
        event.preventDefault();

        const keyTherapies = [];
        $('.therapy-tag.badge-success').each(function() {
            keyTherapies.push($(this).text());
        });

        const formData = $(this).serialize() + '&key_therapies=' + encodeURIComponent(keyTherapies.join(', '));

        $.post('save_prescription.php', formData, function(response) {
            alert(response);
            $('#prescriptionModal').modal('hide');
        });
    });
});

</script>
</body>
</html>
