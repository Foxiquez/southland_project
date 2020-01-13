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
            <div class="col-xs-12">
                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#tab_null" data-toggle="tab" aria-expanded="true">Античит</a></li>
                        <li class=""><a href="#tab_first" data-toggle="tab" aria-expanded="false">Операции с домами</a></li>
                        <li class=""><a href="#tab_second" data-toggle="tab" aria-expanded="false">Передачи имущества</a></li>
                        <li class=""><a href="#tab_third" data-toggle="tab" aria-expanded="false">Операции с транспортом</a></li>
                        <li class=""><a href="#tab_fourth" data-toggle="tab" aria-expanded="false">Операции с деньгами</a></li>
                        <li class=""><a href="#tab_fifth" data-toggle="tab" aria-expanded="false">Действия администрации</a></li>
                        <li class=""><a href="#tab_sixth" data-toggle="tab" aria-expanded="false">Операции с бизнесами</a></li>
                        <li class=""><a href="#tab_eighth" data-toggle="tab" aria-expanded="false">Операции с Premium</a></li>
                        <li class=""><a href="#tab_tenth" data-toggle="tab" aria-expanded="false">Смены имен</a></li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="tab_null">
                            <div id="requests_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
                                <div class="row">
                                    <div class="col-sm-6"></div>
                                    <div class="col-sm-6"></div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <table id="null" class="table table-bordered table-hover dataTable"
                                               role="grid" aria-describedby="null">
                                            <thead>
                                            <tr role="row">
                                                <th>Дата</th>
                                                <th>Содержимое</th>
                                                <th>IP</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php
                                            $qu = R::getAssocRow('SELECT * FROM logs WHERE type=0 ORDER BY date ASC');
                                            for ($i = 0; $i < count($qu); $i++) {
                                                echo '
                                                        <tr role="row">
                                                            <td>' . $qu[$i]['date'] . '</td>
                                                            <td>' . $qu[$i]['text'] . '</td>
                                                            <td>' . $qu[$i]['ip'] . '</td>
                                                        </tr>';
                                            }
                                            ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="tab_first">
                            <div id="requests_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
                                <div class="row">
                                    <div class="col-sm-6"></div>
                                    <div class="col-sm-6"></div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <table id="first" class="table table-bordered table-hover dataTable"
                                               role="grid" aria-describedby="first">
                                            <thead>
                                            <tr role="row">
                                                <th>Дата</th>
                                                <th>Содержимое</th>
                                                <th>IP</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php
                                            $qu = R::getAssocRow('SELECT * FROM logs WHERE type=1 ORDER BY date ASC');
                                            for ($i = 0; $i < count($qu); $i++) {
                                                echo '
                                                        <tr role="row">
                                                            <td>' . $qu[$i]['date'] . '</td>
                                                            <td>' . $qu[$i]['text'] . '</td>
                                                            <td>' . $qu[$i]['ip'] . '</td>
                                                        </tr>';
                                            }
                                            ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="tab_second">
                            <div id="requests_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
                                <div class="row">
                                    <div class="col-sm-6"></div>
                                    <div class="col-sm-6"></div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <table id="second" class="table table-bordered table-hover dataTable"
                                               role="grid" aria-describedby="second">
                                            <thead>
                                            <tr role="row">
                                                <th>Дата</th>
                                                <th>Содержимое</th>
                                                <th>IP</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php
                                            $qu = R::getAssocRow('SELECT * FROM logs WHERE type=2 ORDER BY date ASC');
                                            for ($i = 0; $i < count($qu); $i++) {
                                                echo '
                                                        <tr role="row">
                                                            <td>' . $qu[$i]['date'] . '</td>
                                                            <td>' . $qu[$i]['text'] . '</td>
                                                            <td>' . $qu[$i]['ip'] . '</td>
                                                        </tr>';
                                            }
                                            ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="tab_third">
                            <div id="requests_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
                                <div class="row">
                                    <div class="col-sm-6"></div>
                                    <div class="col-sm-6"></div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <table id="third" class="table table-bordered table-hover dataTable"
                                               role="grid" aria-describedby="third">
                                            <thead>
                                            <tr role="row">
                                                <th>Дата</th>
                                                <th>Содержимое</th>
                                                <th>IP</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php
                                            $qu = R::getAssocRow('SELECT * FROM logs WHERE type=3 ORDER BY date ASC');
                                            for ($i = 0; $i < count($qu); $i++) {
                                                echo '
                                                        <tr role="row">
                                                            <td>' . $qu[$i]['date'] . '</td>
                                                            <td>' . $qu[$i]['text'] . '</td>
                                                            <td>' . $qu[$i]['ip'] . '</td>
                                                        </tr>';
                                            }
                                            ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="tab_fourth">
                            <div id="requests_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
                                <div class="row">
                                    <div class="col-sm-6"></div>
                                    <div class="col-sm-6"></div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <table id="fourth" class="table table-bordered table-hover dataTable"
                                               role="grid" aria-describedby="fourth">
                                            <thead>
                                            <tr role="row">
                                                <th>Дата</th>
                                                <th>Содержимое</th>
                                                <th>IP</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php
                                            $qu = R::getAssocRow('SELECT * FROM logs WHERE type=4 ORDER BY date ASC');
                                            for ($i = 0; $i < count($qu); $i++) {
                                                echo '
                                                        <tr role="row">
                                                            <td>' . $qu[$i]['date'] . '</td>
                                                            <td>' . $qu[$i]['text'] . '</td>
                                                            <td>' . $qu[$i]['ip'] . '</td>
                                                        </tr>';
                                            }
                                            ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="tab_fifth">
                            <div id="requests_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
                                <div class="row">
                                    <div class="col-sm-6"></div>
                                    <div class="col-sm-6"></div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <table id="fifth" class="table table-bordered table-hover dataTable"
                                               role="grid" aria-describedby="fifth">
                                            <thead>
                                            <tr role="row">
                                                <th>Дата</th>
                                                <th>Содержимое</th>
                                                <th>IP</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php
                                            $qu = R::getAssocRow('SELECT * FROM logs WHERE type=5 ORDER BY date ASC');
                                            for ($i = 0; $i < count($qu); $i++) {
                                                echo '
                                                        <tr role="row">
                                                            <td>' . $qu[$i]['date'] . '</td>
                                                            <td>' . $qu[$i]['text'] . '</td>
                                                            <td>' . $qu[$i]['ip'] . '</td>
                                                        </tr>';
                                            }
                                            ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="tab_sixth">
                            <div id="requests_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
                                <div class="row">
                                    <div class="col-sm-6"></div>
                                    <div class="col-sm-6"></div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <table id="sixth" class="table table-bordered table-hover dataTable"
                                               role="grid" aria-describedby="sixth">
                                            <thead>
                                            <tr role="row">
                                                <th>Дата</th>
                                                <th>Содержимое</th>
                                                <th>IP</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php
                                            $qu = R::getAssocRow('SELECT * FROM logs WHERE type=6 ORDER BY date ASC');
                                            for ($i = 0; $i < count($qu); $i++) {
                                                echo '
                                                        <tr role="row">
                                                            <td>' . $qu[$i]['date'] . '</td>
                                                            <td>' . $qu[$i]['text'] . '</td>
                                                            <td>' . $qu[$i]['ip'] . '</td>
                                                        </tr>';
                                            }
                                            ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="tab_eighth">
                            <div id="requests_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
                                <div class="row">
                                    <div class="col-sm-6"></div>
                                    <div class="col-sm-6"></div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <table id="eighth" class="table table-bordered table-hover dataTable"
                                               role="grid" aria-describedby="eighth">
                                            <thead>
                                            <tr role="row">
                                                <th>Дата</th>
                                                <th>Содержимое</th>
                                                <th>IP</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php
                                            $qu = R::getAssocRow('SELECT * FROM logs WHERE type=8 ORDER BY date ASC');
                                            for ($i = 0; $i < count($qu); $i++) {
                                                echo '
                                                        <tr role="row">
                                                            <td>' . $qu[$i]['date'] . '</td>
                                                            <td>' . $qu[$i]['text'] . '</td>
                                                            <td>' . $qu[$i]['ip'] . '</td>
                                                        </tr>';
                                            }
                                            ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="tab_tenth">
                            <div id="requests_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
                                <div class="row">
                                    <div class="col-sm-6"></div>
                                    <div class="col-sm-6"></div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <table id="tenth" class="table table-bordered table-hover dataTable"
                                               role="grid" aria-describedby="tenth">
                                            <thead>
                                            <tr role="row">
                                                <th>Дата</th>
                                                <th>Содержимое</th>
                                                <th>IP</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php
                                            $qu = R::getAssocRow('SELECT * FROM logs WHERE type=10 ORDER BY date ASC');
                                            for ($i = 0; $i < count($qu); $i++) {
                                                echo '
                                                        <tr role="row">
                                                            <td>' . $qu[$i]['date'] . '</td>
                                                            <td>' . $qu[$i]['text'] . '</td>
                                                            <td>' . $qu[$i]['ip'] . '</td>
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
        $('#null').DataTable({
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
                "emptyTable": "Записи отсутствуют",
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
                '</select> записей'
            }
        });
        var table = $('#null').DataTable();
    });
    $(document).ready(function () {
        $('#first').DataTable({
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
                "emptyTable": "Записи отсутствуют",
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
                '</select> записей'
            }
        });
        var table = $('#first').DataTable();
    });
    $(document).ready(function () {
        $('#second').DataTable({
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
                "emptyTable": "Записи отсутствуют",
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
                '</select> записей'
            }
        });
        var table = $('#second').DataTable();
    });
    $(document).ready(function () {
        $('#third').DataTable({
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
                "emptyTable": "Записи отсутствуют",
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
                '</select> записей'
            }
        });
        var table = $('#third').DataTable();
    });
    $(document).ready(function () {
        $('#fourth').DataTable({
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
                "emptyTable": "Записи отсутствуют",
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
                '</select> записей'
            }
        });
        var table = $('#fourth').DataTable();
    });
    $(document).ready(function () {
        $('#fifth').DataTable({
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
                "emptyTable": "Записи отсутствуют",
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
                '</select> записей'
            }
        });
        var table = $('#fifth').DataTable();
    });
    $(document).ready(function () {
        $('#sixth').DataTable({
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
                "emptyTable": "Записи отсутствуют",
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
                '</select> записей'
            }
        });
        var table = $('#sixth').DataTable();
    });
    $(document).ready(function () {
        $('#eighth').DataTable({
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
                "emptyTable": "Записи отсутствуют",
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
                '</select> записей'
            }
        });
        var table = $('#eighth').DataTable();
    });
    $(document).ready(function () {
        $('#tenth').DataTable({
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
                "emptyTable": "Записи отсутствуют",
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
                '</select> записей'
            }
        });
        var table = $('#tenth').DataTable();
    });
</script>
</body>
</html>