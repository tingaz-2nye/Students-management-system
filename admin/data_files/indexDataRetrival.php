<?php 
    require_once ('../../config/database.php');
    require_once ('../includes/functions.php');

    $arr = array();

    $students_online = SimpleWhereSelect($db,'student')->rowCount();
    $parents_online = SimpleWhereSelect($db,'parent')->rowCount();
    $teachers_online = SimpleWhereSelect($db,'teacher')->rowCount();


    $arr[0] = $students_online;
    $arr[1] = $parents_online;
    $arr[2] = $teachers_online;

        

    echo json_encode($arr);

?>
