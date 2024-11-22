<?php

class ApplicationController extends Controller
{
    public function index()
    {
        session_start();
//        if (!isset($_SESSION['user'])) {
//            header("Location: /login");
//            exit();
//        }
        $this->view('application/view_all_applications');
    }

    public function get_available_app_total_count()
    {
        $response = [];
        $applicationModel = $this->model('Application');
        $result = $applicationModel->get_available_app_total();

        if ($result) {
            $row = $result->fetch_assoc();

            $pending_app_count = $row['pending_app_count'];
            $response['total'] = $pending_app_count;
        } else {
            $_SESSION['error'] = "Invalid username/email or password!";
            header("Location: ../index.php");
        }

        header('Content-Type: application/json');
        echo json_encode($response);
    }
    public function get_incomplete_count(){
        $response = [];
        $applicationModel = $this->model('Application');
        $result = $applicationModel->get_incomplete_count();

        if ($result) {
            $row = $result->fetch_assoc();

            $pending_app_incom_count = $row['pending_app_count'];
            $response['total'] = $pending_app_incom_count;
        } else {
            $_SESSION['error'] = "Invalid username/email or password!";
            header("Location: ../index.php");
        }

        header('Content-Type: application/json');
        echo json_encode($response);
    }

    public function get_processing_count(){
        $response = [];
        $applicationModel = $this->model('Application');
        $result = $applicationModel->get_processing_count();

        if ($result) {
            $row = $result->fetch_assoc();

            $pending_app_processing_count = $row['pending_porcess_count'];
            $response['total'] = $pending_app_processing_count;
        } else {
            $_SESSION['error'] = "Invalid username/email or password!";
            header("Location: ../index.php");
        }

        header('Content-Type: application/json');
        echo json_encode($response);
    }
    public function get_departure_count(){
        $response = [];
        $applicationModel = $this->model('Application');
        $result = $applicationModel->get_departure_count();

        if ($result) {
            $row = $result->fetch_assoc();

            $pending_app_departure_count = $row['pending_departure_count'];
            $response['total'] = $pending_app_departure_count;
        } else {
            $_SESSION['error'] = "Invalid username/email or password!";
            header("Location: ../index.php");
        }

        header('Content-Type: application/json');
        echo json_encode($response);
    }
    public function get_deported_count(){
        $response = [];
        $applicationModel = $this->model('Application');
        $result = $applicationModel->get_deported_count();

        if ($result) {
            $row = $result->fetch_assoc();

            $pending_app_departure_count = $row['pending_depoted_count'];
            $response['total'] = $pending_app_departure_count;
        } else {
            $_SESSION['error'] = "Invalid username/email or password!";
            header("Location: ../index.php");
        }

        header('Content-Type: application/json');
        echo json_encode($response);
    }

    public function viewNew(){
        if (isset($_GET['client_id'])) {
            $client_id = $_GET['client_id'];
            $response = [];
            $applicationModel = $this->model('Application');
            $result = $applicationModel->getProfileDetails($client_id);

            $clientTitle = $result[1]["applicantTitle"];
            $client_fname = $result[1]["applicatFname"];
            $client_mname = $result[1]["applicantMname"];
            $client_lname = $result[1]["applicantLname"];
            $client_passport = $result[1]["applicantPassno"];
            $client_religion = $result[1]["appReligion"];
            $client_birthday = $result[1]["applicantDob"];
            $client_photo = $result[1]["profile_image"];
            $clientstatus = $result[1]["applicantStatus"];
            $client_register_date = $result[1]["register_date"];

            // Calculate age
            $birthdate = new DateTime($client_birthday);
            $today = new DateTime('today');
            $age = $birthdate->diff($today);

            $profileImage = '../../uploads/profile_images/'.$client_photo;
            $fallbackimage = '../../uploads/img/fallback-image.png';
            $imgSrc = !empty($profileImage) ? $profileImage : $fallbackimage;
            $contract=$result[0];



            $data=[
                "clientTitle"=> $clientTitle,
                "client_fname"=>$client_fname,
                "client_mname"=> $client_mname,
                "client_lname"=>$client_lname,
                "client_passport"=> $client_passport,
                "client_religion"=>$client_religion,
                "client_birthday"=> $client_birthday,
                "client_photo"=> $client_photo,
                "clientstatus"=>$clientstatus,
                "client_register_date"=>$client_register_date,
                "age"=>$age,
                "imgSrc"=>$imgSrc,
                "contract"=>$contract
            ];
            session_start();
            $this->view('application/application-profile-edit', ['details' => $data]);
        }

    }

    public function user_registartion_precheck(){
        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            $applicantTitle = isset($_POST['name-title']) ? $_POST['name-title'] : '';
            $applicantFname = isset($_POST['Cfname']) ? $_POST['Cfname'] : '';
            $applicantMname = isset($_POST['cmname']) ? $_POST['cmname'] : '';
            $applicantLname = isset($_POST['clname']) ? $_POST['clname'] : '';
            $applicantDob = isset($_POST['dateofbirth']) ? $_POST['dateofbirth'] : '';
            $passportNumber = isset($_POST['passportNumber']) ? $_POST['passportNumber'] : '';
            $nicNumber = isset($_POST['nicNumber']) ? $_POST['nicNumber'] : '';

            if (isset($_POST['saveContineue'])) {
//                var_dump("hello2");
//                die();
                // collect form data
                // Store data in session
                $data = [
                    'applicantTitle' => $applicantTitle,
                    'applicantFname' => $applicantFname,
                    'applicantMname' => $applicantMname,
                    'applicantLname' => $applicantLname,
                    'applicantDob' => $applicantDob,
                    'passportNumber' => $passportNumber,
                    'nicNumber' => $nicNumber,
                ];

                session_start();
                $this->view('application/client_registration', ['data' =>  $data]);
                // Redirect to registration page
//                header("Location: ../client_registration.php"); // Example redirect
//                exit();
            }

            else {

                // collect form data
                $apptitle = $_POST['name-title'];
                $appFirstname = $_POST['Cfname'];
                $appMidname = $_POST['cmname'];
                $appLname = $_POST['clnam'];
                $appdatebirth = $_POST['dateofbirth'];
                $appPassport = $_POST['passportNumber'];
                $appNic = $_POST['nicNumber'];


                $saveandclose_sql = "INSERT INTO 
        `applications`( 
        `applicantTitle`, `applicatFname`, 
        `applicantMname`, `applicantLname`,
        `applicantDob`, 
        `applicantPassno`, `applicantNICno`) 
        VALUES 
        ('$applicantTitle',
        '$applicantFname','$applicantMname',
        '$applicantLname','$applicantDob','$passportNumber',
        '$nicNumber')";
                $this>db->query($saveandclose_sql);
                // Redirect or perform any action needed for this button
                header("Location: ../view_all_applications.php"); // Example redirect
                exit;
            }
        }
    }

    public function main_insert(){
        if (isset($_POST['save'])) {
//            var_dump($_POST['save']);die();
            // Sanitize and retrieve form data
            $applicantTItile = htmlspecialchars(trim($_POST['name-title']), ENT_QUOTES, 'UTF-8');
            $applicantFname = htmlspecialchars(trim($_POST['Cfname']), ENT_QUOTES, 'UTF-8');
            $applicantMname = htmlspecialchars(trim($_POST['cmname']), ENT_QUOTES, 'UTF-8');
            $applicantLname = htmlspecialchars(trim($_POST['clname']), ENT_QUOTES, 'UTF-8');
            $passportNumner = htmlspecialchars(trim($_POST['cpassport']), ENT_QUOTES, 'UTF-8');
            $nicNumber = htmlspecialchars(trim($_POST['nicnumber']), ENT_QUOTES, 'UTF-8');
            $appheight = htmlspecialchars(trim($_POST['height']), ENT_QUOTES, 'UTF-8');
            $appweight = htmlspecialchars(trim($_POST['weight']), ENT_QUOTES, 'UTF-8');
            $appGnder = htmlspecialchars(trim($_POST['gender']), ENT_QUOTES, 'UTF-8');
            $appReligion = htmlspecialchars(trim($_POST['Religion']), ENT_QUOTES, 'UTF-8');
            $appRase = htmlspecialchars(trim($_POST['rase']), ENT_QUOTES, 'UTF-8');
            $appNationality = htmlspecialchars(trim($_POST['nationality']), ENT_QUOTES, 'UTF-8');
            $passportIssuedate = htmlspecialchars(trim($_POST['cpassportdate']), ENT_QUOTES, 'UTF-8');
            $appMeritalStatus = htmlspecialchars(trim($_POST['maritalstatus']), ENT_QUOTES, 'UTF-8');
            $appFilenumber = htmlspecialchars(trim($_POST['cffileno']), ENT_QUOTES, 'UTF-8');
            $howFoundus = htmlspecialchars(trim($_POST['findUs']), ENT_QUOTES, 'UTF-8');
            $subAgentID = htmlspecialchars(trim($_POST['subAgentId']), ENT_QUOTES, 'UTF-8');
            $applicntBirth = htmlspecialchars(trim($_POST['dateofbirth']), ENT_QUOTES, 'UTF-8');
            $applicantStatus = "Completed";

            $sqlpersonalinfo = "INSERT INTO applications (
        applicantTitle, applicatFname, applicantMname, applicantLname, applicantDob, 
        applicantPassno, applicantNICno, applicantPassdate, applicantNationality, applicanthight, 
        applicantWeight, applicantGender, appReligion, appRase, 
        maritalestatus, how_foun_us, subagentId, applicantStatus
    ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

            var_dump($sqlpersonalinfo);die();

        }
    }


}