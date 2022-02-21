<?php
if($rs_usersadmin['users_type'] != "Admin" && $rs_usersadmin['id'] != mysqli_real_escape_string($conn, $_GET['id']) ){
    header('Location:index.php?mn=users&file=users_list');
   exit();
}
$id_view = mysqli_real_escape_string($conn, $_GET['id']);
$sql_view = " SELECT * FROM users WHERE id = $id_view ";
$result_view = mysqli_query($conn, $sql_view);
$rs_view = mysqli_fetch_assoc($result_view);
?>
<div class="card bg-white">
    <div class="card-header">
        <h4 class="m-0 font-weight-bold text-primary"><i class="far fa-user-circle"></i> รายละเอียดโปร์ไฟล์</h4>
    </div>
    <div class="card-body text-dark">
        <p><img class="img-profile border-0 img-thumbnail " src="../images/images_profile/<?= $rs_view['picture'] ?>">
            <a class="btn btn-primary btn-circle" href="../images/images_profile/<?= $rs_view['picture'] ?>" data-fancybox="images"><i class="fas fa-search-plus"></i></a>
        </p>
        <p><i class="fas fa-tasks"></i> <?= $rs_view['users_type'] ?></p>
        <p><i class="far fa-user"></i> <?= $rs_view['name'] ?></p>
        <p><i class="far fa-envelope"></i> <?= $rs_view['email'] ?></p>
        <p><i class="far fa-calendar-plus"></i> <?= th_date2(strtotime($rs_view['created_at'])) ?></p>
        <p><i class="far fa-edit"></i> <?= th_date2(strtotime($rs_view['updated_at'])) ?></p>
    </div>
</div>