<?php
class LoginController extends Controller {
    public function index() {
        $this->view('login');
    }

    public function login() {
        session_start();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username_email'];
            $password = $_POST['password'];

            $userModel = $this->model('User');
            $user = $userModel->getUser($username,$password);


            if ($user->num_rows == 1) {
                $row = $user->fetch_assoc();

                // Verify password (assuming passwords are not hashed)
                if ($password === $row['password']) {
                    // Set session variables
                    $_SESSION['session_name'] = $row['Username'];     // Username
                    $_SESSION['session_id'] = $row['userID'];         // User ID
                    $_SESSION['session_role_id'] = $row['userRoleID']; // User role ID
                    $_SESSION['session_role_name'] = $row['UserRoleName']; // Role name

                    // Redirect to dashboard or any protected page
//                    $this->view('admin/dashboard', ['user' => $_SESSION]);

//                    $this->view('auth/login', ['message' => 'Hello, MVC!']);
//                    $file = BASE_URL . "dashboard";
//                    var_dump($file);die();
                    header("Location:../dashboard/index");
//                    include $file;
//                    exit();
                } else {
                    // Password doesn't match
                    $_SESSION['error'] = "Invalid username/email or password!";
                    header("Location: ../index.php");
                }
            } else {
                // User doesn't exist
                $_SESSION['error'] = "Invalid username/email or password!";
                header("Location: ../index.php");
            }

//            if ($user && password_verify($password, $user['password'])) {
//                session_start();
//                $_SESSION['user_id'] = $user['id'];
//                header('Location: /dashboard');
//            } else {
//                $data['error'] = 'Invalid credentials';
//                $this->view('login', $data);
//            }
        }
    }

    public function logout() {
        session_start();
        session_unset();
        session_destroy();
        header('Location: /');
    }
}
