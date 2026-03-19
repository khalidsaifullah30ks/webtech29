<?php
session_start();

require_once __DIR__ . '/../config/database.php';

$action = $_GET['action'] ?? 'home';

switch ($action) {
    case 'home':
        require_once __DIR__ . '/../app/controllers/HomeController.php';
        $controller = new HomeController($pdo);
        $controller->index();
        break;

    case 'programmes':
        require_once __DIR__ . '/../app/controllers/ProgrammeController.php';
        $controller = new ProgrammeController($pdo);
        $controller->index();
        break;

    case 'programme_show':
        require_once __DIR__ . '/../app/controllers/ProgrammeController.php';
        $controller = new ProgrammeController($pdo);
        $controller->show();
        break;

    case 'register_interest':
        require_once __DIR__ . '/../app/controllers/InterestController.php';
        $controller = new InterestController($pdo);
        $controller->create();
        break;

    case 'store_interest':
        require_once __DIR__ . '/../app/controllers/InterestController.php';
        $controller = new InterestController($pdo);
        $controller->store();
        break;

    case 'withdraw_interest':
        require_once __DIR__ . '/../app/controllers/InterestController.php';
        $controller = new InterestController($pdo);
        $controller->withdrawForm();
        break;

    case 'withdraw_interest_submit':
        require_once __DIR__ . '/../app/controllers/InterestController.php';
        $controller = new InterestController($pdo);
        $controller->withdraw();
        break;

    case 'admin_login':
        require_once __DIR__ . '/../app/controllers/AdminAuthController.php';
        $controller = new AdminAuthController($pdo);
        $controller->loginForm();
        break;

    case 'admin_login_submit':
        require_once __DIR__ . '/../app/controllers/AdminAuthController.php';
        $controller = new AdminAuthController($pdo);
        $controller->login();
        break;

    case 'admin_logout':
        require_once __DIR__ . '/../app/controllers/AdminAuthController.php';
        $controller = new AdminAuthController($pdo);
        $controller->logout();
        break;

    case 'admin_dashboard':
        require_once __DIR__ . '/../app/controllers/AdminProgrammeController.php';
        $controller = new AdminProgrammeController($pdo);
        $controller->dashboard();
        break;

    case 'admin_programmes':
        require_once __DIR__ . '/../app/controllers/AdminProgrammeController.php';
        $controller = new AdminProgrammeController($pdo);
        $controller->index();
        break;

    case 'admin_programme_create':
        require_once __DIR__ . '/../app/controllers/AdminProgrammeController.php';
        $controller = new AdminProgrammeController($pdo);
        $controller->create();
        break;

    case 'admin_programme_store':
        require_once __DIR__ . '/../app/controllers/AdminProgrammeController.php';
        $controller = new AdminProgrammeController($pdo);
        $controller->store();
        break;

    case 'admin_programme_edit':
        require_once __DIR__ . '/../app/controllers/AdminProgrammeController.php';
        $controller = new AdminProgrammeController($pdo);
        $controller->edit();
        break;

    case 'admin_programme_update':
        require_once __DIR__ . '/../app/controllers/AdminProgrammeController.php';
        $controller = new AdminProgrammeController($pdo);
        $controller->update();
        break;

    case 'admin_programme_delete':
        require_once __DIR__ . '/../app/controllers/AdminProgrammeController.php';
        $controller = new AdminProgrammeController($pdo);
        $controller->delete();
        break;

    case 'admin_programme_toggle':
        require_once __DIR__ . '/../app/controllers/AdminProgrammeController.php';
        $controller = new AdminProgrammeController($pdo);
        $controller->togglePublish();
        break;

    default:
        echo "Page not found.";
}