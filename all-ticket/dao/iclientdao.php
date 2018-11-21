<?php
    namespace DAO;

    use Models\Client as Client;

    interface IClientDAO {
        function AddClient(Client $client);
        function GetAllClients();
        function GetClientById($id);
        function GetClientByUserName($userName);
        function GetClientByEmail($email);
        function GetClientByPassword($password);
        function GetClientStateByUserName($userName);
        function ChangeClientState($id);
    }
?>