<?php
include_once(__DIR__ . "/../Classes/TourOperator.php");
include_once(__DIR__ . "/../Repository/TourOperatorRepository.php");



if (isset($_POST["name"])) {

    $name = $_POST["name"];
    $addresse_web = $_POST["link"];
    $isPremium = false;
    
    if (isset($_POST["isPremium"])){
        $isPremium = true;
    }

    try {
        $My_DBR = new TourOperatorRepository();
        $My_DBR->createTourOperator($name, $addresse_web, $isPremium);
    } catch (Exception $e) {
        echo "yop". $e->getMessage() ;
    }
}


if (isset($_POST["new-name"])) {

  $id = $_POST["ch-id"];
  $new_name = $_POST["new-name"];
  $new_web = $_POST["new-web"];
  $new_premium = false;
  if (isset($_POST["new-premium"])){
        $new_premium = true;
    }

  if (isset($_POST["suppression"])) {
    try {
      $My_DBR = new TourOperatorRepository();
      $My_DBR->suppressTourOperator($id);
      echo "Suppression de la destination : ".$new_name.", id : ".$id." effectué <br>";
    } catch (Exception $e) {
        echo "yop". $e->getMessage() ;
    }

  } else {
    try {
      $My_DBR = new TourOperatorRepository();
      $My_DBR->editTourOperator($id, $new_name, $new_web, $new_premium);
      echo "Modification de la destination : ".$new_name.", id : ".$id." effectué <br>";
    } catch (Exception $e) {
      echo "yop". $e->getMessage() ;
    }
  }
}







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
<P><a href="Index.php"> retour </a>

    <section>

 <hr>

    <!-- add destination -->
    <form action="adm_TO.php" method="post" >
        <p><label for="addTO" class="form-label me-3">Ajout d'un tour opérateur :</label></p>
        <table>
            <tr>
                <td>Nom du TO</td>
                <td>Adresse web</td>
                <td>Est premium</td>
            </tr>
            <tr>
                <td><input type="text" id="nom" name="name" required></td>
                <td><input type="text" id="Link" name="link" ></td>
                <td><input type="checkbox" id="ch-premium" name="isPremium" ></td>
            </tr>
            <tr>
                <td><button type="submit" >Ajouter le Tour opérateur</button></td>
            </tr>
        </table>
    </form>

<table>
    <?php

    $my_TOR = new TourOperatorRepository();
    $my_TOs = $my_TOR->getAllTO();

    if ($my_TOs) {
        echo "<tr>";
        echo "<td> destination  : </td>";
        echo "<td> adresse web  : </td>";
        echo "<td> nombre de vote  : </td>";
        echo "<td> Somme des votes  : </td>";
        echo "<td> Moyenne des votes  : </td>";
        echo "<td> Client 'Premium'  : </td>";
        echo "</tr>";   

        foreach ($my_TOs as $TourOperator) {
            echo "<tr>";
            echo '<td>' . $TourOperator->getName();
            ?>
                <form method="post" action="adm_dest.php">
                    <input type="text" id="id_TO" name="id_TO" value="<?php echo $TourOperator->getId() // renvoi l'id du TO en cours ?>" style="display: none;">
                    <input type="submit" name= "valider" value="Gerer les destinations" />
                </form>
            <?php
            echo "</td>";
            echo '<td>' . $TourOperator->getLink();
            echo "</td>";
            echo '<td>' . $TourOperator->getGradeCount();
            echo "</td>";
            echo '<td>' . $TourOperator->getGradeTotal();
            echo "</td>";
            echo '<td>' . $TourOperator->getGrade();
            echo "</td>";
            echo '<td>' . $TourOperator->getPremium();
            echo "</td>";

            echo "<td>";
?>
            <button type="button" id="toggle-btn-<?php echo $TourOperator->getId()?>" aria-expanded="false" aria-controls="mon-formulaire-<?php echo $TourOperator->getId()?>">
                Modifier ce Tour Operateur
            </button>




            <form action="adm_TO.php" method="post" id="mon-formulaire-<?php echo $TourOperator->getId()?>" style="display: none;">
            <input type="text" id="ch-id" name="ch-id" value="<?php echo $TourOperator->getId()?>" style="display: none;">
            <label for="nom">Nouveau nom :</label>
            <input type="text" id="nom" name="new-name">
            <label for="nom">Nouveau web :</label>
            <input type="text" id="web" name="new-web">
            <label for="nom">Nouveau premium :</label>
            <input type="checkbox" id="chk_premium" name="new-premium">
            <label for="nom">supression (irreversible)</label>
            <input type="checkbox" id="check" name="suppression">
            
            <button type="submit">Envoyer</button>
            </form>

            <script>
            const btn<?php echo $TourOperator->getId()?> = document.getElementById('toggle-btn-<?php echo $TourOperator->getId()?>');
            const form<?php echo $TourOperator->getId()?> = document.getElementById('mon-formulaire-<?php echo $TourOperator->getId()?>');

            btn<?php echo $TourOperator->getId()?>.addEventListener('click', () => {
                const isHidden<?php echo $TourOperator->getId()?> = form<?php echo $TourOperator->getId()?>.style.display === 'none';
                form<?php echo $TourOperator->getId()?>.style.display = isHidden<?php echo $TourOperator->getId()?> ? 'block' : 'none';
                btn<?php echo $TourOperator->getId()?>.setAttribute('aria-expanded', String(isHidden<?php echo $TourOperator->getId()?>));

            });
            </script>



<?php


            echo "</td>";
            echo "</tr>";


        }
        
    }else{
        echo '<P> Pas de Tour opérateur de renseigné';
    }

    ?>

</table>
    </section>
