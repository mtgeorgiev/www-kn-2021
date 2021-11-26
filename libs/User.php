<?php

declare(strict_types=1);

class User {

    private $id;

    private $email;

    private $password;

    public function __construct(string $email, string $password) {
        $this->email = $email;
        $this->password = $password;
    }

    public function getEmail(): string  {
        return $this->email;
    }

    public function getId(): int {
        return $this->id;
    }

    public function setId(int $id) {
        $this->id = $id;
    }

    public function toArray(): array {

        return [
            'id' => $this->getId(),
            'email' => $this->getEmail(),
        ];

    }

}