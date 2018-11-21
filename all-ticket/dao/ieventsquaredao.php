<?php
    namespace DAO;

    use Models\EventSquare as EventSquare;

    interface IEventSquareDAO {
    public function AddEventSquare(EventSquare $eventSquare, $id);
    public function GetAllEventsquares();
    public function GetEventSquareById($id);
    public function GetEventSquarePrice($id);
    public function GetDateByEventSquareId($id);
    public function UpdateEventSquareRemainings($id,$quantity);
    public function Delete($id);
    
    }
?>