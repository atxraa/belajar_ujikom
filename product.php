<?php
require 'koneksi.php';

if (isset($_POST['simpan'])) {
    $name = $_POST['name'];
    $price = $_POST['price'];
    $stock = $_POST['stock'];

    // Check if the 'image' field is set and not empty
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $image = $_FILES['image']['name'];
        $tmp = $_FILES['image']['tmp_name'];

        $path = 'assets/img/product/' . $image;

        if (move_uploaded_file($tmp, $path)) {
            $simpan = $conn->query("INSERT INTO products (name, price, stock, image) VALUES ('$name', '$price', '$stock', '$image')");
            if ($simpan) {
                echo "<script>alert('Data berhasil disimpan'); location.replace('product.php');</script>";
            } else {
                echo "<script>alert('Data gagal disimpan'); location.replace('product.php');</script>";
            }
        } else {
            echo "<script>alert('Gagal upload gambar'); location.replace('product.php');</script>";
        }
    } else {
        // Handle the case when the 'image' field is not set or empty
        echo "<script>alert('Mohon pilih gambar'); location.replace('product.php');</script>";
    }
}

$product = $conn->query("SELECT * FROM products");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>
<section class="product">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 card border-0 shadow rounded-2">
                <div class="card-body">
                    <h3 class="text-center">Tambah Produk</h3>
                    <form method="post" enctype="multipart/form-data">
                        <div class="row justify-content-center">
                            <div class="col-lg-6">
                                <label class="form-label" for="name">Name</label>
                                <input class="form-control" type="text" name="name" id="name"><br>
                                <label class="form-label" for="price">Harga</label>
                                <input class="form-control" type="text" name="price" id="price"><br>
                            </div>
                            <div class="col-lg-6">
                                <label class="form-label" for="stock">Stok</label>
                                <input class="form-control" type="text" name="stock" id="stock"><br>
                                <label class="form-label" for="image">Image</label>
                                <input class="form-control" type="file" name="image" id="image"><br>
                            </div>
                        </div>
                        <button type="submit" name="simpan" class="btn btn-primary btn-sm mt-4">Submit</button>
                    </form>
                    <table class="mt-5 table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nama</th>
                                <th>Harga</th>
                                <th>Stok</th>
                                <th>Image</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            foreach ($product as $products) { ?>
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td><?= $products['name']; ?></td>
                                    <td><?= $products['price']; ?></td>
                                    <td><?= $products['stock']; ?></td>
                                    <td><img src="assets/img/product/<?= $products['image']; ?>" alt="" width="10%" height="auto"></td>
                                    <td>
                                        <a href="edit.php?id=<?= $products['id']; ?>" class="btn btn-warning text-white btn-sm">Edit</a>
                                        <form action="" method="POST">
                                            <input type="hidden" name="id" value="<?= $products['id']; ?>">
                                            <button type="submit" name="delete" class="btn btn-danger text-white btn-sm">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                        