<?php

use app\models\ajax\Meeting;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var Meeting $meeting */

$this->title = 'Собрание';
?>
<div class="site-index">
	<?php Pjax::begin(['id' => 'meeting']); ?>
    <div class="row">
        <?php foreach ($meeting->participants as $index => $participant): ?>
        <div class="col mt-5">
            <div class="card" style="width: 18rem;">
                <img class="card-img-top" src="https://i.pravatar.cc/1000?u=<?= $participant->id ?>" alt="Аватар пользователя">
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">Пользователь №<?= $participant->id ?></li>
                    <li class="list-group-item">Эмоция: <?= $participant->predominantEmotion ?></li>
                </ul>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
	<?php Pjax::end(); ?>
	<?php
	$script = <<< JS
	$(document).ready(function() {
		setInterval(function(){
			$.pjax.reload({container: '#meeting'});
		}, 1000);
	});
	JS;
	$this->registerJs($script);
	?>
</div>
