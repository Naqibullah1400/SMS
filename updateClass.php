<?php
require_once("db.php");

$class_id = intval($_GET['id']);

if (isset($_POST['update'])) {
    $class = $_POST['class'];
    $fees = $_POST['fees'];

    try {

        if ($class != "" && $fees != "") {
            $sql = "UPDATE class SET class_grade=?, fees=? WHERE class_id=?";
            $query = $conn->prepare($sql);
            $query->bindValue(1, $class);
            $query->bindValue(2, $fees);
            $query->bindValue(3, $class_id);
            $query->execute(); ?>
            <script>
                window.location.href = "allClass.php"
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
    <title>addClass</title>
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/style.css">
</head>

<body style="background-color: lightblue;">

    <div class="container-fluid">
        <div class="row">

            <h2 class="w-100 text-center text-white bg-primary p-4">فورم ثبت فنوف جدید</h2>
            <form method="POST" class="col-6 offset-3 d-flex flex-wrap p-4 justify-content-center" dir="rtl">

                <?php
                if (isset($_REQUEST['id'])) {
                    $sql = "SELECT * FROM class WHERE class_id=?";
                    $query = $conn->prepare($sql);
                    $query->bindValue(1, $class_id);
                    $query->execute();
                    $result = $query->fetchAll(PDO::FETCH_OBJ);
                    if ($query->rowCount() > 0) {
                        foreach ($result as $res) { ?>

                            <div class="col-8 mt-3">
                                <label for="class" class="float-right">صنف</label>
                                <input type="text" name="class" id="class" class="form-control" value="<?php echo $res->class_grade ?>">
                            </div>

                            <div class="col-8 mt-3">
                                <label for="fees" class="float-right">فیس</label>
                                <input type="number" class="form-control" name="fees" value="<?php echo $res->fees ?>">
                            </div>
                <?php
                        }
                    }
                }
                ?>
                <div class="col-8 mt-4">
                    <input type="submit" value="ویرایش" class="btn btn-warning btn-block mb-3" name="update">
                    <a href="allClass.php" class="btn btn-secondary btn-block">بازگشت</a>
                </div>

            </form>

        </div>
    </div>

</body>
<script src="js/jquery-3.5.1.min.js"></script>
<script src="js/bootstrap.min.js"></script>

</html>