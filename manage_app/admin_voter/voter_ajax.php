<?php
ob_start();
session_start();
if ($_SESSION['session_icadmin'] == true or $_COOKIE['cookie_icadmin'] == true) {
    require '../lib/connect.php';
    require '../lib/mudule.php';
    if ($_SESSION['session_icadmin'] != "" and $_COOKIE['cookie_icadmin'] == "") {
        $sql_usersadmin = " SELECT * FROM users WHERE accesstokens = '" . $_SESSION['session_icadmin'] . "'";
    }
    if ($_SESSION['session_icadmin'] != "" and $_COOKIE['cookie_icadmin'] != "") {
        $sql_usersadmin = " SELECT * FROM users WHERE accesstokens = '" . $_COOKIE['cookie_icadmin'] . "'";
    }
    if ($_SESSION['session_icadmin'] == "" and $_COOKIE['cookie_icadmin'] != "") {
        $sql_usersadmin = " SELECT * FROM users WHERE accesstokens = '" . $_COOKIE['cookie_icadmin'] . "'";
    }
    $result_usersadmin = mysqli_query($conn, $sql_usersadmin);
    $rs_usersadmin = mysqli_fetch_assoc($result_usersadmin);

    $requestData = $_REQUEST;

    $columns = array(
        0 => 'voter.id',
        1 => 'voter.voter_rate',
        2 => 'assessor.assessor_fullname_th',
        3 => 'voter.voter_created',
    );

    $sql = "SELECT voter.id,voter.voter_rate,voter.voter_created,assessor.assessor_fullname_th";
    $sql .= " FROM voter INNER JOIN assessor ON assessor.id = voter.assessor_id";
    $query = mysqli_query($conn, $sql);
    $totalData = mysqli_num_rows($query);
    $totalFiltered = $totalData;

    $sql = "SELECT voter.id,voter.voter_rate,voter.voter_created,assessor.assessor_fullname_th";
    $sql .= " FROM voter INNER JOIN assessor ON assessor.id = voter.assessor_id WHERE 1=1";
    if (!empty($requestData['search']['value'])) {   // if there is a search parameter, $requestData['search']['value'] contains search parameter
        $sql .= " AND ( voter.id LIKE '" . $requestData['search']['value'] . "%' ";
        $sql .= " OR voter.voter_rate LIKE '%" . $requestData['search']['value'] . "%' ";
        $sql .= " OR voter.voter_created LIKE '%" . $requestData['search']['value'] . "%' ";
        $sql .= " OR assessor.assessor_fullname_th LIKE '%" . $requestData['search']['value'] . "%') ";
    }
    $query = mysqli_query($conn, $sql);
    $totalFiltered = mysqli_num_rows($query);
    $sql .= " ORDER BY " . $columns[$requestData['order'][0]['column']] . "   " . $requestData['order'][0]['dir'] . "  LIMIT " . $requestData['start'] . " ," . $requestData['length'] . "   ";
    $query = mysqli_query($conn, $sql);

    $data = array();
    while ($row = mysqli_fetch_array($query)) {  // preparing an array
        $nestedData = array();
        $nestedData[] = $row["id"];
        $nestedData[] = $row["voter_rate"];
        $nestedData[] = $row["assessor_fullname_th"];
        $nestedData[] = DateThai($row["voter_created"]);
        if ($rs_usersadmin['users_type'] == "Admin") {
            $nestedData[] = "
 <button type=\"button\" class=\"btn btn-info\" onclick=\"javascript:location.href='?mn=voter&amp;file=voter_view&amp;id=$row[id]'\"><i class=\"far fa-file-alt\"></i></button>
 <button type=\"button\" class=\"btn btn-warning\" onclick=\"javascript:location.href='?mn=voter&amp;file=voter_edit&amp;id_edit=$row[id]'\"><i class=\"far fa-edit\"></i></button>
 <button type=\"button\" class=\"btn btn-danger mb-1\" onclick=\"cdelte('$row[voter_rate]','index.php?mn=voter&file=voter_delete&id_delete=$row[id]')\">
 <i class=\"fas fa-trash-alt\"></i></button>
 ";
        } else {
            $nestedData[] = "
 <button type=\"button\" class=\"btn btn-info\" onclick=\"javascript:location.href='?mn=voter&amp;file=voter_view&amp;id=$row[id]'\"><i class=\"far fa-file-alt\"></i></button>
 <button type=\"button\" class=\"btn btn-warning\" onclick=\"javascript:location.href='?mn=voter&amp;file=voter_edit&amp;id_edit=$row[id]'\"><i class=\"far fa-edit\"></i></button>
 ";
        }
        $data[] = $nestedData;
    }

    $json_data = array(
        "draw" => intval($requestData['draw']),
        "recordsTotal" => intval($totalData),  // total number of records
        "recordsFiltered" => intval($totalFiltered), // total number of records after searching, if there is no searching then totalFiltered = totalData
        "data"            => $data   // total data array
    );

    echo json_encode($json_data);  // send data as json format
}
