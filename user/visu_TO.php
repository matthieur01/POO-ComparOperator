<?php

echo '<pre>';
print_r($_POST);
echo '</pre>';

if (isset($_POST["id_Dest"])) {

    $idDest = $_POST["id_Dest"];
    $my_DBR= new DestinationBaseRepository() ;
    $my_destination= $my_DBR->getOneDestination($idDest)
    
    $my_DestR = new DestinationRepository() ;
    $my_ToByDest =



    if ($my_TOs) {
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



}