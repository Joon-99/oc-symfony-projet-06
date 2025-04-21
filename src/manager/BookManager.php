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
            $userManager = new UserManager();
            $authorManager = new AuthorManager();
            $fileManager = new FileManager();
            $newBook = new Book($book);
            $owner = $userManager->findById($newBook->getOwnerId());
            $author = $authorManager->findById($newBook->getAuthorId());
            $coverFile = $fileManager->findById($newBook->getCoverImgId());
            $newBook->setAuthor($author);
            $newBook->setOwner($owner);
            $newBook->setCoverImg($coverFile);  
            return $newBook;
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

    /**
     * @return Book[] | null
     */
    public function findAllAvailable(): ?array
    {
        $sql = <<<SQL
            SELECT *
            FROM books
            WHERE available = 1
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

    /**
     * @return Book[] | null
     */
    public function findByText(string $searchText): ?array  {
        $sql = <<<SQL
            SELECT *
            FROM books
            LEFT JOIN authors ON books.author_id = authors.id
            WHERE books.title LIKE :searchText
            OR CONCAT(authors.first_name, ' ', authors.last_name) LIKE :searchText
            OR authors.pen_name LIKE :searchText
        SQL;
        $params = [
            'searchText' => "%$searchText%",
        ];
        $statement = DBManager::execQuery($sql, $params);
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