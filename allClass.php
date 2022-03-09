<?php
require_once("db.php");

if (isset($_REQUEST['del'])) {

    $class_id = intval($_GET['del']);

    $sql = "DELETE FROM class WHERE class_id = ?";
    $query = $conn->prepare($sql);
    $query->bindvalue(1, $class_id);
    $query->execute();
}

?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>allClass</title>
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/style.css">
</head>

<body>

    <div class="container-fluid">
        <div class="row">

            <h3 class="bg-primary text-white text-center col-12 p-3">لیست صنف های لیسه عالی خصوصی بروت</h3>

            <button class="btn btn-secondary col-4 offset-4 mb-2" onclick="window.location.href='home.php'">بازگشت</button>

            <table class="table table-bordered col-4 offset-4 text-center" dir="rtl">

                <thead class="table-primary">
                    <tr>
                        <th>شناسه</th>
                        <th>صنف</th>
                        <th>فیس</th>
                        <th>ویرایش</th>
                        <th>حذف</th>
                    </tr>
                </thead>

                <tbody>

                    <?php
                    $sql = "SELECT * FROM class";
                    $query = $conn->prepare($sql);
                    $query->execute();
                    $result = $query->fetchAll(PDO::FETCH_OBJ);
                    if ($query->rowCount() > 0) {
                        foreach ($result as $res) { ?>
                            <tr>
                                <td> <?php echo $res->class_id ?> </td>
                                <td> <?php echo $res->class_grade ?> </td>
                                <td> <?php echo $res->fees ?> </td>
                                <td><a href="updateClass.php?id=<?php echo $res->class_id ?>" class="btn btn-warning">ویرایش</a></td>
                                <td><a href="allClass.php?del=<?php echo $res->class_id ?>" class="btn btn-danger" onclick="return confirm('آیا این ریکورد حذف شود؟')">حذف</a></td>
                            </tr>
                    <?php
                        }
                    }
                    ?>

                </tbody>

            </table>

        </div>
    </div>

</body>
<script src="js/jquery-3.5.1.min.js"></script>
<script src="js/bootstrap.min.js"></script>

</html>