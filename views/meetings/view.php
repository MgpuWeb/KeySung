<?php

/* @var $this yii\web\View */
/* @var $meeting array */

use yii\widgets\Pjax;

$this->title = 'Собрание';
?>
<div class="site-index">
	<?php Pjax::begin(['id' => 'meeting']); ?>
    <div class="row">
        <?php foreach ($meeting['participants'] as $participant): ?>
        <div class="col mt-5">
            <div class="card" style="width: 18rem;">
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">Пользователь №<?= $participant['id'] ?></li>
                    <li class="list-group-item">Эмоция: <?= $participant['emotion'] ?></li>
                    <li class="list-group-item">Вовлечён: <?= $participant['isInvolved'] ?></li>
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
