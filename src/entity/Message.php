<?php

namespace App\Entity;

class Message extends BaseEntity
{
    private int $senderId; // References a User
    private int $receiverId; // References a User
    private string $content;

    public function getSenderId(): int
    {
        return $this->senderId;
    }

    public function setSenderId(int $senderId): void
    {
        $this->senderId = $senderId;
    }

    public function getReceiverId(): int
    {
        return $this->receiverId;
    }

    public function setReceiverId(int $receiverId): void
    {
        $this->receiverId = $receiverId;
    }

    public function getContent(): string
    {
        return $this->content;
    }

    public function setContent(string $content): void
    {
        $this->content = $content;
    }

    public function getAbbreviatedContent(int $maxLength = 30): string
    {
        if (mb_strlen($this->content) <= $maxLength) {
            return $this->content;
        }
        return substr($this->content, 0, $maxLength - 3) . '...';
    }
}
