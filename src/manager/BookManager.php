<?php
class BookManager
{
    public function findById(int $id): ?Book
    {
        $sql = <<<SQL
            SELECT *
            FROM books
            WHERE id = :id
        SQL;
        $statement = DBManager::execQuery($sql, ['id' => $id]);
        $book = $statement->fetch();
        if ($book) {
            return new Book($book);
        }
        return null;
    }
    /**
     * @return Book[] | null
     */
    public function findAll(): ?array
    {
        $sql = <<<SQL
            SELECT *
            FROM books
        SQL;
        $statement = DBManager::execQuery($sql);
        $booksResults = $statement->fetchAll();
        if ($booksResults) {
            $books = [];
            foreach ($booksResults as $bookResult) {
                $books[] = new Book($bookResult);
            }
            return $books;
        }
        return null;
    }

}