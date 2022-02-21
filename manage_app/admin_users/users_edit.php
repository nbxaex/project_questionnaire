<?php
if($rs_usersadmin['users_type'] != "Admin" && $rs_usersadmin['id'] != mysqli_real_escape_string($conn, $_GET['id_edit']) ){
    header('Location:index.php?mn=users&file=users_list');
   exit();
}
// include composer autoload
require_once 'plugin-php/autoload.php';

// import the Intervention Image Manager Class
use Intervention\Image\ImageManager;

// สร้างตัวแปรอ้างอิง object ตัวจัดการรูปภาพ
$manager = new ImageManager();
if (password_verify('ESurvey', $_POST['csbt'])) {
    $id_edit = mysqli_real_escape_string($conn, $_POST['id_edit']);
    $users_type = mysqli_real_escape_string($conn, $_POST['users_type']);
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $useremail = mysqli_real_escape_string($conn, $_POST['useremail']);
    $userpasswordold = mysqli_real_escape_string($conn, $_POST['userpasswordold']);
    $userpassword = mysqli_real_escape_string($conn, $_POST['userpassword']);
    $userpassword2 = mysqli_real_escape_string($conn, $_POST['userpassword2']);
    $created_at = date("Y-m-d H:i:s");
    $updated_at = date("Y-m-d H:i:s");
    $sql_check_update_users = " SELECT * FROM users WHERE id = $id_edit ";
    $result_check_update_users = mysqli_query($conn, $sql_check_update_users);
    $rs_check_update_users = mysqli_fetch_assoc($result_check_update_users);

    if ($userpassword != $userpassword2) {
        $wrongpass .= " กรุณากรอกรหัสผ่าน และยืนยันรหัสผ่านให้ตรงกัน ";
    }
    if (strlen($userpassword) < 6) {
        $wrongpass .= " รหัสผ่านต้อง 6 ตัวขึ้นไป ";
    }
    if (password_verify($userpasswordold, $rs_check_update_users['password']) == true) {
        if ($userpassword == $userpassword2 && strlen($userpassword) >= 6) {

            if (isset($_FILES['picupload']['name']) && $_FILES['picupload']['name'] != "") {
                list($filename, $ext) = explode(".", $_FILES['picupload']['name']);
                // สร้างไฟล์ thumbnail จากไฟล์ต้นฉบับ จำนวน 1 ขนาด
                $manager->make($_FILES['picupload']['tmp_name'])
                    ->resize(60, 60)
                    ->save('../images/images_profile/' . 'Profile-' . date('Ymd') . date("His") . '_60x60.jpg');
                $picture = 'Profile-' . date('Ymd') . date("His") . '_60x60.jpg';
                $sql_im_users = " UPDATE users SET
                                        picture  = '$picture'
                                        WHERE id = $id_edit ";
                mysqli_query($conn, $sql_im_users);
            }

            $pass = password_hash($userpassword, PASSWORD_DEFAULT); // Password Check
            $aukey = md5(random_bytes(5)); // key session เอาไว้ใช้งานในเว็บ
            $accessToken = password_hash(random_bytes(10), PASSWORD_DEFAULT); // เอาไว้ขอปลดล็อคเมื่อลืมรหัสผ่าน
            $sql_create_users = " UPDATE users SET
                                        users_type = '$users_type',
                                        name  = '$username',
                                        email = '$useremail',
                                        password = '$pass',
                                        authkeys = '$aukey',
                                        accesstokens = '$accessToken',
                                        updated_at = '$updated_at'
                                        WHERE id = $id_edit
            ";
            $result_create_users = mysqli_query($conn, $sql_create_users);
            if ($result_create_users) {
                $sql = " SELECT * FROM users WHERE id = $id_edit ";
                $result = mysqli_query($conn, $sql) or die(mysqli_error($conn));
                $rs = mysqli_fetch_assoc($result);
                $_SESSION['session_icadmin'] = $rs['accesstokens'];
                setcookie('cookie_icadmin', $rs['accesstokens'], time() + 525600);

                header("Location: index.php?mn=users&file=users_list");
            } else {
                $wrongpass = " ไม่สามารถบันทึกข้อมูลได้ ";
            }
        }
    } else {
        $wrongpass .= " รหัสผ่านเดิมไม่ถูกต้อง กรุณากรอกใหม่อีกครั้ง ";
    }
}
if ($_GET['del_pic'] != "") {
    $sql_update_im = " UPDATE users SET picture = '' WHERE id = $_GET[id_edit] ";
    $result_update_im = mysqli_query($conn, $sql_update_im);
    unlink("../images/images_profile/$_GET[del_pic]");
    header("Location: index.php?mn=users&file=users_edit&id_edit=$_GET[id_edit]");
}
?>
<?php if (isset($wrongpass)) { ?>
    <div class="alert alert-danger" role="alert">
        <?= $wrongpass ?>
    </div>
<?php } ?>
<?php
$id_edit = mysqli_real_escape_string($conn, $_GET['id_edit']);
$sql_update_users = "SELECT * FROM users WHERE id = $id_edit ";
$result_update_users = mysqli_query($conn, $sql_update_users);
$rs_update_users = mysqli_fetch_assoc($result_update_users);
$d_pic = $rs_update_users['picture'];
?>
<form action="" method="POST" enctype="multipart/form-data">
    <div class="form-group">
        <label for="users_type">กำหนดสิทธิ์ :</label>
        <select class="form-control" name="users_type" id="users_type">
            <option disabled>เลือกสิทธิ์</option>
            <option value="1" <?php if($rs_update_users['users_type'] == "Admin"){ echo "selected";}?>>Admin</option>
            <option value="2" <?php if($rs_update_users['users_type'] == "Manager"){ echo "selected";}?>>Manager</option>
        </select>
    </div>
    <div class="form-group">
        <label for="username" class="text-light">รูปภาพ :</label>
        <?php if ($rs_update_users['picture'] != "") { ?>
            <img class="img-profile border-0 img-thumbnail " src="../images/images_profile/<?= $rs_update_users['picture'] ?>">
            <button type="button" class="btn btn-danger btn-sm" onclick="javascript:location.href='?mn=users&file=users_edit&id_edit=<?= $id_edit ?>&del_pic=<?= $d_pic ?>'"><i class="far fa-trash-alt"></i></button>
        <?php } else { ?>
            <input type="file" class="file-3" id="picupload" name="picupload">
        <?php } ?>
    </div>
    <div class="form-group">
        <label for="username" class="text-light">ชื่อผู้ใช้ :</label>
        <input type="text" class="form-control" id="username" placeholder="ชื่อผู้ใช้..." name="username" value="<?= $rs_update_users['name'] ?>" required>
    </div>
    <div class="form-group">
        <label for="email" class="text-light">อีเมล :</label>
        <input type="email" class="form-control" id="useremail" placeholder="อีเมล..." name="useremail" value="<?= $rs_update_users['email'] ?>" required>
    </div>
    <div class="form-group">
        <label for="pwd" class="text-light">รหัสผ่านเดิม :</label>
        <div class="input-group">
            <input type="password" class="form-control" placeholder="รหัสผ่านเดิม..." aria-label="รหัสผ่านเดิม..." aria-describedby="basic-addon1" name="userpasswordold" id="userpasswordold" required="">
            <div class="input-group-append">
                <button class="btn btn-primary" type="button" onclick="if (userpasswordold.type == 'text') userpasswordold.type = 'password';
  else userpasswordold.type = 'text';"><i class="far fa-eye"></i></button>
            </div>
        </div>
    </div>
    <hr class="border-bottom-primary">
    <div class="form-group">
        <label for="pwd" class="text-light">รหัสผ่านใหม่ :</label>
        <div class="input-group">
            <input type="password" class="form-control" placeholder="รหัสผ่าน..." aria-label="รหัสผ่าน..." aria-describedby="basic-addon2" name="userpassword" id="userpassword" required="">
            <div class="input-group-append">
                <button class="btn btn-primary" type="button" onclick="if (userpassword.type == 'text') userpassword.type = 'password';
  else userpassword.type = 'text';"><i class="far fa-eye"></i></button>
            </div>
        </div>
        <span id="result"></span>
    </div>
    <div class="form-group">
        <label for="pwd" class="text-light">ยืนยันรหัสผ่านใหม่ :</label>
        <div class="input-group">
            <input type="password" class="form-control" placeholder="ยืนยันรหัสผ่าน..." aria-label="ยืนยันรหัสผ่าน..." aria-describedby="basic-addon3" name="userpassword2" id="userpassword2" required="">
            <div class="input-group-append">
                <button class="btn btn-primary" type="button" onclick="if (userpassword2.type == 'text') userpassword2.type = 'password';
  else userpassword2.type = 'text';"><i class="far fa-eye"></i></button>
            </div>
        </div>
        <span id='message'></span>
    </div>
    <input type="hidden" name="id_edit" value="<?= $rs_update_users['id'] ?>">
    <input type="hidden" name="csbt" value="<?= password_hash('ESurvey', PASSWORD_DEFAULT) ?>">
    <button type="submit" id="submit" class="btn btn-block btn-primary">บันทึก</button>
</form>