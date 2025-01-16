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

    public function add_user($email, $naam, $achternaam){
        global $database;

        // Zorg dat invoer veilig is
        $email = $database->connection->real_escape_string($email);
        $naam = $database->connection->real_escape_string($naam);
        $achternaam = $database->connection->real_escape_string($achternaam);

        // Voeg de gebruiker toe aan de database
        $query = "INSERT INTO klanten (email, naam, achternaam) VALUES ('$email', '$naam', '$achternaam')";

        $result = $database->query($query);

        return $result ? true : false;
    }
}
?>
