<?php

include 'koneksi.php';

if (isset($_POST['login'])){
    $username = $_POST['username'];
    $password = $_POST['password'];

    $user = $conn->query("SELECT * FROM users WHERE username = '$username' AND password = '$password'");
    $cek = mysqli_num_rows($user);
    
    // var_dump($cek);
    // die;
    if ($cek > 0){
        echo "<script>alert('Login berhasil')
        location.replace('product.php')</script>";
        $_SESSION['user'] = $user->fetch_assoc();
    } else {
        echo "<script>alert('login gagal')
        location.replace('')</script>";
        // set_message("danger", "Username / password salah");
        // header("Location: index.php");
    }
}

?>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<div class="container">
    <div class="row justify-content-center align-items-center py-5" style="min-height: 100vh;">
        <div class="col-md-6 col-lg-4">

            <div class="card bg-light mb-5">
                <div class="card-body">
                    <form action="" method="post">
                        <div class="mb-3">
                            <label for="username" class="form-label">Username</label>
                            <input type="text" class="form-control" id="username" name="username" required autocomplete="off">
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>
                        <Button class="btn btn-primary w-100 mt-3" type="submit" name="login">Login</Button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>