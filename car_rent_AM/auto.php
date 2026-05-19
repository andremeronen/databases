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

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $start_date = $_POST["start_date"] ?? "";
    $end_date   = $_POST["end_date"] ?? "";

    if ($start_date && $end_date) {

        $start = new DateTime($start_date);
        $end   = new DateTime($end_date);

        if ($start > $end) {
            $message = "<div class='alert alert-danger'>Kuupäevad on valed.</div>";
        } else {

            $days = $start->diff($end)->days + 1;
            $total = $days * $auto["price"];

            $user_id = $_SESSION["user_id"] ?? 1;
        }
    }
}
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
          <a class="nav-link active" aria-current="page" href="index.php">Avaleht</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="index.php">Autod</a>
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

      <form method="POST" class="border p-3 rounded bg-light">
                <div class="mb-2">
                    <label>Algus</label>
                    <input type="date" name="start_date" class="form-control" required>
                </div>
     <div class="mb-2">
                    <label>Lõpp</label>
                    <input type="date" name="end_date" class="form-control" required>
                </div>

                <button class="btn btn-success w-100 mt-2">Broneeri</button>
            </form>

            <a href="index.php" class="btn btn-secondary mt-2">Tagasi</a>
        </div>
<?php else: ?>
    <a href="login.php" class="btn btn-dark mt-3 w-100">Rentimiseks logi sisse</a>
<?php endif; ?>

</div>

</div>
</div>

</div>

</body>
</html>
