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

}