<?php

declare(strict_types=1);

class User
{
    private ?int $id = null;
    private ?string $username = null;
    private ?string $email = null;
    private ?string $password_hash = null;
    private ?string $role = 'customer'; // Default role

    // Getters
    public function getId(): ?int { return $this->id; }
    public function getUsername(): ?string { return $this->username; }
    public function getEmail(): ?string { return $this->email; }
    public function getPasswordHash(): ?string { return $this->password_hash; }
    public function getRole(): ?string { return $this->role; }

    // Setters (Fluent Interface)
    public function setId(?int $id): self { $this->id = $id; return $this; }
    public function setUsername(string $username): self { $this->username = $username; return $this; }
    public function setEmail(string $email): self { $this->email = $email; return $this; }
    public function setPasswordHash(string $password_hash): self { $this->password_hash = $password_hash; return $this; }
    public function setRole(string $role): self { $this->role = $role; return $this; }
}
