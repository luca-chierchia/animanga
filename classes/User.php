<?php

include 'Anime.php';

class User
{

    private string $username;
    private string $password;

    private int  $id;

    private array $mediaItem = [];

    public function __construct(){

    }

    public static function create() : ?User{
        return new User();
    }

    public static function loadByCredentials(string $username, string $password, Database $dbc) : ?User
    {
        $db = $dbc->connectToDatabase();
        $sql = "SELECT * FROM `users` WHERE `username` = :username ";
        $stmt = $db->prepare($sql);

        $stmt->bindValue(':username', $username);


        try {
            $stmt->execute();
            $stmt->setFetchMode(\PDO::FETCH_ASSOC);
            $userData = $stmt->fetch();



            if ($userData && $password === $userData['password_hash']) {

                $user = new User();
                $user->username = $userData['username'];
                $user->password = $userData['password_hash'];
                $user->id = $userData['user_id'];

                // sql per selezioniamo tutti i record dalla tabella progress associati al suo id
                // per comporre l'array mediaItems dell'user corrente
                $sql = "SELECT * FROM `progress` WHERE `user_id` = :id";
                $stmt = $db->prepare($sql);
                $stmt->bindValue(':id', $user->id, PDO::PARAM_INT);
                $stmt->execute();
                $stmt->setFetchMode(\PDO::FETCH_ASSOC);
                $items = $stmt->fetchAll();

                foreach ($items as $item) {
                    $user->mediaItem[] = $item;
                }
                return $user;

            } else
                return  null;

        } catch (PDOException $e) {
            echo  $e->getMessage();
            return  null;
        }finally{
            $db = null;
        }
    }


    /*
     * Aggiungere/togliere follow: Implementa metodi che eseguono query di inserimento (INSERT)
     *  o eliminazione (DELETE) nella tabella progress o user_media_items per riflettere i cambiamenti
     * nel database.
     */
    public function followMediaItems(MediaItem $mediaItem) : bool{
        foreach ($this->mediaItem as $item){
            if($item['media_item_id'] === $mediaItem->getId()){
                echo "questo tipo di item è già seguito";
                return false;
            }
        }
        return true;
    }
    public function unfollowMediaItems(MediaItem $mediaItem) : void{

    }

    /*
     * Gestire il progresso: Implementa metodi che aggiornino il database,
     *  ad esempio con query di aggiornamento (UPDATE), per incrementare episodi/capitoli
     *  o aggiornare lo stato di completamento per un mediaItem specifico.
     */
    public function incrementChapter(Manga $manga) : void{

    }
    public function incrementAnime(Anime $anime) : void{

    }
    public function incrementEpisodes(SerieTV $serie) :void {

    }

    public function getFollowedItems() : array{
        return array();
    }
}