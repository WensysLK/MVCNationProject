<?php
class HomeController extends Controller {
    public function index() {
        $this->view('auth/login', ['message' => 'Hello, MVC!']);
    }
}
