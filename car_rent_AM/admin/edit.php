<?php
include("config.php");

/* id URList */

$id = $_GET['id'];

/* auto päring */

$paring = "SELECT * FROM cars WHERE id=$id";
$tulemus = mysqli_query($yhendus, $paring);
$auto = mysqli_fetch_assoc($tulemus);

/* vormi salvestamine */

if(isset($_POST["save"])){

    $mark = $_POST["mark"];
    $model = $_POST["model"];
    $engine = $_POST["engine"];
    $fuel = $_POST["fuel"];
    $price = $_POST["price"];
    $status = $_POST["status"];

    $update = "UPDATE cars SET
    mark='$mark';
    model='$model';
    engine='$engine';
    fuel='$fuel';
    price='$price;
    status='$status;
    WHERE id=$id";

    mysqli_query($yhendus, $update);

    header("Location: admin.php");
    exit();
}
?>

<!doctype html>
<html lang="et">
<head>
<meta charset="utf-8">
<title>Muuda autot</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

<div class="container py-4">

<h3>Muuda autot</h3>

<form method="post">

<div class="mb-3">
<label>Mark</label>
<input type="text" name="mark" class="form-control" value="<?php echo $auto["mark"]; ?>">
</div>

<div class="mb-3">
<label>Mudel</label>
<input type="text" name="model" class="form-control" value="<?php echo $auto["model"]; ?>">
</div>

<div class="mb-3">
<label>Mootor</label>
<input type="text" name="engine" class="form-control" value="<?php echo $auto["engine"]; ?>">
</div>

<div class="mb-3">
<label>Kütus</label>
<input type="text" name="fuel" class="form-control" value="<?php echo $auto["fuel"]; ?>">
</div>

<div class="mb-3">
<label>Hind</label>
<input type="number" name="price" class="form-control" value="<?php echo $auto["price"]; ?>">
</div>

<div class="mb-3">
<label>Kirjeldus</label>
<textarea name="status" class="form-control"><?php echo $auto["status"]; ?></textarea>
</div>

<button type="submit" name="save" class="btn btn-dark">Salvesta</button>
<a href="index.php" class="btn btn-secondary">Tagasi</a>

</form>

</div>

</body>
</html>