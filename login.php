<?php
session_start();
include 'konfig.php';

if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM login WHERE username='$username' AND password='$password'";
    $result = mysqli_query($koneksi, $sql);
    if ($result->num_rows > 0) {
        $row = mysqli_fetch_assoc($result);
        $_SESSION['username'] = $row['username'];
        $_SESSION['password'] = $row['password'];
        $_SESSION['is_login'] = true;
        header("Location: index.php");
        return;
    } else {
        echo "<script>alert('User atau password Anda salah. Silahkan coba lagi!')</script>";
    }
}


?>
<!DOCTYPE html>
<html>

<head>
    <title>Login Form</title>
    <!-- Bootstrap 5 CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.2/css/bootstrap.min.css">
    <style>
        /* Style untuk form */
        .form-container {
            background-color: white;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
            border-radius: 10px;
            padding: 30px;
            margin-top: 100px;
        }

        .form-container h2 {
            text-align: center;
            margin-bottom: 30px;
        }

        .form-container label {
            font-weight: 600;
            margin-bottom: 5px;
        }

        .form-container input[type="username"],
        .form-container input[type="password"] {
            border: none;
            border-radius: 5px;
            padding: 10px;
            margin-bottom: 20px;
            width: 100%;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
        }

        .form-container input[type="submit"] {
            background-color: #2ecc71;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .form-container input[type="submit"]:hover {
            background-color: #27ae60;
        }

        /* Style untuk centering form */
        .center-container {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }
    </style>
</head>

<body>
    <div class="center-container">
        <!-- Form Login -->
        <div class="form-container">
            <h2>Login ToDo List</h2>
            <p class="text-center">Created by &copy; Farhan Syawal</p>
            <form method="POST" action="" autocomplete="off">
                <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input type="username" name="username" class="form-control" id="username" aria-describedby="username" autofocus>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" name="password" class="form-control" id="password">
                </div>
                <button type="submit" name="submit" class="btn btn-primary">Login</button>
            </form>
        </div>
    </div>

    <!-- Bootstrap 5 JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.2/js/bootstrap.min.js"></script>
</body>

</html>