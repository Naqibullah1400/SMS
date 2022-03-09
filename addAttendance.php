<?php
require_once("db.php");

if (isset($_POST['sub'])) {
    $month = $_POST['month'];
    $class = $_POST['class'];
    $studentId = $_POST['studentId'];
    $present = $_POST['present'];

    try {

        if ($month != "" && $class != "" && $studentId != "" && $present != "") {

            $sql = "INSERT INTO attendance SET `month`=?, class_id=?, student_id=?, present=?";
            $query = $conn->prepare($sql);
            $query->bindValue(1, $month);
            $query->bindValue(2, $class);
            $query->bindValue(3, $studentId);
            $query->bindValue(4, $present);
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
    <title>addAttendance</title>
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/style.css">
</head>

<body style="background-color: lightblue;">

    <div class="container-fluid">
        <div class="row">

            <h3 class="text-white text-center bg-primary p-3 col-12">فورم ثبت حاضری ماهانه شاگردان</h3>

            <form method="POST" class="col-6 offset-2" dir="rtl">

                <div class="col-8 offset-2 mt-5">
                    <label for="month" class="float-right">ماه</label>
                    <select name="month" class="form-control">
                        <option>حمل</option>
                        <option>ثور</option>
                        <option>جوزا</option>
                        <option>سرطان</option>
                        <option>اسد</option>
                        <option>سنبله</option>
                        <option>میزان</option>
                        <option>عقرب</option>
                        <option>فوس</option>
                        <option>جدی</option>
                        <option>دلو</option>
                        <option>حوت</option>
                    </select>
                </div>

                <div class="col-8 offset-2 mt-3">
                    <label for="class" class="float-right">صنف</label>
                    <select name="class" id="class" class="form-control">
                        <?php
                        $sql = "SELECT * FROM class";
                        $query = $conn->prepare($sql);
                        $query->execute();
                        $results = $query->fetchAll(PDO::FETCH_OBJ);
                        if ($query->rowCount() > 0) {
                            foreach ($results as $result) { ?>
                                <option> <?php echo $result->class_id . "- " . $result->class_grade ?> </option>
                        <?php
                            }
                        }

                        ?>
                    </select>
                </div>

                <div class="col-8 offset-2 mt-3">
                    <label for="studentId" class="float-right">نام</label>
                    <input type="number" class="form-control" placeholder="آی دی نمبر" id="studentId" name="studentId">
                </div>

                <div class="col-8 offset-2 mt-3">
                    <label for="present" class="float-right">روز های حاضر</label>
                    <input type="number" id="present" class="form-control" name="present">
                </div>

                <div class="col-8 offset-2 mt-3">
                    <input type="submit" value="ثبت" class="btn btn-block btn-success" name="sub">
                    <a href="home.php" class="btn btn-block btn-secondary mt-3">بازگشت</a>
                </div>

            </form>

        </div>
    </div>

</body>
<script src="js/jquery-3.5.1.min.js"></script>
<script src="js/bootstrap.min.js"></script>

</html>