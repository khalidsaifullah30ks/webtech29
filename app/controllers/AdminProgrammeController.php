<?php

require_once __DIR__ . '/../models/Programme.php';
require_once __DIR__ . '/../models/InterestedStudent.php';
require_once __DIR__ . '/../models/Module.php';

class AdminProgrammeController
{
    private Programme $programmeModel;
    private InterestedStudent $interestModel;
    private Module $moduleModel;

    public function __construct(PDO $pdo)
    {
        $this->programmeModel = new Programme($pdo);
        $this->interestModel = new InterestedStudent($pdo);
        $this->moduleModel = new Module($pdo);
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
    $programmeCount = $this->programmeModel->countAll();
    $moduleCount = $this->moduleModel->countAll();
    $studentCount = $this->interestModel->countAll();
    $activeStudentCount = $this->interestModel->countActive();

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

$errors = [];

if ($programmeName === '') {
    $errors[] = 'Programme name is required.';
}

if (strlen($programmeName) > 100) {
    $errors[] = 'Programme name must be less than 100 characters.';
}

if ($levelId <= 0) {
    $errors[] = 'Please select a valid level.';
}

if ($description === '') {
    $errors[] = 'Description is required.';
}

if (strlen($description) < 20) {
    $errors[] = 'Description must be at least 20 characters.';
}

if ($image !== '' && !filter_var($image, FILTER_VALIDATE_URL)) {
    $errors[] = 'Image must be a valid URL.';
}

if (!empty($errors)) {
    require __DIR__ . '/../views/admin/programmes/create.php';
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

    $id = isset($_POST['id']) ? (int) $_POST['id'] : 0;

    if ($id <= 0) {
        echo "Invalid programme ID.";
        return;
    }

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