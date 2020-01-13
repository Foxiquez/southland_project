<?php
include_once $_SERVER['DOCUMENT_ROOT'] . '/main.php';
if (!isset($_SESSION['username'])) exit(redirect('../', 0));
if ($_SESSION['admin'] < 2) exit(redirect('../profile/', 0));
ucp_header();
sidebar();
?>
<div class="content-wrapper">
    <section class="content">
        <div class="row">
            <div class="col-xs-12 col-md-8 col-md-offset-2"">
                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#tab_active" data-toggle="tab" aria-expanded="true">Активные
                                заявки</a></li>
                        <li class=""><a href="#tab_declined" data-toggle="tab" aria-expanded="false">Отклоненные
                                заявки</a></li>
                        <li class=""><a href="#tab_accepted" data-toggle="tab" aria-expanded="false">Одобренные
                                заявки</a></li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="tab_active">
                            <div id="requests_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
                                <div class="row">
                                    <div class="col-sm-6"></div>
                                    <div class="col-sm-6"></div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <table id="active_requests" class="table table-bordered table-hover dataTable"
                                               role="grid" aria-describedby="active_requests">
                                            <thead>
                                            <tr role="row">
                                                <th style="width: 10px;">№</th>
                                                <th>Имя персонажа</th>
                                                <th>Аккаунт</th>
                                                <th>Время подачи</th>
                                                <th class="disabled-sorting" style="width:30px;">Действие</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php
                                            $qu = R::getAssocRow('SELECT * FROM ucp_requests WHERE status=0 ORDER BY id ASC');
                                            for ($i = 0; $i < count($qu); $i++) {
                                                $checkkey = '
                                                        <td>
                                                            <a href="/admin/request_info.php?id=' . $qu[$i]['id'] . '">Рассмотреть</a>
                                                        </td>';
                                                echo '
                                                        <tr role="row">
                                                            <td>' . $qu[$i]['id'] . '</td>
                                                            <td>' . $qu[$i]['charactername'] . '</td>
                                                            <td>' . $qu[$i]['username'] . '</td>
                                                            <td>' . $qu[$i]['create_time'] . '</td>
                                                            ' . $checkkey . '
                                                        </tr>';
                                            }
                                            ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="tab_declined">
                            <div id="requests_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
                                <div class="row">
                                    <div class="col-sm-6"></div>
                                    <div class="col-sm-6"></div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <table id="declined_requests" class="table table-bordered table-hover dataTable"
                                               role="grid" aria-describedby="declined_requests">
                                            <thead>
                                            <tr role="row">
                                                <th style="width: 10px;">№</th>
                                                <th>Имя персонажа</th>
                                                <th>Аккаунт</th>
                                                <th>Время подачи</th>
                                                <th>Администратор</th>
                                                <th class="disabled-sorting" style="width:30px;">Действие</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php
                                            $qu = R::getAssocRow('SELECT * FROM ucp_requests WHERE status=-1 ORDER BY id DESC');
                                            for ($i = 0; $i < count($qu); $i++) {
                                                $checkkey = '
                                                        <td>
                                                            <a href="/admin/seen_request_info.php?id=' . $qu[$i]['id'] . '">Рассмотреть</a>
                                                        </td>';
                                                echo '
                                                        <tr role="row">
                                                            <td>' . $qu[$i]['id'] . '</td>
                                                            <td>' . $qu[$i]['charactername'] . '</td>
                                                            <td>' . $qu[$i]['username'] . '</td>
                                                            <td>' . $qu[$i]['create_time'] . '</td>
                                                            <td>' . $qu[$i]['adminname'] . '</td>
                                                            ' . $checkkey . '
                                                        </tr>';
                                            }
                                            ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="tab_accepted">
                            <div id="requests_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
                                <div class="row">
                                    <div class="col-sm-6"></div>
                                    <div class="col-sm-6"></div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <table id="accepted_requests" class="table table-bordered table-hover dataTable"
                                               role="grid" aria-describedby="accepted_requests">
                                            <thead>
                                            <tr role="row">
                                                <th style="width: 10px;">№</th>
                                                <th>Имя персонажа</th>
                                                <th>Аккаунт</th>
                                                <th>Время подачи</th>
                                                <th>Администратор</th>
                                                <th class="disabled-sorting" style="width:30px;">Действие</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php
                                            $qu = R::getAssocRow('SELECT * FROM ucp_requests WHERE status=1 ORDER BY id DESC');
                                            for ($i = 0; $i < count($qu); $i++) {
                                                $checkkey = '
                                                        <td>
                                                            <a href="/admin/seen_request_info.php?id=' . $qu[$i]['id'] . '">Рассмотреть</a>
                                                        </td>';
                                                echo '
                                                        <tr role="row">
                                                            <td>' . $qu[$i]['id'] . '</td>
                                                            <td>' . $qu[$i]['charactername'] . '</td>
                                                            <td>' . $qu[$i]['username'] . '</td>
                                                            <td>' . $qu[$i]['create_time'] . '</td>
                                                            <td>' . $qu[$i]['adminname'] . '</td>
                                                            ' . $checkkey . '
                                                        </tr>';
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
        $('#active_requests').DataTable({
            "searching": false,
            language: {
                "processing": "Подождите...",
                "search": "Поиск:",
                "info": "Отображается с _START_ по _END_ из _TOTAL_ заявок",
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
                '</select> заявок'
            }
        });
        var table = $('#active_requests').DataTable();
    });
    $(document).ready(function () {
        $('#declined_requests').DataTable({
            "searching": false,
            "order": [[0,"desc"]],
            language: {
                "processing": "Подождите...",
                "search": "Поиск:",
                "info": "Отображается с _START_ по _END_ из _TOTAL_ заявок",
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
                '</select> заявок'
            }
        });
        var table = $('#declined_requests').DataTable();
    });
    $(document).ready(function () {
        $('#accepted_requests').DataTable({
            "searching": false,
            "order": [[0,"desc"]],
            language: {
                "processing": "Подождите...",
                "search": "Поиск:",
                "info": "Отображается с _START_ по _END_ из _TOTAL_ заявок",
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
                '</select> заявок'
            }
        });
        var table = $('#accepted_requests').DataTable();
    });
</script>
</body>
</html>