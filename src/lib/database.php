<?php

class DatabaseConnection
{
    private ?\PDO $database = null;
    private string $dsn;
    private string $username;
    private string $password;

    public function __construct(string $dsn, string $username, string $password)
    {
        $this->dsn = $dsn;
        $this->username = $username;
        $this->password = $password;
    }

    public function getConnection(): \PDO

    {
        if ($this->database === null) {
            try {
                $this->database = new \PDO($this->dsn, $this->username, $this->password);
                $this->database->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        } catch (\PDOException $e) {
            // On relance l'exception pour que le contrôleur la capture
            throw $e;
        }
    }
    return $this->database;
}
}
