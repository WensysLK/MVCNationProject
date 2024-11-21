<?php

class FollowUp extends Model
{
    public function insertFollowup($followup_type, $message, $clientId, $followup_date)
    {

        $sql = "INSERT INTO follow_ups (lead_id, followup_type, message, followup_date) 
            VALUES ('$clientId', '$followup_type', '$message', '$followup_date')";


        if ($this->db->query($sql) === TRUE) {
            // Update the lead status to 'follow-up'
            $stmt = $this->db->query("UPDATE leads SET status='processing' WHERE id='$clientId'");

            return $stmt;

        }

    }


    public function updateFollowUps($followup_id,$followup_type,$message,$clientId,$followup_date){
        $sql = "UPDATE follow_ups 
            SET followup_type = ?, message = ?, followup_date = ?
            WHERE id = ?";

        $stmt = $this->db->prepare($sql);
        if ($stmt) {
            $stmt->bind_param("sssi", $followup_type, $message, $followup_date, $followup_id);

            if ($stmt->execute()) {
                // Optionally update the lead status if necessary
                $stmtNew =   $this->db->query("UPDATE leads SET status='follow-up' WHERE id='$followup_id'");

                // Redirect to the follow-up page
                return $stmtNew;
//                header('Location: ../followups/followup.php?lead_id=' . $clientId);
                exit;
            } else {
                return "Error updating follow-up: " . $stmt->error;
            }

            $stmt->close();
        } else {
            return "Error preparing the statement: " . $this->db->error;
        }

    }

    public function deleteFollowUps($followup_id,$clientId){
        $sql = "UPDATE follow_ups SET softdeletestatus = 0 WHERE id = ?";

        $stmt = $this->db->prepare($sql);
        if ($stmt) {
            $stmt->bind_param('i', $followup_id);

            if ($stmt->execute()) {
                return $stmt;

            } else {
                return "Error performing soft delete: " . $stmt->error;
            }


        } else {
            return "Error preparing the soft delete statement: " . $this->db->error;
        }

    }
}