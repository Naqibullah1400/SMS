<?php
require_once("db.php");

if (isset($_REQUEST['del'])) {
    $tid = intval($_GET['del']);
    $sql = "DELETE FROM teacher WHERE teacher_id=?";
    $query = $conn->prepare($sql);
    $query->bindValue(1, $tid);
    $query->execute();
}
?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>allTeacher</title>
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/style.css">
</head>

<body>

    <div class="container-fluid">
        <div class="row">

            <h3 class="col-12 bg-primary text-center p-3 text-white">لیست استادان لیسه عالی خصوصی بروت</h3>

            <button class="btn btn-secondary col-4 offset-4 mb-2" onclick="window.location.href='home.php'">بازگشت</button>

            <table class="table table-bordered table-hover text-center" dir="rtl">

                <thead class="table-primary">
                    <tr>
                        <th>شناسه</th>
                        <th>نام</th>
                        <th>نام پدر</th>
                        <th>نام پدرکلان</th>
                        <th>عکس</th>
                        <th>نمبر تذکره</th>
                        <th>جنسیت</th>
                        <th>تاریخ تولد</th>
                        <th>درجه تحصیل</th>
                        <th>تاریخ</th>
                        <th>موبایل</th>
                        <th>آدرس</th>
                        <th>ویرایش</th>
                        <th>حذف</th>
                    </tr>
                </thead>

                <tbody>

                    <?php
                    $sql = "SELECT * FROM teacher";
                    $query = $conn->prepare($sql);
                    $query->execute();
                    $result = $query->fetchAll(PDO::FETCH_OBJ);
                    if ($query->rowCount() > 0) {
                        foreach ($result as $res) { ?>
                            <tr>
                                <td> <?php echo $res->teacher_id ?> </td>
                                <td> <?php echo $res->fullname ?> </td>
                                <td> <?php echo $res->fathername ?> </td>
                                <td> <?php echo $res->gfathername ?> </td>
                                <td> <img src="image/<?php echo $res->photo ?>" class="img-fluid" style="width: 4vw !important; height: 8vh;"> </td>
                                <td> <?php echo $res->tazkira ?> </td>
                                <td> <?php echo $res->gender ?> </td>
                                <td> <?php echo $res->dob ?> </td>
                                <td> <?php echo $res->position ?> </td>
                                <td> <?php echo $res->date ?> </td>
                                <td> <?php echo $res->phone ?> </td>
                                <td> <?php echo $res->address ?> </td>
                                <td><a href="updateTeacher.php?id=<?php echo $res->teacher_id ?>" class="btn btn-warning">ویرایش</a></td>
                                <td><a href="allTeacher.php?del=<?php echo $res->teacher_id ?>" class="btn btn-danger" onclick="return confirm('آیا این ریکورد حذف شود؟')">حذف</a></td>
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