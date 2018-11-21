<?php
    namespace DAO;

    use Models\EventPlace as EventPlace;

    interface IEventPlaceDAO {
        function AddEventPlace(EventPlace $eventPlace);
        function GetAllEventPlaces($what);
        function GetEventPlaceById($id, $what);
        function GetEventPlaceByDesc($desc, $what);
        function CheckEventPlaceById($id);
        function UpdateEventPlace($id, EventPlace $newEventPlace);
        function ChangeEventPlaceState($id);
    }
?>