<?php
include("config.php");

if(isset($_POST['submit'])){

$mark = $_POST['mark'];
$model = $_POST['model'];
$engine = $_POST['engine'];
$fuel = $_POST['fuel'];
$price = $_POST['price'];
$status = $_POST['status'];
$desc = $_POST['description'];

$paring = "INSERT INTO cars (mark, model, engine, fuel, price, status, description)
VALUES ('$mark','$model','$engine','$fuel','$price','$status', '$desc')";

mysqli_query($yhendus, $paring);

header("Location: index.php");
}
?>

<!doctype html>
<html lang="et">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<title>Lisa auto</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

<div class="container py-5">

<h2>Lisa uus auto</h2>
<p class="text-secondary">Täida vorm, et lisada uus auto autorendi nimekirja.</p>

<form method="post">

<div class="mb-3">
<label class="form-label">Mark</label>
<input type="text" name="mark" class="form-control" required>
</div>

<div class="mb-3">
<label class="form-label">Mudel</label>
<input type="text" name="model" class="form-control" required>
</div>

<div class="mb-3">
<label class="form-label">Mootor</label>
<input type="text" name="engine" class="form-control">
</div>

<div class="mb-3">
<label class="form-label">Kütus</label>
<input type="text" name="fuel" class="form-control">
</div>

<div class="mb-3">
<label class="form-label">Hind (€ / päev)</label>
<input type="number" name="price" class="form-control">
</div>

<div class="mb-3">
<label class="form-label">Kirjeldus</label>
<input type="text" name="description" class="form-control">
</div>


<button type="submit" name="submit" class="btn btn-dark">
Lisa auto
</button>

<a href="index.php" class="btn btn-secondary">
Tagasi
</a>

</form>

</div>

</body>
</html>