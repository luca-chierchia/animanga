<?php

use interface\Progredibile;

include './interface/Progredibile.php';
include 'MediaItem.php';

class Anime extends MediaItem implements Progredibile
{



    public function __construct(Database $db, string $tableName)
    {
        parent::__construct($db, $tableName);
    }





    public function updateProgress(int $episodesWatched, int $chaptersRead): bool
    {return true;
        // TODO: Implement updateProgress() method.
    }

    public function getProgress(int $id): array
    { return [];
        // TODO: Implement getProgress() method.
    }

    public function markAsCompleted(int $id): bool
    {return true;
        // TODO: Implement markAsCompleted() method.
    }

}