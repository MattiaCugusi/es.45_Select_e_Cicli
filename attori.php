<?php
include ('connessione.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Attori</title>
</head>
<body>

    <?php

    $num = $_GET["numAttori"];
    

    if ($num < 1) {
        echo "<p>Nessun attore selezionato</p>";
    }

   

    
    $query = "SELECT attori.CodAttore, attori.Nome, COUNT(recita.CodFilm)  AS NumFilm  FROM attori LEFT JOIN recita ON attori.CodAttore = recita.CodAttore GROUP BY attori.CodAttore, attori.Nome ORDER BY attori.Nome LIMIT  $num ";

    $result = $conn->query($query);


        echo "<table style ='text-align: center; border: 1px solid black; border-collapse: collapse; margin-left: auto; margin-right: auto'>";
        echo "<tr>";
        echo "<th>Cod_Attore</th>";
        echo "<th>Nome_Attore</th>";
        echo "<th>Num_film</th>"; 
        echo "<th>Lista_film</th>"; 
        echo "</tr>";
    

    if ($result->num_rows > 0) {
        while ($riga = $result->fetch_assoc()){
            echo "<tr>";
            echo "<td style='border: 1px solid black'>" . $riga['CodAttore'] . "</td>";
            echo "<td style='border: 1px solid black'>" . $riga['Nome'] . "</td>";
            echo "<td style='border: 1px solid black'>" . $riga['NumFilm'] . "</td>";
            
            echo "</tr>";
    
            $codAttore = $riga['CodAttore'];
            $query_film = "SELECT film.CodFilm, film.Titolo, film.AnnoProduzione FROM film LEFT JOIN recita ON film.CodFilm = recita.CodFilm WHERE recita.CodAttore = $codAttore";

            $risultato_film = $conn->query($query_film);
            echo "<td style='border: 1px solid black'>";
            if ($risultato_film->num_rows > 0) {
                echo "<ul>";
                while ($film = $risultato_film->fetch_assoc()) {
                    echo "<li>" . $film['CodFilm'] . " - " . $film['Titolo'] . " - " . $film['AnnoProduzione'] . "</li>";
                }
                echo "</ul>";
            } else {
                echo "-";
            }
            echo "</td>";

            echo "</tr>";


        }
        }
        echo "</table>";
    
    
    

    


    ?>
    
</body>
</html>