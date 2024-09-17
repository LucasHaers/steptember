<?php

class Stap
{
    public int $id;
    public int $userID;
    public string $date;
    public int $steps;

    public static function vindStappen($userID)
    {
        include "connectie.php";

        $query = "SELECT * FROM steps WHERE step_user_id = $userID";
        $resultaat = $conn->query($query);

        $stappen = [];

        if ($resultaat->num_rows > 0) {
            while ($row = $resultaat->fetch_assoc()) {
                $stap = new Stap();
                $stap->id = $row['step_id'];
                $stap->userID = $row['step_user_id'];
                $stap->date = $row['step_date'];
                $stap->steps = $row['step_total'];
                $stappen[] = $stap;
            }
        }
        $conn->close();

        return $stappen;
    }
}
?>

