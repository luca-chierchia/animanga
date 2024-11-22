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

function dbContainsId(int $int, Database $db):bool{

    $dbc = $db->connectToDatabase();
    $sql = "SELECT 1 AS recordId FROM media_items WHERE media_item_id = :id";
    $stmt = $dbc->prepare($sql);
    $stmt->bindValue(':id', $int, pdo::PARAM_INT);
    $stmt->execute();
    $stmt->setFetchMode(\PDO::FETCH_ASSOC);
    $contains = $stmt->fetch();

    if($contains['recordId'] > 0){
        return true;
    }else
        return false;


}

function dbContainsUser(string $username, Database $db):bool{
    $dbc = $db->connectToDatabase();
    $sql = "SELECT 1 AS recordId FROM users WHERE username = :username";
    $stmt = $dbc->prepare($sql);
    $stmt->bindValue(':username', $username, pdo::PARAM_STR);
    $stmt->execute();
    $result = $stmt->fetch();

    if($result)
        return true;
    else
        return false;

}

// aggiungere Funzione per matchare nelle pagine anime.php && manga.php && serieTv.php gli item di cui un user è follow,
// ed evidenziarli con un etichetta che indica questa informazione