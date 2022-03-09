<?php
require_once("db.php");

if (isset($_REQUEST['del'])) {

    $book_id = intval($_GET['del']);

    $sql = "DELETE FROM library WHERE book_id=?";
    $query = $conn->prepare($sql);
    $query->bindValue(1, $book_id);
    $query->execute();
}

?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>allBook</title>
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/style.css">
</head>

<body>

    <div class="container-fluid">
        <div class="row">

            <h3 class="text-white text-center bg-primary p-3 col-12">لیست کتاب های لیسه عالی خصوصی بروت</h3>

            <button class="btn btn-secondary col-4 offset-4 mb-2" onclick="window.location.href='home.php'">بازگشت</button>

            <table class="table table-bordered table-hover text-center col-4 offset-4" dir="rtl">

                <thead class="table-primary">
                    <tr>
                        <th>شناسه</th>
                        <th>نام کتاب</th>
                        <th>صنف</th>
                        <th>تعداد کتاب</th>
                        <th>ویرایش</th>
                        <th>حذف</th>
                    </tr>
                </thead>

                <tbody>

                    <?php
                    $sql = "SELECT book_id, book_name, class_grade, book_num FROM library JOIN class USING(class_id)";
                    $query = $conn->prepare($sql);
                    $query->execute();
                    $result = $query->fetchAll(PDO::FETCH_OBJ);
                    if ($query->rowCount() > 0) {
                        foreach ($result as $res) { ?>
                            <tr>
                                <td> <?php echo $res->book_id  ?> </td>
                                <td> <?php echo $res->book_name ?> </td>
                                <td> <?php echo $res->class_grade ?> </td>
                                <td> <?php echo $res->book_num ?> </td>
                                <td><a href="updateBook.php?id=<?php echo $res->book_id ?>" class="btn btn-warning">ویرایش</a></td>
                                <td><a href="allBook.php?del=<?php echo $res->book_id ?>" class="btn btn-danger" onclick="return confirm('آیا این ریکورد حذف شود؟')">حذف</a></td>
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