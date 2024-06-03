<?php
    if($_SERVER["REQUEST_METHOD"] === "POST")
    {
        // Récupérons le nombre total de mesure
        $nombre = intval($_POST["nombre"]);
        $mesure = explode(" " , $_POST["mesure"]);

        // Tableau récapitulatif
        $arr_recap = [];
        $count = 0;
        $parcour = 0;

        // Parcourons notre tableau de mesure
        for($i = 0; $i < $nombre; $i++)
        {
            $diff = 0;
            if(($i + 1) < $nombre)
            {
                // Calculons la différence
                $diff = floatval($mesure[$i]) - floatval($mesure[$i + 1]);
                $x = $i + 1;
                $segment = "[" . floatval($mesure[$i]) . "," . floatval($mesure[$i + 1]) . "]";
                /**
                 * Pourquoi 2
                 * 
                 * dans l'exemple 1, il a parcouru 2,4 kilomètres qui équivaut à 144 km/h
                 * donc 2 kilomètres font 120 km/h après calcul ((120 * 2,4) / 144)
                 */
            }
            if($diff > 2)
            {
                $kilometre = (120 * $diff) / 2;
                array_push($arr_recap, ["message" => "Lors du segement $segment, le conducteur a parcouru $diff kilomètres. Cela équivaut à une vitesse de $kilometre km/h.", "message_system" => "POLLUTION"]);
            } else {
                $count++;
                if($parcour == floatval(2))
                {
                    $parcour = floatval(2);
                } else {
                    $parcour = $diff;
                }
            }
        }

        if(($count === $nombre) && count($arr_recap) === 0)
        {
            if($parcour == floatval(2))
            {
                echo "<div style='border: 1px solid gray; width: 500px; padding: 10px;'>";
                echo "<p>Le segment le plus rapide est parcouru à 120 km/h exactement. Cela ne dépasse pas strictement la limite, le trajet est donc acceptable</p>";
                echo "<p style='background-color: green; width: 100px; color: white; padding: 10px; border-radius: .2em;'>OK</p>";
                echo "</div>";
            } else {
                echo "<div style='border: 1px solid gray; width: 500px; padding: 10px;'>";
                echo "<p>Le segment le plus rapide est parcouru à une vitesse en dessous de 120 km/h. Cela ne dépasse pas strictement la limite, le trajet est donc acceptable</p>";
                echo "<p style='background-color: green; width: 100px; color: white; padding: 10px; border-radius: .2em;'>OK</p>";
                echo "</div>";
            }
        }

        if(count($arr_recap) > 0)
        {
            foreach($arr_recap as $key => $value)
            {
                echo "<div style='border: 1px solid gray; width: 500px; padding: 10px;'>";
                echo "<p>" . $value["message"] . "</p>";
                echo "<p style='background-color: green; width: 100px; color: white; padding: 10px; border-radius: .2em;'>" . $value["message_system"] . "</p>";
                echo "</div>";
            }
        }
    }
?>

<!-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HighFive Test</title>
</head>
<body>
    <form action="/index.phtml" method="POST">
        <input type="text">
        <textarea name="" id="" cols="30" rows="10"></textarea>
        <button>Calculer</button>
    </form>
</body>
</html> -->