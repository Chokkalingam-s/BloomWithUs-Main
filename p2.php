<div class="modal fade" id="prescriptionModal2" tabindex="-1" aria-labelledby="prescriptionModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg mt-0" style="max-width: 100%; max-height: 100vh;">
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
                        <div class="col-8">
                            <image src="assets/img/logo.png" style="height: 17vh; width:17vh;"></image>

                        </div>
                        <div class="col-4">
                        <div class="title mt-5">
                        <h1 class="heading">BloomWithUs</h1> 
                        <h4 class="fw-bold">Dr. Tamana Sharma</h4>
                        <h6 class="fw-bold"> <i class="bi bi-geo-alt-fill"></i><span> #132/6, Mansa Devi Complex, Sector 4,<br> <span style="opacity:0%;">cho</span>  Panchkula, Haryana, India, 134109</span></h6>
                        <h6 class="fw-bold"> <i class="bi bi-telephone-fill"> </i><span> +91 9779981199</span></h6>
                        <h6 class="fw-bold"> <i class="bi bi-envelope-fill"> </i><span> Bloomwithuscounselling@gmail.com</span></h6>
                    </div>
                    
                    </div>
                    </div>
                    <h2 class="mt-5 p-2">Patient Details</h2>
                    <div class="section2 d-flex justify-content-start align-items-center">
                            <div class="col-6 d-flex justify-content-start align-items-center">
                                <div class="patient_photo text-left mr-3 pl-5">
                                    <div class="d-flex justify-content-start align-items-center">
                                        <div class="add-photo-btn">
                                            +
                                            <input type="file" id="upload-photo" accept="image/*" name="patient_image" onchange="displayPhoto(event)">
                                        </div>
                                        <img id="patient-photo" class="passport-photo" alt="Patient Photo">
                                    </div>
                                </div>
                                <div class="appointment_details text-left pl-5">    
                                    <!-- Appointment details automatic render -->
                                </div>
                            </div>
                        </div>


                        <div class=" section1"> <!-- Adjusted width to 9 columns -->
                            <h2 class="mb-3 mt-5 p-2">DIAGNOSIS</></h2>
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
                                            <tr></tr>
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

                                <div class="row">
                                    <div class="future_appointments pt-1 col-12 my-5"></div>
                                </div>

                                <div class="row">
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
                <div class="modal-footer"></div>
            </form>
        </div>
    </div>
</div>
