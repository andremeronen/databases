<?php
include("config.php");
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    
    $paring = "SELECT * FROM cars WHERE id = '$id'";
    $valjund = mysqli_query($yhendus, $paring);
    $auto = mysqli_fetch_assoc($valjund);

    if (!$auto) {
        die("Autot ei leitud!");
    }
} else {
    header("Location: index.php");
    exit();
}

if (isset($_POST['muuda_auto'])) {
    $mark = $_POST['mark'];
    $model = $_POST['model'];
    $engine = $_POST['engine'];
    $fuel = $_POST['fuel'];
    $price = $_POST['price'];
    $year = $_POST['year'];
    $transmission = $_POST['transmission']; 
    $seats = $_POST['seats'];
    $description = $_POST['description'];
    $status = $_POST['status'];
    
    $image = "pilt.jpg"; 

    $uuenda_paring = "UPDATE cars SET 
        mark='$mark', 
        model='$model', 
        engine='$engine', 
        fuel='$fuel', 
        price='$price', 
        image='$image', 
        year='$year', 
        transmission='$transmission', 
        seats='$seats', 
        description='$description', 
        status='$status' 
        WHERE id='$id'";

    if (mysqli_query($yhendus, $uuenda_paring)) {
        header("Location: index.php");
        exit();
    } else {
        echo "Viga muuutmisel: " . mysqli_error($yhendus);
    }
}
?>

<!doctype html>
<html lang="et">
<head>
    <meta charset="utf-8">
    <title>Muuda auto infot</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    
    <nav class="navbar navbar-expand-lg bg-white border-bottom mb-4 py-3">
        <div class="container">
            <a class="navbar-brand fw-bold text-dark" href="index.php">Autorent admin</a>
            <a href="logout.php" class="btn btn-outline-secondary btn-sm">Logi välja</a>
        </div>
    </nav>

    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h3 class="mb-0">Muuda auto: <?php echo $auto['mark'] . " " . $auto['model']; ?></h3>
            <a href="index.php" class="btn btn-outline-secondary btn-sm">Tagasi</a>
            
        </div>

        <div class="card shadow-sm">
            <div class="card-body p-4">
                <form method="POST" enctype="multipart/form-data">
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Mark</label>
                            <input type="text" name="mark" class="form-control" value="<?php echo $auto['mark']; ?>" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Mudel</label>
                            <input type="text" name="model" class="form-control" value="<?php echo $auto['model']; ?>" required>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Mootor</label>
                            <input type="text" name="engine" class="form-control" value="<?php echo $auto['engine']; ?>" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Kütus</label>
                            <select name="fuel" class="form-select" required>
                                <option value="Bensiin" <?php if($auto['fuel'] == 'Bensiin') echo 'selected'; ?>>Bensiin</option>
                                <option value="Diisel" <?php if($auto['fuel'] == 'Diisel') echo 'selected'; ?>>Diisel</option>
                                <option value="Elekter" <?php if($auto['fuel'] == 'Elekter') echo 'selected'; ?>>Elekter</option>
                                <option value="Hübriid" <?php if($auto['fuel'] == 'Hübriid') echo 'selected'; ?>>Hübriid</option>
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Aasta</label>
                            <input type="number" name="year" class="form-control" value="<?php echo $auto['year']; ?>" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Käigukast</label>
                            <select name="transmission" class="form-select" required>
                                <option value="Automaat" <?php if($auto['transmission'] == 'Automaat') echo 'selected'; ?>>Automaat</option>
                                <option value="Manuaal" <?php if($auto['transmission'] == 'Manuaal') echo 'selected'; ?>>Manuaal</option>
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Istmete arv</label>
                            <input type="number" name="seats" class="form-control" value="<?php echo $auto['seats']; ?>" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Staatus</label>
                            <select name="status" class="form-select" required>
                                <option value="vaba" <?php if($auto['status'] == 'vaba') echo 'selected'; ?>>Vaba</option>
                                <option value="renditud" <?php if($auto['status'] == 'renditud') echo 'selected'; ?>>Renditud</option>
                                <option value="hoolduses" <?php if($auto['status'] == 'hoolduses') echo 'selected'; ?>>Hoolduses</option>
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Hind (€ / päev)</label>
                            <input type="number" name="price" class="form-control" value="<?php echo $auto['price']; ?>" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Auto pilt (praegu: <?php echo $auto['image']; ?>)</label>
                            <input type="file" name="pilt" class="form-control">
                        </div>
                    </div>

                    <div class="row mb-4">
                        <div class="col-md-12">
                            <label class="form-label">Kirjeldus</label>
                            <textarea name="description" class="form-control" rows="2" required><?php echo $auto['description']; ?></textarea>
                        </div>
                    </div>

                    <hr>
                    
                    <div class="d-flex gap-2">
                        <button type="submit" name="muuda_auto" class="btn btn-dark">Salvesta muudatused</button>
                        <a href="index.php" class="btn btn-outline-secondary">Tühista</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

</body>
</html>