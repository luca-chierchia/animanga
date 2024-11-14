<?php

use interface\CRUDInterface;


include './interface/CRUDInterface.php';
class MediaItem implements CRUDInterface
{
    private PDO $dbh;
    private string $tableName;

    private  string $mediaType ;
    private int $id;
    private string $title;

    private string $author;
    private string $description;
    private int $stagioniTotali;
    private int $episodiTotali;

    private int $volumiTotali;
    private int $capitoliTotali;


    public function __construct(){

    }

    public  function getMediaType(): string
    {
        return $this->mediaType;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getAuthor(): string{
        return $this->author;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getStagioniTotali(): int
    {
        return $this->stagioniTotali;
    }

    public function getEpisodiTotali(): int
    {
        return $this->episodiTotali;
    }

    public function getVolumiTotali(): int
    {
        return $this->volumiTotali;
    }

    public function getCapitoliTotali(): int
    {
        return $this->capitoliTotali;
    }

    /*
     * $arr = [
    "title"      => "prova",
    "decription" => "prova",
    "media_type" => "book",
    "realease_date" => date("Y-m-d")

];
     */
    public  function  loadMediaItem(int $id, Database $db):?MediaItem{

        $dbh = $db->connectToDatabase();
        $sql = "SELECT * FROM media_items WHERE media_item_id = :media_item_id";
        $stmt = $dbh->prepare($sql);
        $stmt->bindParam(':media_item_id', $id, PDO::PARAM_INT);

        try{
            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $array = $stmt->fetch();

            if($array){

            $this->id = $array['media_item_id'];
            $this->title = $array['title'];
            $this->author = $array['author'];
            $this->description = $array['description'];
            $this->stagioniTotali = $array['stagioni_totali'];
            $this->episodiTotali = $array['episodi_totali'];
            $this->volumiTotali = $array['volumi_totali'];
            $this->capitoliTotali = $array['capitoli_totali'];

            return $this;
            }

            return null;

        }catch(PDOException $e){
            echo $e->getMessage();
            return null;
        }
    }
    public function create(array $data, Database $db): bool
    {
        $dbh = $db->connectToDatabase();
        $field = implode(',', array_keys($data));
        $sql = "INSERT INTO media_items ({$field})
                VALUES (:title, :description, :author ,:media_type, :release_date, :stagioni_totali, :episodi_totali, :volumi_totali, :capitoli_totali)";
        $data['release_date'] = date('Y-m-d');
        $stmt = $dbh->prepare($sql);

        try{

            $stmt->bindParam(':title', $data['title'], PDO::PARAM_STR);
            $stmt->bindParam(':description', $data['description'], PDO::PARAM_STR);
            $stmt->bindParam(':author', $data['author'], PDO::PARAM_STR);
            $stmt->bindParam(':media_type', $data['media_type'], PDO::PARAM_STR);
            $stmt->bindParam(':release_date', $data['release_date'], PDO::PARAM_STR);
            $stmt->bindParam(':stagioni_totali', $data['stagioni_totali'], PDO::PARAM_INT);
            $stmt->bindParam(':episodi_totali', $data['episodi_totali'], PDO::PARAM_INT);
            $stmt->bindParam(':volumi_totali', $data['volumi_totali'], PDO::PARAM_INT);
            $stmt->bindParam(':capitoli_totali', $data['capitoli_totali'], PDO::PARAM_INT);
            echo "Dati salvati nel DB \n";
            return $stmt->execute();

        }catch(PDOException $e){
            echo "ERRORE:".$e->getMessage()."\n";
            return false;

        }
    }

    public function update(array $data, int $id, Database $db): bool
    {
        $dbh = $db->connectToDatabase();
        $tmpArr = [];

        foreach ($data as $key => $value) {
            if (!empty($value)) {
                $tmpArr[$key] = $value;
            }
        }


        if (!isset($tmpArr["release_date"])) {
            $tmpArr["release_date"] = date('Y-m-d');
        }


        $mappedData = array_map(
            fn($key) => "$key = :$key",
            array_keys($tmpArr)
        );

        // Costruzione della query SQL
        $sql = "UPDATE media_items \n";
        $sql .= "SET " . implode(',', $mappedData) . "\n";
        $sql .= "WHERE media_item_id = :id";

        $stmt = $dbh->prepare($sql);

        try {
            // Binding dei parametri per i dati di aggiornamento
            foreach ($tmpArr as $key => $value) {
                $stmt->bindValue(":$key", $value);
            }

            // Binding dell'ID
            $stmt->bindValue(":id", $id, PDO::PARAM_INT);

            echo "Hai aggiornato l'elemento \n";
            return $stmt->execute();

        } catch (PDOException $e) {
            echo "ERRORE:" . $e->getMessage() . "\n";
            return false;
        }
    }

    // DELETE FROM table_name WHERE condition;
    public function delete( int $id, Database $db): bool
    {
        $dbh = $db->connectToDatabase();
        $sql = "DELETE FROM media_items 
                WHERE media_item_id = :id";

        $stmt = $dbh->prepare($sql);

        try{
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            echo "Hai eliminato l'elemento \n";
            return true;
        } catch (PDOException $e) {
            echo "ERRORE:" . $e->getMessage() . "\n";
            return false;
        }
    }

    public function readAll(Database $db): array
    {
        $dbh = $db->connectToDatabase();
        $sql = "SELECT * FROM media_items";
        $stmt = $dbh->prepare($sql);

        try{
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }catch(PDOException $e){
            echo "ERRORE:".$e->getMessage()."\n";
            return [];
        }
    }

    /*
     * public function readById(int $id): ?array{

    }
     */


}
