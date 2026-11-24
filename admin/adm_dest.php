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

  <style>
    .table-wrapper {
      overflow-x: auto; /* Scroll horizontal sur petit écran */
      margin: 24px 0;
    }

    table {
      width: 100%;
      border-collapse: collapse; /* Fusionne les bordures des cellules */
      font-family: Arial, sans-serif;
      font-size: 15px;
    }

    caption {
      caption-side: top;
      font-weight: bold;
      margin-bottom: 10px;
      text-align: left;
    }

    th, td {
      border: 1px solid #d1d5db;
      padding: 10px 14px;
      text-align: left;
    }

    thead th {
      background-color: #1f2937;
      color: #ffffff;
    }

    tbody tr:nth-child(even) {
      background-color: #f9fafb; /* Lignes alternées */
    }

    tbody tr:hover {
      background-color: #f3f4f6;
    }

    tfoot td {
      font-weight: bold;
      background-color: #e5e7eb;
    }
  </style>
</head>


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

<table>
    <?php

    $my_DR = new DestinationBaseRepository();
    $my_destinations = $my_DR->getAllDestination();

    if ($my_destinations) {
        echo "<tr>";
        echo "<td>";
        echo 'destination  : </td>';
        echo "</tr>";   

        foreach ($my_destinations as $destination) {
            echo "<tr>";
            echo '<td>' . $destination->getLocation();
            echo "</td>";

            echo "<td>";
?>
            <button type="button" id="toggle-btn-<?php echo $destination->getId()?>" aria-expanded="false" aria-controls="mon-formulaire-<?php echo $destination->getId()?>">
                Modifier cette destination
            </button>




            <form action="adm_dest.php" method="post" id="mon-formulaire-<?php echo $destination->getId()?>" style="display: none;">
            <label for="nom">Nom :</label>
            <input type="text" id="nom" name="new-name" required>
            
            <button type="submit">Envoyer</button>
            </form>

            <script>
            const btn<?php echo $destination->getId()?> = document.getElementById('toggle-btn-<?php echo $destination->getId()?>');
            const form<?php echo $destination->getId()?> = document.getElementById('mon-formulaire-<?php echo $destination->getId()?>');

            btn<?php echo $destination->getId()?>.addEventListener('click', () => {
                const isHidden<?php echo $destination->getId()?> = form<?php echo $destination->getId()?>.style.display === 'none';
                form<?php echo $destination->getId()?>.style.display = isHidden<?php echo $destination->getId()?> ? 'block' : 'none';
                btn<?php echo $destination->getId()?>.setAttribute('aria-expanded', String(isHidden<?php echo $destination->getId()?>));

            });
            </script>



<?php


            echo "</td>";
            echo "</tr>";


        }
        
    }else{
        echo '<P> pas de destination renseignée';
    }

    ?>

</table>
    </section>
