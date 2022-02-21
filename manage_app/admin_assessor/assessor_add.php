<?php
// include composer autoload
require_once 'plugin-php/autoload.php';

// import the Intervention Image Manager Class
use Intervention\Image\ImageManager;

// สร้างตัวแปรอ้างอิง object ตัวจัดการรูปภาพ
$manager = new ImageManager();

if (password_verify('ESurvey', $_POST['csbt'])) {
    $assessor_fullname_th = mysqli_real_escape_string($conn, $_POST['assessor_fullname_th']);
    $assessor_fullname_en = mysqli_real_escape_string($conn, $_POST['assessor_fullname_en']);

    $rand_integers = rand(0, 9999999);
    if (isset($_FILES['picupload']['name']) && $_FILES['picupload']['name'] != "") {
        list($filename, $ext) = explode(".", $_FILES['picupload']['name']);
        $manager->make($_FILES['picupload']['tmp_name'])
            ->resize(181, 174)
            ->save('../images/images_assessor/' . 'assessor_' . $rand_integers . '_' . date('Ymd') . date("His") . '_181x174.jpg');
        $picture = 'assessor_' . $rand_integers . '_' . date('Ymd') . date("His") . '_181x174.jpg';
    } else {
        $picture = '';
    }
    $sql_assessor = " INSERT INTO assessor SET 
                                    id = NULL,
                                    assessor_fullname_th = '$assessor_fullname_th',
                                    assessor_fullname_en = '$assessor_fullname_en',
                                    assessor_images = '$picture',
                                    assessor_created = CURRENT_TIMESTAMP
    ";
    $result_assessor = mysqli_query($conn, $sql_assessor);
    if ($result_assessor) {
        header("Location: index.php?mn=assessor&file=assessor_list");
    } else {
        $msg = " ไม่สามารถบันทึกข้อมูลได้ ";
    }
}
?>
<?php if (isset($msg)) { ?>
    <div class="alert alert-danger" role="alert">
        <?= $msg ?>
    </div>
<?php } ?>
<div class="card">
    <div class="card-header h5 font-weight-bold">
        เพิ่มผู้ถูกประเมิน
    </div>
    <div class="card-body">
        <form action="" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="username" class="text-secondary">รูปภาพ :</label>
                <input type="file" class="file-3" id="picupload" name="picupload" accept="image/*" required>
            </div>
            <div class="form-group">
                <label for="assessor_fullname_th" class="text-secondary">ชื่อ-นามสกุล ภาษาไทย :</label>
                <input type="text" class="form-control" id="assessor_fullname_th" placeholder="ชื่อ-นามสกุล ภาษาไทย..." name="assessor_fullname_th" value="<?= $_POST['assessor_fullname_th'] ?>" required>
            </div>
            <div class="form-group">
                <label for="assessor_fullname_en" class="text-secondary">ชื่อ-นามสกุล ภาษาอังกฤษ :</label>
                <input type="text" class="form-control" id="assessor_fullname_en" placeholder="ชื่อ-นามสกุล ภาษาอังกฤษ..." name="assessor_fullname_en" value="<?= $_POST['assessor_fullname_en'] ?>" required>
            </div>
            <input type="hidden" name="csbt" value="<?= password_hash('ESurvey', PASSWORD_DEFAULT) ?>">
            <button type="submit" id="submit" class="btn btn-block btn-primary">บันทึก</button>
        </form>
    </div>
    <div class="card-footer">&nbsp;</div>
</div>