<?php
if (isset($_GET['id_delete'])) {
    $id_del_voter = $_GET['id_delete'];

    $sql_dl = " DELETE FROM voter WHERE id = $id_del_voter ";
    $result_dl = mysqli_query($conn, $sql_dl);

    if ($result_dl) {
        header("Location: index.php?mn=voter&file=voter_list");
    }
}
