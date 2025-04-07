<?php
class Author extends BaseEntity
{
    /**
     * Represents an Author, each Book has one.
     * If the author has a pen name, it will be used for display instead of its first name and last name.
     */

    private ?string $firstName;
    private ?string $lastName;
    private ?string $penName;
    private ?string $biography;

    public function getFullName(): ?string
    {
        if ($this->penName) {
            return $this->penName;
        }
        if ($this->firstName && $this->lastName) {
            return "{$this->firstName} {$this->lastName}";
        }
        return null;
    }

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(?string $firstName): void
    {
        $this->firstName = $firstName;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function setLastName(?string $lastName): void
    {
        $this->lastName = $lastName;
    }

    public function getPenName(): ?string
    {
        return $this->penName;
    }

    public function setPenName(?string $penName): void
    {
        $this->penName = $penName;
    }

    public function getBiography(): ?string
    {
        return $this->biography;
    }

    public function setBiography(?string $biography): void
    {
        $this->biography = $biography;
    }

}