<!-- Run these 2 queries in localhost/phpmyadmin  in sql panel -->


<!-- 1:- CREATE DATABASE IF NOT EXISTS crud
 
2 :- $sql = "CREATE TABLE IF NOT EXISTS `crud`.`crud` (`Sno` INT NOT NULL AUTO_INCREMENT , `Title` VARCHAR(255) NOT NULL , `Description` VARCHAR(255) NOT NULL , `Date` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP , PRIMARY KEY (`Sno`)) ENGINE = InnoDB"; -->

<?php
$insert = false;
$update = false;
$delete = false;


//Connecting to database

$username = "localhost";
$servername = "root";
$password = "";
$database = "crud";

$conn = mysqli_connect($username, $servername, $password, $database);          // Database connection

if (!$conn) {
    die("Connection was not made");
}


if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    if (isset($_POST['snoEdit'])) {
        //Updating the record
        $sno = $_POST['snoEdit'];
        $title = $_POST['titleEdit'];
        $desc = $_POST['descEdit'];

        $sql = "UPDATE `crud` SET `Title` = '$title', `Description` = '$desc' WHERE `crud`.`Sno` = '$sno'";
        $result = mysqli_query($conn, $sql);
        if ($result) {
            $update = true;
        }
    }

    if (isset($_POST['title']) && isset($_POST['desc'])) {
        $title = $_POST['title'];
        $desc = $_POST['desc'];
        $sql = "INSERT INTO `crud` (`Title`, `Description`) VALUES ('$title', '$desc')";
        $result = mysqli_query($conn, $sql);

        if ($result) {
            $insert = true;

        }
    }
}



//Deleting the record
if (isset($_POST['delsno'])) {
    $dsno = $_POST['delsno'];
    $sql = "DELETE FROM `crud` WHERE `crud`.`Sno` = '$dsno'";
    $result = mysqli_query($conn, $sql);
    $delete = true;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>iNotes(CRUD App)</title>

    <link rel="stylesheet" href="//cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">

</head>

<body>
    <?php
    if ($insert) {
        echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
        <strong>Success!</strong> Your note has been inserted successfully.
        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
      </div>";
    }
    if ($update) {
        echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
        <strong>Success!</strong> Your note has been updated successfully.
        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
      </div>";
    }
    if ($delete) {
        echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
        <strong>Success!</strong> Your note has been deleted successfully.
        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
      </div>";
    }
    ?>

    <div class="modal" id="myModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Note</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="index.php" method="post">
                        <input type="hidden" name="snoEdit" id="snoEdit">
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Title</label>
                            <input type="text" class="form-control" id="titleEdit" aria-describedby="emailHelp"
                                name="titleEdit">
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label">Description</label>
                            <input type="text" class="form-control" id="descEdit" name="descEdit">
                        </div>


                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal" id="myModaldel" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Delete Note</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="index.php" method="post">
                        <input type="hidden" name="delsno" id="delsno">
                        <p>Are you sure you want to delete this task?</p>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">OK</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <div class="form">
        <form action="/CRUD/index.php" method="post">
            <label for="title">Title</label>
            <input type="text " name="title" class="title">

            <label for="desc">Description</label>
            <textarea name="desc" id="description" class="desc" cols="30" rows="10"></textarea>
            <button class="btn2" type="submit">Add Note</button>
        </form>
    </div>

    <div class="table my-4">
        <table id="myTable" class="">
            <thead>
                <th>Sno</th>
                <th>Title</th>
                <th>Description</th>
                <th>Actions</th>
            </thead>
            <tbody>
                <?php
                $sql = "SELECT * FROM `crud`";
                $result = mysqli_query($conn, $sql);
                $sno = 0;
                while ($row = mysqli_fetch_assoc($result)) {
                    $sno = $sno + 1;
                    echo "<tr>
                        <td>" . $sno . "</td>
                        <td>" . $row['Title'] . "</td>
                        <td>" . $row['Description'] . "</td>
                        <td> <button class='edit' id = " . $row['Sno'] . ">Edit</button> <button class='delete' id = d" . $row['Sno'] . ">Delete</button> </td>
                        </tr>";
                }
                ?>
            </tbody>
        </table>
    </div>




    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>

    <script src="https://code.jquery.com/jquery-3.7.1.js"
        integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <script src="//cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

    <script>
        let table = new DataTable('#myTable');
    </script>
    <link rel="stylesheet" href="style.css">

    <script>
        //Updating the records
        var element = document.querySelectorAll(".edit");
        var len = element.length;
        for (let i = 0; i < len; i++) {
            element[i].addEventListener("click", function () {
                var title = document.querySelectorAll(".edit")[i].parentNode.parentNode.getElementsByTagName("td")[1].innerText;
                var description = document.querySelectorAll(".edit")[i].parentNode.parentNode.getElementsByTagName("td")[2].innerText;

                titleEdit.value = title;
                descEdit.value = description;
                snoEdit.value = document.querySelectorAll(".edit")[i].id;
                $("#myModal").modal("toggle");
            });
        }

        //Deleting the records

        var del = document.querySelectorAll(".delete");
        var deletelen = del.length;
        for (let i = 0; i < deletelen; i++) {
            document.querySelectorAll(".delete")[i].addEventListener("click", function () {
                delsno.value = document.querySelectorAll(".delete")[i].id.substr(1,);  // Setting the value of input field in deleting form.
                $("#myModaldel").modal("toggle");
            });
        }
    </script>
</body>

</html>