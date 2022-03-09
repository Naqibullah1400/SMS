<?php
require_once("db.php");

if (isset($_POST['sub'])) {

    $subject = $_POST['subject'];
    $class = $_POST['class'];

    try {

        if ($subject != "" && $class != "") {
            $sql = "INSERT INTO `subject` SET sub_name=?, class_id=?";
            $query = $conn->prepare($sql);
            $query->bindValue(1, $subject);
            $query->bindValue(2, $class);
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
    <title>addSubject</title>
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/style.css">
</head>

<body style="background-color: lightblue;">

    <div class="container-fluid">
        <div class="row">


            <h3 class="text-center text-white bg-primary p-4 col-12">فورم ثبت مضامین لیسه عالی خصوصی بروت</h3>

            <form method="POST" dir="rtl" class="col-8 mt-4">

                <div class="col-6 mt-3">
                    <label for="subject" class="float-right">مضمون</label>
                    <input type="text" placeholder="مضمون" class="form-control" name="subject">
                </div>

                <div class="col-6 mt-3">
                    <label for="class" class="float-right">صنف</label>
                    <select name="class" id="class" class="form-control">

                        <?php
                        $sql = "SELECT * FROM class";
                        $query = $conn->prepare($sql);
                        $query->execute();
                        $result = $query->fetchAll(PDO::FETCH_OBJ);
                        if ($query->rowCount() > 0) {
                            foreach ($result as $res) { ?>
                                <option> <?php echo $res->class_id . " -" . $res->class_grade ?> </option>
                        <?php
                            }
                        }
                        ?>
                    </select>
                </div>

                <div class="col-6 mt-3">
                    <input type="submit" value="ثبت" class="btn btn-success btn-block" name="sub">
                    <a href="home.php" class="btn btn-secondary btn-block mt-3">بازگشت</a>
                </div>

            </form>

        </div>
    </div>

</body>
<script src="js/jquery-3.5.1.min.js"></script>
<script src="js/bootstrap.min.js"></script>

</html>