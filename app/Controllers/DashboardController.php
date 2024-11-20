<?php

class DashboardController extends Controller
{
    /**
     * Created By :Oshadhi Chamodya
     * Created At : 2024-11-18
     */


    /**
     *  Check if the user is logged in and Load the dashboard view
     * @return void
     */
    public function index()
    {
        session_start();

        if (!isset($_SESSION['session_name'])) {
            header("Location: /login");
            exit();
        }
        $this->view('admin/dashboard', ['user' => $_SESSION['user']]);
    }

    /**
     * Call Application Model Function Get DashBoard Pending Application Count
     * @return void
     */
    public function get_pending_application()
    {
        $response = [];
        $applicationModel = $this->model('Application');
        $result = $applicationModel->getPendingApplications();

        if ($result) {
            $row = $result->fetch_assoc();
            $pending_count = $row['pending_count'];
            $response['total'] = $pending_count;
        } else {
            $_SESSION['error'] = "Invalid username/email or password!";
            header("Location: ../index.php");
        }

        header('Content-Type: application/json');
        echo json_encode($response);

    }

    /**
     * Call Application Model Function Get DashBoard Current Date Book Medical Application Count
     * @return void
     */
    public function get_medical_applications()
    {
        $applicationModel = $this->model('Application');
        $result = $applicationModel->getMedicalApplications();

        if ($result) {
            $row = $result->fetch_assoc();
            $booked_count = $row['booked_count'];
            $responseMedical['total'] = $booked_count;
        } else {
            $_SESSION['error'] = "Invalid username/email or password!";
            header("Location: ../index.php");
        }

        header('Content-Type: application/json');
        echo json_encode($responseMedical);

    }

    /**
     * Call Application Model Function Get DashBoard Contracts Application Count
     * @return void
     */
    public function get_contracts_applications()
    {
        $applicationModel = $this->model('Application');
        $result = $applicationModel->getContractApplications();

        if ($result) {
            $row = $result->fetch_assoc();
            $contract_count = $row['contract_count'];
            $responseContract['total'] = $contract_count;
        } else {
            $_SESSION['error'] = "Invalid username/email or password!";
            header("Location: ../index.php");
        }
        header('Content-Type: application/json');
        echo json_encode($responseContract);

    }

    /**
     * Call Application Model Function Get DashBoard Enjaz Application Count
     * @return void
     */
    public function get_enjaz_applications()
    {
        $applicationModel = $this->model('Application');
        $result = $applicationModel->getEnjazApplications();

        if ($result) {
            $row = $result->fetch_assoc();
            $enjaz_count = $row['enjaz_count'];
            $responseEnjaz['total'] = $enjaz_count;
        } else {
            $_SESSION['error'] = "Invalid username/email or password!";
            header("Location: ../index.php");
        }

        header('Content-Type: application/json');
        echo json_encode($responseEnjaz);

    }
    /**
     * Call Application Model Function Get DashBoard Muzaned Application Count
     * @return void
     */
    public function get_muzaned_applications()
    {
        $applicationModel = $this->model('Application');
        $result = $applicationModel->getMuzanedApplications();

        if ($result) {
            $row = $result->fetch_assoc();
            $muzaned_count = $row['muzaned_count'];
            $responseMuzaned['total'] = $muzaned_count;
        } else {
            $_SESSION['error'] = "Invalid username/email or password!";
            header("Location: ../index.php");
        }

        header('Content-Type: application/json');
        echo json_encode($responseMuzaned);

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

}
