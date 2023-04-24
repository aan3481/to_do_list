<?php
session_start();

if (!isset($_SESSION['is_login'])) {
    header("Location: login.php");
    exit;
}


?>
<!doctype html>
<html lang="en">


<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>ToDo List MyApp</title>
    <link rel="stylesheet" href="style.css">
    <!-- bootsrtap icon -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.4/font/bootstrap-icons.css">
</head>

<body>
    <br><br><br>
    <h1 class="text-center">ToDo List MyApp</h1>
    <p class="text-center">Created by &copy; <a href="https://www.instagram.com/farhansawal22_">Farhan Syawal</a></p>

    <form action="data.php" method="POST" class="form-floating  w-50 m-auto">
        <input type="text" class="form-control" name="title" id="todolist" placeholder="Mau ap hari ini?" autocomplete="off">
        <label for="todolist">Mau apa hari ini?</label>
        <button class="btn btn-success mt-2 d-flex ms-auto" name="submit">Add Task</button>
        <a class="btn btn-secondary btn mt-5" href="logout.php" style="float: right;">Logout</a>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="status" value="Selesai" id="selesai">
            <label class="form-check-label" for="selesai">
                Selesai
            </label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="status" value="Belum Selesai" id="belumselesai">
            <label class="form-check-label" for="belumselesai">
                Belum Selesai
            </label>
        </div>
    </form>
    <hr class="bg-dark w-50 m-auto mt-5 mb-5">

    <hr class="dark w-50 m-auto">

    <div class="card w-50 m-auto">
        <div class="card-header">
            ToDo List
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table m-auto text-center">
                    <tr>
                        <th>#</th>
                        <th>Judul</th>
                        <th>Keterangan</th>
                        <th>Aksi</th>
                    </tr>
                    <?php
                    include 'konfig.php';
                    $no = 1;
                    $data = mysqli_query($koneksi, "SELECT * FROM todolist");
                    while ($d = mysqli_fetch_assoc($data)) {
                    ?>
                        <tr>
                            <td><?php echo $no++; ?></td>
                            <td><?php echo $d['title'] ?></td>
                            <td><?php echo $d['status']; ?></td>
                            <td>
                                <!-- Button trigger modal -->

                                <button type="button" class="btn btn-warning btn-block" data-bs-toggle="modal" data-bs-target="#modalEdit<?php echo $d['id']; ?>"><i class="bi bi-pencil-square"></i>
                                    Edit
                                </button>
                                <a class="btn btn-danger btn-block" href="delete.php?id=<?php echo $d['id'] ?>"><i class="bi bi-x-square"> Delete</i></a>
                                <!-- Modal -->
                                <form action="" method="POST">
                                    <div class="modal fade" id="modalEdit<?php echo $d['id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Edit ToDo List</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <input type="text" class="form-control" value="<?php echo $d['title']; ?>" name="title" id="todolist" placeholder="Mau ap hari ini?" autocomplete="off">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" <?php if ($d['status'] == 'Selesai') echo 'checked' ?> name="status" value="Selesai" id="selesai">
                                                        <label class="form-check-label" for="selesai">
                                                            Selesai
                                                        </label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="status" <?php if ($d['status'] == 'Belum Selesai') echo 'checked' ?> value="Belum Selesai" id="belumselesai">
                                                        <label class="form-check-label" for="belumselesai">
                                                            Belum Selesai
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <input type="hidden" value="<?php echo $d['id']; ?>" name="id">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                    <button type="submit" name="update" class="btn btn-primary">Save changes</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                                <?php
                                if (isset($_POST['update'])) {
                                    $id = $_POST['id'];

                                    $title = $_POST['title'];
                                    $status = $_POST['status'];
                                    $sql = "UPDATE todolist SET title = '$title', status = '$status' WHERE id = '$id'";

                                    if ($koneksi->query($sql) === false) {
                                        trigger_error("Gagal" . $sql . "Error :" . $koneksi->error . E_USER_ERROR);
                                    } else {
                                        echo "<meta http-equiv='refresh' content=0.1; url=?page-index>";
                                    }
                                }
                                ?>
                            </td>
                        </tr>
                    <?php } ?>
                </table>
            </div>
        </div>

    </div>


    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    -->
</body>

</html>