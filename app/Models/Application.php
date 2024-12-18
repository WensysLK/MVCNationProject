<?php

class Application extends Model
{
    /**
     * Created By :Oshadhi Chamodya
     * Created At : 2024-11-18
     */

    /**
     * Get DashBoard Pending Application Count
     * @return false|mysqli_result
     */
    public function getPendingApplications()
    {
        $stmt = $this->db->prepare("SELECT COUNT(*) AS pending_count FROM applications WHERE applicantStatus = 'incomplete' AND softdeletStatus = 1");
        $stmt->execute();
        return $stmt->get_result();
    }

    /**
     * Get DashBoard Current Date Book Medical Application Count
     * @return false|mysqli_result
     */
    public function getMedicalApplications()
    {
        $current_date = date('Y-m-d');
        $stmt = $this->db->prepare("SELECT COUNT(*) AS booked_count FROM medical_details WHERE medicalStatus = 'booked' AND allocationDate = '$current_date'");
        $stmt->execute();
        return $stmt->get_result();
    }

    /**
     *  Get DashBoard Contract Application Count
     * @return false|mysqli_result
     */
    public function getContractApplications()
    {
        $stmt = $this->db->prepare("SELECT COUNT(*) AS contract_count FROM contract_details WHERE ContractStartus = 'Started' AND softdeletestatus = 1");
        $stmt->execute();
        return $stmt->get_result();
    }

    /**
     * Get DashBoard Enjaz Application Count
     * @return false|mysqli_result
     */
    public function getEnjazApplications()
    {
        $stmt = $this->db->prepare("SELECT COUNT(*) AS enjaz_count FROM enjaz_details WHERE EnjazStatus = 'processing' AND softdeletestatus = 1");
        $stmt->execute();
        return $stmt->get_result();
    }

    /**
     * Get DashBoard Muzane Application Count
     * @return false|mysqli_result
     */
    public function getMuzanedApplications()
    {
        $stmt = $this->db->prepare("SELECT COUNT(*) AS muzaned_count FROM contract_details WHERE muzanedStatus = 'processing' AND softdeletestatus = 1");
        $stmt->execute();
        return $stmt->get_result();
    }

    public function get_available_app_total(){
        $stmt = $this->db->prepare("SELECT COUNT(*) AS pending_app_count FROM applications WHERE applicantStatus = 'Completed' AND softdeletStatus = 1");
        $stmt->execute();
        return $stmt->get_result();
    }

    public function get_incomplete_count(){
        $stmt = $this->db->prepare("SELECT COUNT(*) AS pending_app_count FROM applications WHERE applicantStatus = 'incomplete' AND softdeletStatus = 1");
        $stmt->execute();
        return $stmt->get_result();
    }

    public function get_processing_count(){
        $stmt = $this->db->prepare("SELECT COUNT(*) AS pending_porcess_count FROM applications WHERE ContractCreated = 1 AND softdeletStatus = 1");
        $stmt->execute();
        return $stmt->get_result();
    }

    public function get_departure_count(){
        $stmt = $this->db->prepare("SELECT COUNT(*) AS pending_departure_count FROM applications WHERE ContractCreated = 3 AND softdeletStatus = 1");
        $stmt->execute();
        return $stmt->get_result();
    }
    public function get_deported_count(){
        $stmt = $this->db->prepare("SELECT COUNT(*) AS pending_depoted_count FROM applications WHERE ContractCreated = 4 AND softdeletStatus = 1");
        $stmt->execute();
        return $stmt->get_result();
    }
    public function registerLead($applicantTitle,$applicantFname,$applicantMname,$applicantLname,$applicantDob,$passportNumber,$nicNumber,$leadId,$source){
        $profile_image="../../uploads/img/fallback-image.png";
        $applicantPassdate=date("Y-m-d");;
        $insertQuery = "INSERT INTO Applications (profile_image,applicantTitle, applicatFname, applicantMname, applicantLname, applicantDob, applicantPassno, applicantNICno,applicantPassdate, how_foun_us, leadId)
                    VALUES (?,?,?, ?, ?, ?, ?, ?, ?, ?, ?)";

        if ($stmt = $this->db->prepare($insertQuery)) {
            // Bind parameters and execute the insert query
            $stmt->bind_param("ssssssssssi", $profile_image,$applicantTitle, $applicantFname, $applicantMname, $applicantLname, $applicantDob, $passportNumber, $nicNumber, $applicantPassdate,$source, $leadId);

            if ($stmt->execute()) {
                // Check if the insert was successful using affected_rows
                if ($this->db->affected_rows > 0) {
                    // Update the lead status to "registered"
                    $updateQuery = "UPDATE leads SET status = 'registered' WHERE id = ?";
                    $updateStmt = $this->db->prepare($updateQuery);
                    $updateStmt->bind_param("i", $leadId);
                    $updateStmt->execute();

                    // Redirect to the next page
                    return $stmt->get_result();
                } else {
                    return "Error: Unable to insert application data.";
                }
            } else {
                return "Error: Execution failed - " . $stmt->error;
            }

            // Close the statement

        } else {
            return "Error: Could not prepare the insert statement - " . $this->db->error;
        }
    }

    public function getProfileDetails($client_id){
        $sql = "SELECT * FROM applications WHERE applicationID=$client_id"; // Ensure `lead_id` exists in the `leads` table
        $res = mysqli_query($this->db,$sql);
        if($row = mysqli_fetch_assoc($res)) {

            $sqlContractStatus = "SELECT `interviewStatus`,`medicalStatus`, `EnjazSatus`, `MuzanedStatus`, `fprintStatus`, `BeauroStatus`, `contractType`, `ContractStartus`, `contractCreated`
                                                    FROM `contract_details` 
                                                    WHERE `applicationID` =$client_id  LIMIT 1";


            $rese = mysqli_query($this->db,$sqlContractStatus);
//            $stmtContract = $this->db->prepare($sqlContractStatus);
//            $stmtContract->bind_param("i", $client_id);
//            $stmtContract->execute();
            $resultContract = mysqli_fetch_assoc($rese);
//            var_dump($resultContract);die();
            $data=[$resultContract,$row];
//            var_dump($data[1]);die();
            return $data;
        }else{
            return $row;
        }
    }
}
