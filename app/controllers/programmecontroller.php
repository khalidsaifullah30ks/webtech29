<?php

require_once __DIR__ . '/../models/Programme.php';

class ProgrammeController
{
    private Programme $programmeModel;

    public function __construct(PDO $pdo)
    {
        $this->programmeModel = new Programme($pdo);
    }

    public function index(): void
    {
        $keyword = $_GET['keyword'] ?? null;
        $level = $_GET['level'] ?? null;

        $programmes = $this->programmeModel->getPublishedProgrammes($keyword, $level);
        require_once __DIR__ . '/../views/programmes/index.php';
    }

    public function show(): void
    {
        $id = isset($_GET['id']) ? (int) $_GET['id'] : 0;
        $programme = $this->programmeModel->getById($id);

        if (!$programme) {
            echo "Programme not found.";
            return;
        }

        $modules = $this->programmeModel->getModulesByProgramme($id);
        require_once __DIR__ . '/../views/programmes/show.php';
    }
}