<?php
require_once("db.php");

if (isset($_POST['sub'])) {
    $bookName = $_POST['bookName'];
    $class = $_POST['class'];
    $quantity = $_POST['quantity'];

    try {

        if ($bookName != "" && $class != "" && $quantity != "") {
            $sql = "INSERT INTO library SET book_name=?, class_id=?, book_num=?";
            $query = $conn->prepare($sql);
            $query->bindValue(1, $bookName);
            $query->bindValue(2, $class);
            $query->bindValue(3, $quantity);
            $query->execute();
        }
    } catch (PDOException $e) { ?>
        <!-- <h4 class="alert alert-danger col-12 text-center of" dir="rtl">تمام فیلد ها را با دقت پر کنید!</h4> -->
        <script>
            alert("تمام فیلد ها را با دقت پر کنید!")
        </script>
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

                <div>
                    <label for="bookName" class="float-right">نام کتاب</label>
                    <input type="text" placeholder="نام کتاب" class="form-control" name="bookName">
                </div>

                <div class="mt-3">
                    <label for="class" class="float-right">صنف</label>
                    <select name="class" id="class" class="form-control">

                        <?php
                        $sql = "SELECT * FROM class";
                        $query = $conn->prepare($sql);
                        $query->execute();
                        $result = $query->fetchAll(PDO::FETCH_OBJ);
                        if ($query->rowCount() > 0) {
                            foreach ($result as $res) { ?>
                                <option> <?php echo $res->class_id . "- " . $res->class_grade ?> </option>
                        <?php
                            }
                        }
                        ?>
                    </select>
                </div>

                <div class="mt-3">
                    <label for="quantity" class="float-right">تعداد کتاب</label>
                    <input type="number" placeholder="تعداد کتاب" class="form-control" name="quantity">
                </div>

                <div class="mt-3">
                    <input type="submit" value="ثبت" class="btn btn-success btn-block" name="sub">
                    <a href="home.php" class="btn btn-secondary btn-block mt-2">بازگشت</a>
                </div>

            </form>

        </div>
    </div>

</body>
<script src="js/jquery-3.5.1.min.js"></script>
<script src="js/bootstrap.min.js"></script>

</html>