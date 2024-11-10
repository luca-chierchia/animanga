<?php

namespace interface;

interface Progredibile
{
    public function updateProgress(int $episodesWatched, int $chaptersRead): bool;

    // id riferito all'utente
    public function getProgress(int $id): array;

    // id riferito all'utente
    public function markAsCompleted(int $id): bool;


}