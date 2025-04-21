<?php

class MainController {
    public function homePage(): void {
        $userManager = new UserManager();
        $users = $userManager->findAll();
        $userU = $userManager->findById(1);
        RenderService::renderView('home', [
            'users' => $users,
            'userU' => $userU,
        ]);
    }

    public function booksAvailable(?string $searchText = null): void {
        $bookManager = new BookManager();
        if ($searchText) {
            $books = $bookManager->findByText($searchText);
            if (!$books) {
                FlashService::addMessage('warning', "Aucun livre trouvé pour la recherche : $searchText");
            }
        } else {
            $books = $bookManager->findAll();
        }
        RenderService::renderView('books', [
            'searchText' => $searchText,
            'books' => $books,
        ]);
    }

    public function bookDetails(int $bookId): void {
        $bookManager = new BookManager();
        $fileManager = new FileManager();
        $book = $bookManager->findById($bookId);
        if (!$book) {
            RenderService::renderView('error', ['errorMsg' => "Aucun livre trouvé avec l'ID : $bookId"]);
            return;
        }
        $ownerImage = $fileManager->findById($book->getOwner()->getProfileImgId());
        $ownerImage = $ownerImage ? $ownerImage->getFilePath() : null;
        RenderService::renderView('book-details', [
            'id' => $book->getId(),
            'title' => $book->getTitle(),
            'img' => $book->getCoverImg()->getFilePath(),
            'author' => $book->getAuthor()->getFullName(),
            'description' => $book->getDescription(),
            'ownerUsername' => $book->getOwner()->getUsername(),
            'ownerImage' => $ownerImage,
        ]);
    }

    public function signInPage(): void {
        RenderService::renderView('sign-up', []);
    }
}