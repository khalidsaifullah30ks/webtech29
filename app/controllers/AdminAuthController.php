<?php

require_once __DIR__ . '/../models/Admin.php';

class AdminAuthController
{
    private Admin $adminModel;

    public function __construct(PDO $pdo)
    {
        $this->adminModel = new Admin($pdo);
    }

    public function loginForm(): void
    {
        $error = '';
        require __DIR__ . '/../views/admin/login.php';
    }

    public function login(): void
    {
        $username = trim($_POST['username'] ?? '');
        $password = $_POST['password'] ?? '';

        $admin = $this->adminModel->findByUsername($username);

        if (!$admin || !password_verify($password, $admin['PasswordHash'])) {
            $error = 'Invalid username or password.';
            require __DIR__ . '/../views/admin/login.php';
            return;
        }

$_SESSION['admin_id'] = $admin['AdminID'];
$_SESSION['admin_username'] = $admin['Username'];
$_SESSION['admin_role'] = $admin['Role'];
session_regenerate_id(true);

header('Location: index.php?action=admin_dashboard');
exit;
    }

    public function logout(): void
    {
        session_unset();
        session_destroy();

        header('Location: index.php?action=admin_login');
        exit;
    }
}