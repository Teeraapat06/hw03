<?php
// =================== ประมวลผลเมื่อกด submit ===================
if (isset($_POST['submit'])) {

    $name   = $_POST['fullname'];
    $email  = $_POST['email'];
    $topic  = $_POST['topic'];
    $join   = $_POST['join'];

    // checkbox (เลือกได้หลายค่า)
    if (!empty($_POST['food'])) {
        $food = implode(", ", $_POST['food']);
    } else {
        $food = "ไม่ระบุ";
    }

    // เตรียมข้อมูลสำหรับบันทึกไฟล์
    $data = "ชื่อ-นามสกุล: $name\n";
    $data .= "Email: $email\n";
    $data .= "หัวข้ออบรม: $topic\n";
    $data .= "อาหารที่ต้องการ: $food\n";
    $data .= "รูปแบบการเข้าร่วม: $join\n";
    $data .= "-----------------------------\n";

    // บันทึกข้อมูลลงไฟล์ register.txt
    file_put_contents("register.txt", $data, FILE_APPEND);
}
?>

<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <title>ฟอร์มลงทะเบียนอบรม</title>
</head>
<body>

<h2>ฟอร์มลงทะเบียนอบรม</h2>

<form method="post">
    ชื่อ-นามสกุล:<br>
    <input type="text" name="fullname" required><br><br>

    Email:<br>
    <input type="email" name="email" required><br><br>

    หัวข้ออบรม:<br>
    <select name="topic">
        <option>AI สำหรับงานสำนักงาน</option>
        <option>Excel สำหรับการทำงาน</option>
        <option>การเขียนเว็บด้วย PHP</option>
    </select><br><br>

    อาหารที่ต้องการ:<br>
    <input type="checkbox" name="food[]" value="ปกติ"> ปกติ
    <input type="checkbox" name="food[]" value="มังสวิรัติ"> มังสวิรัติ
    <input type="checkbox" name="food[]" value="ฮาลาล"> ฮาลาล
    <br><br>

    รูปแบบการเข้าร่วม:<br>
    <input type="radio" name="join" value="Onsite" required> Onsite
    <input type="radio" name="join" value="Online"> Online
    <br><br>

    <input type="submit" name="submit" value="ลงทะเบียน">
</form>

<hr>

<h3>ข้อมูลผู้ลงทะเบียน</h3>
<pre>
<?php
// =================== แสดงข้อมูลจากไฟล์ ===================
if (file_exists("register.txt")) {
    echo file_get_contents("register.txt");
}
?>
</pre>

</body>
</html>
