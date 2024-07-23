

$(document).ready(function() {

    const urlParams = new URLSearchParams(window.location.search);
    const uniqueId = urlParams.get('unique_id2');
    if (uniqueId){

        $.ajax({
            url: 'fetch_p2.php',
            method: 'GET',
            success: function(response) {
                $('.patientpres').html(response);
            },
            error: function(xhr, status, error) {
                console.error('Error fetching the PHP content:', error);
            }
        });
    

            
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
                    console.log('hi');
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
                            <p><strong>Remarks:</strong> ${oldPrescription.medicine_took}</p>
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

                        $('#prescriptionModal2').modal('show');
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

