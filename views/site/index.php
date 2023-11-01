<?php

/* @var $this yii\web\View */
use app\models\Author;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
/** @var yii\web\View $this */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = Yii::t('app', 'Authors');
    $this->title = 'main';
?>
<div class="site-index">

    <div class="body-content">
        <p>Для авторизации: <br />
            user 12345678 <br />
            admin 12345678
        </p>

    </div>
</div>

<div class="author-index">

    <h1>Топ 10 авторов у которых больше всего книг: в порядке убывания</h1>

   <?php
        foreach ($model as $authorname) {
            echo $authorname['name'] . '<br />';
        }?>


</div>