<?php
require_once("db.php");

$book_id = intval($_GET['id']);

if (isset($_POST['update'])) {
    $bookName = $_POST['bookName'];
    $class = $_POST['class'];
    $quantity = $_POST['quantity'];

    try {

        if ($bookName != "" && $class != "" && $quantity != "") {
            $sql = "UPDATE library SET book_name=?, class_id=?, book_num=? WHERE book_id=?";
            $query = $conn->prepare($sql);
            $query->bindValue(1, $bookName);
            $query->bindValue(2, $class);
            $query->bindValue(3, $quantity);
            $query->bindValue(4, $book_id);
            $query->execute();
?>
            <script>
                window.location.href = 'allBook.php'
            </script>
        <?php
        }
    } catch (PDOException $e) { ?>

<?php
    }
}

?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>addBook</title>
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/style.css">
</head>

<body style="background-color: lightblue;">

    <div class="container-fluid">
        <div class="row">

            <h3 class="text-white text-center bg-primary col-12 p-3">فورم ثبت کتاب های لیسه عالی خصوصی بروت</h3>

            <form method="POST" dir="rtl" class="col-4 offset-4 mt-5">

                <?php
                if (isset($_REQUEST['id'])) {
                    $sql = "SELECT book_name, class_id, class_grade, book_num FROM library JOIN class USING(class_id) WHERE book_id = ?";
                    $query = $conn->prepare($sql);
                    $query->bindValue(1, $book_id);
                    $query->execute();
                    $result = $query->fetchAll(PDO::FETCH_OBJ);
                    if ($query->rowCount() > 0) {
                        foreach ($result as $res) { ?>
                            <div>
                                <label for="bookName" class="float-right">نام کتاب</label>
                                <input type="text" class="form-control" name="bookName" value="<?php echo $res->book_name ?>">
                            </div>

                            <div class="mt-3">
                                <label for="class" class="float-right">صنف</label>
                                <input type="text" class="form-control" name="class" id="class" value="<?php echo $res->class_id . " -" . $res->class_grade ?>">
                            </div>

                            <div class="mt-3">
                                <label for="quantity" class="float-right">تعداد کتاب</label>
                                <input type="number" class="form-control" name="quantity" value="<?php echo $res->book_num ?>">
                            </div>
                <?php
                        }
                    }
                }
                ?>

                <div class="mt-3">
                    <input type="submit" value="ویرایش" class="btn btn-warning btn-block" name="update">
                    <a href="allBook.php" class="btn btn-secondary btn-block mt-2">بازگشت</a>
                </div>

            </form>

        </div>
    </div>

</body>
<script src="js/jquery-3.5.1.min.js"></script>
<script src="js/bootstrap.min.js"></script>

</html>