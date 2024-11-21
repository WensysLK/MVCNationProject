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
        $this->view('applications/view_all_applications');
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

    public function profileView(){
        if (isset($_GET['client_id'])) {
            var_dump($_GET['client_id']);die();
        }
    }
}