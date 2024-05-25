<?php 

session_start();
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $value = null;
    foreach ($_SESSION['data_siswa'] as $key => $rinci) {
        if ($key == $id) {
            $value = $rinci;
        }
    }
    if($value == null) {
        header("Location: index.php");
        exit;
    }
}
if (isset($_POST['btn'])) {
    $nama = $_POST['nama'];
    $nis = $_POST['nis'];
    $rayon = $_POST['rayon'];
    $dataAwal = false;
    if (isset($_GET['id'])) {
        foreach ($_SESSION['data_siswa'] as $value) {
            if ($value['nis'] == $nis) {
                $dataAwal = true;
                break;
            }
        }
    }
    if ($dataAwal) {
        echo "<h1> NIS Sudah Terpakai!</h1>";
    }else {
        $_SESSION['data_siswa'][$id] = [
            "nama" => $nama,
            "nis" => $nis,
            "rayon" => $rayon
        ]; 
        header("Location: index.php");
        exit;
    }
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="responsive.css">
    <!-- Link font awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />

</head>
<body class="edit">

    <div class="container-edit">
        <form action="" method="POST" class="form-edit">
            <input type="text" name="nama" id="nama" value="<?= $value['nama']; ?>" class="input-edit" required>
            <input type="number" name="nis" id="nis" value="<?= $value['nis']; ?>" class="input-edit" required>
            <input type="text" name="rayon" id="rayon" value="<?=  $value['rayon']; ?>" class="input-edit" required>
            <div class="btn-edit">
                <button type="submit" name="btn" id="btn" class="btn-edit"><i class="fa-solid fa-rotate-left"></i>Update</button>
            </div>
            <a href="index.php" class="icon-print">Batal Edit</a>
            <p style="text-align: center; color: #fff;" >Jika anda ingin mengganti nama atau rayonnya anda harus mengganti NIS nya terlebih dahulu <br> Walau NIS anda sudah benar! <br> kerena NIS anda sebelumnya masih tersimpan di halaman awal  </p>
        </form>
       
    </div>

</body>
</html>