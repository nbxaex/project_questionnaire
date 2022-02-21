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
        <a href="?mn=assessor&file=assessor_add" class="btn btn-primary"><i class="fas fa-plus"></i> เพิ่มข้อมูล</a>
        <div class="table-responsive mt-3">
            <table class="table table-striped table-hover text-nowrap" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>รูปภาพ</th>
                        <th>ชื่อ-นามสกุล ภาษาไทย</th>
                        <th>ชื่อ-นามสกุล ภาษาอังกฤษ</th>
                        <th>วันที่</th>
                        <th>ตัวจัดการ</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sql_assessor = " SELECT * FROM assessor ORDER BY id ASC ";
                    $result_assessor = mysqli_query($conn, $sql_assessor);
                    $nums = mysqli_num_rows($result_assessor);
                    while ($rs_assessor = mysqli_fetch_assoc($result_assessor)) {
                        $assessor_id = $rs_assessor['id'];
                    ?>
                        <tr>
                            <td><?= $rs_assessor['id'] ?></td>
                            <td class="align-middle"><img src="../images/images_assessor/<?= $rs_assessor['assessor_images'] ?>" class="rounded" width="55px" alt=""></td>
                            <td class="align-middle"><?= $rs_assessor['assessor_fullname_th'] ?></td>
                            <td class="align-middle"><?= $rs_assessor['assessor_fullname_en'] ?></td>
                            <td class="align-middle"><?= th_date2(strtotime($rs_assessor['assessor_created'])) ?></td>
                            <td class="align-middle">
                                <button class="btn btn-info mb-1" onclick="javascript:location.href='?mn=assessor&file=assessor_view&id=<?= $assessor_id ?>'"><i class="far fa-address-card"></i></button>
                                <button type="button" class="btn btn-warning mb-1" onclick="javascript:location.href='?mn=assessor&file=assessor_edit&id_edit=<?= $assessor_id ?>'"><i class="fas fa-user-edit"></i></button>
                                <button type="button" class="btn btn-danger mb-1" onclick="cdelte('<?= $rs_assessor['assessor_fullname_th'] ?>','index.php?mn=assessor&file=assessor_delete&id_delete=<?= $assessor_id ?>')">
                                    <i class="fas fa-user-minus"></i>
                                </button>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>