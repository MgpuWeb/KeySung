<?php

use app\models\ajax\Meeting;
use yii\bootstrap4\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var \yii\data\ArrayDataProvider $dataProvider */
/* @var \app\models\search\MeetingItem $searchModel */

$this->title = 'Список собраний';
?>
<div class="site-index">
    <?php
        echo GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => [
                ['class' => \yii\grid\SerialColumn::class],
                'id',
                [
                    'attribute' => 'externalId',
                ],
                'createdAt:datetime',
                [
                    'content' => static function(\app\models\ajax\MeetingItem $meeting) {
                        return Html::a('Подробнее', ["/meetings/{$meeting->id}"], ['class'=>'btn btn-primary']);
                    },
                ]
            ],
        ]);
    ?>
</div>
