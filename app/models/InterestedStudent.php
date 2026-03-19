<?php

class InterestedStudent
{
    private PDO $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function create(array $data): bool
    {
        $studentName = trim($data['first_name'] . ' ' . $data['last_name']);

        $stmt = $this->pdo->prepare(
            "INSERT INTO interestedstudents (ProgrammeID, StudentName, Email, IsActive)
             VALUES (?, ?, ?, 1)"
        );

        return $stmt->execute([
            $data['programme_id'],
            $studentName,
            $data['email']
        ]);
    }

    public function alreadyExists(int $programmeId, string $email): bool
    {
        $stmt = $this->pdo->prepare(
            "SELECT InterestID
             FROM interestedstudents
             WHERE ProgrammeID = ? AND Email = ?"
        );
        $stmt->execute([$programmeId, $email]);

        return (bool) $stmt->fetch();
    }

    public function withdraw(int $programmeId, string $email): bool
    {
        $stmt = $this->pdo->prepare(
            "UPDATE interestedstudents
             SET IsActive = 0
             WHERE ProgrammeID = ? AND Email = ?"
        );

        return $stmt->execute([$programmeId, $email]);
    }

    public function getAllWithProgramme(): array
    {
        $stmt = $this->pdo->query(
            "SELECT 
                i.InterestID,
                i.StudentName,
                i.Email,
                i.RegisteredAt,
                i.IsActive,
                p.ProgrammeName
             FROM interestedstudents i
             JOIN programmes p ON i.ProgrammeID = p.ProgrammeID
             ORDER BY i.RegisteredAt DESC"
        );

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}