<?php

declare(strict_types=1);

class Event
{
    private int $id_events;
    private DateTime $creation_date;
    private DateTime $updated_at;
    private string $title;
    private string $description;
    private bool $is_active;
    private DateTime $start_date;
    private DateTime $end_date;

    // GETTERS

    public function getIdEvents(): int
    {
        return $this->id_events;
    }

    public function getCreationDate(): DateTime
    {
        return $this->creation_date;
    }

    public function getUpdatedAt(): DateTime
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

    public function getEndDate(): DateTime
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

    public function setUpdatedAt(DateTime $updated_at): void
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

    public function setEndDate(DateTime $end_date): void
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
            "SELECT title, description FROM events where is_active = 1"
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
    
}
