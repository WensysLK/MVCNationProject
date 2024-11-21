<?php


use Middleware\AuthMiddleware;

require_once __DIR__ . '/../Middleware/AuthMiddleware.php';

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
            $user = $userModel->insertLead($fname, $lname, $nic, $passport, $email, $phone, $source);

            header('Location: view_all_leads');  // Redirect to lead list after adding


        }

    }

    public function update_follupstatus()
    {
//        AuthMiddleware::handle();
        if (isset($_GET['lead_id'])) {
            $lead_id = $_GET['lead_id'];
            $userModel = $this->model('Lead');
            $user = $userModel->updateFollowUpStatus($lead_id);
            $details = $userModel->getFollowup($lead_id);
            $lead_name = $details['name'] . ' ' . $details['lname'];
            $_SESSION['session_id'] = $_GET['lead_id'];
            $_SESSION['lead_name'] = $details['name'] . ' ' . $details['lname'];
            $url = 'followUp/index?lead_id=' . $lead_id;
//            var_dump($url);die();
            session_start();

//            header("Location: ../leads/followup.php?lead_id=$lead_id");
            $this->view('leads/followup', ['lead_name' => $lead_name]);
//            } else {
//                $lead_name = "Lead not found"; // Handle case where lead is not found
//            }
//            header('Location: lead/followups');
//            header("Location: ../followups/followup.php?lead_id=$lead_id");
            exit();
        }
    }

    public function followupNew()
    {
        if (isset($_GET['lead_id'])) {
            $lead_id = $_GET['lead_id'];
            $userModel = $this->model('Lead');
            $details = $userModel->getFollowup($lead_id);
            $lead_name = $details['name'] . ' ' . $details['lname'];
            session_start();
            $this->view('leads/followupNew', ['lead_name' => $lead_name]);
        }
    }

    public function insert_followup()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Get the form data
            $followup_type = $_POST['followup_type'];
            $message = $_POST['message'];
            $clientId = $_POST['follupid'];
            $followup_date = $_POST['followup_date'];
//            $status = $_POST['status'];
            $userModel = $this->model('FollowUp');

            $user = $userModel->insertFollowup($followup_type, $message, $clientId, $followup_date);
//            var_dump($user);die();
//            if ($user === TRUE) {
            session_start();
            header('Location: followupNew?lead_id=' . $clientId);
//            } else {
//                echo "Error: " . $user->error;
//            }

        }

    }

    public function update_followup(){
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $followup_id = $_POST['followup_id']; // ID of the follow-up record to update
            $followup_type = $_POST['followup_type']; // Updated follow-up type
            $message = $_POST['message']; // Updated message
            $clientId = $_POST['leadid']; // Client or lead ID
            $followup_date = $_POST['followup_date'];

            // Updated follow-up date
            $userModel = $this->model('FollowUp');
            $user = $userModel->updateFollowUps($followup_id,$followup_type,$message,$clientId,$followup_date);
//            $details = $userModel->getFollowup($lead_id);

            session_start();


            header('Location: followupNew?lead_id=' . $clientId);
//            } else {
//                $lead_name = "Lead not found"; // Handle case where lead is not found
//            }
//            header('Location: lead/followups');
//            header("Location: ../followups/followup.php?lead_id=$lead_id");
            exit();
        }
    }

    public function delete_followup(){
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['followup_id'])) {
            $followup_id = $_POST['followup_id']; // The ID of the follow-up to soft delete
            $clientId = $_POST['clientId'];
            $userModel = $this->model('FollowUp');
            $user = $userModel->deleteFollowUps($followup_id,$clientId);
            session_start();


            header('Location: followupNew?lead_id=' . $clientId);
            exit();
        }
    }


    public function update_leadNew()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Get the form data
            $lead_id = $_POST['lead_id'];
            $name = $_POST['firstName'];
            $lastname = $_POST['lastName'];
            $nic = $_POST['nic'];
            $passport = $_POST['passport'];
            $email = $_POST['email'];
            $phone = $_POST['phone'];
            $source = $_POST['source'];
            $status = $_POST['status'];
            $userModel = $this->model('Lead');
            $user = $userModel->updateLead($lead_id, $name, $lastname, $nic, $passport, $email, $phone, $source);
            session_start();
            header('Location: view_all_leads');
        }
    }

    public function delete_lead(){
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['clientId'])) {
            // The ID of the follow-up to soft delete
            $clientId = $_POST['clientId'];
            $userModel = $this->model('Lead');
            $user = $userModel->deleteLead($clientId);
            session_start();
            header('Location: view_all_leads');
        }
    }

    public function registerLead(){
        if (isset($_POST['saveContinue'])) {
            // Capture form data
            $applicantTitle = $_POST['name-title'];
            $applicantFname = $_POST['Cfname'];
            $applicantMname = $_POST['cmname'];
            $applicantLname = $_POST['clname'];
            $applicantDob = $_POST['dateofbirth'];
            $passportNumber = $_POST['passportNumber'];
            $nicNumber = $_POST['nicNumber'];
            $leadId = $_POST['lead_id'];
            $source = $_POST['sourcelead'];
            $userModel = $this->model('Application');
            $user = $userModel->registerLead($applicantTitle,$applicantFname,$applicantMname,$applicantLname,$applicantDob,$passportNumber,$nicNumber,$leadId,$source);
            session_start();
            header('Location: view_all_leads');
        }
    }

}