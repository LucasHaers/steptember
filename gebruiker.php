<?php

class Gebruiker
{
    public int $id;
    public string $firstname;
    public string $lastname;
    public string $email;
    public string $username;
    public string $password;

    public static function vindGebruikers($username, $password)
    {
        include "connectie.php";

        $username = mysqli_real_escape_string($conn, $username);
        $password = mysqli_real_escape_string($conn, $password);

        $query = "SELECT * FROM users WHERE user_username = '$username' AND user_password = '$password'";
        $resultaat = $conn->query($query);

        $gebruiker = null;

        if ($resultaat->num_rows > 0) {
            while($row = $resultaat->fetch_assoc()) {
                $gebruiker = new Gebruiker();
                $gebruiker->id = $row['user_id'];
                $gebruiker->firstname = $row['user_firstname'];
                $gebruiker->lastname = $row['user_lastname'];
                $gebruiker->email = $row['user_email'];
                $gebruiker->username = $row['user_username'];
                $gebruiker->password = $row['user_password'];
            }
        }
        $conn->close();

        return $gebruiker;
    }

    public static function vindGebruikerOpID($userID)
    {
        include "connectie.php";

        $query = "SELECT * FROM users WHERE user_id = $userID";
        $resultaat = $conn->query($query);

        if ($resultaat->num_rows > 0) {
            $row = $resultaat->fetch_assoc();
            $gebruiker = new Gebruiker();
            $gebruiker->id = $row['user_id'];
            $gebruiker->firstname = $row['user_firstname'];
            $gebruiker->lastname = $row['user_lastname'];
            $gebruiker->email = $row['user_email'];
            $gebruiker->username = $row['user_username'];
            $gebruiker->password = $row['user_password'];
            return $gebruiker;
        }
        $conn->close();

        return null;
    }
}
?>

