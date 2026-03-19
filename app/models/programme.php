<?php

class Programme
{
    private PDO $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function getPublishedProgrammes(?string $keyword = null, ?string $level = null): array
    {
        $sql = "SELECT 
                    p.ProgrammeID,
                    p.ProgrammeName,
                    p.Description,
                    p.Image,
                    p.IsPublished,
                    l.LevelName,
                    s.Name AS ProgrammeLeaderName
                FROM programmes p
                LEFT JOIN levels l ON p.LevelID = l.LevelID
                LEFT JOIN staff s ON p.ProgrammeLeaderID = s.StaffID
                WHERE p.IsPublished = 1";

        $params = [];

        if ($keyword) {
            $sql .= " AND (p.ProgrammeName LIKE ? OR p.Description LIKE ?)";
            $params[] = "%$keyword%";
            $params[] = "%$keyword%";
        }

        if ($level) {
            $sql .= " AND l.LevelName = ?";
            $params[] = $level;
        }

        $sql .= " ORDER BY p.ProgrammeName ASC";

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($params);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getAllAdmin(): array
    {
        $stmt = $this->pdo->query(
            "SELECT 
                p.ProgrammeID,
                p.ProgrammeName,
                p.Description,
                p.Image,
                p.IsPublished,
                p.LevelID,
                p.ProgrammeLeaderID,
                l.LevelName,
                s.Name AS ProgrammeLeaderName
             FROM programmes p
             LEFT JOIN levels l ON p.LevelID = l.LevelID
             LEFT JOIN staff s ON p.ProgrammeLeaderID = s.StaffID
             ORDER BY p.ProgrammeID DESC"
        );

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getById(int $id): array|false
    {
        $stmt = $this->pdo->prepare(
            "SELECT 
                p.ProgrammeID,
                p.ProgrammeName,
                p.Description,
                p.Image,
                p.IsPublished,
                p.LevelID,
                p.ProgrammeLeaderID,
                l.LevelName,
                s.Name AS ProgrammeLeaderName
             FROM programmes p
             LEFT JOIN levels l ON p.LevelID = l.LevelID
             LEFT JOIN staff s ON p.ProgrammeLeaderID = s.StaffID
             WHERE p.ProgrammeID = ? AND p.IsPublished = 1"
        );

        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getByIdAdmin(int $id): array|false
    {
        $stmt = $this->pdo->prepare(
            "SELECT * FROM programmes WHERE ProgrammeID = ?"
        );
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getModulesByProgramme(int $programmeId): array
    {
        $stmt = $this->pdo->prepare(
            "SELECT 
                m.ModuleID,
                m.ModuleName,
                m.Description,
                m.Image,
                pm.Year,
                s.Name AS ModuleLeaderName
             FROM programmemodules pm
             JOIN modules m ON pm.ModuleID = m.ModuleID
             LEFT JOIN staff s ON m.ModuleLeaderID = s.StaffID
             WHERE pm.ProgrammeID = ?
             ORDER BY pm.Year, m.ModuleName"
        );

        $stmt->execute([$programmeId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function create(array $data): bool
    {
        $stmt = $this->pdo->prepare(
            "INSERT INTO programmes
            (ProgrammeName, LevelID, ProgrammeLeaderID, Description, Image, IsPublished)
            VALUES (?, ?, ?, ?, ?, ?)"
        );

        return $stmt->execute([
            $data['ProgrammeName'],
            $data['LevelID'],
            $data['ProgrammeLeaderID'] !== '' ? $data['ProgrammeLeaderID'] : null,
            $data['Description'],
            $data['Image'],
            $data['IsPublished']
        ]);
    }

    public function update(int $id, array $data): bool
    {
        $stmt = $this->pdo->prepare(
            "UPDATE programmes
             SET ProgrammeName = ?, LevelID = ?, ProgrammeLeaderID = ?, Description = ?, Image = ?, IsPublished = ?
             WHERE ProgrammeID = ?"
        );

        return $stmt->execute([
            $data['ProgrammeName'],
            $data['LevelID'],
            $data['ProgrammeLeaderID'] !== '' ? $data['ProgrammeLeaderID'] : null,
            $data['Description'],
            $data['Image'],
            $data['IsPublished'],
            $id
        ]);
    }

    public function delete(int $id): bool
    {
        $stmt = $this->pdo->prepare("DELETE FROM programmes WHERE ProgrammeID = ?");
        return $stmt->execute([$id]);
    }

    public function togglePublish(int $id): bool
    {
        $stmt = $this->pdo->prepare(
            "UPDATE programmes
             SET IsPublished = CASE WHEN IsPublished = 1 THEN 0 ELSE 1 END
             WHERE ProgrammeID = ?"
        );

        return $stmt->execute([$id]);
    }
}