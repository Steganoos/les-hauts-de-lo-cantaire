<?php

class NotFound
{
    public function execute(): void
    {
        http_response_code(404);
        echo "<h1>404 - Page non trouvée</h1>";
        echo "<a href='index.php?page=homepage'>Retour à l'accueil</a>";
    }
}
