<?php

require_once __DIR__ . '/../models/Programme.php';

class HomeController
{
    private Programme $programmeModel;

    public function __construct(PDO $pdo)
    {
        $this->programmeModel = new Programme($pdo);
    }

    public function index(): void
    {
        $programmes = $this->programmeModel->getPublishedProgrammes();
        require __DIR__ . '/../views/home.php';
    }
}