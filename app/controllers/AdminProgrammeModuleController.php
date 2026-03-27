<?php

require_once __DIR__ . '/../models/Module.php';
require_once __DIR__ . '/../models/Programme.php';

class AdminProgrammeModuleController
{
    private Module $moduleModel;
    private Programme $programmeModel;

    public function __construct(PDO $pdo)
    {
        $this->moduleModel = new Module($pdo);
        $this->programmeModel = new Programme($pdo);
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

        $programmeId = $_GET['id'] ?? null;

        if (!$programmeId) {
            echo "Programme not found";
            return;
        }

        $programme = $this->programmeModel->getByIdAdmin((int)$programmeId);
        $modules = $this->moduleModel->getAll();
        $assignedModules = $this->moduleModel->getModulesByProgramme($programmeId);
        require __DIR__ . '/../views/admin/programmes/modules.php';
    }

    public function store()
    {
        $this->requireLogin();

        $programmeId = $_POST['programme_id'] ?? null;
        $moduleId = $_POST['module_id'] ?? null;
        $year = $_POST['year'] ?? null;

        if (!$programmeId || !$moduleId || !$year) {
            echo "All fields are required.";
            return;
        }

        $this->moduleModel->attachToProgramme($programmeId, $moduleId, $year);

        header('Location: index.php?action=admin_programme_modules&id=' . $programmeId);
        exit;
    }
}