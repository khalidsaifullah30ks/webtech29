<?php

require_once __DIR__ . '/../models/Module.php';

class AdminModuleController
{
    private Module $moduleModel;

    public function __construct(PDO $pdo)
    {
        $this->moduleModel = new Module($pdo);
    }

    private function requireLogin()
    {
        if (empty($_SESSION['admin_id'])) {
            header('Location: index.php?action=admin_login');
            exit;
        }
    }

    public function index()
    {
        $this->requireLogin();

        $modules = $this->moduleModel->getAll();

        require __DIR__ . '/../views/admin/modules/index.php';
    }

    public function create()
    {
        $this->requireLogin();

        $staff = $this->moduleModel->getStaff();
        $programmes = $this->moduleModel->getProgrammes();

        require __DIR__ . '/../views/admin/modules/create.php';
    }

public function store()
{
    $this->requireLogin();

    $moduleName = trim($_POST['module_name'] ?? '');
    $leaderId = $_POST['leader_id'] ?? null;
    $description = trim($_POST['description'] ?? '');
    $image = trim($_POST['image'] ?? '');
    $programmeId = $_POST['programme_id'] ?? null;
    $year = $_POST['year'] ?? null;

    $errors = [];

    if ($moduleName === '') {
        $errors[] = 'Module name is required.';
    }

    if (strlen($moduleName) > 100) {
        $errors[] = 'Module name must be less than 100 characters.';
    }

    if ($description === '') {
        $errors[] = 'Description is required.';
    }

    if (strlen($description) < 20) {
        $errors[] = 'Description must be at least 20 characters.';
    }

    if (!$programmeId || (int)$programmeId <= 0) {
        $errors[] = 'Please select a programme.';
    }

    if (!$year || !in_array((int)$year, [1, 2, 3, 4], true)) {
        $errors[] = 'Please select a valid year.';
    }

    if ($image !== '' && !filter_var($image, FILTER_VALIDATE_URL)) {
        $errors[] = 'Image must be a valid URL.';
    }

    if (!empty($errors)) {
        $staff = $this->moduleModel->getStaff();
        $programmes = $this->moduleModel->getProgrammes();
        require __DIR__ . '/../views/admin/modules/create.php';
        return;
    }

    $this->moduleModel->create([
        'ModuleName' => $moduleName,
        'ModuleLeaderID' => $leaderId,
        'Description' => $description,
        'Image' => $image
    ]);

    $moduleId = $this->moduleModel->getLastInsertId();

    $this->moduleModel->attachToProgramme((int)$programmeId, $moduleId, (int)$year);

    header('Location: index.php?action=admin_modules');
    exit;
}

    public function edit()
    {
        $this->requireLogin();

        $id = $_GET['id'] ?? 0;

        $module = $this->moduleModel->getById($id);
        $staff = $this->moduleModel->getStaff();
        $programmes = $this->moduleModel->getProgrammes();

        require __DIR__ . '/../views/admin/modules/edit.php';
    }

    public function update()
    {
        $this->requireLogin();

        $id = $_POST['module_id'];

        $this->moduleModel->update($id, [
            'ModuleName' => $_POST['module_name'],
            'ModuleLeaderID' => $_POST['leader_id'],
            'Description' => $_POST['description'],
            'Image' => $_POST['image']
        ]);

        header('Location: index.php?action=admin_modules');
        exit;
    }

public function delete()
{
    $this->requireLogin();

    $id = isset($_POST['id']) ? (int) $_POST['id'] : 0;

    if ($id <= 0) {
        echo "Invalid module ID.";
        return;
    }

    $this->moduleModel->delete($id);

    header('Location: index.php?action=admin_modules');
    exit;
}
}