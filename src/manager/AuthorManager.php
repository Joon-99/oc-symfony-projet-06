<?php
class AuthorManager
{
    public function findById(int $id): ?Author
    {
        $sql = <<<SQL
            SELECT *
            FROM authors
            WHERE id = :id
        SQL;
        $statement = DBManager::execQuery($sql, ['id' => $id]);
        $author = $statement->fetch();
        if ($author) {
            return new Author($author);
        }
        return null;
    }
    /**
     * @return Author[] | null
     */
    public function findAll(): ?array
    {
        $sql = <<<SQL
            SELECT *
            FROM authors
        SQL;
        $statement = DBManager::execQuery($sql);
        $authorResults = $statement->fetchAll();
        if ($authorResults) {
            $authors = [];
            foreach ($authorResults as $authorResult) {
                $authors[] = new Author($authorResult);
            }
            return $authors;
        }
        return null;
    }

}