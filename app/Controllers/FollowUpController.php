<?php

class FollowUpController extends Controller
{
    public function index()
    {
        session_start();
var_dump($_SESSION);die();
        if (!isset($_SESSION['session_name'])) {
            header("Location: /login");
            exit();
        }
        $details=$userModel->getFollowup($lead_id);
        $this->view('lead/follow_ups_new', ['user' => $_SESSION['user']]);
    }
}