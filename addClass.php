<?php
require_once("db.php");

if (isset($_POST['sub'])) {
    $class = $_POST['class'];
    $fees = $_POST['fees'];

    try {

        if ($class != "" && $fees != "") {
            $sql = "INSERT INTO class SET class_grade=?, fees=?";
            $query = $conn->prepare($sql);
            $query->bindValue(1, $class);
            $query->bindValue(2, $fees);
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
    <title>addClass</title>
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/style.css">
</head>

<body style="background-color: lightblue;">

    <div class="container-fluid">
        <div class="row">

            <h2 class="w-100 text-center text-white bg-primary p-4">فورم ثبت فنوف جدید</h2>
            <form method="POST" class="col-6 offset-3 d-flex flex-wrap p-4 justify-content-center" dir="rtl">

                <div class="col-8 mt-3">
                    <label for="class" class="float-right">صنف</label>
                    <select name="class" id="class" class="form-control">
                        <option>اول</option>
                        <option>دوم</option>
                        <option>سوم</option>
                        <option>چهارم</option>
                        <option>پنجم</option>
                        <option>ششم</option>
                        <option>هفتم</option>
                        <option>هشتم</option>
                        <option>نهم</option>
                        <option>دهم</option>
                        <option>یازدهم</option>
                        <option>دوازدهم</option>
                    </select>
                </div>

                <div class="col-8 mt-3">
                    <label for="fees" class="float-right">فیس</label>
                    <input type="number" placeholder="فیس" class="form-control" name="fees">
                </div>

                <div class="col-8 mt-4">
                    <input type="submit" value="ثبت صنف جدید" class="btn btn-success btn-block mb-3" name="sub">
                    <a href="home.php" class="btn btn-secondary btn-block">بازگشت</a>
                </div>

            </form>

        </div>
    </div>

</body>
<script src="js/jquery-3.5.1.min.js"></script>
<script src="js/bootstrap.min.js"></script>

</html>