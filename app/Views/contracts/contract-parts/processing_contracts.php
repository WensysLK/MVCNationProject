<?php 
 function getBadge($status) {
    switch ($status) {
        case 'not_started':
            return ['badge bg-danger', 'Pending'];
        case 'processing':
            return ['badge bg-warning', 'Processing'];
        case 'finance':
                return ['badge bg-primary', 'Finance'];
        case 'completed':
            return ['badge bg-success', 'Completed'];
        default:
            return ['badge bg-light', 'Unknown'];
    }
}





?>

<table id="viewclintsprocesscontracts" class="table table-striped table-bordered mt-2" style="width:100%">
    <thead>
        <tr>
            <th>No</th>
            <th>Name</th>
            <th>Contract</th>
            <th>Passport</th>
            <th>Medical</th>
            <th>Enjaz</th>
            <th>Muzaned</th>
            <th>Fprint</th>
            <th>Beauro</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php
                        $sqlapplication = "SELECT a.*, c.*
                        FROM applications a
                        LEFT JOIN contract_details c ON a.applicationID = c.applicationID
                        WHERE a.softdeletStatus = 1 AND a.ContractCreated = 1 AND a.applicantStatus='Completed'";

     

                        
                        $resapplication = mysqli_query($conn,$sqlapplication);
                        
                        if($resapplication==true){
                            $count_rows = mysqli_num_rows($resapplication);
                            $num = 1;
                           
                            if($count_rows>0){
                                while($row=mysqli_fetch_assoc($resapplication)){
                                  $applicationID = $row['applicationID'];
                                  $applicationTitle = $row['applicantTitle'];
                                  $applicationFname = $row['applicatFname'];
                                  $applcationMname = $row['applicantMname'];
                                  $applicationLname = $row['applicantLname'];
                                  $applicationPassport = $row['applicantPassno'];
                                  $contractMedical = $row['medicalStatus'];
                                  $contractEnhjaz = $row['EnjazSatus'];
                                  $contractMuzaned = $row['MuzanedStatus'];
                                  $contractfprinnt = $row['fprintStatus'];
                                  $contractBeauro = $row['BeauroStatus'];
                                  $contractID = $row['contractId'];
                                  $profilepciture = $row['profile_image']; 
                              
                                  $profileImage = '../uploads/profile_images/'.$profilepciture;

                                  $fallbackimage = '../uploads/img/fallback-image.png';
 
                                  // Check if image path exists and is not empty
                                $imgSrc = !empty($profileImage) ? $profileImage : $fallbackimage;

                                //Badget Status 
                                // Function to get badge class and text based on status
                               

                                $medicalBadge = getBadge($contractMedical);
                                $enjazBadge = getBadge($contractEnhjaz);
                                $muzanedBadge = getBadge($contractMuzaned);
                                $fprintdBadge = getBadge($contractfprinnt);
                                $beauroBadge = getBadge($contractBeauro);
                                ?>
        <tr>
            <td><?php echo $num++; ?></td>
            <td>
                <div class="d-flex align-items-center">
                    <div class="d-flex align-items-center">

                        <img class="rounded-circle" style="width: 40px; height: 40px;"
                            src="<?php echo $imgSrc; ?>" alt="Fallback Image" />

                        <div class="ms-2">
                            <?php echo $applicationTitle . "." . $applicationFname . " " . $applicationLname; ?>
                        </div>
                    </div>
                </div>
            </td>
            <td><?php echo $contractID; ?></td>
            <td><?php echo $applicationPassport; ?></td>
            <td><span class="<?php echo $medicalBadge[0]; ?>"><?php echo $medicalBadge[1]; ?></span></td>
            <td><span class="<?php echo $enjazBadge[0]; ?>"><?php echo $enjazBadge[1]; ?></span></td>
            <td><span class="<?php echo $muzanedBadge[0]; ?>"><?php echo $muzanedBadge[1]; ?></td>
            <td><span class="<?php echo $fprintdBadge[0]; ?>"><?php echo $fprintdBadge[1]; ?></td>
            <td><span class="<?php echo $beauroBadge[0]; ?>"><?php echo $beauroBadge[1]; ?></span></td>
            <td>


           
               
                <a href="#" class="btn-success btn-xs lni lni-eye">
                <i class="fas fa-solid fa-eye fa-2xl" style="color: #009933;"></i>
                </a>
                <a href="#" class="btn-danger btn-xs lni lni-trash"><i class="fas fa-trash-alt fg-2xl" style="color: #ff0000;" ></i></a>
            </td>
        </tr>
        <?php } } }?>
        <!-- Add more rows as needed -->
    </tbody>
</table>

<?php include('popups/create_contract_form.php'); ?>
