<?php
include_once $_SERVER['DOCUMENT_ROOT'] . '/main.php';
if (!isset($_SESSION['username'])) exit(redirect('../', 0));
if ($_SESSION['admin'] < 2) exit(redirect('../profile/', 0));
if (!preg_match("/^([0-9]){1,11}$/", $_GET['id']) || $_GET['id'] < 1) exit(redirect("../profile/", 0));
$character = R::getRow('SELECT id,username,`name`,gender,birthdate,skin,phone,cked FROM characters WHERE id=?', [$_GET['id']]);
$skin = explode('|', $character['skin']);
$request = R::getRow('SELECT * FROM ucp_requests WHERE charactername=?', [$character['name']]);
ucp_header();
sidebar();
?>
<div class="content-wrapper">
    <section class="content">
        <div class="row">
            <div class="col-md-3">
                <div class="box box-primary">
                    <div class="box-body box-profile">
                        <?php
                        if (file_exists("../assets/skins/Skin_" . $skin[0] . ".png")) echo '<img class="profile-user-img img-responsive" src="../assets/skins/Skin_' . $skin[0] . '.png">';
                        else echo '<img class="profile-user-img img-responsive" src="../assets/skins/Skin_74.png">';
                        ?>
                        <h3 class="profile-username text-center"><?php echo $character['name']; ?></h3>
                        <ul class="list-group list-group-unbordered">
                            <li class="list-group-item">
                                <b>Пол</b> <a
                                        class="pull-right"><?php if ($character['gender'] == 1) echo 'Мужской'; else echo 'Женский'; ?></a>
                            </li>
                            <li class="list-group-item">
                                <b>Дата рождения</b> <a
                                        class="pull-right"><?php echo $character['birthdate']; ?></a>
                            </li>
                            <?php
                            if ($character['cked'] == 0) {
                                echo '
                                        <li class="list-group-item">
                                            <b>Номер телефона</b> <a class="pull-right">';
                                if ($character['phone'] != 0) echo $character['phone']; else echo 'Отсутствует';
                                echo '</a></li>';
                            }
                            ?>
                            <li class="list-group-item">
                                <b>Идентификатор (id)</b> <a
                                        class="pull-right"><?php echo $character['id']; ?></a>
                            </li>
                            <?php
                            if ($character['cked'] == 0)
                                echo '
                                        <li class="list-group-item">
                                            <b>Ответственный администратор</b> 
                                            <a class="pull-right">' . $request['adminname'] . '</a>
                                        </li>';
                            ?>
                            <li class="list-group-item">
                                <b>Дата создания</b> <a
                                        class="pull-right"><?php echo $request['create_time']; ?></a>
                            </li>
                            <?php
                            if ($character['cked'] == -1)
                                echo '
                                        <li class="list-group-item">
                                            <b>Статус</b> 
                                            <span class="pull-right text-orange">На рассмотрении</span>
                                        </li>';
                            ?>
                            <?php
                            if ($character['cked'] == -2) {
                                echo '
                                        <li class="list-group-item">
                                            <b>Статус</b> 
                                            <span class="pull-right text-red">Отклонен</span>
                                        </li>
                                        <li class="list-group-item">
                                            <b>Ответственный администратор</b> 
                                            <a class="pull-right">' . $request['adminname'] . '</a>
                                        </li>
                                        <li class="list-group-item">
                                            <b>Причина отклонения</b> 
                                            <a class="pull-right">' . $request['admin_answer'] . '</a>
                                        </li>';
                            }
                            if ($character['cked'] > 0) {
                                echo '
                                        <li class="list-group-item">
                                            <b>Статус</b> 
                                            <span class="pull-right text-red">CKed</span>
                                        </li>';
                            }
                            ?>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Полное имя, характер, история персонажа, описание конкретных
                            особеностей как
                            внешних, так и внутренних.</h3>
                    </div>
                    <div class="box-body">
                        <p class="text-muted">
                            <?php echo $request['character']; ?>
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-5">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Ваш персонаж занимался стрижкой газона на территории своего
                            дома, но вдруг из
                            проезжающего мимо автомобиля открываются мимо автомобиля открывается огонь по
                            соседскому дому,
                            каковы действия вашего персонажа.</h3>
                    </div>
                    <div class="box-body">
                        <p class="text-muted">
                            <?php echo $request['situation1']; ?>
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Ваш персонаж уходит из дома, поссорившись с родителями. На
                            дворе поздний
                            вечер. Опишите действия ВАШЕГО персонажа.</h3>
                    </div>
                    <div class="box-body">
                        <p class="text-muted">
                            <?php echo $request['situation2']; ?>
                        </p>
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
</body>
</html>