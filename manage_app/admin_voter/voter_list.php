<!-- Page Heading -->
<?php if (isset($_GET['authority'])) { ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong><i class="fas fa-user-lock"></i> สำหรับสถานะ <span class="badge badge-danger">Admin</span></strong> คุณไม่มีสิทธิ์เข้าถึงหน้านี้
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
<?php } ?>
<div class="card shadow mb-4">
    <div class="card-body">
        <a href="?mn=voter&file=voter_add" class="btn btn-primary"><i class="fas fa-plus"></i> เพิ่มข้อมูล</a>
        <div class="table-responsive mt-3">
            <table class="table table-striped table-hover text-nowrap text-center" id="voter-grid" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>ความพึงพอใจ</th>
                        <th>ชื่อผู้ถูกประเมิน ภาษาไทย</th>
                        <th>วันที่</th>
                        <th>ตัวจัดการ</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>