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

}
