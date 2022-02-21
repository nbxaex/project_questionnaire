<?php
if (password_verify('ESurvey', $_POST['csbt'])) {
    $assessor_id = mysqli_real_escape_string($conn, $_POST['assessor_id']);
    $voter_rate = mysqli_real_escape_string($conn, $_POST['voter_rate']);
    $sql_create_voter = " INSERT INTO voter SET
        id = NULL,
        voter_rate = '$voter_rate',
        assessor_id = '$assessor_id',
        voter_created = CURRENT_TIMESTAMP ";
    $result_create_voter = mysqli_query($conn, $sql_create_voter);
    if ($result_create_voter) {
        header("Location: index.php?mn=voter&file=voter_list");
    } else {
        $wrongpass = " ไม่สามารถบันทึกข้อมูลได้ ";
    }
}
?>
<?php if (isset($wrongpass)) { ?>
    <div class="alert alert-danger" role="alert">
        <?= $wrongpass ?>
    </div>
<?php } ?>
<div class="card">
    <div class="card-header font-weight-bold h5">
        เพิ่มข้อมูลประเมิน
    </div>
    <div class="card-body">
        <form action="" method="POST">
            <div class="form-group">
                <label for="assessor_id">ผู้ถูกประเมิน :</label>
                <select name="assessor_id" id="assessor_id" name="assessor_id" class="form-control" required>
                    <option disabled>เลือกผู้ถูกประเมิน</option>
                    <?php
                    $sql_assessor = " SELECT * FROM assessor ORDER BY id ASC";
                    $result_assessor = mysqli_query($conn, $sql_assessor);
                    while ($rs_assessor = mysqli_fetch_assoc($result_assessor)) {
                    ?>
                        <option value="<?= $rs_assessor['id'] ?>"><?= $rs_assessor['assessor_fullname_th'] ?> (<?= $rs_assessor['assessor_fullname_en'] ?>)</option>
                    <?php } ?>
                    <?php ?>
                </select>
            </div>
            <div class="form-group">
                <label for="voter_rate">คะแนนความพึงพอใจ :</label>
                <select name="voter_rate" id="voter_rate" name="voter_rate" class="form-control" required>
                    <option disabled>กรุณาให้คะแนนความพึงพอใจ</option>
                    <option value="แย่มาก">แย่มาก</option>
                    <option value="แย่">แย่</option>
                    <option value="พอใช้">พอใช้</option>
                    <option value="ดี">ดี</option>
                    <option value="ดีมาก">ดีมาก</option>
                </select>
            </div>
            <input type="hidden" name="csbt" value="<?= password_hash('ESurvey', PASSWORD_DEFAULT) ?>">
            <button type="submit" id="submit" class="btn btn-block btn-primary">บันทึก</button>
        </form>
    </div>
    <div class="card-footer">
        &nbsp;
    </div>
</div>