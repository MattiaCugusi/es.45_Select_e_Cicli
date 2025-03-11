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

    
    $query = "SELECT attori.CodAttore, attori.Nome, COUNT(recita.CodFilm) FROM attori LEFT JOIN recita ON attori.CodAttore = recita.CodAttore GROUP BY attori.CodAttore, attori.Nome ORDER BY attori.Nome;";

    $result = $conn->query($query);


        echo "<table style ='text-align: center; border: 1px solid black; border-collapse: collapse; margin-left: auto; margin-right: auto'>";
        echo "<tr>";
        echo "<th>Cod_Attore</th>";
        echo "<th>Nome_Attore</th>";
        echo "<th>Num_film</th>"; 
        echo "<th>Lista_film</th>"; 
        echo "</tr>";
    

    $count = 0;

    if ($result->num_rows > 0) {
        while ($riga = $result->fetch_assoc()){
            $count++;
            if ($count <= $num){
            echo "<tr>";
            foreach($riga as $value){
                echo "<td style = 'border: 1px solid black'>" . $value . "</td>";
            }
        }
            echo "</tr>";
    
        }
        echo "</table>";
    
    }
    

    


    ?>
    
</body>
</html>