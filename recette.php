<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nombre = intval($_POST["nombre"]);
    $insctructions = explode(",", $_POST["instructions"]);
    var_dump($insctructions);
    $bac_left = 0;
    $bac_right = 0;
    $jump = 0;
    $swap = 2;
    for ($i = 0; $i < $nombre; $i++) {
        // coupage
        $cup = explode(" ", $insctructions[$i]);
        $insctruction = $cup[0];
        $value = 0;
        if (count($cup) > 1) {
            $value = intval($cup[1]);
        }

        $a = 0;
        $c = 0;
        $reste = 0;
        
        if (strtolower($insctruction) === 'add') {
            $bac_right += $value;
        }
        elseif (strtolower($insctruction) === 'swap') {
            if(($swap  % 2) == 0) {
                $c = $bac_right;
                $bac_right = $bac_left;
                $bac_left = $c;
                $swap++;
            } else {
                $c = $bac_left;
                $bac_left = $bac_right;
                $bac_right = $c;
                $swap++;
            }
        }
        elseif (strtolower($insctruction) === 'jump' && $jump === 0) {
            $jump++;
            $nouvel_index = ($i + $value) % $nombre;
            if($nouvel_index < 0)
            {
                $nouvel_index += $nombre;
            }
            $i = $nouvel_index;
            $i -= 1;
            if($i < 0)
            {
                $i = 0;
            }

        }
        elseif (strtolower($insctruction) === 'transfer') {
            $a = $bac_right;
            $bac_left += $a;
            $bac_right = 0;
        }
    }
    // ADD 5,SWAP,ADD 3,TRANSFER,ADD 2
    echo "Le bac de gauche $bac_left";
    echo "<br>";

    echo "Le bac de droit $bac_right";
    echo "<br>";

}
?>