<?php

include 'Database.php';
include 'Anime.php';
class User
{

    private string $username;
    private string $password;

    private array $mediaItem = [];

    public function __construct(){

    }

    public static function create(string $username, string $password) : User{
        return new User();
    }

    public static function loadByCredentials(string $username, string $password) : User{
        return new User();
    }

    public function followMediaItems(MediaItem $mediaItem) : void{}
    public function unfollowMediaItems(MediaItem $mediaItem) : void{}
    public function incrementChapter(Manga $manga) : void{}
    public function incrementAnime(Anime $anime) : void{}
    public function incrementEpisodes(SerieTV $serie) :void {}

    public function getFollowedItems() : array{
        return array();
    }
}