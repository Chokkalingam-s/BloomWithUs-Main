

   $(document).ready(function() {

    const urlParams = new URLSearchParams(window.location.search);
    const uniqueId = urlParams.get('unique_id');
    if (uniqueId){

            
function displayPhoto(event) {
    const photo = document.getElementById('patient-photo');
    const addButton = document.querySelector('.add-photo-btn');
    photo.src = URL.createObjectURL(event.target.files[0]);
    photo.style.display = 'block';
    addButton.style.display = 'none';
}
function toggleTable(tableId) {
var checkbox = document.getElementById(tableId == 'therapyTable' ? 'optTherapy' : 'optMedicine');
var table = document.getElementById(tableId);

if (checkbox.checked && table.style.display === 'none') {
    table.style.display = 'table'; 
} else {
    table.style.display = 'none';
}
}
        let oldPrescriptionDataFetched = false;

        $('#oldPrescriptionAvailableDropdown').change(function() {
            if ($(this).val() === 'Yes' && !oldPrescriptionDataFetched) {
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
                    
                // Helper function to get title based on gender
                function getTitle(gender) {
                    if (gender.toLowerCase() === 'male') {
                        return 'Mr.';
                    } else if (gender.toLowerCase() === 'female') {
                        return 'Ms.';
                    } else {
                        return '';
                    }
                }

                // Construct name with title
                const title = getTitle(data.gender);
                const fullName = `${title} ${data.patient_first_name} ${data.patient_last_name}`;

                // Update appointment details HTML
                $('.appointment_details').html(`
                    <div class="row" >
                        <div class="col-12" style="margin-top: 5%;">
                            <p style="font-size:1.2em;"><strong>Name: ${fullName} </strong></p>
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


                // Helper function to convert date format
                function formatDate(dateString) {
                    const date = new Date(dateString);
                    const day = date.getDate();
                    const month = date.toLocaleString('default', { month: 'long' });
                    const year = date.getFullYear();
                    return `${day} ${month} , ${year}`;
                }

                // Display previous appointments
                let previousAppointmentsHtml = '<h4 style="color:#282924;"><strong>Previous Appointments</strong></h4>';
                if (data.previous_appointments.length > 0) {
                    data.previous_appointments.forEach(appointment => {
                        previousAppointmentsHtml += `<p>${formatDate(appointment.appointment_date)} - ${appointment.time_slot}</p>`;
                    });
                } else {
                    previousAppointmentsHtml += '<p>No Previous Appointments</p>';
                }

                // Display future appointments
                let futureAppointmentsHtml = '<h4 style="color:#282924;"><strong>Upcoming Appointments</strong></h4>';
                if (data.future_appointments.length > 0) {
                    data.future_appointments.forEach(appointment => {
                        futureAppointmentsHtml += `<p>${formatDate(appointment.appointment_date)} - ${appointment.time_slot}</p>`;
                    });
                } else {
                    futureAppointmentsHtml += '<p>No Future Appointments</p>';
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
                            tokenSeparators: [',']
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
                $('#optSelect').select2({
        placeholder: "Opt For Therapy / Medicine",
        allowClear: true
    });

    // Variables to track availability of data
    let medicinesAvailable = false;
    let therapiesAvailable = false;

    // Function to update the dropdown and table visibility
    function updateDropdownAndTables() {
        const selectedOptions = [];
        if (therapiesAvailable) {
            selectedOptions.push('therapy');
            $('#therapyTable').show();
        } else {
            $('#therapyTable').hide();
        }
        if (medicinesAvailable) {
            selectedOptions.push('medicine');
            $('#medicineTable').show();
        } else {
            $('#medicineTable').hide();
        }
        $('#optSelect').val(selectedOptions).trigger('change');
    }

    // AJAX request to fetch medicine data
    $.ajax({
        url: 'fetch_medicine.php',
        type: 'GET',
        data: { unique_id: uniqueId },
        dataType: 'json',
        success: function(response) {
            if (response.success) {
                const medicines = response.data;
                if (medicines.length > 0) {
                    medicinesAvailable = true;
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
                }
            } else {
                console.error('Failed to fetch medicine data:', response.message);
            }
            updateDropdownAndTables();
        },
        error: function(xhr, status, error) {
            console.error('Error fetching medicine data:', error);
            updateDropdownAndTables();
        }
    });

    // AJAX request to fetch therapies data
    $.ajax({
        url: 'fetch_therapies.php',
        type: 'GET',
        data: { unique_id: uniqueId },
        dataType: 'json',
        success: function(response) {
            if (response.success) {
                const therapies = response.data;
                if (therapies.length > 0) {
                    therapiesAvailable = true;
                    therapies.forEach(therapy => {
                        const rowHtml = `
                            <tr data-id="${therapy.unique_id}"
                                data-name="${therapy.therapies_name}"
                                data-times="${therapy.times_per_day}"
                                data-sos="${therapy.sos ? '1' : '0'}"
                                class="${therapy.sos ? 'sos-highlight' : ''}">
                                <td>${therapy.therapies_name}</td>
                                <td>${therapy.times_per_day}</td>
                                <td>${therapy.before_after_meal}</td>
                                <td>${therapy.sos ? 'Yes' : 'No'}</td>
                                <td>
                                    <button type="button" class="btn btn-danger delete-therapies-btn">Delete</button>
                                </td>
                            </tr>
                        `;
                        $('#therapies-table-body').append(rowHtml);
                    });
                }
            } else {
                console.error('Failed to fetch therapies data:', response.message);
            }
            updateDropdownAndTables();
        },
        error: function(xhr, status, error) {
            console.error('Error fetching therapies data:', error);
            updateDropdownAndTables();
        }
    });

    // Dropdown change event to toggle table visibility
    $('#optSelect').on('change', function() {
        const selectedOptions = $(this).val();
        $('#therapyTable').toggle(selectedOptions.includes('therapy'));
        $('#medicineTable').toggle(selectedOptions.includes('medicine'));
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
                            
                            <p><strong>Doctor's Name:</strong> ${oldPrescription.doctor_name}</p>
                            <p><strong>Duration:</strong> ${oldPrescription.time_duration}</p>
                            <p><strong>Therapy / Medicine:</strong> ${oldPrescription.medicine_took}</p>
                                <p><strong>Old Prescription:</strong> 
                    <a href="${oldPrescription.prescription_image}" target="_blank" class="btn btn-light" style="background-color: #765341; color: white;">
                        View Image
                    </a>
                </p>
                        `;
                        $('#oldPrescriptionDetails').html(oldPrescriptionHtml);
                                $('#oldPrescriptionAvailableDropdown').val('Yes');
            oldPrescriptionDataFetched = true;
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

                        const diseases = $('#diseases').val().join(', ');

                        const formData = new FormData(this);
                        formData.append('medicineData', JSON.stringify(medicineDataArray));
                        formData.append('therapiesData', JSON.stringify(therapiesDataArray));

                        formData.append('diseases', diseases);

                        formData.append('patient_image', $('#upload-photo')[0].files[0]); // Add prescription image file


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
                const selectedDiseases = patient.diseases ? patient.diseases.split(', ') : [];
                $('#diseases').val(selectedDiseases);


                // Update diseases badges
                updateBadges('diseases', 'diseases-badges', selectedDiseases);


        // Check if patient photo exists and display accordingly
        if (patient.patient_image) {
            displayPhoto1(patient.patient_image);
        } else {
            $('#patient-photo').hide(); // Hide patient photo element if no image
            $('#add-photo-btn').show(); // Show the "Add Photo" button
        }

                        $('#prescriptionModal').modal('show');
                    }
                });

                function displayPhoto1(photoUrl) {
                    const photo = document.getElementById('patient-photo');
                    const addButton = document.querySelector('.add-photo-btn');
                    photo.src = photoUrl; // Set the source of the patient photo
                    photo.style.display = 'block'; // Show the patient photo
                    addButton.style.display = 'none'; // Hide the "Add Photo" button
                }
                
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
                    $('#therapies-table-body select.therapy-select').val(null).trigger('change');
                    $('#therapies-table-body input[type="text"], #medicine-table-body input[type="number"]').val('');
                    $('#therapies-table-body select').eq(1).val('Before Meal');
                    $('#therapies-table-body input[type="checkbox"]').prop('checked', false);
                }

                const therapiesDataArray = [];
                $(document).on('click', '.therapies-save-btn', function() {
                    const row = $(this).closest('tr');
                    const data = {
                        therapiesName: row.find('select').eq(0).val(),
                        noOfTimes: row.find('input[type="text"]').eq(0).val(),
                        meal: row.find('select').eq(1).val(),
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
