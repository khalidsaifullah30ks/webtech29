<?php

require_once __DIR__ . '/../models/Programme.php';
require_once __DIR__ . '/../models/InterestedStudent.php';

class InterestController
{
    private Programme $programmeModel;
    private InterestedStudent $interestModel;

    public function __construct(PDO $pdo)
    {
        $this->programmeModel = new Programme($pdo);
        $this->interestModel = new InterestedStudent($pdo);
    }

    public function create(): void
    {
        $id = isset($_GET['id']) ? (int) $_GET['id'] : 0;
        $programme = $this->programmeModel->getById($id);

        if (!$programme) {
            echo "Programme not found.";
            return;
        }

        $error = '';
        require __DIR__ . '/../views/interest/create.php';
    }

    public function store(): void
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: index.php?action=programmes');
            exit;
        }

        $programmeId = (int) ($_POST['programme_id'] ?? 0);
        $programme = $this->programmeModel->getById($programmeId);

        if (!$programme) {
            echo "Programme not found.";
            return;
        }

        $firstName = trim($_POST['first_name'] ?? '');
        $lastName = trim($_POST['last_name'] ?? '');
        $email = trim($_POST['email'] ?? '');

        $error = '';

        if ($firstName === '' || $lastName === '' || $email === '') {
            $error = 'Please fill in all required fields.';
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $error = 'Please enter a valid email address.';
        } elseif ($this->interestModel->alreadyExists($programmeId, $email)) {
            $error = 'You have already registered interest for this programme.';
        }

        if ($error !== '') {
            require __DIR__ . '/../views/interest/create.php';
            return;
        }

        $this->interestModel->create([
            'programme_id' => $programmeId,
            'first_name' => $firstName,
            'last_name' => $lastName,
            'email' => $email
        ]);

        $success = 'Interest registered successfully.';
        require __DIR__ . '/../views/interest/success.php';
    }

    public function withdrawForm(): void
    {
        $programmes = $this->programmeModel->getPublishedProgrammes();
        $message = '';
        require __DIR__ . '/../views/interest/withdraw.php';
    }

    public function withdraw(): void
    {
        $programmeId = (int) ($_POST['programme_id'] ?? 0);
        $email = trim($_POST['email'] ?? '');

        $programmes = $this->programmeModel->getPublishedProgrammes();
        $message = '';

if ($programmeId <= 0 || $email === '') {
    $message = 'Please select a programme and enter your email.';
    require __DIR__ . '/../views/interest/withdraw.php';
    return;
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $message = 'Please enter a valid email address.';
    require __DIR__ . '/../views/interest/withdraw.php';
    return;
}

        $this->interestModel->withdraw($programmeId, $email);
        $message = 'If a matching registration was found, it has been withdrawn.';
        require __DIR__ . '/../views/interest/withdraw.php';
    }
}