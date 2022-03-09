<?php
require_once("db.php");

if (isset($_REQUEST['del'])) {
    $sid = intval($_GET['del']);
    $sql = "DELETE FROM student WHERE student_id=?";
    $query = $conn->prepare($sql);
    $query->bindValue(1, $sid);
    $query->execute();
}

?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>allStudent</title>
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/style.css">
</head>

<body>

    <div class="container-fluid">
        <div class="row">

            <h3 class="text-white text-center bg-primary col-12 p-3">لیست شاگردان لیسه عالی خصوصی بروت</h3>

            <button class="btn btn-secondary col-4 offset-4 mb-2" onclick="window.location.href='home.php'">بازگشت</button>

            <table class="table table-bordered text-center" dir="rtl">

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
                        <th>صنف</th>
                        <th>تاریخ</th>
                        <th>موبایل</th>
                        <th>آدرس</th>
                        <th>ویرایش</th>
                        <th>حذف</th>
                    </tr>
                </thead>

                <tbody>

                    <?php
                    $sql = "SELECT student_id, fullname, fathername, gfathername, photo, tazkira, gender, dob, class_grade, date, phone, address FROM student JOIN class USING(class_id)";
                    $query = $conn->prepare($sql);
                    $query->execute();
                    $result = $query->fetchAll(PDO::FETCH_OBJ);
                    if ($query->rowCount() > 0) {
                        foreach ($result as $res) { ?>

                            <tr>
                                <td> <?php echo $res->student_id ?> </td>
                                <td> <?php echo $res->fullname ?> </td>
                                <td> <?php echo $res->fathername ?> </td>
                                <td> <?php echo $res->gfathername ?> </td>
                                <td> <img src="image/<?php echo $res->photo ?>" class="img-fluid" style="width: 4vw !important; height: 8vh;"> </td>
                                <td> <?php echo $res->tazkira ?> </td>
                                <td> <?php echo $res->gender ?> </td>
                                <td> <?php echo $res->dob ?> </td>
                                <td> <?php echo $res->class_grade ?> </td>
                                <td> <?php echo $res->date ?> </td>
                                <td> <?php echo $res->phone ?> </td>
                                <td> <?php echo $res->address ?> </td>
                                <td><a href="updateStudent.php?id=<?php echo $res->student_id ?>" class="btn btn-warning">ویرایش</a></td>
                                <td><a href="allStudent.php?del=<?php echo $res->student_id ?>" class="btn btn-danger" onclick=" return confirm('آیا این ریکورد حذف شود؟')">حذف</a></td>
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