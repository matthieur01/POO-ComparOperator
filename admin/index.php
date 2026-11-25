<?php

if (isset($_GET[""])){

    include_once(__DIR__ . "/../admin/adm_dest.php");
}
elseif (isset($_GET[""])){
    include_once(__DIR__ . "/../admin/adm_TO.php");

}else{

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

    <P><a href="adm_dest_base.php"> Gérer les destinations </a>

    <P><a href="adm_TO.php"> Gerer les Tours opérateurs</a>

    <P><a href="adm_dest.php"> Gérer les Associations 'Opérateurs/Destinations' </a>


    </section>
<body>


<?php
}