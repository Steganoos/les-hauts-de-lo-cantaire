<?php

declare(strict_types=1);

class Event
{
    private int $id_events;
    private DateTime $creation_date;
    private ?DateTime $updated_at;
    private string $title;
    private string $description;
    private bool $is_active;
    private DateTime $start_date;
    private ?DateTime $end_date;

    // GETTERS

    public function getIdEvents(): int
    {
        return $this->id_events;
    }

    public function getCreationDate(): DateTime
    {
        return $this->creation_date;
    }

    public function getUpdatedAt(): ?DateTime
    {
        return $this->updated_at;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function isActive(): bool
    {
        return $this->is_active;
    }

    public function getStartDate(): DateTime
    {
        return $this->start_date;
    }

    public function getEndDate(): ?DateTime
    {
        return $this->end_date;
    }

    // SETTERS

    public function setIdEvents(int $id_events): void
    {
        $this->id_events = $id_events;
    }

    public function setCreationDate(DateTime $creation_date): void
    {
        $this->creation_date = $creation_date;
    }

    public function setUpdatedAt(?DateTime $updated_at): void
    {
        $this->updated_at = $updated_at;
    }

    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    public function setIsActive(bool $is_active): void
    {
        $this->is_active = $is_active;
    }

    public function setStartDate(DateTime $start_date): void
    {
        $this->start_date = $start_date;
    }

    public function setEndDate(?DateTime $end_date): void
    {
        $this->end_date = $end_date;
    }
}


class EventsRepository
{
    private DatabaseConnection $connection;

    public function __construct(DatabaseConnection $connection)
    {
        $this->connection = $connection;
    }


    public function getEvents(): array
    {
       $statement = $this->connection->getConnection()->query(
            "SELECT id_events, title, description FROM events where is_active = 1"
        );
        $events = [];
        while (($row = $statement->fetch(PDO::FETCH_ASSOC))) {
            $event = new Event();
            $event->setIdEvents((int)$row['id_events']);
            $event->setTitle($row['title']);
            $event->setDescription($row['description']);
            
            $events[] = $event;
        }
        
        return $events;
    }


    public function getAdminEditEvent(int $id): ?Event
{
    $statement = $this->connection->getConnection()->prepare(
        "SELECT * FROM events WHERE id_events = ?"
    );

    $statement->execute([$id]);

    $row = $statement->fetch(PDO::FETCH_ASSOC);

    if (!$row) {
        return null;
    }

    $event = new Event();
    $event->setIdEvents((int)$row['id_events']);

    // Obligatoire
    $event->setCreationDate(new DateTime($row['creation_date']));

    // Optionnels
    $event->setUpdatedAt(!empty($row['updated_at']) ? new DateTime($row['updated_at']) : null);
    $event->setEndDate(!empty($row['end_date']) ? new DateTime($row['end_date']) : null);

    // Autres champs
    $event->setTitle($row['title']);
    $event->setDescription($row['description']);
    $event->setIsActive((bool)$row['is_active']);
    $event->setStartDate(new DateTime($row['start_date']));

    return $event;
}


    public function getAdminEvents(): array
    {
       $statement = $this->connection->getConnection()->query(
            "SELECT id_events, title, description FROM events"
        );
        
        $events = [];
        
        while (($row = $statement->fetch(PDO::FETCH_ASSOC))) {
            $event = new Event();
            $event->setIdEvents((int)$row['id_events']);
            $event->setTitle($row['title']);
            $event->setDescription($row['description']);
            
            $events[] = $event;
        }
        

        return $events;
    }

    public function updateEvents(
        int $id,
        string $title,
        string $description,
        string $startDate,
        ?string $endDate,
        int $isActive
        ): void
    {
        
        $sql = "
        UPDATE events 
        SET 
        title = :title, 
        description = :description, 
        start_date = :startDate, 
        end_date = :endDate, 
        is_active = :isActive 
        WHERE id_events = :id_events
        ";
        
        $statement = $this->connection->getConnection()->prepare($sql);

        $statement->execute([
            ':id_events' => $id,
            ':title' => $title,
            ':description' => $description,
            ':startDate' => $startDate,
            ':endDate' => $endDate,
            ':isActive' => $isActive
        ]);
    }

  public function newEvent(
    string $title,
    string $description,
    string $startDate,
    ?string $endDate,
    int $isActive
    ): void {
    $sql = "
        INSERT INTO events (
            title,
            description,
            start_date,
            end_date,
            is_active
        ) VALUES (
            :title,
            :description,
            :startDate,
            :endDate,
            :isActive
        )
    ";

    $statement = $this->connection->getConnection()->prepare($sql);

    $statement->execute([
        ':title' => $title,
        ':description' => $description,
        ':startDate' => $startDate,
        ':endDate' => $endDate,
        ':isActive' => $isActive
    ]);
    }

    public function deleteEvent(int $id): void
    {
    $statement = $this->connection->getConnection()->prepare(
        "DELETE FROM events WHERE id_events = :id"
    );

    $statement->execute([':id' => $id]);
    }
}
