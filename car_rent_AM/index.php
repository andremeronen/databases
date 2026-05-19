<?php 
include("config.php");

if (isset($_POST['logout'])) {
    session_destroy();
    header("Location: login.php");
    exit();
}
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
  </head>
  <body>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
  </body>
  <style>
    .hero {
      height: 300px;
    }
  </style>
</head>
</html>
<!-- navbar -->
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
      <form class="d-flex" role="search">
        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" name = "search"/>
        <button class="btn btn-outline-success" type="submit"><i class="bi bi-search"></i></button>
      </form>
    </div>
    <a href="regamine.php" class="nav-link">Registreeri</a>
    <a href="login.php" button type="button" class="btn btn-success">logi sisse</a>
  </div>
</nav>
<!-- navbar -->

  <!-- suure pildiga -->
<div class="container py-4">
      <div class="hero bg-body-tertiary p-4">
        <div class="row h-100">
          <div class="col-sm-6">
            <h1 class="fw-bold">Rendi<br>auto<br>soodsalt</h1>
            <p class="text-secondary">Lai valik autosid igaks olukorraks</p>
            <button class="btn btn-dark"> Vaata autosid</button>
          </div>
          <div class="col-sm-6">
        <img class="image-fluid h-100" src="https://loremflickr.com/600/250/car" alt="autopilt">
          </div>
        </div>
        </div>
      </div>
    </div>
<!-- suure pildiga -->

<?php
$paring = "SELECT * FROM cars"; 
if (isset ($_GET['search'])){
  $otsi = $_GET['search'];
  $paring .= " WHERE mark LIKE '%".$otsi."%'";
}

$paring .= " LIMIT 8";
$valjund = mysqli_query($yhendus, $paring);

// var_dump($valjund);

?>



<!-- autod -->
<div class="container">
   <?php
  // alert kast, kui autot ei leitud
    if ($result=mysqli_query($yhendus,$paring)){
      $rowcount=mysqli_num_rows($result);
      if ($rowcount == 0) {
       echo '
       <div class="alert alert-danger alert-dismissible fade show" role="alert">
        Otsitud autot ei leitud
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
       ';
      }
    }
  ?>


<div class="row">
    <?php
while($rida = mysqli_fetch_row($valjund)){ 
    ?>

    <div class="col-sm-3">
<div class="card my-4" style="width: 18rem;">
  <img src="https://loremflickr.com/600/350/<?php  echo $rida[1] ?>" class="card-img-top" alt="auto">
  <div class="card-body">
    <div class="row">
        <h5>   
  <?php  echo($rida[1]. "<br>");  ?>  
        </h5>

        <div class="col text-end"><i class="bi bi-suit-heart"></i></div>
    </div>

    <p class="card-text text-secondary "><?php  echo($rida[2]. "<br>");  ?>  </p>
    <p class="card-text ">
        Mootor:  <?php  echo($rida[3]. "<br>");  ?>   <br>
        Kütus:  <?php  echo($rida[7]. "<br>");  ?>  
        Hind:  <?php  echo($rida[8]. "<br>");  ?>  
    <a href="auto.php?id=<?php echo $rida[0]; ?>" class="btn btn-primary">Rendi</a>
  </div>
</div>
    </div>
<?php
}
?>
<!-- teine rida -->
<div class="row">


    <nav>
      <ul class="pagination p-4 justify-content-center">
        <li class="page-item disabled"> <span class="page-link link-dark border-secondary">Eelmine</span> </li>
        <li class="page-item active"> <span class="page-link bg-dark text-white border-dark">1</span></li>
        <li class="page-item"> <a class="page-link link-dark border-secondary" href="#">2</a> </li>
        <li class="page-item"> <a class="page-link link-dark border-secondary" href="#">3</a> </li>
        <li class="page-item"> <a class="page-link link-dark border-secondary" href="#">Järgmine</a> </li>
      </ul>
    </nav>
</nav>

</div>

</div>