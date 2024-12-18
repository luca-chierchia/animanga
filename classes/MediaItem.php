<?php
require_once __DIR__ . '/../interface/CRUDInterface.php';



use interface\CRUDInterface;



class MediaItem implements CRUDInterface
{



    private PDO $dbc;
    private  string $mediaType ;
    private int $id;
    private string $title;

    private string $author;
    private string $description;
    private string $releaseDate;
    private int $stagioniTotali;
    private int $episodiTotali;

    private int $volumiTotali;
    private int $capitoliTotali;


    public function __construct(){

    }

    public function setMediaType(string $mediaType): void
    {
        $this->mediaType = $mediaType;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    public function setAuthor(string $author): void
    {
        $this->author = $author;
    }

    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    public function setReleaseDate(string $releaseDate): void
    {
        $this->releaseDate = $releaseDate;
    }

    public function setStagioniTotali(int $stagioniTotali): void
    {
        $this->stagioniTotali = $stagioniTotali;
    }

    public function setEpisodiTotali(int $episodiTotali): void
    {
        $this->episodiTotali = $episodiTotali;
    }

    public function setVolumiTotali(int $volumiTotali): void
    {
        $this->volumiTotali = $volumiTotali;
    }

    public function setCapitoliTotali(int $capitoliTotali): void
    {
        $this->capitoliTotali = $capitoliTotali;
    }

    public function getMediaType(): string
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

    public function getReleaseDate(): string
    {
        return $this->releaseDate;
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

        $this->dbc = $db->connectToDatabase();
        $sql = "SELECT * FROM media_items WHERE media_item_id = :media_item_id";
        $stmt = $this->dbc->prepare($sql);
        $stmt->bindValue(':media_item_id', $id, PDO::PARAM_INT);

        try{
            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $array = $stmt->fetch();

            if($array){

            $this->id = $array['media_item_id'];
            $this->title = $array['title'];
            $this->mediaType = $array['media_type'];
            $this->author = $array['author'];
            $this->description = $array['description'];
            $this->releaseDate = $array['release_date'];
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
        $this->dbc = $db->connectToDatabase();
        $sql = "INSERT INTO media_items (title, description, author ,media_type, release_date, stagioni_totali, episodi_totali, volumi_totali, capitoli_totali)
                VALUES (:title, :description, :author ,:media_type, :release_date, :stagioni_totali, :episodi_totali, :volumi_totali, :capitoli_totali)";
        $data['release_date'] = date('Y-m-d');
        $stmt = $this->dbc->prepare($sql);

        try{

            $stmt->bindValue(':title', $data['title'], PDO::PARAM_STR);
            $stmt->bindValue(':description', $data['description'], PDO::PARAM_STR);
            $stmt->bindValue(':author', $data['author'], PDO::PARAM_STR);
            $stmt->bindValue(':media_type', $data['media_type'], PDO::PARAM_STR);
            $stmt->bindValue(':release_date', $data['release_date'], PDO::PARAM_STR);
            $stmt->bindValue(':stagioni_totali', $data['stagioni_totali'], PDO::PARAM_INT);
            $stmt->bindValue(':episodi_totali', $data['episodi_totali'], PDO::PARAM_INT);
            $stmt->bindValue(':volumi_totali', $data['volumi_totali'], PDO::PARAM_INT);
            $stmt->bindValue('capitoli_totali', $data['capitoli_totali'], PDO::PARAM_INT);

            return $stmt->execute();

        }catch(PDOException $e){
            echo "ERRORE:".$e->getMessage()."\n";
            return false;

        }
    }

    public function update(array $data, int $id, Database $db): bool
    {
        $this->dbc = $db->connectToDatabase();
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

        $stmt = $this->dbc->prepare($sql);

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
        $this->dbc = $db->connectToDatabase();
        $sql = "DELETE FROM media_items 
                WHERE media_item_id = :id";

        $stmt = $this->dbc->prepare($sql);

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
        $this->dbc = $db->connectToDatabase();
        $sql = "SELECT * FROM media_items";
        $stmt = $this->dbc->prepare($sql);

        try{
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }catch(PDOException $e){
            echo "ERRORE:".$e->getMessage()."\n";
            return [];
        }
    }

    public function readAllVideoType(Database $db):array{
        $this->dbc = $db->connectToDatabase();
        $sql = "SELECT * FROM media_items
                WHERE media_type = 'video'";
        $stmt = $this->dbc->prepare($sql);

        try{
            $stmt->execute();
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $mediaItems = [];

            foreach ($results as $result) {
                $item = new MediaItem();
                $item->id = $result['media_item_id'];
                $item->title = $result['title'];
                $item->description = $result['description'];
                $item->author = $result['author'];
                $item->media_type = $result['media_type'];
                $item->release_date = $result['release_date'];
                $item->stagioni_totali = $result['stagioni_totali'];
                $item->episodi_totali = $result['episodi_totali'];
                $item->volumi_totali = $result['volumi_totali'];
                $mediaItems[] = $item;
            }

            return $mediaItems;
        }catch(PDOException $e){
            echo "ERRORE:".$e->getMessage()."\n";
            return [];
        }
    }


    public function readAllBookType(Database $db): array{
        $this->dbc = $db->connectToDatabase();
        $sql = "SELECT * FROM media_items
                WHERE media_type = 'book'";
        $stmt = $this->dbc->prepare($sql);

        try{
            $stmt->execute();
            $results =$stmt->fetchAll(PDO::FETCH_ASSOC);
            $mediaItems = [];

            foreach ($results as $result) {
                $item = new MediaItem();
                $item->id = $result['media_item_id'];
                $item->title = $result['title'];
                $item->description = $result['description'];
                $item->author = $result['author'];
                $item->media_type = $result['media_type'];
                $item->release_date = $result['release_date'];
                $item->stagioni_totali = $result['stagioni_totali'];
                $item->episodi_totali = $result['episodi_totali'];
                $item->volumi_totali = $result['volumi_totali'];
                $mediaItems[] = $item;
            }

            return $mediaItems;


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
