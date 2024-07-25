<div class="modal fade" id="prescriptionModal" tabindex="-1" aria-labelledby="prescriptionModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg mt-0" style="max-width: 100%;max-height: 90vh;">
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
                            <div class="form-group" style="margin-top: 18%;">
                                    <div class="row align-items-center">
                                        <label for="oldPrescriptionAvailableDropdown" class="form-label col-auto">
                                            <h5><strong>Old Prescription Details</strong></h5>
                                        </label>
                                        <div class="col-auto">
                                            <select class="form-control mb-2" id="oldPrescriptionAvailableDropdown">
                                                <option value="No">No</option>
                                                <option value="Yes">Yes</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="mt-1 d-none" id="oldPrescriptionForm">
                                    <div class="mb-3">
                                        <label for="doctorName" class="form-label">Doctor's Name</label>
                                        <input type="text" class="form-control" id="doctorName" name="doctor_name" placeholder="Past Doctor's name">
                                    </div>
                                    <div class="mb-3">
                                        <label for="timeDuration" class="form-label">Duration</label>
                                        <input type="text" class="form-control" id="timeDuration" name="time_duration" placeholder="Time duration treated">
                                    </div>
                                    <div class="mb-3">
                                        <label for="medicineTook" class="form-label">Remarks</label>
                                        <textarea class="form-control" id="medicineTook" name="medicine_took" rows="2" placeholder="Previous Doctor's Remarks"></textarea>
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
                            <label for="diseases"><u><h4 Style="color:red;"><strong>DISEASES</strong></h4></u></label><br>
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
                             <div class="thermed">
                            <label for="optSelect"><span style=" font-weight: bold; font-size:large;">Opt For Therapy / Medicine : </span></label>
                                    <select id="optSelect" class="form-control" multiple="multiple">
                                        <option value="therapy">Therapy</option>
                                        <option value="medicine">Medicine</option>
                                    </select>
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
                                        <th>Options</th>
                                    </tr>
                                </thead>
                                <tbody id="therapies-table-body">
                                    <tr>
                                        <td>
                                            <select name="therapies" class="form-control therapy-select"  multiple="multiple">
                                                <option value="Cognitive behavioural therapy">Cognitive behavioural therapy</option>
                                                <option value="Relaxation therapy">Relaxation therapy</option>
                                                <option value="Behavioural therapy">Behavioural therapy</option>
                                                <option value="Art therapy">Art therapy</option>
                                                <option value="Interpersonal therapy">Interpersonal therapy</option>
                                                <option value="Emotion focused therapy">Emotion focused therapy</option>
                                                <option value="Family therapy">Family therapy</option>
                                            </select>
                                        </td>
                                        <td><input type="text" name="therapies_times_per_day" class="form-control"></td>
                                        <td>
                                            <select name="therapies_before_after_meal" class="form-control">
                                                <option>Before Meal</option>
                                                <option>After Meal</option>
                                            </select>
                                        </td>
                                        <td class="sos-checkbox-cell">
                                        <div class="sos-checkbox-wrapper">
                                            <input type="checkbox" name="therapies_sos" class="form-check-input sos-checkbox">
                                        </div>
                                        </td>
                                        <td>
                                            <button type="button" id="save-therapies-btn" class="btn btn-success therapies-save-btn">Save</button>
                                        </td>
                                    </tr>
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
                                        <th>Options</th>
                                    </tr>
                                </thead>
                                <tbody id="medicine-table-body">
                                    <tr>
                                        <td><input type="text" name="medicine" class="form-control"></td>
                                        <td><input type="text" name="times_per_day" class="form-control"></td>
                                        <td><input type="number" name="dose" class="form-control"></td>
                                        <td>
                                            <select name="before_after_meal" class="form-control">
                                                <option>Before Meal</option>
                                                <option>After Meal</option>
                                            </select>
                                        </td>
                                        <td class="sos-checkbox-cell">
                                        <div class="sos-checkbox-wrapper">
                                            <input type="checkbox" name="sos" class="form-check-input sos-checkbox">
                                        </div>
                                        </td>
                                        <td>
                                            <button type="button" id="save-medicine-btn" class="btn btn-success save-btn">Save</button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            </div>
                  <div class="row "> 
                              <div class="past_appointments pt-1 col-6 my-5">

                              </div>
                              <div class="future_appointments pt-1 col-6 my-5">

                              </div>
                              </div>
                              <div class="row ">
                            <div class="form-group col-6">
                                    <label for="notes"><h4 style="color:#282924;"><strong>Remarks</strong></h4></label>
                                    <textarea class="form-control mb-3" name="notes" id="notes" rows="5"></textarea>
                                </div>
                                <div class="form-group col-6">
                                    <label for="notes2"><h4 style="color:#282924;"><strong>Doctor Remarks</strong></h4></label>
                                    <textarea class="form-control" name="notes2" id="notes2" rows="5"></textarea>
                                </div>
                                </div>
                                </div>

                                </div>
                    </div>
                </div>
                <div class="modal-footer mfp">
                    
                <button type="button" class="btn btn-primary" style="width:20%;" onclick="submitForm('unique_id1')"><strong>Print Patient Copy</strong></button>
                <button type="button" class="btn btn-dark" style="width:20%;" onclick="submitForm('unique_id2')"><strong>Print Doctor Copy</strong></button>
                <button type="submit" class="btn btn-success w-50 mx-auto" ><strong>Save</strong></button></div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>