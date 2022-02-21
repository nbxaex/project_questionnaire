<?php

// include composer autoload
require_once 'plugin-php/autoload.php';

// import the Intervention Image Manager Class
use Intervention\Image\ImageManager;

// สร้างตัวแปรอ้างอิง object ตัวจัดการรูปภาพ
$manager = new ImageManager();
if (password_verify('ESurvey', $_POST['csbt'])) {
    $id_edit = mysqli_real_escape_string($conn, $_POST['id_edit']);
    $assessor_fullname_th = mysqli_real_escape_string($conn, $_POST['assessor_fullname_th']);
    $assessor_fullname_en = mysqli_real_escape_string($conn, $_POST['assessor_fullname_en']);

    $rand_integers = rand(0, 9999999);
    if (isset($_FILES['picupload']['name']) && $_FILES['picupload']['name'] != "") {
        list($filename, $ext) = explode(".", $_FILES['picupload']['name']);
        $manager->make($_FILES['picupload']['tmp_name'])
            ->resize(181, 174)
            ->save('../images/images_assessor/' . 'assessor_' . $rand_integers . '_' . date('Ymd') . date("His") . '_181x174.jpg');
        $picture = 'assessor_' . $rand_integers . '_' . date('Ymd') . date("His") . '_181x174.jpg';

        // 
        $sql_img_assessor = " UPDATE assessor SET assessor_images = '$picture' WHERE id = '$id_edit' ";
        $result_img_assessor = mysqli_query($conn, $sql_img_assessor);
    }
    $sql_assessor = " UPDATE assessor SET 
                                    assessor_fullname_th = '$assessor_fullname_th',
                                    assessor_fullname_en = '$assessor_fullname_en'
                                    WHERE id = '$id_edit'
    ";
    $result_assessor = mysqli_query($conn, $sql_assessor);
    if ($result_assessor) {
        header("Location: index.php?mn=assessor&file=assessor_list");
    } else {
        $msg = " ไม่สามารถบันทึกข้อมูลได้ ";
    }
}

// del img
if ($_GET['del_pic'] != "") {
    $sql_update_im = " UPDATE assessor SET assessor_images = '' WHERE id = $_GET[id_edit] ";
    $result_update_im = mysqli_query($conn, $sql_update_im);
    unlink("../images/images_assessor/$_GET[del_pic]");
    header("Location: index.php?mn=assessor&file=assessor_edit&id_edit=$_GET[id_edit]");
}
?>
<?php if (isset($wrongpass)) { ?>
    <div class="alert alert-danger" role="alert">
        <?= $msg ?>
    </div>
<?php } ?>
<?php
$id_edit = mysqli_real_escape_string($conn, $_GET['id_edit']);
$sql_update_assessor = "SELECT * FROM assessor WHERE id = $id_edit ";
$result_update_assessor = mysqli_query($conn, $sql_update_assessor);
$rs_update_assessor = mysqli_fetch_assoc($result_update_assessor);
$d_pic = $rs_update_assessor['assessor_images'];
?>
<form action="" method="POST" enctype="multipart/form-data">
    <div class="form-group">
        <label for="username" class="text-light">รูปภาพ :</label>
        <?php if ($rs_update_assessor['assessor_images'] != "") { ?>
            <img class="img-profile border-0 img-thumbnail " src="../images/images_assessor/<?= $rs_update_assessor['assessor_images'] ?>">
            <button type="button" class="btn btn-danger btn-sm" onclick="javascript:location.href='?mn=assessor&file=assessor_edit&id_edit=<?= $id_edit ?>&del_pic=<?= $d_pic ?>'"><i class="far fa-trash-alt"></i></button>
        <?php } else { ?>
            <input type="file" class="file-3" id="picupload" name="picupload" accept="image/*" required>
        <?php } ?>
    </div>
    <div class="form-group">
        <label for="assessor_fullname_th" class="text-secondary">ชื่อ-นามสกุล ภาษาไทย :</label>
        <input type="text" class="form-control" id="assessor_fullname_th" placeholder="ชื่อ-นามสกุล ภาษาไทย..." name="assessor_fullname_th" value="<?= $rs_update_assessor['assessor_fullname_th'] ?>" required>
    </div>
    <div class="form-group">
        <label for="assessor_fullname_en" class="text-secondary">ชื่อ-นามสกุล ภาษาอังกฤษ :</label>
        <input type="text" class="form-control" id="assessor_fullname_en" placeholder="ชื่อ-นามสกุล ภาษาอังกฤษ..." name="assessor_fullname_en" value="<?= $rs_update_assessor['assessor_fullname_en'] ?>" required>
    </div>
    <input type="hidden" name="id_edit" value="<?= $rs_update_assessor['id'] ?>">
    <input type="hidden" name="csbt" value="<?= password_hash('ESurvey', PASSWORD_DEFAULT) ?>">
    <button type="submit" id="submit" class="btn btn-block btn-primary">บันทึก</button>
</form>