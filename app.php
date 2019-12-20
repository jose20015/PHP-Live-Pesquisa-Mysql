<?php

try{
    $pdo = new PDO("mysql:host=localhost;dbname=mundo", "root", "");

    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e){
    die("ERROR: Could not connect. " . $e->getMessage());
}
 
try{
    if(isset($_REQUEST["term"])){

        $sql = "SELECT * FROM countries WHERE name LIKE :term";
        $stmt = $pdo->prepare($sql);
        $term = $_REQUEST["term"] . '%';

        $stmt->bindParam(":term", $term);

        $stmt->execute();
        if($stmt->rowCount() > 0){
            while($row = $stmt->fetch()){
                echo "<p>" . $row["name"] . "</p>";
            }
        } else{
            echo "<p>No matches found</p>";
        }
    }  
} catch(PDOException $e){
    die("ERROR: Could not able to execute $sql. " . $e->getMessage());
}
 
unset($stmt);
unset($pdo);
?>