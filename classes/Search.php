<?php

class Search
{
    public function __construct(){

    }

    public static function searchByTitle(Database $db, string $title):array
    {
        $dbc = $db->connectToDatabase();
        $sql = "SELECT media_item_id,title,description,author,media_type,release_date,stagioni_totali,episodi_totali,volumi_totali,capitoli_totali
                FROM media_items 
                WHERE title LIKE :title";
        $stmt = $dbc->prepare($sql);
        $stmt->bindValue(':title', '%'.$title.'%');

        try{
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

            if($result){
                // se vengono prodotti risultati
                $items = [];

                foreach($result as $item){
                    $i = new MediaItem();
                    $i->setTitle($item['title']);
                    $i->setId((int) $item['media_item_id']);
                    $i->setAuthor($item['author']);
                    $i->setDescription($item['description']);
                    if($item['media_type'] === 'book')
                        $i->setCapitoliTotali((int) $item['capitoli_totali']);
                    else
                        $i->setEpisodiTotali((int) $item['episodi_totali']);
                    $i->setReleaseDate($item['release_date']);
                    $items[] = $i;
                }

                return $items;

            }else{
                // se non sono stati prodotti risultati
                return [];
            }
        }catch(PDOException $e){
            echo $e->getMessage();
            return [];
        }
    }

    public static function searchByContent(Database $db, string $content):array{
        return [];
    }

    public static function searchByDate(Database $db, string $date):array
    {
        $dbc = $db->connectToDatabase();
        $sql = "SELECT media_item_id,title,description,author,media_type,release_date,stagioni_totali,episodi_totali,volumi_totali,capitoli_totali
                FROM media_items 
                WHERE release_date LIKE :date";
        $stmt = $dbc->prepare($sql);
        $stmt->bindValue(':date', '%'.$date.'%');

        try{
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

            if($result){
                // se vengono prodotti risultati
                $items = [];

                foreach($result as $item){
                    $i = new MediaItem();
                    $i->setTitle($item['title']);
                    $i->setId((int) $item['media_item_id']);
                    $i->setAuthor($item['author']);
                    $i->setDescription($item['description']);
                    if($item['media_type'] === 'book')
                        $i->setCapitoliTotali((int) $item['capitoli_totali']);
                    else
                        $i->setEpisodiTotali((int) $item['episodi_totali']);
                    $i->setReleaseDate($item['release_date']);
                    $items[] = $i;
                }

                return $items;

            }else{
                // se non sono stati prodotti risultati
                return [];
            }
        }catch(PDOException $e){
            echo $e->getMessage();
            return [];
        }
    }

    public static function searchByNumOfEpi(Database $db, int $numOfEp):array
    {
        $dbc = $db->connectToDatabase();
        $sql = "SELECT media_item_id,title,description,author,media_type,release_date,stagioni_totali,episodi_totali,volumi_totali,capitoli_totali
                FROM media_items 
                WHERE episodi_totali > :numOfEp ";
        $stmt = $dbc->prepare($sql);
        $stmt->bindValue(':numOfEp', $numOfEp, PDO::PARAM_INT);

        try{
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

            if($result){
                // se vengono prodotti risultati
                $items = [];

                foreach($result as $item){
                    $i = new MediaItem();
                    $i->setTitle($item['title']);
                    $i->setId((int) $item['media_item_id']);
                    $i->setAuthor($item['author']);
                    $i->setDescription($item['description']);
                    if($item['media_type'] === 'book')
                        $i->setCapitoliTotali((int) $item['capitoli_totali']);
                    else
                        $i->setEpisodiTotali((int) $item['episodi_totali']);
                    $i->setReleaseDate($item['release_date']);
                    $items[] = $i;
                }

                return $items;

            }else{
                // se non sono stati prodotti risultati
                return [];
            }
        }catch(PDOException $e){
            echo $e->getMessage();
            return [];
        }
    }

    public static function searchByNumOfCap(Database $db, int $numOfCap):array{
        $dbc = $db->connectToDatabase();
        $sql = "SELECT media_item_id,title,description,author,media_type,release_date,stagioni_totali,episodi_totali,volumi_totali,capitoli_totali
                FROM media_items 
                WHERE capitoli_totali > :numOfCap ";
        $stmt = $dbc->prepare($sql);
        $stmt->bindValue(':numOfCap', $numOfCap, PDO::PARAM_INT);

        try{
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

            if($result){
                // se vengono prodotti risultati
                $items = [];

                foreach($result as $item){
                    $i = new MediaItem();
                    $i->setTitle($item['title']);
                    $i->setId((int) $item['media_item_id']);
                    $i->setAuthor($item['author']);
                    $i->setDescription($item['description']);
                    if($item['media_type'] === 'book')
                        $i->setCapitoliTotali((int) $item['capitoli_totali']);
                    else
                        $i->setEpisodiTotali((int) $item['episodi_totali']);
                    $i->setReleaseDate($item['release_date']);
                    $items[] = $i;
                }

                return $items;

            }else{
                // se non sono stati prodotti risultati
                return [];
            }
        }catch(PDOException $e){
            echo $e->getMessage();
            return [];
        }
        return [];
    }
}