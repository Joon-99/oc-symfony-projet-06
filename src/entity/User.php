<?php
class User extends BaseEntity
{
    /**
     * Represents a user of TomTroc.
     */
    private string $username;
    private string $passwordHash;
    private string $email;
    private ?int $profileImgId; // References a File

    public function getUsername(): string
    {
        return $this->username;
    }

    public function setUsername(string $username): void
    {
        $this->username = $username;
    }

    public function getPasswordHash(): string
    {
        return $this->passwordHash;
    }

    public function setPasswordHash(string $passwordHash): void
    {
        $this->passwordHash = $passwordHash;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    public function getProfileImgId(): ?int
    {
        return $this->profileImgId;
    }

    public function setProfileImgId(?int $profileImgId): void
    {
        $this->profileImgId = $profileImgId;
    }

}