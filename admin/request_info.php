<?php
include_once $_SERVER['DOCUMENT_ROOT'] . '/main.php';
if (!isset($_SESSION['username'])) exit(redirect('../', 0));
if ($_SESSION['admin'] < 2) exit(redirect('../profile/', 0));
if (!preg_match("/^([0-9]){1,11}$/", $_GET['id']) || $_GET['id'] < 1) exit(redirect("../admin/requests.php", 0));
$request = R::getRow('SELECT * FROM ucp_requests WHERE id=?', [$_GET['id']]);
$character = R::getRow('SELECT * FROM characters WHERE `name`=?', [$request['charactername']]);
$skin = explode('|', $character['skin']);
$check = hash("sha256", $character['name'] . $request['situation2']);
ucp_header();
sidebar();
?>
<div class="content-wrapper">
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
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
                                        <b>Аккаунт</b> <a class="pull-right"><?php echo $request['username']; ?></a>
                                    </li>
                                    <li class="list-group-item">
                                        <b>Пол</b> <a
                                                class="pull-right"><?php if ($character['gender'] == 1) echo 'Мужской'; else echo 'Женский'; ?></a>
                                    </li>
                                    <li class="list-group-item">
                                        <b>Дата рождения</b> <a
                                                class="pull-right"><?php echo $character['birthdate']; ?></a>
                                    </li>
                                    <?php
                                    if ($request['projects'] == $check && $request['terms'] == $check) echo '<li class="list-group-item text-center text-green"><b>Имеется одобренный персонаж!</b></li>';
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
                            <div class="box-footer">
                                <h4>Вердикт</h4>
                                <form action="../admin/update_request_info.php" method="post">
                                    <input type='hidden' name='req' value='<? echo $request['id']; ?>'>
                                    <div class="row">
                                        <div class="col-xs-12">
                                            <br><textarea class="form-control" rows="2" name="admin_answer"
                                                          required></textarea><br>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-xs-6">
                                            <input type="submit" name="accept" class="btn btn-block btn-success"
                                                   onclick="return confirm('Вы действительно хотите одобрить персонажа?')"
                                                   value="Одобрить">
                                        </div>
                                        <div class="col-xs-6">
                                            <input type="submit" name="decline" class="btn btn-block btn-danger"
                                                   onclick="return confirm('Вы действительно хотите отклонить персонажа?')"
                                                   value="Отклонить">
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
                if ($request['projects'] != $check && $request['terms'] != $check) {
                    ?>
                    <div class="row">
                        <div class="col-md-5">
                            <div class="box box-primary">
                                <div class="box-header with-border">
                                    <h3 class="box-title">Как долго вы играете на ролевых проектах и какие это были
                                        проекты?</h3>
                                </div>
                                <div class="box-body">
                                    <p class="text-muted">
                                        <?php echo $request['projects']; ?>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="box box-primary">
                                <div class="box-header with-border">
                                    <h3 class="box-title">Дайте развернутое определение терминам и приведите два
                                        примера: PowerGaming,
                                        MetaGaming, IC, DM, CK.</h3>
                                </div>
                                <div class="box-body">
                                    <p class="text-muted">
                                        <?php echo $request['terms']; ?>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } ?>
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