<?php

class DatabaseConnection
{
    private ?\PDO $database = null;
    private string $dns;
    private string $username;
    private string $password;

    public function __construct(string $dns, string $username, string $password)
    {
        $this->dns = $dns;
        $this->username = $username;
        $this->password = $password;
    }

    public function getConnection(): \PDO
    {
        if ($this->database === null) {
            $this->database = new \PDO($this->dns, $this->username, $this->password);
            $this->database->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        }

        return $this->database;
    }
}
