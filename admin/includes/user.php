<?php

class User
{
    public function find_all_users(){
        global $database;
        $result = $database->query("SELECT * FROM klanten");
        return $result;
    }

    public function count_all_users(){
        global $database;
        $result = $database->query("SELECT COUNT(*) as total FROM klanten");
        $row = $result->fetch_assoc();
        return $row['total'];
    }
}
