<?php

if (isset($_GET['id_delete'])) {
    $id_del_assessor = $_GET['id_delete'];

    $sql_del_assessor = " SELECT * FROM assessor WHERE id = $id_del_assessor ";
    $result_del_assessor = mysqli_query($conn, $sql_del_assessor);
    $rs_delete_assessor = mysqli_fetch_assoc($result_del_assessor);
    $fileupload = $rs_delete_assessor['assessor_images'];
    if ($fileupload != "") {
        unlink("../images/images_assessor/$fileupload");
    }
    $sql_dl = " DELETE FROM assessor WHERE id = $id_del_assessor ";
    $result_dl = mysqli_query($conn, $sql_dl);

    if ($result_dl) {
        header("Location: index.php?mn=assessor&file=assessor_list");
        exit;
    }
}
