<?php
require_once("db.php");

$atten_id = intval($_GET['id']);

if (isset($_POST['update'])) {
    $month = $_POST['month'];
    $class = $_POST['class'];
    $studentId = $_POST['studentId'];
    $present = $_POST['present'];

    try {

        if ($month != "" && $class != "" && $studentId != "" && $present != "") {

            $sql = "UPDATE attendance SET `month`=?, class_id=?, student_id=?, present=? WHERE atten_id=?";
            $query = $conn->prepare($sql);
            $query->bindValue(1, $month);
            $query->bindValue(2, $class);
            $query->bindValue(3, $studentId);
            $query->bindValue(4, $present);
            $query->bindValue(5, $atten_id);
            $query->execute(); ?>
            <script>
                window.location.href = "allAttendance.php";
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
    <title>addAttendance</title>
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/style.css">
</head>

<body style="background-color: lightblue;">

    <div class="container-fluid">
        <div class="row">

            <h3 class="text-white text-center bg-primary p-3 col-12">فورم ثبت حاضری ماهانه شاگردان</h3>

            <form method="POST" class="col-6 offset-2" dir="rtl">

                <?php
                $sql = "SELECT `month`, attendance.class_id, class_grade, attendance.student_id, fullname, present FROM attendance JOIN class USING(class_id) JOIN student USING(student_id) WHERE atten_id=?";
                $query = $conn->prepare($sql);
                $query->bindvalue(1, $atten_id);
                $query->execute();
                $result = $query->fetchAll(PDO::FETCH_OBJ);
                if ($query->rowCount() > 0) {
                    foreach ($result as $res) { ?>

                        <div class="col-8 offset-2 mt-5">
                            <label for="month" class="float-right">ماه</label>
                            <input type="text" name="month" class="form-control" value="<?php echo $res->month ?>">
                        </div>

                        <div class="col-8 offset-2 mt-3">
                            <label for="class" class="float-right">صنف</label>
                            <input type="text" name="class" id="class" class="form-control" value="<?php echo $res->class_id . "- " . $res->class_grade ?>">
                        </div>

                        <div class="col-8 offset-2 mt-3">
                            <label for="studentId" class="float-right">نام</label>
                            <input type="text" class="form-control" id="studentId" name="studentId" value="<?php echo $res->student_id . "- " . $res->fullname ?>">
                        </div>

                        <div class="col-8 offset-2 mt-3">
                            <label for="present" class="float-right">روز های حاضر</label>
                            <input type="number" id="present" class="form-control" name="present" value="<?php echo $res->present ?>">
                        </div>
                <?php
                    }
                }
                ?>
                <div class="col-8 offset-2 mt-3">
                    <input type="submit" value="ویرایش" class="btn btn-block btn-warning" name="update">
                    <a href="home.php" class="btn btn-block btn-secondary mt-3">بازگشت</a>
                </div>

            </form>

        </div>
    </div>

</body>
<script src="js/jquery-3.5.1.min.js"></script>
<script src="js/bootstrap.min.js"></script>

</html>