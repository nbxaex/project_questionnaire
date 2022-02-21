<?php
$id_view = mysqli_real_escape_string($conn, $_GET['id']);
$sql_view = " SELECT * FROM assessor WHERE id = $id_view ";
$result_view = mysqli_query($conn, $sql_view);
$rs_view = mysqli_fetch_assoc($result_view);
?>
<div class="card">
    <div class="card-header bg-primary text-light">
        <i class="far fa-user-circle"></i> รายละเอียดผู้ถูกประเมิน
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-3">

                <div class="card card-primary card-outline">
                    <div class="card-body box-profile">
                        <div class="text-center">
                            <img class="card-img rounded-circle" src="../images/images_assessor/<?= $rs_view['assessor_images'] ?>" alt="User profile picture">
                            <div class="card-img-overlay text-right">
                                <a class="btn btn-primary btn-circle" href="../images/images_assessor/<?= $rs_view['assessor_images'] ?>" data-fancybox="images"><i class="fas fa-search-plus"></i></a>
                            </div>
                        </div>
                        <h5 class="profile-username text-center mt-1"><?= $rs_view['assessor_fullname_th'] ?></h5>
                        <p class="text-muted text-center"><?= $rs_view['assessor_fullname_en'] ?></p>
                        <ul class="list-group list-group-unbordered mb-3">
                            <li class="list-group-item">
                                <b><i class="far fa-calendar-plus"></i></b> <a class="float-right"><?= th_date2(strtotime($rs_view['assessor_created'])) ?></a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="col-md-9">
                <div class="card">
                    <div class="card-header p-2 text-primary">
                        ภาพรวมข้อมูลความพึงพอใจ
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <!-- แย่มาก (Very Poor) -->
                            <?php
                            $sql_very_poor = " SELECT count(id) AS 'count_voter' FROM voter WHERE voter_rate = 'แย่มาก' AND assessor_id = '$id_view' ";
                            $result_very_poor = mysqli_query($conn, $sql_very_poor);
                            $rs_very_poor = mysqli_fetch_assoc($result_very_poor);
                            ?>
                            <div class="col-xl-4 col-md-6 mb-4">
                                <div class="card border-left-danger shadow h-100 py-2">
                                    <div class="card-body">
                                        <div class="row no-gutters align-items-center">
                                            <div class="col mr-2">
                                                <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                                                    แย่มาก (Very Poor)</div>
                                                <div class="h5 mb-0 font-weight-bold text-danger"><?= number_format($rs_very_poor['count_voter']) ?></div>
                                            </div>
                                            <div class="col-auto">
                                                <i class="far fa-tired fa-2x text-danger"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- แย่ (Poor) -->
                            <?php
                            $sql_poor = " SELECT count(id) AS 'count_voter' FROM voter WHERE voter_rate = 'แย่' AND assessor_id = '$id_view' ";
                            $result_poor = mysqli_query($conn, $sql_poor);
                            $rs_poor = mysqli_fetch_assoc($result_poor);
                            ?>
                            <div class="col-xl-4 col-md-6 mb-4">
                                <div class="card border-left-warning shadow h-100 py-2">
                                    <div class="card-body">
                                        <div class="row no-gutters align-items-center">
                                            <div class="col mr-2">
                                                <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                                    แย่ (Poor)</div>
                                                <div class="h5 mb-0 font-weight-bold text-warning"><?= number_format($rs_poor['count_voter']) ?></div>
                                            </div>
                                            <div class="col-auto">
                                                <i class="far fa-angry fa-2x text-warning"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- พอใช้ (Average) -->
                            <?php
                            $sql_average = " SELECT count(id) AS 'count_voter' FROM voter WHERE voter_rate = 'พอใช้' AND assessor_id = '$id_view' ";
                            $result_average = mysqli_query($conn, $sql_average);
                            $rs_average = mysqli_fetch_assoc($result_average);
                            ?>
                            <div class="col-xl-4 col-md-6 mb-4">
                                <div class="card shadow h-100 py-2" style="border-left:solid 5px yellow; opacity: 0.7;">
                                    <div class="card-body">
                                        <div class="row no-gutters align-items-center">
                                            <div class="col mr-2">
                                                <div class="text-xs font-weight-bold text-uppercase mb-1 text-dark">
                                                    พอใช้ (Average)</div>
                                                <div class="h5 mb-0 font-weight-bold text-dark"><?= number_format($rs_average['count_voter']) ?></div>
                                            </div>
                                            <div class="col-auto">
                                                <i class="far fa-meh fa-2x" style="color:yellow;opacity: 0.6;"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- ดี (Good) -->
                            <?php
                            $sql_good = " SELECT count(id) AS 'count_voter' FROM voter WHERE voter_rate = 'ดี' AND assessor_id = '$id_view' ";
                            $result_good = mysqli_query($conn, $sql_good);
                            $rs_good = mysqli_fetch_assoc($result_good);
                            ?>
                            <div class="col-xl-4 col-md-6 mb-4">
                                <div class="card shadow h-100 py-2" style="border-left:solid 5px yellowgreen;">
                                    <div class="card-body">
                                        <div class="row no-gutters align-items-center">
                                            <div class="col mr-2">
                                                <div class="text-xs font-weight-bold text-uppercase mb-1" style="color:yellowgreen;">
                                                    ดี (Good)</div>
                                                <div class="h5 mb-0 font-weight-bold" style="color:yellowgreen;"><?= number_format($rs_good['count_voter']) ?></div>
                                            </div>
                                            <div class="col-auto">
                                                <i class="far fa-smile fa-2x" style="color:yellowgreen;"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- ดีมาก (Excellent) -->
                            <?php
                            $sql_excellent = " SELECT count(id) AS 'count_voter' FROM voter WHERE voter_rate = 'ดีมาก' AND assessor_id = '$id_view' ";
                            $result_excellent = mysqli_query($conn, $sql_excellent);
                            $rs_excellent = mysqli_fetch_assoc($result_excellent);
                            ?>
                            <div class="col-xl-4 col-md-6 mb-4">
                                <div class="card border-left-success shadow h-100 py-2">
                                    <div class="card-body">
                                        <div class="row no-gutters align-items-center">
                                            <div class="col mr-2">
                                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                    ดีมาก (Excellent)</div>
                                                <div class="h5 mb-0 font-weight-bold text-success"><?= number_format($rs_excellent['count_voter']) ?></div>
                                            </div>
                                            <div class="col-auto">
                                                <i class="far fa-smile-beam fa-2x text-success"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>