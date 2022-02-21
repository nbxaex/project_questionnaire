<?php
if($rs_usersadmin['users_type'] != "Admin" && $rs_usersadmin['id'] != mysqli_real_escape_string($conn, $_GET['id_delete']) ){
    header('Location:index.php?mn=users&file=users_list&authority=wrong');
   exit();
}
 if (isset($_GET['id_delete'])) {
     $id_del_users = $_GET['id_delete'];

     $sql_del_users = " SELECT * FROM users WHERE id = $id_del_users ";
     $result_del_users = mysqli_query($conn,$sql_del_users);
     $rs_delete_users = mysqli_fetch_assoc($result_del_users);
         $fileupload = $rs_delete_users['picture'];
         if ($fileupload != "") {
             unlink("images-profile/$fileupload");
         }
     $sql_dl = " DELETE FROM users WHERE id = $id_del_users ";
     $result_dl = mysqli_query($conn,$sql_dl);

     if($result_dl){
        header("Location: index.php?mn=users&file=users_list");
        exit;
    }
 }
