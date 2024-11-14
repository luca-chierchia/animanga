<?php

// Set di funzioni


// Funzione che ritorna un array di mediaItem specificando il tipo di media.
function mostFollowed(string $type, Database $db):array
{

    $sql = "SELECT progress.media_item_id, media_items.media_type, COUNT(*) AS frequency
        FROM progress
        JOIN media_items ON progress.media_item_id = media_items.media_item_id
        WHERE media_items.media_type = :type
        GROUP BY progress.media_item_id, media_items.media_type
        ORDER BY frequency DESC
        LIMIT 3;";

    $dbc = $db->connectToDatabase();
    $stmt = $dbc->prepare($sql);

    try{
        $stmt->bindValue(':type', $type, pdo::PARAM_STR);
        $stmt->execute();
        $stmt->setFetchMode(\PDO::FETCH_ASSOC);
        return $stmt->fetchAll();
    }catch (PDOException $e){
        echo $e->getMessage();
        return [];

    } finally {
        $dbc = null;
    }


};