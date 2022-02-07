<?php

use kartik\daterange\DateRangePicker;
use yii\bootstrap4\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var \yii\data\ArrayDataProvider $dataProvider */
/* @var \app\models\search\MeetingItem $searchModel */

$this->title = 'Список собраний';
?>
<div class="site-index">
    <?php
    echo GridView::widget([
        'dataProvider' => $dataProvider,
//        'filterModel' => $searchModel,
        'columns' => [
            ['class' => \yii\grid\SerialColumn::class],
            'id',
            'externalId',
            [
                'attribute' => 'createdAt',
                'format' => 'text',
//                'filter' =>
//                    DateRangePicker::widget([
//                        'name'=>'createdAt',
//                        'convertFormat'=> true,
//                        'pluginOptions'=>[
//                            'locale'=>[
//                                'format'=>'d F y',
//                                'separator'=>' to ',
//                            ],
//                            'opens'=>'left'
//                        ]
//                    ]),
                'content' => static function (\app\models\ajax\MeetingItem $data) {
                    return Yii::$app->formatter->asDatetime($data->createdAt, "php:d F Y");
                }
            ],
            [
                'label' => 'Перейти к собранию',
                'content' => static function (\app\models\ajax\MeetingItem $meeting) {
                    return Html::a('Подробнее', ["/meetings/{$meeting->id}"], ['class' => 'btn btn-primary']);
                },
            ]
        ],
    ]);
    ?>
</div>
