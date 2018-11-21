<?php
    namespace DAO;

    use Models\Artist as Artist;

    interface IArtistDAO {
        function AddArtist(Artist $artist);
        function GetAllArtist($what);
        function UpdateArtist($id, Artist $newArtist);
        function GetArtistByNickName($nickName, $what);
        function GetArtistById($id, $what);
        function CheckArtistById($id);
        function ChangeArtistState($id);
    }
?>