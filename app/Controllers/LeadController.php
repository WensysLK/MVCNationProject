<?php

class LeadController extends Controller
{
    public function index()
    {
        session_start();
        if (!isset($_SESSION['session_name'])) {
            header("Location: /login");
            exit();
        }
        $this->view('leads/view_all_leads');
    }

    public function update_lead()
    {

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Get the form data
            $fname = $_POST['firstName'];
            $lname = $_POST['lastName'];
            $nic = $_POST['nic'];
            $passport = $_POST['passport'];
            $email = $_POST['email'];
            $phone = $_POST['phone'];
            $source = $_POST['source'];
            $userModel = $this->model('Lead');
            $user = $userModel->insertLead($fname,$lname,$nic,$passport,$email,$phone,$source);
//            var_dump($user);die();
//            if ($user === TRUE) {
                header('Location: view_all_leads');  // Redirect to lead list after adding
//            } else {
//                echo "Error: " . $user->error;
//            }

        }

    }
    public function update_follupstatus(){

        if (isset($_GET['lead_id'])) {
            $lead_id = $_GET['lead_id'];
            $userModel = $this->model('Lead');
            $user = $userModel->updateFollowUpStatus($lead_id);
            $details=$userModel->getFollowup($lead_id);
//            $lead_name = $details['name'] . ' ' . $details['lname'];
            $_SESSION['session_id'] = $_GET['lead_id'];
            $_SESSION['lead_name'] = $details['name'] . ' ' . $details['lname'];
            $url='followUp/index?lead_id='.$lead_id;
//            var_dump($url);die();

            header("Location:$url");
//                $this->view('leads/followups/followup', ['lead_name' => $lead_name]);
//            } else {
//                $lead_name = "Lead not found"; // Handle case where lead is not found
//            }
//            header('Location: lead/followups');
//            header("Location: ../followups/followup.php?lead_id=$lead_id");
            exit();
        }
    }

//    public function followups(){
//        $lead_id = isset($_GET['lead_id']) ? $_GET['lead_id'] : null;
//        if ($lead_id) {
//            // Prepare the query to fetch the lead's name using the lead_id
//            $userModel = $this->model('Lead');
//            $user = $userModel->getFollowup($lead_id);
//
//            if ($user->num_rows > 0) {
//                $lead = $user->fetch_assoc();
//
//                $lead_name = $lead['name'] . ' ' . $lead['lname'];
//                $this->view('leads/followups/followup', ['lead_name' => $lead_name]);
//            } else {
//                $lead_name = "Lead not found"; // Handle case where lead is not found
//            }
//        } else {
//            $lead_name = "No lead selected"; // Handle case where no lead_id is provided
//        }
//    }
}