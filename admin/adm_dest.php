<?php
include_once(__DIR__ . "/../Classes/DestinationBase.php");
include_once(__DIR__ . "/../Repository/DestinationBaseRepository.php");



if (isset($_POST["name"])) {
    echo "ici";
    $name = $_POST["name"];

    try {
        $My_DBR = new DestinationBaseRepository();
        $My_DBR->createDestinationBase($name);
    } catch (Exception $e) {
        echo "yop". $e->getMessage() ;
        }
}else{echo "la"; 
foreach($_POST as $aa){print_r($_POST);}    }



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administration</title>

    <link rel="stylesheet" type="text/css" href="fonts/font-awesome/css/font-awesome.min.css">

    <!-- Bootstrap core CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <!-- Custom styles for this template -->
    <link href="css/custom.css" rel="stylesheet">

</head>
<body>
    <section>

 <hr>

    <!-- add destination -->
    <form action="adm_dest.php" method="post" >
        <p><label for="addAnimal" class="form-label me-3">Ajout d'une destination :</label></p>
        <p>localisation</p>
        <p><input type="text" id="nom" name="name" required></p>




<?php
        // <select class="form-select me-3" name="addAnimal" id="addAnimal">
        //     <?php foreach ($zoo->getEnclosures() as $enclosure) { ?><?php
        //         <option value="<?php echo htmlspecialchars($enclosure->getName()); ">
        //             <?php echo htmlspecialchars($enclosure->getName()); ?><?php
        //         </option>
        //     <?php } ?><?php
        // </select>

?>

        <button type="submit" >Ajouter destination</button>
    </form>


    <?php

    $my_DR = new DestinationBaseRepository();
    $my_destinations = $my_DR->getAllDestination();

    if ($my_destinations) {
        foreach ($my_destinations as $destination) {
            echo '<P> destination  : ' . $destination->getLocation();
        }
    }else{
        echo '<P> pas de destination renseignée';
    }

    ?>


    </section>
