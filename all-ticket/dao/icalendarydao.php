<?php
    namespace DAO;

    use Models\Calendary;

    interface ICalendaryDAO {
        function AddCalendary(Calendary $category, $horary);
        function UpdateCalendary($id, Calendary $newCalendary);
        function GetAllCalendaries($what);
        function GetCalendaryById4Buy($id);
        function CheckCalendaryById($id);
        function GetCalendaryByCreated($horary, $id, $date);
        function ChangeCalendaryState($id);
    }
?>