<?php
if (isset($_POST['submit'])) {

    $fullname = $_POST['fullname'];
    $email    = $_POST['email'];
    $course   = $_POST['course'];
    $type     = $_POST['type'];

    // อาหาร (Checkbox)
    if (isset($_POST['food'])) {
        $food = implode(", ", $_POST['food']);
    } else {
        $food = "ไม่ระบุ";
    }

    // ค่าลงทะเบียน
    if ($type == "Onsite") {
        $price = 1500;
    } else {
        $price = 800;
    }

    // บันทึกไฟล์
    $data = $fullname . "|" . $email . "|" . $course . "|" . $food . "|" . $type . "|" . $price . "\n";
    file_put_contents("register.txt", $data, FILE_APPEND);
}
?>

<!DOCTYPE html>
<html lang="th">
<head>
<meta charset="UTF-8">
<title>ฟอร์มลงทะเบียนอบรม</title>

<!-- Bootstrap 5 -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
body{
    background: linear-gradient(135deg,#74ebd5,#ACB6E5);
    min-height:100vh;
}
.card{
    border-radius:15px;
}
</style>
</head>

<body>

<div class="container py-5">

    <!-- ฟอร์ม -->
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow">
                <div class="card-body">
                    <h3 class="text-center text-primary mb-4">ฟอร์มลงทะเบียนอบรม</h3>

                    <form method="post">

                        <div class="mb-3">
                            <label class="form-label">ชื่อ-นามสกุล</label>
                            <input type="text" name="fullname" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" name="email" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">หัวข้ออบรม</label>
                            <select name="course" class="form-select">
                                <option>AI สำหรับงานสำนักงาน</option>
                                <option>Excel สำหรับการทำงาน</option>
                                <option>การเขียนเว็บด้วย PHP</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">อาหารที่ต้องการ</label><br>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="food[]" value="ปกติ">
                                <label class="form-check-label">ปกติ</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="food[]" value="มังสวิรัติ">
                                <label class="form-check-label">มังสวิรัติ</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="food[]" value="ฮาลาล">
                                <label class="form-check-label">ฮาลาล</label>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">รูปแบบการเข้าร่วม</label><br>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="type" value="Onsite" required>
                                <label class="form-check-label">Onsite</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="type" value="Online">
                                <label class="form-check-label">Online</label>
                            </div>
                        </div>

                        <div class="d-grid">
                            <button type="submit" name="submit" class="btn btn-primary btn-lg">
                                ลงทะเบียน
                            </button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- แสดงผลหลังลงทะเบียน -->
    <?php if (isset($_POST['submit'])) { ?>
    <div class="row justify-content-center mt-4">
        <div class="col-md-6">
            <div class="alert alert-success shadow">
                <h5 class="alert-heading">ลงทะเบียนสำเร็จ</h5>
                ชื่อ: <?= $fullname ?><br>
                อีเมล: <?= $email ?><br>
                หัวข้ออบรม: <?= $course ?><br>
                อาหาร: <?= $food ?><br>
                รูปแบบ: <?= $type ?><br>
                ค่าลงทะเบียน: <?= number_format($price,2) ?> บาท
            </div>
        </div>
    </div>
    <?php } ?>

    <!-- ตารางรายชื่อ -->
    <?php if (file_exists("register.txt")) { ?>
    <div class="row mt-5">
        <div class="col">
            <div class="card shadow">
                <div class="card-body">
                    <h4 class="text-center mb-3">รายชื่อผู้ลงทะเบียนทั้งหมด</h4>

                    <table class="table table-bordered table-striped text-center">
                        <thead class="table-dark">
                            <tr>
                                <th>ชื่อ</th>
                                <th>Email</th>
                                <th>หัวข้อ</th>
                                <th>อาหาร</th>
                                <th>รูปแบบ</th>
                                <th>ค่าลงทะเบียน</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                        $lines = file("register.txt");
                        foreach ($lines as $line) {
                            list($n,$e,$c,$f,$t,$p) = explode("|", trim($line));
                            echo "<tr>
                                    <td>$n</td>
                                    <td>$e</td>
                                    <td>$c</td>
                                    <td>$f</td>
                                    <td>$t</td>
                                    <td>".number_format($p,2)."</td>
                                  </tr>";
                        }
                        ?>
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
    <?php } ?>

</div>

</body>
</html>
