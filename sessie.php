<?php

class Sessie
{
    public int $userID;
    public string $key;
    public string $start;
    public string $end;

    public function insert()
    {
        include "connectie.php";

        $userID = mysqli_real_escape_string($conn, $this->userID);
        $key = mysqli_real_escape_string($conn, $this->key);
        $start = mysqli_real_escape_string($conn, $this->start);
        $end = mysqli_real_escape_string($conn, $this->end);

        $sql = "INSERT INTO sessions (
            session_user_id,
            session_key,
            session_start,
            session_end
        ) VALUES (
            '" . $userID . "',
            '" . $key . "',
            '" . $start . "',
            '" . $end . "'
        )";
        $conn->query($sql);
        $conn->close();
    }

    public static function vindActieveSessie()
    {
        $sessie = null;

        if (isset($_COOKIE["steptember-session"])) {
            include "connectie.php";

            $key = mysqli_real_escape_string($conn, $_COOKIE["steptember-session"]);

            $query = "SELECT * FROM sessions WHERE session_key = '" . $key . "' AND session_end > '" . date("Y-m-d H:i:s") . "'";
            $resultaat = $conn->query($query);

            if ($resultaat->num_rows > 0) {
                $rij = $resultaat->fetch_assoc();

                $sessie = new Sessie();
                $sessie->userID = $rij['session_user_id'];
                $sessie->key = $rij['session_key'];
                $sessie->start = $rij['session_start'];
                $sessie->end = $rij['session_end'];
            }

            $conn->close();
        }

        return $sessie;
    }
}
?>
