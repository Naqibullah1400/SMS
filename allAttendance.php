<?php
require_once("db.php");

if (isset($_REQUEST['del'])) {
    $aid = intval($_GET['del']);
    $sql = "DELETE FROM attendance WHERE atten_id=?";
    $query = $conn->prepare($sql);
    $query->bindValue(1, $aid);
    $query->execute();
}
?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>allAttendance</title>
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/style.css">
</head>

<body>

    <div class="container-fluid">
        <div class="row">
            <h3 class="text-center text-white bg-primary col-12 p-3">لیست حاضری شاگردان لیسه عالی خصوصی بروت</h3>

            <button class="btn btn-secondary mb-2 col-4 offset-4" onclick="window.location.href='home.php'">بازگشت</button>

            <table class="table table-bordered table-hover col-8 offset-2 text-center" dir="rtl">

                <thead class="table-primary">
                    <tr>
                        <th>شناسه</th>
                        <th>ماه</th>
                        <th>صنف</th>
                        <th>نام</th>
                        <th>نام پدر</th>
                        <th>حاضر</th>
                        <th>غیر حاضر</th>
                        <th>ویرایش</th>
                        <th>حذف</th>
                    </tr>
                </thead>

                <tbody>

                    <?php
                    $sql = "SELECT atten_id, `month`, class_grade, fullname, fathername, present, (30-present) as apsent FROM attendance JOIN class USING (class_id) JOIN student USING (student_id)";
                    $query = $conn->prepare($sql);
                    $query->execute();
                    $result = $query->fetchAll(PDO::FETCH_OBJ);
                    if ($query->rowCount() > 0) {
                        foreach ($result as $res) { ?>
                            <tr>
                                <td> <?php echo $res->atten_id ?> </td>
                                <td> <?php echo $res->month ?> </td>
                                <td> <?php echo $res->class_grade ?> </td>
                                <td> <?php echo $res->fullname ?> </td>
                                <td> <?php echo $res->fathername ?> </td>
                                <td> <?php echo $res->present ?> </td>
                                <td> <?php echo $res->apsent ?> </td>
                                <td><a href="updateAttendance.php?id=<?php echo $res->atten_id ?>" class="btn btn-warning">ویرایش</a></td>
                                <td><a href="allAttendance.php?del=<?php echo $res->atten_id ?>" class="btn btn-danger" onclick="return confirm('آیا این ریکورد حذف شود؟')">حذف</a></td>
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