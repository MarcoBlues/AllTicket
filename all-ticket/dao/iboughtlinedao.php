<?php
    namespace DAO;

    use Models\BoughtLine as BoughtLine;

    interface IBoughtLineDAO{
    public function AddBoughtLine(BoughtLine $boughtLine, $boughtId);
    
    }
?>