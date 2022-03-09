<?php
require_once("db.php");

$teacher_id = intval($_GET['id']);

if (isset($_POST['update'])) {

    $fullname = $_POST['fullname'];
    $fathername = $_POST['fathername'];
    $gfathername = $_POST['gfathername'];
    $photo = $_POST['photo'];
    $tazkira = $_POST['tazkira'];
    $gender = $_POST['gender'];
    $dob = $_POST['dob'];
    $position = $_POST['position'];
    $date = $_POST['date'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];

    try {

        if ($fullname != "" && $fathername != "" && $gfathername != "" && $photo != "" && $tazkira != "" && $gender != "" && $dob != "" && $position != "" && $date != "" && $phone != "" && $address != "") {

            $sql = "UPDATE teacher SET fullname=?, fathername=?, gfathername=?, photo=?, tazkira=?, gender=?, dob=?, position=?, `date`=?, phone=?, `address`=? WHERE teacher_id=?";
            $query = $conn->prepare($sql);
            $query->bindValue(1, $fullname);
            $query->bindValue(2, $fathername);
            $query->bindValue(3, $gfathername);
            $query->bindValue(4, $photo);
            $query->bindValue(5, $tazkira);
            $query->bindValue(6, $gender);
            $query->bindValue(7, $dob);
            $query->bindValue(8, $position);
            $query->bindValue(9, $date);
            $query->bindValue(10, $phone);
            $query->bindValue(11, $address);
            $query->bindValue(12, $teacher_id);
            $query->execute(); ?>
            <script>
                window.location.href = "allTeacher.php";
            </script>
<?php
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
    <title>addTeacher</title>
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/style.css">
</head>

<body style="background-color: lightblue;">

    <div class="container-fluid">
        <div class="row">

            <h3 class="w-100 bg-primary text-white p-3 text-center">فورم ثبت نام استادان</h3>

            <form method="POST" class="form col-8 offset-2 d-flex flex-wrap justify-content-center mt-3" dir="rtl">

                <?php
                $sql = "SELECT * FROM teacher WHERE teacher_id=?";
                $query = $conn->prepare($sql);
                $query->bindValue(1, $teacher_id);
                $query->execute();
                $result = $query->fetchAll(PDO::FETCH_OBJ);
                if ($query->rowCount() > 0) {
                    foreach ($result as $res) { ?>

                        <div class="col-5 offset-1 mb-3">
                            <label for="fullname" class="float-right">نام</label>
                            <input type="text" id="fullname" class="form-control" name="fullname" value="<?php echo $res->fullname ?>">
                        </div>

                        <div class="col-5 mb-3">
                            <label for="fathername" class="float-right">نام پدر</label>
                            <input type="text" id="fathername" class="form-control" name="fathername" value="<?php echo $res->fathername ?>">
                        </div>

                        <div class="col-5 offset-1 mb-3">
                            <label for="gfathername" class="float-right">نام پدرکلان</label>
                            <input type="text" id="gfathername" class="form-control" name="gfathername" value="<?php echo $res->gfathername ?>">
                        </div>

                        <div class="col-5 mb-3">
                            <label for="photo" class="float-right">عکس</label>
                            <input type="input" id="photo" class="form-control" name="photo" value="<?php echo $res->photo ?>">
                        </div>

                        <div class="col-5 offset-1 mb-3">
                            <label for="tazkira" class="float-right">نمبر تذکره</label>
                            <input type="number" id="tazkira" class="form-control" name="tazkira" value="<?php echo $res->tazkira ?>">
                        </div>

                        <div class="col-5 mb-3">
                            <label for="gender" class="float-right">جنسیت</label>
                            <input type="text" name="gender" id="gender" class="form-control" value="<?php echo $res->gender ?>">
                        </div>

                        <div class="col-5 offset-1 mb-3">
                            <label for="dob" class="float-right">تاریخ تولد</label>
                            <input type="date" id="dob" class="form-control" name="dob" value="<?php echo $res->dob ?>">
                        </div>

                        <div class="col-5 mb-3">
                            <label for="position" class="float-right">درجه تحصیل</label>
                            <input type="text" name="position" id="class" class="form-control" value="<?php echo $res->position ?>">
                        </div>

                        <div class="col-5 offset-1 mb-3">
                            <label for="date" class="float-right">تاریخ</label>
                            <input type="date" id="date" class="form-control mt-3" name="date" value="<?php echo $res->date ?>">
                        </div>

                        <div class="col-5 mb-3">
                            <label for="phone" class="float-right">موبایل</label>
                            <input type="tel" id="phone" class="form-control mt-3" name="phone" value="<?php echo $res->phone ?>">
                        </div>

                        <div class="col-8 mb-2">
                            <label for="address" class="float-right">آدرس</label>
                            <textarea name="address" id="address" class="form-control mt-3" rows="1"><?php echo $res->address ?></textarea>
                        </div>
                <?php
                    }
                }
                ?>
                <div class="col-8" dir="ltr">
                    <input type="submit" value="ویرایش" class="btn btn-warning btn-block col-8 offset-2 mt-3" name="update">
                    <a href="allTeacher.php" class="btn btn-block btn-secondary col-8 offset-2">بازگشت</a>
                </div>

            </form>

        </div>
    </div>

</body>
<script src="js/jquery-3.5.1.min.js"></script>
<script src="js/bootstrap.min.js"></script>

</html>