<?php

declare(strict_types=1);

class UserManager
{
    private PDO $db;

    public function __construct()
    {
        $this->db = Database::getInstance()->getConnection();
    }

    /**
     * Find a user by their email for authentication.
     */
    public function findByEmail(string $email): ?User
    {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE email = :email");
        $stmt->execute(['email' => $email]);
        $row = $stmt->fetch();

        if ($row) {
            return (new User())
                ->setId((int)$row['id'])
                ->setUsername($row['username'])
                ->setEmail($row['email'])
                ->setPasswordHash($row['password_hash'])
                ->setRole($row['role']);
        }
        return null;
    }

    /**
     * Register a new user securely.
     */
    public function create(User $user): bool
    {
        $sql = "INSERT INTO users (username, email, password_hash, role) 
                VALUES (:username, :email, :password_hash, :role)";
        
        $stmt = $this->db->prepare($sql);
        
        return $stmt->execute([
            'username' => $user->getUsername(),
            'email' => $user->getEmail(),
            'password_hash' => $user->getPasswordHash(),
            'role' => $user->getRole()
        ]);
    }
}
