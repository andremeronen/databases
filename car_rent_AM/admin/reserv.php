<?php
include("config.php");

/* kustutamine */

if(isset($_GET['id'])){
    $id = $_GET['id'];

    $kustuta = "DELETE FROM cars WHERE id=$id";
    mysqli_query($yhendus, $kustuta);

    header("Location: admin.php");
    exit();
}

/* autode päring */

$paring = "SELECT * FROM cars";
$tulemus = mysqli_query($yhendus, $paring);
?>

<!doctype html>
<html lang="et">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<title>Autorent admin</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">

</head>
<body>

<!-- navbar -->
<nav class="navbar navbar-expand-lg bg-light border-bottom">
<div class="container">

<a class="navbar-brand fw-bold">Autorent admin</a>

<ul class="navbar-nav me-auto">
<li class="nav-item">
<a class="nav-link active" href="index.php">Autod</a>
</li>

<li class="nav-item">
<a class="nav-link" href="reserv.php">Reserveeringud</a>
</li>

<li class="nav-item">
<a class="nav-link">Kasutajad</a>
</li>
</ul>

<a href="index.php" class="btn btn-secondary">Logout</a>

</div>
</nav>