<?php

class Module
{
    private PDO $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function getAll(): array
    {
        $stmt = $this->pdo->query(
            "SELECT m.*, s.Name AS LeaderName
             FROM modules m
             LEFT JOIN staff s ON m.ModuleLeaderID = s.StaffID
             ORDER BY m.ModuleName"
        );

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getModulesByProgramme($programmeId): array
{
    $stmt = $this->pdo->prepare(
        "SELECT m.ModuleName, pm.Year
         FROM programmemodules pm
         JOIN modules m ON pm.ModuleID = m.ModuleID
         WHERE pm.ProgrammeID = ?
         ORDER BY pm.Year, m.ModuleName"
    );

    $stmt->execute([$programmeId]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

    public function getById(int $id)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM modules WHERE ModuleID = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function create(array $data): bool
    {
        $stmt = $this->pdo->prepare(
            "INSERT INTO modules (ModuleName, ModuleLeaderID, Description, Image)
             VALUES (?, ?, ?, ?)"
        );

        return $stmt->execute([
            $data['ModuleName'],
            $data['ModuleLeaderID'],
            $data['Description'],
            $data['Image']
        ]);
    }

    public function update(int $id, array $data): bool
    {
        $stmt = $this->pdo->prepare(
            "UPDATE modules
             SET ModuleName = ?, ModuleLeaderID = ?, Description = ?, Image = ?
             WHERE ModuleID = ?"
        );

        return $stmt->execute([
            $data['ModuleName'],
            $data['ModuleLeaderID'],
            $data['Description'],
            $data['Image'],
            $id
        ]);
    }

    public function delete(int $id): bool
    {
        $stmt = $this->pdo->prepare("DELETE FROM modules WHERE ModuleID = ?");
        return $stmt->execute([$id]);
    }

    public function getStaff(): array
    {
        $stmt = $this->pdo->query("SELECT StaffID, Name FROM staff ORDER BY Name");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getProgrammes(): array
    {
        $stmt = $this->pdo->query("SELECT ProgrammeID, ProgrammeName FROM programmes");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function attachToProgramme($programmeId, $moduleId, $year): bool
    {
        $stmt = $this->pdo->prepare(
            "INSERT INTO programmemodules (ProgrammeID, ModuleID, Year)
             VALUES (?, ?, ?)"
        );

        return $stmt->execute([$programmeId, $moduleId, $year]);
    }

    public function countAll(): int
{
    $stmt = $this->pdo->query("SELECT COUNT(*) FROM modules");
    return (int) $stmt->fetchColumn();
}

    public function getLastInsertId(): string
{
    return $this->pdo->lastInsertId();
}
}