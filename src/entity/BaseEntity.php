<?php
abstract class BaseEntity
{
    private int $id;
    private int $valid;
    private DateTime $createdAt;
    private DateTime $updatedAt;

    public function __construct(array $data = []) 
    {
        if (!empty($data)) {
            $this->hydrate($data);
        }
    }

    protected function hydrate(array $data) : void 
    {
        foreach ($data as $key => $value) {
            $method = 'set' . str_replace('_', '', ucwords($key, '_'));
            // var_dump($key);
            if (method_exists($this, $method)) {
                $this->$method($value);
            }
        }
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getValid(): int
    {
        return $this->valid;
    }

    public function setValid(int $valid): void
    {
        $this->valid = $valid;
    }

    public function getCreatedAt(): DateTime
    {
        return $this->createdAt;
    }

    public function setCreatedAt(string|DateTime $createdAt, string $format = 'Y-m-d H:i:s'): void
    {
        if (is_string($createdAt)) {
            $createdAt = DateTime::createFromFormat($format, $createdAt);
        }
        $this->createdAt = $createdAt;
    }

    public function getUpdatedAt(): DateTime
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(string|DateTime $updatedAt, string $format = 'Y-m-d H:i:s'): void
    {
        if (is_string($updatedAt)) {
            $updatedAt = DateTime::createFromFormat($format, $updatedAt);
        }
        $this->updatedAt = $updatedAt;
    }
}