<?php

class Lead extends Model
{
   public function insertLead($fname,$lname,$nic,$passport,$email,$phone,$source){

       $stmt = $this->db->prepare("INSERT INTO leads (name,lname,nic,passportNumber, email, phone, source) VALUES ('$fname','$lname','$nic','$passport', '$email', '$phone', '$source')");
       $stmt->execute();
       return $stmt->get_result();
   }

   public function updateFollowUpStatus($id){
       $status="Pending";
       $stmt = $this->db->prepare("UPDATE Leads SET status = 'Pending' WHERE id = '$id'");
//       $stmt->bind_param("si", $status, $id); // Bind the username or email
       $stmt->execute();
       return $stmt->get_result();
   }

   public function getFollowup($id){
       $sql = "SELECT * FROM leads WHERE id = ?"; // Ensure `lead_id` exists in the `leads` table
       $stmt = $this->db->prepare($sql);

       if (!$stmt) {
           throw new Exception("SQL Error: " . $this->db->error);
       }

       $stmt->bind_param('i', $id); // Bind the ID parameter
       $stmt->execute();

       $result = $stmt->get_result();
       return $result->fetch_assoc(); // Fetch the row
//       $stmt = $this->db->prepare("SELECT name, lname FROM leads WHERE id = ?");
//       $stmt->bind_param("i",  $id); // Bind the username or email
//       $stmt->execute();
//       return $stmt->get_result();
   }

   public function updateLead($lead_id,$name, $lastname, $nic, $passport, $email, $phone, $source){
       $status="new";
//       var_dump($lead_id,$name, $lastname, $nic, $passport, $email, $phone, $source);die();
       $sql = "UPDATE leads SET name = ?,lname=?,nic=?,passportNumber=?, email = ?, phone = ?, source = ?, status = ? WHERE id = ?";

       // Prepare the statement
       if ($stmt = $this->db->prepare($sql)) {
           // Bind the parameters
           $stmt->bind_param('ssssssssi', $name,$lastname,$nic,$passport, $email, $phone, $source, $status, $lead_id);

           // Execute the query
           $stmt->execute();
           return $stmt->get_result();

           // Close the statement

       } else {
           // Handle preparation error
           return "Error preparing the query: " . $this->db->error;
       }
   }

   public function deleteLead($clientId){
       $sql = "UPDATE leads SET softdeletStatus = 0 WHERE id = ?";

       $stmt = $this->db->prepare($sql);
       if ($stmt) {
           $stmt->bind_param('i', $clientId);

           $stmt->execute();
           return $stmt->get_result();


       } else {
           return "Error preparing the soft delete statement: " . $this->db->error;
       }
   }

}