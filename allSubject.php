<?php
require_once("db.php");

if (isset($_REQUEST['del'])) {

    $sub_id = intval($_GET['del']);

    $sql = "DELETE FROM `subject` WHERE sub_id = ?";
    $query = $conn->prepare($sql);
    $query->bindvalue(1, $sub_id);
    $query->execute();
}

?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>allSubject</title>
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/style.css">
</head>

<body>

    <div class="container-fluid">
        <div class="row">

            <h3 class="text-white text-center bg-primary p-3 col-12">لیست مضامین لیسه عالی خصوصی بروت</h3>

            <button class="btn btn-secondary col-4 offset-4 mb-2" onclick="window.location.href='home.php'">بازگشت</button>

            <table class="table table-bordered table-hover text-center col-4 offset-4" dir="rtl">

                <thead class="table-primary">
                    <tr>
                        <th>شناسه</th>
                        <th>مضمون</th>
                        <th>صنف</th>
                        <th>ویرایش</th>
                        <th>حذف</th>
                    </tr>
                </thead>

                <tbody>

                    <?php
                    $sql = "SELECT sub_id, sub_name, class_grade FROM `subject` JOIN class USING(class_id)";
                    $query = $conn->prepare($sql);
                    $query->execute();
                    $result = $query->fetchAll(PDO::FETCH_OBJ);
                    if ($query->rowCount() > 0) {
                        foreach ($result as $res) { ?>
                            <tr>
                                <td> <?php echo $res->sub_id ?> </td>
                                <td> <?php echo $res->sub_name ?> </td>
                                <td> <?php echo $res->class_grade ?> </td>
                                <td><a href="updateSubject.php?id=<?php echo $res->sub_id ?>" class="btn btn-warning">ویرایش</a></td>
                                <td><a href="allSubject.php?del=<?php echo $res->sub_id ?>" class="btn btn-danger" onclick="return confirm('آیا این ریکورد حذف شود؟')">حذف</a></td>
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