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
                    p.LevelID,
                    p.ProgrammeLeaderID,
                    l.LevelName
                FROM programmes p
                LEFT JOIN levels l ON p.LevelID = l.LevelID
                WHERE p.IsPublished = 1";

        $params = [];

        if (!empty($keyword)) {
            $sql .= " AND (p.ProgrammeName LIKE :keyword OR p.Description LIKE :keyword)";
            $params[':keyword'] = '%' . $keyword . '%';
        }

        if (!empty($level)) {
            $levelLower = strtolower(trim($level));

            if ($levelLower === 'bsc') {
                $sql .= " AND (
                            LOWER(TRIM(l.LevelName)) IN ('bsc', 'bachelor', 'undergraduate')
                            OR p.LevelID = 1
                            OR LOWER(TRIM(p.ProgrammeName)) LIKE 'bsc%'
                          )";
            } elseif ($levelLower === 'msc') {
                $sql .= " AND (
                            LOWER(TRIM(l.LevelName)) IN ('msc', 'master', 'postgraduate')
                            OR p.LevelID = 2
                            OR LOWER(TRIM(p.ProgrammeName)) LIKE 'msc%'
                          )";
            } else {
                $sql .= " AND LOWER(TRIM(l.LevelName)) = :level";
                $params[':level'] = $levelLower;
            }
        }

        $sql .= " ORDER BY p.ProgrammeName ASC";

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($params);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getAllAdmin(): array
    {
        $sql = "SELECT 
                    p.ProgrammeID,
                    p.ProgrammeName,
                    p.Description,
                    p.Image,
                    p.IsPublished,
                    p.LevelID,
                    p.ProgrammeLeaderID,
                    l.LevelName
                FROM programmes p
                LEFT JOIN levels l ON p.LevelID = l.LevelID
                ORDER BY p.ProgrammeName ASC";

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getById(int $id): array|false
    {
        $sql = "SELECT 
                    p.ProgrammeID,
                    p.ProgrammeName,
                    p.Description,
                    p.Image,
                    p.IsPublished,
                    p.LevelID,
                    p.ProgrammeLeaderID,
                    l.LevelName
                FROM programmes p
                LEFT JOIN levels l ON p.LevelID = l.LevelID
                WHERE p.ProgrammeID = :id
                LIMIT 1";

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([':id' => $id]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getByIdAdmin(int $id): array|false
    {
        $sql = "SELECT 
                    p.ProgrammeID,
                    p.ProgrammeName,
                    p.Description,
                    p.Image,
                    p.IsPublished,
                    p.LevelID,
                    p.ProgrammeLeaderID,
                    l.LevelName
                FROM programmes p
                LEFT JOIN levels l ON p.LevelID = l.LevelID
                WHERE p.ProgrammeID = :id
                LIMIT 1";

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([':id' => $id]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function create(array $data): bool
    {
        $sql = "INSERT INTO programmes 
                    (ProgrammeName, LevelID, ProgrammeLeaderID, Description, Image, IsPublished)
                VALUES
                    (:ProgrammeName, :LevelID, :ProgrammeLeaderID, :Description, :Image, :IsPublished)";

        $stmt = $this->pdo->prepare($sql);

        return $stmt->execute([
            ':ProgrammeName'      => $data['ProgrammeName'],
            ':LevelID'            => $data['LevelID'],
            ':ProgrammeLeaderID'  => ($data['ProgrammeLeaderID'] === '' ? null : $data['ProgrammeLeaderID']),
            ':Description'        => $data['Description'],
            ':Image'              => ($data['Image'] === '' ? null : $data['Image']),
            ':IsPublished'        => $data['IsPublished'],
        ]);
    }

    public function update(int $id, array $data): bool
    {
        $sql = "UPDATE programmes
                SET
                    ProgrammeName = :ProgrammeName,
                    LevelID = :LevelID,
                    ProgrammeLeaderID = :ProgrammeLeaderID,
                    Description = :Description,
                    Image = :Image,
                    IsPublished = :IsPublished
                WHERE ProgrammeID = :ProgrammeID";

        $stmt = $this->pdo->prepare($sql);

        return $stmt->execute([
            ':ProgrammeName'      => $data['ProgrammeName'],
            ':LevelID'            => $data['LevelID'],
            ':ProgrammeLeaderID'  => ($data['ProgrammeLeaderID'] === '' ? null : $data['ProgrammeLeaderID']),
            ':Description'        => $data['Description'],
            ':Image'              => ($data['Image'] === '' ? null : $data['Image']),
            ':IsPublished'        => $data['IsPublished'],
            ':ProgrammeID'        => $id,
        ]);
    }

    public function delete(int $id): bool
    {
        $stmt = $this->pdo->prepare("DELETE FROM programmes WHERE ProgrammeID = :id");
        return $stmt->execute([':id' => $id]);
    }

    public function togglePublish(int $id): bool
    {
        $stmt = $this->pdo->prepare(
            "UPDATE programmes
             SET IsPublished = CASE WHEN IsPublished = 1 THEN 0 ELSE 1 END
             WHERE ProgrammeID = :id"
        );

        return $stmt->execute([':id' => $id]);
    }

    public function getModulesByProgramme(int $programmeId): array
    {
        $sql = "SELECT 
                    pm.ProgrammeModuleID,
                    pm.Year,
                    m.ModuleID,
                    m.ModuleName,
                    m.Description,
                    m.Image
                FROM programmemodules pm
                INNER JOIN modules m ON pm.ModuleID = m.ModuleID
                WHERE pm.ProgrammeID = :programmeId
                ORDER BY pm.Year ASC, m.ModuleName ASC";

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([':programmeId' => $programmeId]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getHomeProgrammesByLevel(): array
    {
        $sql = "SELECT 
                    p.ProgrammeID,
                    p.ProgrammeName,
                    p.Description,
                    p.Image,
                    p.IsPublished,
                    p.LevelID,
                    p.ProgrammeLeaderID,
                    l.LevelName
                FROM programmes p
                LEFT JOIN levels l ON p.LevelID = l.LevelID
                WHERE p.IsPublished = 1
                ORDER BY p.ProgrammeName ASC";

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $grouped = [
            'BSc' => [],
            'MSc' => []
        ];

        foreach ($rows as $row) {
            $programmeName = strtolower(trim($row['ProgrammeName'] ?? ''));
            $levelName = strtolower(trim($row['LevelName'] ?? ''));
            $levelId = (int)($row['LevelID'] ?? 0);

            if (
                str_starts_with($programmeName, 'bsc') ||
                $levelName === 'undergraduate' ||
                $levelName === 'bsc' ||
                $levelName === 'bachelor' ||
                $levelId === 1
            ) {
                $grouped['BSc'][] = $row;
            } elseif (
                str_starts_with($programmeName, 'msc') ||
                $levelName === 'postgraduate' ||
                $levelName === 'msc' ||
                $levelName === 'master' ||
                $levelId === 2
            ) {
                $grouped['MSc'][] = $row;
            }
        }

        return $grouped;
    }

    public function countAll(): int
    {
        $stmt = $this->pdo->query("SELECT COUNT(*) FROM programmes");
        return (int) $stmt->fetchColumn();
    }
}