<?php

include_once(__DIR__ . "/../Classes/Review.php");
include_once(__DIR__ . "/../Repository/ReviewRepository.php");
include_once(__DIR__ . "/../Classes/Destination.php");
include_once(__DIR__ . "/../Repository/DestinationRepository.php");
include_once(__DIR__ . "/../Classes/DestinationBase.php");
include_once(__DIR__ . "/../Repository/DestinationBaseRepository.php");
include_once(__DIR__ . "/../Classes/TourOperator.php");
include_once(__DIR__ . "/../Repository/TourOperatorRepository.php");


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
<P><a href="../Index.php"> Accueuil </a>

    <section>

 

<table>
<?php


if (isset($_POST["id_Dest"])) {

    $idDest = (int) $_POST["id_Dest"];
    $my_DBR= new DestinationBaseRepository() ;
    $my_destination= $my_DBR->getOneDestination($idDest);
    
    $my_DestR = new DestinationRepository() ;
    $my_Dests = $my_DestR->getAllTObyDest($idDest) ;
    $msgError = "";


    if ($my_Dests) {

        // si definit alors on a laissé un commentaire.
        if (isset($_POST["com_grade"])) {

            $idTOCom = (int) $_POST["id_TO"];
            $comName = $_POST["com_name"];
            $comCom = $_POST["com_com"];
            $comGrade = (int) $_POST["com_grade"];

            $my_RevR = new ReviewRepository();
            if ($my_RevR->canCommentForTO($comName,$idTOCom)) {
                try{
                    $my_RevR->addReview($comName,$comCom,$idTOCom);
                    $my_TOR = new TourOperatorRepository();
                    $my_TOR->addGrade($idTOCom,$comGrade);

                }catch(Exception $e){
                    $msgError .= $e->getMessage();
                }

            } else {

                $msgError .= "Un seul commentaire par utilisateur possible !";
            }

        }

echo $msgError;



        echo "<tr>";
        echo "<td>";
        echo ' vos future vacances pour : '. $my_destination->getLocation().'</td>';
        echo "</tr>";   

        foreach ($my_Dests as $my_Dest) {

            echo "<tr>";


            $my_TOR = new TourOperatorRepository() ;
            $my_TO = $my_TOR->getOneTOById($my_Dest->getTourOperatorId()) ;
            echo "<td>";
            echo $my_TO->getName(). ' Avec un note moyenne : '.$my_TO->getGrade().' (nb de vote : '.$my_TO->getGradeCount().')';
            echo "</td>";

            echo '<td> Au prix de : </td>';
            echo '<td>' . $my_Dest->getPrice();
            ?>

            <button type="button" id="toggle-btn-<?php echo $my_TO->getId()?>" aria-expanded="false" aria-controls="mon-formulaire-<?php echo $my_TO->getId()?>">
                Laisser un commentaire
            </button>
            <form action="visu_TO.php" method="post" id="mon-formulaire-<?php echo $my_TO->getId()?>" style="display: none;">
                <input type="text" id="id_TO" name="id_TO" value="<?php echo $my_TO->getId()?>" style="display: none;">
                <input type="text" id="id_Dest" name="id_Dest" value="<?php echo $idDest?>" style="display: none;">
                <label for="nom">Votre Nom :</label>
                <input type="text" id="nom" name="com_name" required>
                <label for="nom">Votre commentaire :</label>
                <textarea name="com_com" required></textarea>
                <label for="nom">Note :</label>
                <select name="com_grade" id="com_grade" required>
                    <optgroup label="Choisir une note">
                        <option value="1">1</option>;
                        <option value="2">2</option>;
                        <option value="3">3</option>;
                        <option value="4">4</option>;
                        <option value="5">5</option>;
                    </optgroup>
                </select>
                                
                <button type="submit">Envoyer</button>
            </form>

            <script>
            const btn<?php echo $my_TO->getId()?> = document.getElementById('toggle-btn-<?php echo $my_TO->getId()?>');
            const form<?php echo $my_TO->getId()?> = document.getElementById('mon-formulaire-<?php echo $my_TO->getId()?>');

            btn<?php echo $my_TO->getId()?>.addEventListener('click', () => {
                const isHidden<?php echo $my_TO->getId()?> = form<?php echo $my_TO->getId()?>.style.display === 'none';
                form<?php echo $my_TO->getId()?>.style.display = isHidden<?php echo $my_TO->getId()?> ? 'block' : 'none';
                btn<?php echo $my_TO->getId()?>.setAttribute('aria-expanded', String(isHidden<?php echo $my_TO->getId()?>));

            });
            </script>
            <?php
            echo "</td>";

            echo "<td>";



            echo "</td>";
            echo "</tr>";


        }
        
    }else{
        echo '<P> Pas de destination renseignée';
    }



}