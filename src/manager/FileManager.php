<?php
class FileManager
{
    public function findById(?int $id): ?File
    {
        $sql = <<<SQL
            SELECT *
            FROM files
            WHERE id = :id
        SQL;
        $statement = DBManager::execQuery($sql, ['id' => $id]);
        $file = $statement->fetch();
        if ($file) {
            return new File($file);
        }
        return null;
    }
    /**
     * @return File[] | null
     */
    public function findAll(): ?array
    {
        $sql = <<<SQL
            SELECT *
            FROM files
        SQL;
        $statement = DBManager::execQuery($sql);
        $fileResults = $statement->fetchAll();
        if ($fileResults) {
            $files = [];
            foreach ($fileResults as $fileResult) {
                $files[] = new File($fileResult);
            }
            return $files;
        }
        return null;
    }

    public function createFileFromData(array $fileData): ?File
    {
        $sql = <<<SQL
            INSERT INTO files (title, mime_type, file_path)
            VALUES (:title, :mime_type, :file_path)
        SQL;
        $params = [
            'title' => $fileData['title'],
            'mime_type' => $fileData['mime_type'],
            'file_path' => $fileData['file_path'],
        ];
        $statement = DBManager::execQuery($sql, $params);
        $insertedId = DBManager::getLastInsertId();
        return $this->findById($insertedId);
    }

}