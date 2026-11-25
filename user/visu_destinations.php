<?php
include_once(__DIR__ . "/../Classes/DestinationBase.php");
include_once(__DIR__ . "/../Repository/DestinationBaseRepository.php");

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
            ?>
                <form method="post" action="user/visu_TO.php">
                    <input type="text" id="id_Dest" name="id_Dest" value="<?php echo $destination->getId() // renvoi l'id de la destination en cours ?>" style="display: none;">
                    <input type="submit" name= "valider" value="Choisir cette destination" />
                </form>
            <?php
            echo "</td>";

            echo "<td>";



            echo "</td>";
            echo "</tr>";


        }
        
    }else{
        echo '<P> Pas de destination renseignée';
    }

    ?>

</table>
    </section>
