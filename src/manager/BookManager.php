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

    public function getNbBooksFromUser(int $userId): int
    {
        $sql = <<<SQL
            SELECT COUNT(*) as nbBooks
            FROM books
            WHERE owner_id = :userId
        SQL;
        $statement = DBManager::execQuery($sql, ['userId' => $userId]);
        $result = $statement->fetch();
        return (int)$result['nbBooks'];
    }

    public function findByOwner(int $userId): ?array
    {
        $sql = <<<SQL
            SELECT *
            FROM books
            WHERE owner_id = :userId
        SQL;
        $statement = DBManager::execQuery($sql, ['userId' => $userId]);
        $booksResults = $statement->fetchAll();
        if ($booksResults) {
            $books = [];
            foreach ($booksResults as $bookResult) {
                $authorManager = new AuthorManager();
                $fileManager = new FileManager();
                $userManager = new UserManager();
                $newBook = new Book($bookResult);
                $newBook->setOwner($userManager->findById($newBook->getOwnerId()));
                $newBook->setAuthor($authorManager->findById($newBook->getAuthorId()));
                $newBook->setCoverImg($fileManager->findById($newBook->getCoverImgId()));
                $books[] = $newBook;
            }
            return $books;
        }
        return null;
    }

    public function deleteBook(Book | int $book): bool
    {
        if (is_int($book)) {
            $book = $this->findById($book);
        }
        if ($book) {
            $sql = <<<SQL
                DELETE FROM books
                WHERE id = :id
            SQL;
            $result = DBManager::execQuery($sql, ['id' => $book->getId()]);
            return $result->rowCount() > 0;
        }
        return false;
    }

    public function updateBook(Book $book): bool
    {
        $sql = <<<SQL
            UPDATE books
            SET title = :title,
                author_id = :authorId,
                description = :description,
                available = :available,
                cover_img_id = :coverImgId
            WHERE id = :id
        SQL;
        $params = [
            'title' => $book->getTitle(),
            'authorId' => $book->getAuthorId(),
            'description' => $book->getDescription(),
            'available' => $book->isAvailable(),
            'coverImgId' => $book->getCoverImgId(),
            'id' => $book->getId(),
        ];
        $statement = DBManager::execQuery($sql, $params);
        return $statement->rowCount() > 0;
    }
}