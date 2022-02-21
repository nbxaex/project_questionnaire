<!-- Page Heading -->
<?php if (isset($_GET['authority'])) { ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong><i class="fas fa-user-lock"></i> สำหรับสถานะ <span class="badge badge-danger">Admin</span></strong> คุณไม่มีสิทธิ์เข้าถึงหน้านี้
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
<?php } ?>
<!-- DataTales Example -->
<div class="card shadow mb-4 bg-white text-dark">
    <div class="card-body">
        <a href="?mn=users&file=users_add" class="btn btn-primary"><i class="fas fa-plus"></i> เพิ่มบัญชีผู้ใช้</a>
        <div class="table-responsive mt-3">
            <table class="table table-striped table-hover text-nowrap" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>ชื่อผู้ใช้</th>
                        <th>สถานะผู้ใช้งาน</th>
                        <th>เร่ิมใช้งาน</th>
                        <th>อัปเดตล่าสุด</th>
                        <th>ตัวจัดการ</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($rs_usersadmin['users_type'] == "Admin") {
                        $sql_users_read = "SELECT * FROM users WHERE id <> 0";
                    }
                    if ($rs_usersadmin['users_type'] == "Manager") {
                        $sql_users_read = "SELECT * FROM users WHERE id = " . $rs_usersadmin['id'];
                    }

                    $result_users_read = mysqli_query($conn, $sql_users_read);
                    $nums = mysqli_num_rows($result_users_read);
                    while ($rs_users_read = mysqli_fetch_assoc($result_users_read)) {
                        $users_id = $rs_users_read['id'];
                    ?>
                        <tr>
                            <td><?= $rs_users_read['name'] ?></td>
                            <td><?= $rs_users_read['users_type'] ?></td>
                            <td><?= th_date2(strtotime($rs_users_read['created_at'])) ?></td>
                            <td><?= th_date2(strtotime($rs_users_read['updated_at'])) ?></td>
                            <td>
                                <button class="btn btn-info mb-1" onclick="javascript:location.href='?mn=users&file=users_view&id=<?= $users_id ?>'"><i class="far fa-address-card"></i></button>
                                <button type="button" class="btn btn-warning mb-1" onclick="javascript:location.href='?mn=users&file=users_edit&id_edit=<?= $users_id ?>'"><i class="fas fa-user-edit"></i></button>
                                <?php if ($nums > 1 && $rs_usersadmin['users_type'] == "Admin") { ?>
                                    <button type="button" class="btn btn-danger mb-1" onclick="cdelte('<?= $rs_users_read['name'] ?>','index.php?mn=users&file=users_delete&id_delete=<?= $users_id ?>')">
                                        <i class="fas fa-user-minus"></i>
                                    </button>
                                <?php } ?>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<!-- Confirm Delete Modal -->
<div class="modal fade confirm-delete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">คุณแน่ใจที่จะลบบัญชีผู้ใช้ใช่หรือไม่ ?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <p class="debug-url"></p>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">ยกเลิก</button>
                <a class="btn btn-primary btn-ok" href="login.html">ยืนยันลบ</a>
            </div>
        </div>
    </div>
</div>