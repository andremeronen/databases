<?php
session_start();
if (isset($_SESSION['is_admin']) && $_SESSION['is_admin'] == true) {
} else {
    header('Location: login.php');
}

if (isset($_GET['logout'])) {
    session_destroy();
    header("Location: ../index.php");
    exit();
}

include("config.php");

if(isset($_GET['id'])){
    $id = $_GET['id'];

    $kustuta = "DELETE FROM cars WHERE id=$id";
    mysqli_query($yhendus, $kustuta);

    header("Location: admin.php");
    exit();
}


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

<a href="../index.php" class="btn btn-danger">Logout</a>

</div>
</nav>

<!-- content -->

<div class="container py-4">

<div class="row mb-3">

<div class="col-md-6">
<h3>Autod</h3>
<p class="text-secondary">Halda autorendi autode nimekirja.</p>
</div>

<div class="col-md-6 text-end">
<a href="add.php" class="btn btn-dark">
Lisa auto
</a>
</div>

</div>


<table class="table table-striped table-hover align-middle">

<thead>
<tr>
<th>Pilt</th>
<th>Auto</th>
<th>Mootor</th>
<th>Kütus</th>
<th>Hind</th>
<th>Kirjeldus</th>
<th>Tegevused</th>
</tr>
</thead>

<tbody>

<?php
while($auto = mysqli_fetch_assoc($tulemus)){
?>

<tr>

<td width="120">
<img src="https://loremflickr.com/100/80/<?php echo $auto['mark']; ?>" class="img-fluid rounded">
</td>

<td>
<b><?php echo $auto['mark']; ?></b><br>
<small class="text-secondary"><?php echo $auto['model']; ?></small>
</td>

<td><?php echo $auto['engine']; ?></td>
<td><?php echo $auto['fuel']; ?></td>
<td><?php echo $auto['price']; ?> € / päev</td>
<td><?php echo $auto['description']; ?></td>


<td>
<a href="edit.php?id=<?php echo $auto['id']; ?>" class="btn btn-outline-primary btn-sm">Muuda</a>


<a href="index.php?id=<?php echo $auto['id']; ?>" class="btn btn-outline-danger btn-sm" onclick="return confirm('Kas oled kindel, et tahad selle auto kustutada?')">Kustuta</a>
</td>
</tr>

<?php
}
?>

</tbody>
</table>
<button class="btn btn-dark">Lisa auto</button>
</div>
</body>
</html>
