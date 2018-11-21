<?php
    namespace DAO;

    use Models\Eventype as Eventype;

    interface IEventypeDAO {
        function AddEventype(Eventype $eventType);
        function GetAllEventypes($what);
        function GetEventTypeByDesc($desc, $what);
        function CheckEventypeById($id);
        function UpdateEventype($id, Eventype $newEventype);
        function ChangeStateEventype($id);
    }
?>