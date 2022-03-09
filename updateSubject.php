<?php
require_once("db.php");

$sub_id = intval($_GET['id']);

if (isset($_POST['update'])) {

    $subject = $_POST['subject'];
    $class = $_POST['class'];

    try {

        if ($subject != "" && $class != "") {
            $sql = "UPDATE `subject` SET sub_name=?, class_id=? WHERE sub_id = ?";
            $query = $conn->prepare($sql);
            $query->bindValue(1, $subject);
            $query->bindValue(2, $class);
            $query->bindValue(3, $sub_id);
            $query->execute(); ?>
            <script>
                window.location.href = "allSubject.php"
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
    <title>addSubject</title>
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/style.css">
</head>

<body style="background-color: lightblue;">

    <div class="container-fluid">
        <div class="row">


            <h3 class="text-center text-white bg-primary p-4 col-12">فورم ثبت مضامین لیسه عالی خصوصی بروت</h3>

            <form method="POST" dir="rtl" class="col-8 mt-4">

                <?php
                if (isset($_REQUEST['id'])) {

                    $sql = "SELECT sub_name, class_id, class_grade FROM `subject` JOIN class USING(class_id) WHERE sub_id = ?";
                    $query = $conn->prepare($sql);
                    $query->bindValue(1, $sub_id);
                    $query->execute();
                    $result = $query->fetchAll(PDO::FETCH_OBJ);
                    if ($query->rowCount() > 0) {
                        foreach ($result as $res) { ?>
                            <div class="col-6 mt-3">
                                <label for="subject" class="float-right">مضمون</label>
                                <input type="text" class="form-control" name="subject" value="<?php echo $res->sub_name ?>">
                            </div>

                            <div class="col-6 mt-3">
                                <label for="class" class="float-right">صنف</label>
                                <input type="text" name="class" id="class" class="form-control" value="<?php echo $res->class_id . "- " . $res->class_grade ?>">
                            </div>

                <?php
                        }
                    }
                }
                ?>
                <div class="col-6 mt-3">
                    <input type="submit" value="ویرایش" class="btn btn-warning btn-block" name="update">
                    <a href="home.php" class="btn btn-secondary btn-block mt-3">بازگشت</a>
                </div>

            </form>

        </div>
    </div>

</body>
<script src="js/jquery-3.5.1.min.js"></script>
<script src="js/bootstrap.min.js"></script>

</html>