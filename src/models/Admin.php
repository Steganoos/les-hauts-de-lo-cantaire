<?php

declare(strict_types=1);

class Admin
{
    private int $id_admin;
    private DateTime $creation_date;
    private DateTime $updated_at;
    private string $pseudo;
    private string $email;
    private string $password;
    private bool $is_active;

    // Setters
    public function setIdAdmin(int $id_admin): void
    {
        $this->id_admin = $id_admin;
    }

    public function setCreationDate(DateTime $creation_date): void
    {
        $this->creation_date = $creation_date;
    }

    public function setUpdatedAt(DateTime $updated_at): void
    {
        $this->updated_at = $updated_at;
    }

    public function setPseudo(string $pseudo): void
    {
        $this->pseudo = $pseudo;
    }

    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    public function setPassword(string $password): void
    {
        $this->password = $password;
    }

    public function setIsActive(bool $is_active): void
    {
        $this->is_active = $is_active;
    }

    // Getters
    public function getIdAdmin(): int
    {
        return $this->id_admin;
    }

    public function getCreationDate(): DateTime
    {
        return $this->creation_date;
    }

    public function getUpdatedAt(): DateTime
    {
        return $this->updated_at;
    }

    public function getPseudo(): string
    {
        return $this->pseudo;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function getIsActive(): bool
    {
        return $this->is_active;
    }

}

class AdminRepository
{
    
    private DatabaseConnection $connection;

    public function __construct(DatabaseConnection $connection)
    {
        $this->connection = $connection;
    }

    
    public function getAdminByEmail(string $email): Admin
    {
        $statement = $this->connection->getConnection()->prepare(
            "SELECT id_admins, pseudo, email, password FROM admins WHERE email = ? AND is_active = 1"

        );
        $statement->execute([$email]); 

        $row = $statement->fetch(PDO::FETCH_ASSOC); 
        if (!$row) {
            throw new \Exception("Admin non trouvé ou non actif");
        }

    
        $admin = new Admin();
        $admin->setIdAdmin((int)$row['id_admins']);
        $admin->setPseudo($row['pseudo']);
        $admin->setEmail($row['email']);
        $admin->setPassword($row['password']);
        

        return $admin;
    }

}