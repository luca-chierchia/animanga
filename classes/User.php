<?php

class User
{

    private string $username;
    private string $password;

    private int  $id;

    private array $mediaItem = [];

    public function __construct(){

    }

    public function getUsername(): string
    {
        return $this->username;
    }

    public function setUsername(string $username): void
    {
        $this->username = $username;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): void
    {
        $this->password = $password;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getMediaItem(): array
    {
        return $this->mediaItem;
    }



    public static function create() : ?User{
        return new User();
    }

    public static function newUser(string $username, string $psw, string $email, Database $db):bool{
        $dbc = $db->connectToDatabase();
        $sql = "INSERT INTO users (username, email, password_hash) VALUES (:username, :email, :password_hash)";
        $stmt = $dbc->prepare($sql);
        $stmt->bindValue(':username', $username);
        $stmt->bindValue(':email', $email);

        $hashedPassword = password_hash($psw, PASSWORD_DEFAULT);
        $stmt->bindValue(':password_hash', $hashedPassword);

        try{
            $stmt->execute();
            return true;
        }catch(PDOException $e){
            echo $e->getMessage();
            return false;
        }

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



            if ($userData && ($password === $userData['password_hash'] || password_verify($password, $userData['password_hash']) )) {

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

    public function containsMediaItem(MediaItem $mediaItem) : bool{
        foreach ($this->mediaItem as $item) {
            if ($item['media_item_id'] === $mediaItem->getId()) {
                return true;
            }
        }
        return false;
    }



    /*
     * Aggiungere/togliere follow: Implementa metodi che eseguono query di inserimento (INSERT)
     *  o eliminazione (DELETE) nella tabella progress o user_media_items per riflettere i cambiamenti
     * nel database.
     */
    public function followMediaItems(MediaItem $mediaItem,Database $dbc) : bool{
        if($this->containsMediaItem($mediaItem)){
            echo "sei già un follower di questo media";
            return false;
        }

        $db = $dbc->connectToDatabase();
        $sql = "INSERT INTO progress (media_item_id, user_id, episodes_watched, chapters_read) 
                VALUES (:media_item_id, :user_id, :episodes_watched, :chapters_read)";
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':media_item_id', $mediaItem->getId(), PDO::PARAM_INT);
        $stmt->bindValue(':user_id',$this->id, PDO::PARAM_INT);
        $stmt->bindValue(':chapters_read',0, PDO::PARAM_INT);
        $stmt->bindValue(':episodes_watched',0, PDO::PARAM_INT);

        try{
            $stmt->execute();
            return true;
        }catch (PDOException $e){
            echo $e->getMessage();
            return false;
        } finally {
            $db = null;
        }
    }
    public function unfollowMediaItems(MediaItem $mediaItem,Database $db) : bool{
        if($this->containsMediaItem($mediaItem)){

            $sql = "DELETE FROM progress WHERE media_item_id = :media_item_id AND user_id = :user_id";
            $dbc = $db->connectToDatabase();
            $stmt = $dbc->prepare($sql);
            $stmt->bindValue(':media_item_id', $mediaItem->getId(), PDO::PARAM_INT);
            $stmt->bindValue(':user_id', $this->id, PDO::PARAM_INT);
            $stmt->execute();
            echo "Unfollow eseguito con successo";
            return true;

        }
        echo "l'elemento non è presente nella tua lista di media seguiti.";
        return false;


    }

    /*
     * Gestire il progresso: Implementa metodi che aggiornino il database,
     *  ad esempio con query di aggiornamento (UPDATE), per incrementare episodi/capitoli
     *  o aggiornare lo stato di completamento per un mediaItem specifico.
     */
    public function incrementChapter(MediaItem $manga,Database $db) : bool{
        $capitoliLetti = 1;
        $cap = $manga->getCapitoliTotali();

        if($this->containsMediaItem($manga)) {

            // Mi connetto al DB
            $dbc = $db->connectToDatabase();

            try {
                $sql = "SELECT chapters_read FROM progress WHERE user_id = :user_id AND media_item_id = :media_item_id";
                $stmt = $dbc->prepare($sql);
                $stmt->bindValue(':user_id', $this->id, PDO::PARAM_INT);
                $stmt->bindValue(':media_item_id', $manga->getId(), PDO::PARAM_INT);
                $stmt->execute();
                $currentProgress = $stmt->fetchColumn();

                $newCapRead = min($currentProgress + $capitoliLetti, $cap);
                // Verifico che il valore di incremento non sia superiore al numero reale di episodi del media
                // TODO


                // Preparo la SQL che aggiorna gli episodi guardati nella tabella progress

                $sql = "UPDATE progress 
                        SET chapters_read = :chapters_read 
                        WHERE user_id = :user_id AND media_item_id = :media_item_id";
                $stmt = $dbc->prepare($sql);
                $stmt->bindValue(':chapters_read', $newCapRead, PDO::PARAM_INT);
                $stmt->bindValue(':user_id', $this->id, PDO::PARAM_INT);
                $stmt->bindValue(':media_item_id', $manga->getId(), PDO::PARAM_INT);
                $stmt->execute();
                if ($stmt->rowCount() > 0) {
                    echo "Capitoli incrementati a " . $newCapRead;
                    return true;
                } else {
                    echo "Nessun aggiornamento effettuato. Verifica che l'ID dell'utente e il media_item_id siano corretti.";
                    return false;
                }

            } catch (PDOException $e) {
                echo "Errore SQL: " . $e->getMessage();
                return false;
            }
        }

        echo "Non puoi avere progressi su un media che non fa parte dei tuoi follow.";
        return false;
    }

    // incrementEpisodes incrementa gli episodi guardati di un certo valore, se il valore non viene inserito, di default viene assegnato uno.
    //
    public function incrementEpisodes(MediaItem $serie, Database $db) :bool {
        $episodiGuardati = 1;
        $ep = $serie->getEpisodiTotali();

        if($this->containsMediaItem($serie)) {

            // Mi connetto al DB
            $dbc = $db->connectToDatabase();

            try {
                $sql = "SELECT episodes_watched FROM progress WHERE user_id = :user_id AND media_item_id = :media_item_id";
                $stmt = $dbc->prepare($sql);
                $stmt->bindValue(':user_id', $this->id, PDO::PARAM_INT);
                $stmt->bindValue(':media_item_id', $serie->getId(), PDO::PARAM_INT);
                $stmt->execute();
                $currentProgress = $stmt->fetchColumn();

                $newEpisodesWatched = min($currentProgress + $episodiGuardati, $ep);
            // Verifico che il valore di incremento non sia superiore al numero reale di episodi del media
            // TODO


            // Preparo la SQL che aggiorna gli episodi guardati nella tabella progress

                $sql = "UPDATE progress 
                        SET episodes_watched = :episodes_watched 
                        WHERE user_id = :user_id AND media_item_id = :media_item_id";
                $stmt = $dbc->prepare($sql);
                $stmt->bindValue(':episodes_watched', $newEpisodesWatched, PDO::PARAM_INT);
                $stmt->bindValue(':user_id', $this->id, PDO::PARAM_INT);
                $stmt->bindValue(':media_item_id', $serie->getId(), PDO::PARAM_INT);
                $stmt->execute();
                    if ($stmt->rowCount() > 0) {
                        echo "Episodi incrementati a " . $newEpisodesWatched;
                        return true;
                    } else {
                        echo "Nessun aggiornamento effettuato. Verifica che l'ID dell'utente e il media_item_id siano corretti.";
                        return false;
                }

            } catch (PDOException $e) {
                echo "Errore SQL: " . $e->getMessage();
                return false;
            }
        }

        echo "Non puoi avere progressi su un media che non fa parte dei tuoi follow.";
        return false;

    }

    // Da vedere come deve restituire i dati nella dashboard dell'User;
    // La seguente funzione restituisce un array di oggetti di tipo MediaItems, la funzione deve essere passata ad un array;
    public function getFollowedItems(MediaItem $mediaItems):array {
        $items = [];

        foreach($this->mediaItem as $item){
            $id = $item['media_item_id'] ?? null;
            if($id != null)
                $item = $mediaItems->loadMediaItem($id);


            if($item != null)
                $items[] = $item;
        }
        return $items;
    }
}