<div class="modal fade" id="prescriptionModal1" tabindex="-1" aria-labelledby="prescriptionModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg mt-0" style="max-width: 100%;max-height: 100vh;">
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
                        <div class="cm3 section1">
                            <div class="row appointment_details pt-1">
                                <!-- Appointment details automatic render -->
                            </div>

                            <div class="patient_photo row">
                                <div class="col-md-6 d-flex justify-content-center align-items-center mt-2">
                                    <div class="add-photo-btn">
                                        +
                                        <input type="file" id="upload-photo" accept="image/*" name="patient_image" onchange="displayPhoto(event)">
                                    </div>
                                    <img id="patient-photo" class="passport-photo" alt="Patient Photo">
                                </div>
                            </div>

                            <div class="row  old_prescription"  >
                            <div class="form-group ml-1" style="margin-top:18%;">
                                <label for="oldPrescriptionAvailableDropdown" class="form-label"><h5><strong>Old Prescription Details </strong></h5></label>
                                <select class="form-control" id="oldPrescriptionAvailableDropdown">
                                    <option value="No">No</option>
                                    <option value="Yes">Yes</option>
                                </select>
                            </div>
                                <div class="mt-2 d-none" id="oldPrescriptionForm">
                                    <div class="mb-3">
                                        <label for="doctorName" class="form-label">Doctor's Name</label>
                                        <input type="text" class="form-control" id="doctorName" name="doctor_name" placeholder="Past Doctor's name">
                                    </div>
                                    <div class="mb-3">
                                        <label for="timeDuration" class="form-label">Duration</label>
                                        <input type="text" class="form-control" id="timeDuration" name="time_duration" placeholder="Time duration treated">
                                    </div>
                                    <div class="mb-3">
                                        <label for="medicineTook" class="form-label">Therapy/Medicine</label>
                                        <textarea class="form-control" id="medicineTook" name="medicine_took" rows="2" placeholder="Previous Medication"></textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label for="prescriptionImage" class="form-label">Attachment of Old Prescription</label>
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
                        <div class="col section2">
                            <h2 class="my-3"> <strong> DIAGNOSIS </strong></h2>
                            <div class="ml-2">
                        <div class="form-group">

                            <div id="diseases-badges" class="badge-container"></div>
                        </div>
                             
                            <div id="therapyTable" style="display: none;">
                            <h4><u><strong style="color:#50ab30;">THERAPIES</strong></u></h4>
                            <table class="table mt-2">
                                <thead>
                                    <tr>
                                        <th>Therapies</th>
                                        <th>Times/day</th>
                                        <th>B/A Meal</th>
                                        <th>SOS</th>
                                    </tr>
                                </thead>
                                <tbody id="therapies-table-body">
                                    <tr> </tr>

                                </tbody>
                            </table>
                            </div>


                        <div id="medicineTable" style="display: none;">
                        <h4><u><strong style="color:#037ffc;">MEDICINE</strong></u></h4>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Medicine</th>
                                        <th>Times/day</th>
                                        <th>Dose(mg)</th>
                                        <th>B/A Meal</th>
                                        <th>SOS</th>
                                    </tr>
                                </thead>
                                <tbody id="medicine-table-body">
                                    <tr></tr>
                                </tbody>
                            </table>
                            </div>


                     <div class="row "> 
                              <div class="future_appointments pt-1 col-12 my-5">

                              </div>
                     </div>
                     
                              <div class="row ">
                            <div class="form-group col-12">
                                    <label for="notes"><h4 style="color:#282924;"><strong>Remarks</strong></h4></label>
                                    <textarea class="form-control mb-3" name="notes" id="notes" rows="5"></textarea>
                                </div>
                                </div>
                                </div>

                                </div>
                    </div>
                </div>
                <div class="modal-footer">
                </div>
            </form>
        </div>
    </div>
</div>