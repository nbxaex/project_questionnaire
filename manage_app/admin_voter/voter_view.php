<?php
$id_edit = $_GET['id'];
$sql_edit = " SELECT * FROM vote WHERE id = $id_edit ";
$result_edit = mysqli_query($conn, $sql_edit);
$rs_edit = mysqli_fetch_assoc($result_edit);
?>
<div class="card">
    <div class="card-header font-weight-bold h5">
        รายละเอียดข้อมูลประเมินความพึงพอใจ
    </div>
    <div class="card-body">
        <div class="form-group">
            <label for="vote_fullname" class="font-weight-bold">ชื่อ-นามสกุล :</label>
            <span><?= $rs_edit['vote_fullname'] ?></span>
        </div>
        <div class="form-group">
            <label for="vote_telephone" class="font-weight-bold">เบอร์โทรศัพท์ :</label>
            <span><?= $rs_edit['vote_telephone'] ?></span>
        </div>
        <div class="form-group">
            <label for="vote_create" class="font-weight-bold">คะแนนความพึงพอใจ :</label>
            <span><?= $rs_edit['vote_rate'] ?></span>
        </div>
        <div class="form-group">
            <label for="vote_create" class="font-weight-bold">วันที่ :</label>
            <span><?= DateThai($rs_edit["vote_create"]) ?></span>
        </div>
    </div>
    <div class="card-footer">
        &nbsp;
    </div>
</div>