<?php
session_start();
include("config.php");

if(!isset($_GET["id"])){
    die("Autot ei leitud");
}

$id = $_GET["id"];

$paring = "SELECT * FROM cars WHERE id = $id";
$tulemus = mysqli_query($yhendus, $paring);
$auto = mysqli_fetch_assoc($tulemus);
?>

<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?php echo $auto["mark"]; ?></title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <nav class="navbar navbar-expand-lg bg-body-tertiary border-bottom">
  <div class="container">
    <a class="navbar-brand fw-bold" href="#">Autorent</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="#">Avaleht</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Autod</a>
        </li>
         <li class="nav-item">
          <a class="nav-link active" aria-disabled="true">Hinnad</a>
        </li>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="#">Action</a></li>
            <li><a class="dropdown-item" href="#">Another action</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="#">Something else here</a></li>
          </ul>
        </li>
        <li class="nav-item">
          <a class="nav-link active" aria-disabled="true">Kontakt</a>
        </li>

      </ul>
    </div>
  </div>
</nav>

<div class="container py-5">

<div class="card p-4 shadow">
<div class="row">

<div class="col-md-6">
<img src="https://loremflickr.com/600/400/<?php echo $auto["mark"]; ?>" class="img-fluid rounded">
</div>

<div class="col-md-6">

<h2><?php echo $auto["mark"]; ?></h2>
<p class="text-secondary"><?php echo $auto["model"]; ?></p>

<hr>

<p><b>Mootor:</b> <?php echo $auto["engine"]; ?></p>
<p><b>Kütus:</b> <?php echo $auto["fuel"]; ?></p>
<p><b>Käigukast:</b> <?php echo $auto["transmission"]; ?></p>
<p><b>Kohad:</b> <?php echo $auto["seats"]; ?></p>

<h3 class="mt-4"><?php echo $auto["price"]; ?> € / päev</h3>

<?php if(isset($_SESSION["username"])): ?>
    <a href="rentimine.php?id=<?php echo $auto["id"]; ?>" class="btn btn-success mt-3 w-100">Rendi auto</a>
<?php else: ?>
    <a href="login.php" class="btn btn-dark mt-3 w-100">Rentimiseks logi sisse</a>
<?php endif; ?>

</div>

</div>
</div>

</div>

</body>
</html>
