<?php
include_once $_SERVER['DOCUMENT_ROOT'] . '/main.php';
if (!isset($_SESSION['username'])) exit(redirect('../', 0));
if ($_SESSION['admin'] < 2) exit(redirect('../profile/', 0));
if (!preg_match("/^([0-9]){1,11}$/", $_GET['id']) || $_GET['id'] < 1) exit(redirect("../profile/", 0));
$user = R::getRow('SELECT id,username,mail,reg_date,last_login,last_ip,admin,premium FROM accounts WHERE id=?', [$_GET['id']]);
$characters = R::getAssocRow('SELECT id,name,cked FROM characters WHERE username=?', [$user['username']]);
ucp_header();
sidebar();
?>
<div class="content-wrapper">
    <section class="content-header">
        <?php
        if ($_SESSION['ban-result'] == 1) {
            unset($_SESSION['ban-result']);
            echo '<div class="callout callout-danger"><p>Пользователь заблокирован!</p></div>';
        }
        ?>
    </section>
    <section class="invoice">
        <div class="row">
            <div class="col-xs-12">
                <h2 class="page-header">
                    Аккаунт - <b><?php echo $user['username']; ?></b>
                </h2>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-4 col-md-6">
                <dl class="dl-horizontal">
                    <dt>Идентификатор (id)</dt>
                    <dd><?php echo $user['id']; ?></dd>
                    <br>
                    <dt>Статус</dt>
                    <dd><?php
                        $status = array();
                        if ($user['admin'] > 0) array_push($status, "<span class='text-primary'>Администратор (" . $user['admin'] . " ур.)</span>");
                        if ($user['premium'] == 1) array_push($status, "<span style='color:#cd7f32;'>Bronze VIP</span>");
                        if ($user['premium'] == 2) array_push($status, "<span style='color:#969696;'>Silver VIP</span>");
                        if ($user['premium'] == 3) array_push($status, "<span style='color:#ffd700;'>Gold VIP</span>");
                        if ($user['premium'] == 4) array_push($status, "<span style='color:#ff0000;'>Platinum VIP</span>");
                        if (count($status) == 1) echo $status[0];
                        if (count($status) == 2) echo $status[0] . '<span class="text-primary">,</span> ' . $status[1];
                        if(empty($status)) echo 'Обычный';
                        ?></dd>
                </dl>
            </div>
            <div class="col-lg-4 col-md-6">
                <dl class="dl-horizontal">
                    <dt>E-mail</dt>
                    <dd><?php echo $user['mail']; ?></dd>
                    <br>
                    <dt>Последний вход</dt>
                    <dd><?php if (!empty($user['last_login'])) echo $user['last_login']; else echo 'Отсутствует'; ?></dd>
                    <dd><?php if ($user['last_ip'] != 'n/a') echo $user['last_ip']; ?></dd>
                </dl>
            </div>
            <div class="col-lg-4 col-md-6">
                <dl class="dl-horizontal">
                    <dt>Дата регистрации</dt>
                    <dd><?php echo $user['reg_date']; ?></dd>
                    <br>
                </dl>
            </div>
        </div>
        <div class="row">
            <?php
            if ($_SESSION['admin'] > 1) {
                $ban_status = R::getRow('SELECT * FROM blacklist WHERE username=? ORDER BY id DESC', [$user['username']]);
                if (isset($ban_status['id'])) {
                    echo '<hr><div class="text-center"><div class="col-xs-12"><blockquote>
                    <p>Аккаунт заблокирован админстратором <b>' . $ban_status['admin'] . '</b>';
                    $ban_date=$ban_status['unban_date'];
                    $ban_date=date("d.m i:m",strtotime($ban_date));
                    if ($ban_status['unban_date'] != '00.00.0000 0:00:00') echo ' до ' . $ban_date; else echo ' бессрочно';
                    echo ' по причине: <i>' . $ban_status['reason'] . '</i></p><a class="btn btn-flat btn-danger btn-sm">Разблокировать</a></blockquote></div></div>';
                } else {
                    if($_SERVER['admin']>2)
                    echo '
                    <div class="pull-right">
                        <form method="post" action="../admin/ban.php?id=' . $user['id'] . '">
                            <div class="input-group">
                                <div class="col-sm-3 col-xs-6">
                                    <input type="number" class="form-control" name="time" placeholder="Срок">
                                </div>
                                <div class="col-sm-6 col-xs-6">
                                    <input type="text" class="form-control" name="reason" placeholder="Причина">
                                </div>
                                <div class="col-sm-3 col-xs-12">
                                    <input type="submit" class="btn btn-danger btn-block btn-flat" value="Блокировать">
                                </div>
                            </div>
                        </form>
                    </div>';
                }
            }
            ?>
        </div>
        <hr>
        <div class="row">
            <?php
            for ($i = 0; $i < count($characters); $i++) {
                if ($characters[$i]['cked'] == 0) {
                    $link = R::getRow('SELECT id FROM ucp_requests WHERE charactername=?', [$characters[$i]['name']]);
                    echo '
                            <div class="col-xs-6 col-md-4 col-lg-3">
                                <div class="small-box bg-green">
                                    <div class="icon">
                                        <i class="fa fa-user"></i>
                                    </div>
                                    <div class="inner">
                                        <p>' . $characters[$i]['name'] . '</p>
                                    </div>
                                    <a href="../admin/seen_request_info.php?id=' . $link['id'] . '" class="small-box-footer">Активен <i class="fa fa-arrow-circle-right" style="margin-left: 5px; font-size: 14px; padding-top: 3px;"></i></a>
                                </div>
                            </div>';
                } else if ($characters[$i]['cked'] == '-1') {
                    $link = R::getRow('SELECT id FROM ucp_requests WHERE charactername=?', [$characters[$i]['name']]);
                    echo '
                            <div class="col-xs-6 col-md-4 col-lg-3">
                                <div class="small-box bg-orange">
                                    <div class="icon">
                                        <i class="fa fa-user"></i>
                                    </div>
                                    <div class="inner">
                                        <p>' . $characters[$i]['name'] . '</p>
                                    </div>
                                    <a href="../admin/seen_request_info.php?id=' . $link['id'] . '" class="small-box-footer">На рассмотрении <i class="fa fa-arrow-circle-right" style="margin-left: 5px; font-size: 14px; padding-top: 3px;"></i></a>
                                </div>
                            </div>';
                } else if ($characters[$i]['cked'] == '-2') {
                    $link = R::getRow('SELECT id FROM ucp_requests WHERE charactername=?', [$characters[$i]['name']]);
                    echo '
                            <div class="col-xs-6 col-md-4 col-lg-3">
                                <div class="small-box bg-red">
                                    <div class="icon">
                                        <i class="fa fa-user-times"></i>
                                    </div>
                                    <div class="inner">
                                        <p>' . $characters[$i]['name'] . '</p>
                                    </div>
                                    <a href="../admin/seen_request_info.php?id=' . $link['id'] . '" class="small-box-footer">Отклонен <i class="fa fa-arrow-circle-right" style="margin-left: 5px; font-size: 14px; padding-top: 3px;"></i></a>
                                </div>
                            </div>';
                }
            }
            ?>
        </div>
    </section>
</div>
<script src="../assets/jquery.min.js"></script>
<script src="../assets/bootstrap.min.js"></script>
<script src="../assets/adminlte.min.js"></script>
<script src="../assets/demo.js"></script>
</body>
</html>