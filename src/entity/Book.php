<?php
class Book extends BaseEntity
{
    /**
     * Represents a book. A Book is owned by a User, has an Author and can have a File to illustrate its cover.
     */

     public const DELETE_CONFIRM = "Êtes-vous sûr de vouloir supprimer ce livre ? Cette action est irréversible.";
    private int $ownerId; // References a User
    private string $title;
    private int $authorId; // References an Author
    private ?string $description;
    private int $coverImgId; // References a File
    private bool $available;
    private ?Author $author = null; // References an Author entity
    private ?File $coverImg = null; // References a File entity
    private ?User $owner = null; // References a User entity

    public function getOwnerId(): int
    {
        return $this->ownerId;
    }

    public function setOwnerId(int $ownerId): void
    {
        $this->ownerId = $ownerId;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    public function getAuthorId(): int
    {
        return $this->authorId;
    }

    public function setAuthorId(int $authorId): void
    {
        $this->authorId = $authorId;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): void
    {
        $this->description = $description;
    }

    public function getCoverImgId(): int
    {
        return $this->coverImgId;
    }

    public function setCoverImgId(int $coverImgId): void
    {
        $this->coverImgId = $coverImgId;
    }

    public function isAvailable(): bool
    {
        return $this->available;
    }

    public function setAvailable(bool $available): void
    {
        $this->available = $available;
    }
    public function getAuthor(): ?Author
    {
        return $this->author;
    }
    public function setAuthor(?Author $author): void
    {
        $this->author = $author;
    }
    public function getCoverImg(): ?File
    {
        return $this->coverImg;
    }
    public function setCoverImg(?File $coverImg): void
    {
        $this->coverImg = $coverImg;
    }
    public function getOwner(): ?User
    {
        return $this->owner;
    }
    public function setOwner(?User $owner): void
    {
        $this->owner = $owner;
    }

    public function generateFileNameSlug(): string
    {
        $slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $this->getTitle()), '-'));
        $uniqId = uniqid();
        return "{$this->getId()}-{$slug}-{$uniqId}";
    }

    public function generateFileTitle(): string
    {
        return "{$this->getTitle()} - Cover";
    }
}