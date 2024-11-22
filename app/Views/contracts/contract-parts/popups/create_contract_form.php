<div class="modal fade" id="modal6" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel6" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content tx-14">
            <div class="modal-header">
                <h6 class="modal-title" id="exampleModalLabel6">Create Contract</h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"></span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?php echo BASE_URL; ?>contracts/create_contract" method="POST"
                    enctype="multipart/form-data">
                    <input type="hidden" name="appId" value="<?php echo $applicationID; ?>">
                    <div class="row">
                        <div class="col-4">
                            <img src="../uploads/img/fallback-image.png" class="img-fluid" alt="Responsive image">
                        </div>
                        <div class="col-6">
                            <p><b>Client Name :</b>
                                <?php echo $applicationTitle . "." . $applicationFname . " " . $applicationLname; ?>
                                <br><b>Passport No :</b> <?php echo $applicationPassport; ?> 
                            </p>

                            <label for="contractType">Contract Type</label>
                            <select name="contractType" class="form-control">
                                <option value="none" selected>select Type</option>
                                <option value="domestic">Domestic</option>
                                <option value="non-domestic">Non-Domestic</option>
                            </select>
                            
                            <!-- Checkboxes for options -->
                            <div class="mt-3">
                                <h6>Contract Options:</h6>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="options[]" value="muzaned" id="muzaned">
                                    <label class="form-check-label" for="muzaned">
                                        Muzaned
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="options[]" value="enjaze" id="enjaze">
                                    <label class="form-check-label" for="enjaze">
                                        Enjaze
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="options[]" value="fingerprint" id="fingerprint">
                                    <label class="form-check-label" for="fingerprint">
                                        Finger Print
                                    </label>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary mt-2" name="submit">Create Contract</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary tx-13" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>