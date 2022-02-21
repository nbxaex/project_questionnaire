<?php
// include composer autoload
require_once 'plugin-php/autoload.php';

// import the Intervention Image Manager Class
use Intervention\Image\ImageManager;

// สร้างตัวแปรอ้างอิง object ตัวจัดการรูปภาพ
$manager = new ImageManager();

if (password_verify('ESurvey', $_POST['csbt'])) {
    $users_type = mysqli_real_escape_string($conn, $_POST['users_type']);
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $useremail = mysqli_real_escape_string($conn, $_POST['useremail']);
    $userpassword = mysqli_real_escape_string($conn, $_POST['userpassword']);
    $userpassword2 = mysqli_real_escape_string($conn, $_POST['userpassword2']);
    $created_at = date("Y-m-d H:i:s");
    $updated_at =  date("Y-m-d H:i:s");
    if ($userpassword != $userpassword2) {
        $wrongpass .= " กรุณากรอกรหัสผ่าน และยืนยันรหัสผ่านให้ตรงกัน ";
    }
    if (strlen($userpassword) < 6) {
        $wrongpass .= " รหัสผ่านต้อง 6 ตัวขึ้นไป ";
    }
    if ($userpassword == $userpassword2 && strlen($userpassword) >= 6) {
        if (isset($_FILES['picupload']['name']) && $_FILES['picupload']['name'] != "") {
            list($filename, $ext) = explode(".", $_FILES['picupload']['name']);
            // สร้างไฟล์ thumbnail จากไฟล์ต้นฉบับ จำนวน 3 ขนาด
            $manager->make($_FILES['picupload']['tmp_name'])
                ->resize(60, 60)
                ->save('../images/images_profile/' . 'Profile-' . date('Ymd') . date("His") . '_60x60.jpg');
            $picture = 'Profile-' . date('Ymd') . date("His") . '_60x60.jpg';
        }
        $pass = password_hash($userpassword, PASSWORD_DEFAULT);             // Password Check
        $aukey = md5(random_bytes(5));                                      // key session เอาไว้ใช้งานในเว็บ
        $accessToken = password_hash(random_bytes(10), PASSWORD_DEFAULT);   // เอาไว้ขอปลดล็อคเมื่อลืมรหัสผ่าน
        $sql_create_users = " INSERT INTO users
        VALUES (NULL,'$users_type','$picture','$username','$useremail',NULL,'$pass','$aukey','$accessToken','','$created_at','$updated_at')";
        $result_create_users = mysqli_query($conn, $sql_create_users);
        if ($result_create_users) {
            header("Location: index.php?mn=users&file=users_list");
        } else {
            $wrongpass = " ไม่สามารถบันทึกข้อมูลได้ ";
        }
    }
}
?>
<?php if (isset($wrongpass)) { ?>
    <div class="alert alert-danger" role="alert">
        <?= $wrongpass ?>
    </div>
<?php } ?>
<form action="" method="POST" enctype="multipart/form-data">
    <div class="form-group">
        <label for="users_type">กำหนดสิทธิ์ :</label>
        <select class="form-control" name="users_type" id="users_type">
            <option disabled>เลือกสิทธิ์</option>
            <option value="1">Admin</option>
            <option value="2">Manager</option>
        </select>
    </div>
    <div class="form-group">
        <label for="username" class="text-light">รูปภาพ :</label>
        <input type="file" class="file-3" id="picupload" name="picupload">
    </div>
    <div class="form-group">
        <label for="username" class="text-light">ชื่อผู้ใช้ :</label>
        <input type="text" class="form-control" id="username" placeholder="ชื่อผู้ใช้..." name="username" value="<?= $_POST['username'] ?>" required>
    </div>
    <div class="form-group">
        <label for="email" class="text-light">อีเมล :</label>
        <input type="email" class="form-control" id="useremail" placeholder="อีเมล..." name="useremail" value="<?= $_POST['useremail'] ?>" required>
    </div>
    <div class="form-group">
        <label for="pwd" class="text-light">รหัสผ่าน :</label>
        <div class="input-group">
            <input type="password" class="form-control text-dark" placeholder="รหัสผ่าน..." aria-label="รหัสผ่าน..." aria-describedby="basic-addon2" name="userpassword" id="userpassword" required="">
            <div class="input-group-append">
                <button class="btn btn-primary" type="button" onclick="if (userpassword.type == 'text') userpassword.type = 'password';
  else userpassword.type = 'text';"><i class="far fa-eye"></i></button>
            </div>
        </div>
        <span id="result"></span>
    </div>
    <div class="form-group">
        <label for="pwd" class="text-light">ยืนยันรหัสผ่าน :</label>
        <div class="input-group">
            <input type="password" class="form-control" placeholder="ยืนยันรหัสผ่าน..." aria-label="ยืนยันรหัสผ่าน..." aria-describedby="basic-addon1" name="userpassword2" id="userpassword2" required="">
            <div class="input-group-append">
                <button class="btn btn-primary" type="button" onclick="if (userpassword2.type == 'text') userpassword2.type = 'password';
  else userpassword2.type = 'text';"><i class="far fa-eye"></i></button>
            </div>
        </div> <span id='message'></span>
    </div>
    <input type="hidden" name="csbt" value="<?= password_hash('ESurvey', PASSWORD_DEFAULT) ?>">
    <button type="submit" id="submit" class="btn btn-block btn-primary">บันทึก</button>
</form>