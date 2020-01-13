<?php
include_once $_SERVER['DOCUMENT_ROOT'] . '/main.php';
if (!isset($_SESSION['username'])) exit(redirect('../', 0));
if ($_SESSION['admin'] < 2) exit(redirect('../profile/', 0));
if(isset($_POST['username'])) {
    if($_SESSION['admin']<4) $error=1;
    else {
        $check=R::getRow('SELECT admin FROM accounts WHERE username=?',[$_POST['username']]);
        if(isset($check['admin'])) {
            if($check['admin']>0) $error=3;
            else {
                R::exec('UPDATE accounts SET admin="1" WHERE username=?',[$_POST['username']]);
                exit(redirect('../admin/admins.php',0));
            }
        } else $error=2;
    }
}
if (isset($_POST['level']) && isset($_GET['id'])) {
    if($_SESSION['admin']<4) $error=1;
    else {
        R::exec('UPDATE accounts SET admin=? WHERE id=?',[$_POST['level'],$_GET['id']]);
        $_SESSION['success']=1;
        exit(redirect('../admin/admins.php',0));
    }
}
ucp_header();
sidebar();
?>
<div class="content-wrapper">
    <section class="content">
        <div class="row">
            <div class="col-xs-12 col-md-8 col-md-offset-2">
                <div class="box box-solid">
                    <div class="box-header with-border">
                        <h3 class="box-title">Администрация</h3>
                    </div>
                    <div class="box-body">
                        <?php
                        if($error==1) {
                            echo '
                            <div class="callout callout-danger">
                                <p>Недостаточно прав!</p>
                            </div>';
                            unset($error);
                        }
                        if($_SESSION['success']==1) {
                            echo '
                            <div class="callout callout-success">
                                <p>Уровень успешно обновлен!</p>
                            </div>';
                            unset($_SESSION['success']);
                        }
                        if($error==2) {
                            echo '
                            <div class="callout callout-danger">
                                <p>Аккаунт не найден!</p>
                            </div>';
                            unset($error);
                        }
                        if($error==3) {
                            echo '
                            <div class="callout callout-danger">
                                <p>Аккаунт уже является администраторским!</p>
                            </div>';
                            unset($error);
                        }
                        ?>
                        <div id="requests_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
                            <div class="row">
                                <div class="col-xs-12">
                                    <table id="admins" class="table table-bordered table-hover dataTable" role="grid" aria-describedby="active_requests">
                                        <?php
                                        if($_SESSION['admin']>3) echo '<div class="input-group input-group-sm pull-right">
                                            <form method="post" action="../admin/admins.php">
                                                <input type="text" class="form-control" name="username" placeholder="Username">
                                                <span class="input-group-btn">
                                                    <button type="submit" class="btn btn-success btn-flat">Добавить <i class="fa fa-user-plus" style="padding-left: 5px;"></i></button>
                                                </span>
                                            </form>
                                        </div><br><hr>';
                                        ?>
                                        <thead>
                                            <tr role="row">
                                                <th style="width: 10px">Уровень</th>
                                                <th>Аккаунт</th>
                                                <th class="disabled-sorting" style="width: 10px;">Действие</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        $qu = R::getAssocRow('SELECT id,username,admin FROM accounts WHERE admin>0 ORDER BY id ASC');
                                        for ($i = 0; $i < count($qu); $i++) {
                                            echo '<tr role="row"><td>' . $qu[$i]['admin'] . '</td><td>' . $qu[$i]['username'] . '</td>';
                                            echo '<td><form method="post" action="../admin/admins.php?id='.$qu[$i]['id'].'"><div class="input-group input-group-sm pull-right">';
                                            if($_SESSION['admin']<4) echo '<input type="number" class="form-control" name="level" value="'.$qu[$i]['admin'].'" style="width:50px;" disabled>';
                                            else echo '<input type="number" class="form-control" name="level" value="'.$qu[$i]['admin'].'" style="width:50px;">';
                                            echo '<span class="input-group-btn">';
                                            if($_SESSION['admin']<4) echo '<button type="submit" class="btn btn-primary btn-flat" disabled>Обновить уровень</button>';
                                            else echo '<button type="submit" class="btn btn-primary btn-flat">Обновить уровень</button>';
                                            echo '</span></div></form></td></tr>';
                                        }
                                        ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
</div>
<script src="../assets/jquery.min.js"></script>
<script src="../assets/bootstrap.min.js"></script>
<script src="../assets/adminlte.min.js"></script>
<script src="../assets/demo.js"></script>
<script src="../assets/jquery.dataTables.min.js"></script>
<script src="../assets/dataTables.bootstrap.min.js"></script>
<script type="text/javascript">
    $(document).ready(function () {
        $('#admins').DataTable({
            "searching": false,
            "order": [[0,"desc"]],
            language: {
                "processing": "Подождите...",
                "search": "Поиск:",
                "info": "",
                "infoEmpty": "",
                "infoFiltered": "(отфильтровано из _MAX_ заявок)",
                "infoPostFix": "",
                "loadingRecords": "Загрузка записей...",
                "zeroRecords": "Записи отсутствуют",
                "emptyTable": "Заявки отсутствуют",
                "paginate": {
                    "first": "Первая",
                    "previous": "Предыдущая",
                    "next": "Следующая",
                    "last": "Последняя"
                },
                "aria": {
                    "sortAscending": ": активировать для сортировки столбца по возрастанию",
                    "sortDescending": ": активировать для сортировки столбца по убыванию"
                },
                "lengthMenu": 'Показать <select>' +
                '<option value="10">10</option>' +
                '<option value="20">20</option>' +
                '<option value="30">30</option>' +
                '<option value="40">40</option>' +
                '<option value="50">50</option>' +
                '</select> аккаунтов'
            }
        });
        var table = $('#admins').DataTable();
    });
</script>
</body>
</html>