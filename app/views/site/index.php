<?php

/* @var $this yii\web\View */

$this->title = 'Поиск ЖК';
?>
<div class="site-index">

    <div class="jumbotron">
        <h1>Здравствуйте!</h1>

        <p class="lead">Поищем в нашей базе данных?</p>
        <center>
        <form action="/" method="GET" >
        <input type="text" size="50%" maxlength="200" placeholder="Что ищем?" name="q" value="<?php echo $q;?>">
        <input type="submit" class="btn btn-success" value="Найти" autocomplete="off" />
        </form>
        <?php
        if (!empty($searchResult))
        {
            ?>
            <h3>Результат:</h3>
            <ul>
            <?php
            foreach ($searchResult as $type => $data) {
                ?>
                        <li>
                        <a href="/<?php echo $data->type; ?>/view?id=<?php echo $data->id; ?>"><?php echo $data->meta_title; ?></a>
                        <?php echo $data->meta_description; ?>
                        </li>
                        <?php
            }
            ?>
            </ul>
            <?php
        }
        ?>
        </center>
    </div>

    <div class="body-content">

        <div class="row">
            <div class="col-lg-4">
                <h2>О компании</h2>

                <p>Найдите страницы о компании</p>

                <p><a class="btn btn-default" href="/content">Просмотр</a></p>
            </div>
            <div class="col-lg-4">
                <h2>Жилищные комлпексы</h2>

                <p>Найдите жилищные комплексы</p>

                <p><a class="btn btn-default" href="/complex">Просмотр</a></p>
            </div>
            <div class="col-lg-4">
                <h2>Документы</h2>

                <p>Найдите дополнительные документы</p>

                <p><a class="btn btn-default" href="/knowledge">Просмотр</a></p>
            </div>
        </div>

    </div>
</div>
