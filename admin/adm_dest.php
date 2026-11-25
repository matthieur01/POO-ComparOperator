<?php
include_once(__DIR__ . "/../Classes/Destination.php");
include_once(__DIR__ . "/../Repository/DestinationRepository.php");
include_once(__DIR__ . "/../Classes/DestinationBase.php");
include_once(__DIR__ . "/../Repository/DestinationBaseRepository.php");
include_once(__DIR__ . "/../Classes/TourOperator.php");
include_once(__DIR__ . "/../Repository/TourOperatorRepository.php");



if (!isset($_POST["id_TO"])) {
// si on arrive sur cette page sans avoir selectionné un Tour opérateur
//====================================================================================

  $my_TOR = new TourOperatorRepository();
  $my_TORs = $my_TOR->getAllTO();

?>
<P><a href="index.php"> retour </a>

  <form method="post" action="adm_dest.php">
      <P align="center">Sélectionner un tour operateur:</p>
      <select name="id_TO" id="id_TO">
          <optgroup label="Choisir un tour operateur">
            <?php
              foreach ($my_TORs as $myTO) {
                echo '<option value="'.$myTO->getId().'" name="'.$myTO->getname().'"> '.$myTO->getname().' </option>';
              }
            ?>
          </optgroup>
      </select>
      <input type="submit" name= "valider " value="Valider" />
  </form>
<?php

} else {

  $my_TOR = new TourOperatorRepository();
  $my_TORs = $my_TOR->getAllTO();
?>
  <form method="post" action="adm_dest.php">
        <P align="center">Changer de tour operateur:</p>
        <select name="id_TO" id="id_TO">
            <optgroup label="Choisir un tour operateur">
              <?php
                foreach ($my_TORs as $myTO) {
                  echo '<option value="'.$myTO->getId().'" name="'.$myTO->getname().'"> '.$myTO->getname().' </option>';
                }
              ?>
            </optgroup>
        </select>
        <input type="submit" name= "valider " value="Valider" />
    </form>
  <?php
// si on arrive sur cette page avec un Tour opérateur
//====================================================================================

  $idTO = $_POST["id_TO"];

  $my_TOR = new TourOperatorRepository();
  $my_TO = $my_TOR->getOneTOById($idTO);


// si on a choisi une destination à ajouté pour un Tour opérateur
//====================================================================================
      if (isset($_POST["id_Dest"])) {

        $idDest = $_POST["id_Dest"];
        $cost = $_POST["Prix"];

        $my_DBR = new DestinationBaseRepository();
        $my_destination = $my_DBR->getOneDestination($idDest);


        $my_DestR = new DestinationRepository();
        $my_DestR->createDestination($my_destination->getLocation(), $idTO, $idDest, $cost) ;


      }else{


        if (isset($_POST["new-cost"])) {

          $id = $_POST["ch-id"];
          $new_cost = $_POST["new-cost"];
          if (isset($_POST["suppression"])) {
            try {
              $My_DestR = new DestinationRepository();
              $My_DestR->suppressDest($id);
              echo "Suppression de la destination :  id : ".$id." effectué <br>";
            } catch (Exception $e) {
                echo "yop". $e->getMessage() ;
            }

          } else {
            

            try {
              $My_DestR = new DestinationRepository();
              $My_DestR->editDestination($id, $new_cost);
              echo "Modification de la destination : ".$new_cost.", id : ".$id." effectué <br>";
            } catch (Exception $e) {
              echo "yop". $e->getMessage() ;
            }
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


<?php
  $my_DestR = new DestinationBaseRepository();
  $my_Dests = $my_DestR->getAllDestination();

?>

  <form method="post" action="adm_dest.php">
      
      <input type="text" id="id_TO" name="id_TO" value="<?php echo $idTO // renvoi l'id du TO en cours ?>" style="display: none;">
      <label for="nom">Ajouter un destination destination :</label>
      <select name="id_Dest" id="id_1dest">
          <optgroup label="Choisir une destination">
            <?php
              foreach ($my_Dests as $mydest) {
                echo '<option value="'.$mydest->getId().'" name="'.$mydest->getLocation().'"> '.$mydest->getLocation().' </option>';
              }
            ?>
          </optgroup>
      </select>
      <label for="nom">Prix :</label>
      <input type="text" id="Prix" name="Prix" >

      <input type="submit" name= "valider " value="Valider" />
  </form>

  <table>
      <?php


      //$idTO definit plus tot


      $my_DR = new DestinationRepository();
      $my_destinations = $my_DR->getAllDestinationByTO($idTO);


      if ($my_destinations) {
          echo "<tr>";
          echo "<td>";
          echo 'Destinations pour  : '.$my_TO->getName().'</td>';
          echo "<td>";
          echo 'Prix';
          echo "</tr>";   

          foreach ($my_destinations as $destination) {
              echo "<tr>";
              echo '<td>' . $destination->getLocation();
              echo "</td>";
              echo '<td>' . $destination->getPrice();
              echo "</td>";

              echo "<td>";
      ?>
              <button type="button" id="toggle-btn-<?php echo $destination->getId()?>" aria-expanded="false" aria-controls="mon-formulaire-<?php echo $destination->getId()?>">
                  Modifier cette destination
              </button>




              <form action="adm_dest.php" method="post" id="mon-formulaire-<?php echo $destination->getId()?>" style="display: none;">
                <input type="text" id="id_TO" name="id_TO" value="<?php echo $idTO // renvoi l'id du TO en cours ?>" style="display: none;">
                <label for="nom">Nouveau Prix :</label>
                <input type="text" id="ch-id" name="ch-id" value="<?php echo $destination->getId()?>" style="display: none;">
                <input type="text" id="nom" name="new-cost">
                <input type="checkbox" id="check" name="suppression">
                
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
          echo '<P> Pas de destination renseignée pour ce tour opérateur';
      }

  ?>

    </table>
  </section>


<?php


}


