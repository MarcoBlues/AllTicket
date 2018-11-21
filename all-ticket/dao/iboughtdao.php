<?php
    namespace DAO;

    interface IBoughtDAO {
        function AddBoughtClient($client);
        function GetAllBought4Admin();
        function GetBoughClientById($id);
    }
?>