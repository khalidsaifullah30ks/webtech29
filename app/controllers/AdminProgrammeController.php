<?php

require_once __DIR__ . '/../models/Programme.php';
require_once __DIR__ . '/../models/InterestedStudent.php';

class AdminProgrammeController
{
    private Programme $programmeModel;
    private InterestedStudent $interestModel;

    public function __construct(PDO $pdo)
    {
        $this->programmeModel = new Programme($pdo);
        $this->interestModel = new InterestedStudent($pdo);
    }

    private function requireLogin(): void
    {
        if (empty($_SESSION['admin_id'])) {
            header('Location: index.php?action=admin_login');
            exit;
        }
    }

    public function dashboard(): void
    {
        $this->requireLogin();
        $students = $this->interestModel->getAllWithProgramme();
        require __DIR__ . '/../views/admin/dashboard.php';
    }

    public function index(): void
    {
        $this->requireLogin();
        $programmes = $this->programmeModel->getAllAdmin();
        require __DIR__ . '/../views/admin/programmes/index.php';
    }

    public function create(): void
    {
        $this->requireLogin();
        require __DIR__ . '/../views/admin/programmes/create.php';
    }

    public function store(): void
    {
        $this->requireLogin();

        $programmeName = trim($_POST['programme_name'] ?? '');
        $levelId = (int) ($_POST['level_id'] ?? 0);
        $programmeLeaderId = trim($_POST['programme_leader_id'] ?? '');
        $description = trim($_POST['description'] ?? '');
        $image = trim($_POST['image'] ?? '');
        $isPublished = isset($_POST['is_published']) ? 1 : 0;

        if ($programmeName === '' || $levelId === 0 || $description === '') {
            echo "Please fill in all required fields.";
            return;
        }

        $this->programmeModel->create([
            'ProgrammeName' => $programmeName,
            'LevelID' => $levelId,
            'ProgrammeLeaderID' => $programmeLeaderId,
            'Description' => $description,
            'Image' => $image,
            'IsPublished' => $isPublished
        ]);

        header('Location: index.php?action=admin_programmes');
        exit;
    }

    public function edit(): void
    {
        $this->requireLogin();

        $id = isset($_GET['id']) ? (int) $_GET['id'] : 0;
        $programme = $this->programmeModel->getByIdAdmin($id);

        if (!$programme) {
            echo "Programme not found.";
            return;
        }

        require __DIR__ . '/../views/admin/programmes/edit.php';
    }

    public function update(): void
    {
        $this->requireLogin();

        $id = (int) ($_POST['programme_id'] ?? 0);
        $programmeName = trim($_POST['programme_name'] ?? '');
        $levelId = (int) ($_POST['level_id'] ?? 0);
        $programmeLeaderId = trim($_POST['programme_leader_id'] ?? '');
        $description = trim($_POST['description'] ?? '');
        $image = trim($_POST['image'] ?? '');
        $isPublished = isset($_POST['is_published']) ? 1 : 0;

        $this->programmeModel->update($id, [
            'ProgrammeName' => $programmeName,
            'LevelID' => $levelId,
            'ProgrammeLeaderID' => $programmeLeaderId,
            'Description' => $description,
            'Image' => $image,
            'IsPublished' => $isPublished
        ]);

        header('Location: index.php?action=admin_programmes');
        exit;
    }

    public function delete(): void
    {
        $this->requireLogin();

        $id = isset($_GET['id']) ? (int) $_GET['id'] : 0;
        $this->programmeModel->delete($id);

        header('Location: index.php?action=admin_programmes');
        exit;
    }

    public function togglePublish(): void
    {
        $this->requireLogin();

        $id = isset($_GET['id']) ? (int) $_GET['id'] : 0;
        $this->programmeModel->togglePublish($id);

        header('Location: index.php?action=admin_programmes');
        exit;
    }
}