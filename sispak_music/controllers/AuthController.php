<?php
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../models/UserModel.php';

class AuthController {

    private $userModel;

    public function __construct() {
        $this->userModel = new UserModel();
    }

    public function login() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $email = $_POST['email'];
            $password = $_POST['password'];

            $user = $this->userModel->getByEmail($email);

            if ($user && password_verify($password, $user['password'])) {

                $_SESSION['user'] = [
                    'id' => $user['id_user'],
                    'nama' => $user['nama'],
                    'role' => $user['role']
                ];

                if ($user['role'] === 'admin') {
                    header("Location: index.php?page=admin_dashboard");
                } else {
                    header("Location: index.php?page=musisi_dashboard");
                }
                exit;
            } else {
                echo "Login gagal!";
            }
        }

        require __DIR__ . '/../views/auth/login.php';
    }

    public function register() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $data = [
                'nama' => $_POST['nama'],
                'email' => $_POST['email'],
                'password' => password_hash($_POST['password'], PASSWORD_DEFAULT),
                'role' => 'musisi'
            ];

            $this->userModel->create($data);

            header("Location: index.php?page=login");
            exit;
        }

        require __DIR__ . '/../views/auth/register.php';
    }

    public function logout() {
        session_destroy();
        header("Location: index.php?page=login");
        exit;
    }
}
