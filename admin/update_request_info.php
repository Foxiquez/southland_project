<?php
include_once $_SERVER['DOCUMENT_ROOT'] . '/main.php';
if (!isset($_SESSION['username'])) exit(redirect('../', 0));
if ($_SESSION['admin'] < 2) exit(redirect('../profile/', 0));
if (!preg_match("/^([0-9]){1,11}$/", $_POST['req']) || $_POST['req'] < 1) exit(redirect("../profile/"));
$rows = R::getRow('SELECT * FROM ucp_requests WHERE id=?', [$_POST['req']]);
if ($rows['adminid'] != 0) {
    echo "Данная заявка уже проверена!";
    exit(redirect("../admin/requests.php", 2));
}
$admin_answer = $_POST['admin_answer'];
if (isset($_POST['accept'])) {
    echo "Вы одобрили персонажа.";
    R::exec('UPDATE ucp_requests SET status=1, adminname=?, admin_answer=? WHERE id=?', [$_SESSION['username'], $admin_answer, $_POST['req']]);
    $request = R::getRow('SELECT * FROM ucp_requests WHERE id=?', [$_POST['req']]);
    R::exec('UPDATE characters SET cked=0 WHERE `name`=?', [$request['charactername']]);
    exit(redirect("../admin/requests.php", 2));
} else {
    echo "Вы отклонили персонажа с причиной:<br><b>" . $admin_answer . "</b>";
    R::exec('UPDATE ucp_requests SET status=-1, adminname=?, admin_answer=? WHERE id=?', [$_SESSION['username'], $admin_answer, $_POST['req']]);
    $request = R::getRow('SELECT * FROM ucp_requests WHERE id=?', [$_POST['req']]);
    R::exec('UPDATE characters SET cked=-2 WHERE `name`=?', [$request['charactername']]);
    exit(redirect("../admin/requests.php", 2));
}
?>