<?php
    namespace DAO;
    
    use Models\Event as Event;
    
    interface IEventDAO {
        function AddEvent(Event $event);
        function GetAllEvents($what);
        function GetEventByTitle($title, $what);
        function GetEventById($id, $what);
        function CheckEventById($id);
        function UpdateEvent($id, Event $newEvent, $idCategory);
        function ChangeEventState($id);
    }
?>