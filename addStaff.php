<?php
require_once("db.php");

if (isset($_POST['sub'])) {
    $fullname = $_POST['fullname'];
    $fathername = $_POST['fathername'];
    $gfathername = $_POST['gfathername'];
    $photo = $_POST['photo'];
    $tazkira = $_POST['tazkira'];
    $gender = $_POST['gender'];
    $dob = $_POST['dob'];
    $post = $_POST['post'];
    $salary = $_POST['salary'];
    $date = $_POST['date'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];

    try {

        if ($fullname != "" && $fathername != "" && $gfathername != "" && $photo != "" && $tazkira != "" && $gender != "" && $dob != "" && $post != "" && $salary != "" && $date != "" && $phone != "" && $address != "") {
            $sql = "INSERT INTO staff SET fullname=?, fathername=?, gfathername=?, photo=?, tazkira=?, gender=?, dob=?, post=?, salary=?, `date`=?, phone=?, `address`=?";
            $query = $conn->prepare($sql);
            $query->bindValue(1, $fullname);
            $query->bindValue(2, $fathername);
            $query->bindValue(3, $gfathername);
            $query->bindValue(4, $photo);
            $query->bindValue(5, $tazkira);
            $query->bindValue(6, $gender);
            $query->bindValue(7, $dob);
            $query->bindValue(8, $post);
            $query->bindValue(9, $salary);
            $query->bindValue(10, $date);
            $query->bindValue(11, $phone);
            $query->bindValue(12, $address);
            $query->execute();
        }
    } catch (PDOException $e) {
    }
}
?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>addStaff</title>
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/style.css">
</head>

<body style="background-color: lightblue;">

    <div class="container-fluid">
        <div class="row">

            <h3 class="w-100 bg-primary text-white p-3 text-center">???????? ?????? ?????? ????????????????</h3>

            <form method="POST" class="form col-8 offset-2 d-flex flex-wrap justify-content-center mt-3" dir="rtl">

                <div class="col-5 offset-1 mb-3">
                    <label for="fullname" class="float-right">??????</label>
                    <input type="text" id="fullname" placeholder="??????" class="form-control" name="fullname">
                </div>

                <div class="col-5 mb-3">
                    <label for="fathername" class="float-right">?????? ??????</label>
                    <input type="text" id="fathername" placeholder="?????? ??????" class="form-control" name="fathername">
                </div>

                <div class="col-5 offset-1 mb-3">
                    <label for="gfathername" class="float-right">?????? ??????????????</label>
                    <input type="text" id="gfathername" placeholder="?????? ??????????????" class="form-control" name="gfathername">
                </div>

                <div class="col-5 mb-3">
                    <label for="photo" class="float-right">??????</label>
                    <input type="file" id="photo" placeholder="??????" class="form-control" name="photo">
                </div>

                <div class="col-5 offset-1 mb-3">
                    <label for="tazkira" class="float-right">???????? ??????????</label>
                    <input type="number" id="tazkira" placeholder="???????? ??????????" class="form-control" name="tazkira">
                </div>

                <div class="col-5 mb-3">
                    <label for="gender" class="float-right">??????????</label>
                    <select name="gender" id="gender" class="form-control">
                        <option>??????</option>
                        <option>????</option>
                    </select>
                </div>

                <div class="col-5 offset-1 mb-3">
                    <label for="dob" class="float-right">?????????? ????????</label>
                    <input type="date" id="dob" placeholder="?????????? ????????" class="form-control" name="dob">
                </div>

                <div class="col-5 mb-3">
                    <label for="post" class="float-right">??????????</label>
                    <input type="text" id="post" placeholder="??????????" class="form-control" name="post">
                </div>

                <div class="col-5 offset-1 mb-3">
                    <label for="salary" class="float-right">????????</label>
                    <input type="number" id="salary" placeholder="????????" class="form-control" name="salary">
                </div>

                <div class="col-5 mb-3">
                    <label for="date" class="float-right">??????????</label>
                    <input type="date" id="date" placeholder="??????????" class="form-control mt-3" name="date">
                </div>

                <div class="col-5 offset-1 mb-3">
                    <label for="phone" class="float-right">????????????</label>
                    <input type="number" id="phone" placeholder="????????????" class="form-control mt-3" name="phone">
                </div>

                <div class="col-5 mb-2">
                    <label for="address" class="float-right">????????</label>
                    <textarea name="address" id="address" placeholder="????????" class="form-control mt-3" rows="1"></textarea>
                </div>

                <div class="col-8" dir="ltr">
                    <input type="submit" value="?????? ??????" class="btn btn-success btn-block col-8 offset-2 mt-3" name="sub">
                    <a href="home.php" class="btn btn-block btn-secondary col-8 offset-2">????????????</a>
                </div>

            </form>

        </div>
    </div>

</body>
<script src="js/jquery-3.5.1.min.js"></script>
<script src="js/bootstrap.min.js"></script>

</html>