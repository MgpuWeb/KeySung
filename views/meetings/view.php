<?php

use app\models\ajax\Meeting;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var Meeting $meeting */

$this->title = 'Собрание';
?>
<div class="site-index">
    <?php if ($meeting !== null): ?>
        <?php Pjax::begin(['id' => 'meeting']); ?>
        <div class="row">
            <?php foreach ($meeting->participants as $index => $participant): ?>
            <div class="col mt-5">
                <div class="card" style="width: 18rem;">
                    <img class="card-img-top" width="200" height="200" src="<?= sprintf('%s/%s', Yii::$app->params['services']['emotions']['images_url'], $participant->meta->avatarPath) ?>" alt="Аватар пользователя">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">Пользователь №<?= $participant->id ?></li>
                        <li class="list-group-item">Эмоция:
                            <span style="text-align: center"><?= match ($participant->predominantEmotion) {
                                'neutral'  => '<svg width="60" height="60" viewBox="0 0 60 60" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M60 30C60 46.5683 46.5683 60 30 60C13.4333 60 0 46.5683 0 30C0 13.4333 13.4333 0 30 0C46.5683 0 60 13.4333 60 30Z" fill="#8BD260"/>
<path d="M26.6667 29.9998C25.9684 29.9998 25.3184 29.5582 25.0851 28.8598C24.7467 27.8615 23.3901 24.9998 21.6667 24.9998C19.8967 24.9998 18.5201 28.0448 18.2484 28.8598C17.9567 29.7315 17.0184 30.2065 16.1401 29.9132C15.2667 29.6232 14.7951 28.6782 15.0867 27.8048C15.2951 27.1782 17.2601 21.6665 21.6667 21.6665C26.0734 21.6665 28.0384 27.1782 28.2484 27.8065C28.5401 28.6798 28.0684 29.6248 27.1951 29.9148C27.0184 29.9715 26.8401 29.9998 26.6667 29.9998ZM43.3334 29.9998C42.6351 29.9998 41.9851 29.5582 41.7534 28.8598C41.4151 27.8615 40.0551 24.9998 38.3334 24.9998C36.5634 24.9998 35.1851 28.0448 34.9134 28.8598C34.6217 29.7315 33.6867 30.2065 32.8051 29.9132C31.9334 29.6232 31.4601 28.6782 31.7517 27.8048C31.9617 27.1782 33.9251 21.6665 38.3334 21.6665C42.7417 21.6665 44.7051 27.1782 44.9134 27.8065C45.2051 28.6798 44.7334 29.6248 43.8601 29.9148C43.6851 29.9715 43.5067 29.9998 43.3334 29.9998ZM30.0001 36.6665C23.9617 36.6665 19.9551 35.9632 15.0001 34.9998C13.8684 34.7815 11.6667 34.9998 11.6667 38.3332C11.6667 44.9998 19.3251 53.3332 30.0001 53.3332C40.6734 53.3332 48.3334 44.9998 48.3334 38.3332C48.3334 34.9998 46.1317 34.7798 45.0001 34.9998C40.0451 35.9632 36.0384 36.6665 30.0001 36.6665Z" fill="#664500"/>
<path d="M15 38.3335C15 38.3335 20 40.0002 30 40.0002C40 40.0002 45 38.3335 45 38.3335C45 38.3335 42.76 49.5835 30 49.5835C17.24 49.5835 15 38.3335 15 38.3335Z" fill="white"/>
<path d="M30.0001 45.99C24.0067 45.99 19.5467 45.37 16.7717 44.7483L15.3967 41.63C16.7684 42.15 21.8784 43.125 30.0017 43.125C38.2584 43.125 43.3967 42.0983 44.7751 41.5616L43.6067 44.6316C40.8834 45.265 36.2417 45.99 30.0001 45.99Z" fill="#664500"/>
<path d="M30 60C46.5685 60 60 46.5685 60 30C60 13.4315 46.5685 0 30 0C13.4315 0 0 13.4315 0 30C0 46.5685 13.4315 60 30 60Z" fill="#4DC5F9"/>
<path d="M17.525 39.3683C17.6 39.6666 19.4717 46.6666 30 46.6666C40.53 46.6666 42.4 39.6666 42.475 39.3683C42.5667 39.0066 42.4034 38.6316 42.08 38.445C41.755 38.26 41.3484 38.315 41.08 38.5733C41.0484 38.605 37.8234 41.6666 30 41.6666C22.1767 41.6666 18.95 38.605 18.92 38.575C18.76 38.4166 18.5467 38.3333 18.3334 38.3333C18.1934 38.3333 18.0517 38.3683 17.9234 38.44C17.5967 38.6266 17.4334 39.005 17.525 39.3683Z" fill="#664500"/>
<path d="M19.9999 28.3334C22.3011 28.3334 24.1666 25.7217 24.1666 22.5C24.1666 19.2784 22.3011 16.6667 19.9999 16.6667C17.6987 16.6667 15.8333 19.2784 15.8333 22.5C15.8333 25.7217 17.6987 28.3334 19.9999 28.3334Z" fill="#664500"/>
<path d="M39.9999 28.3334C42.3011 28.3334 44.1666 25.7217 44.1666 22.5C44.1666 19.2784 42.3011 16.6667 39.9999 16.6667C37.6987 16.6667 35.8333 19.2784 35.8333 22.5C35.8333 25.7217 37.6987 28.3334 39.9999 28.3334Z" fill="#664500"/>
</svg>',
                                'happy'    => '<svg width="55" height="55" viewBox="0 0 55 55" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M55 27.5C55 42.6876 42.6876 55 27.5 55C12.3139 55 0 42.6876 0 27.5C0 12.3139 12.3139 0 27.5 0C42.6876 0 55 12.3139 55 27.5Z" fill="#FFCC4D"/>
<path d="M24.4453 27.5002C23.8052 27.5002 23.2093 27.0953 22.9955 26.4552C22.6853 25.54 21.4417 22.9169 19.862 22.9169C18.2395 22.9169 16.9775 25.7081 16.7285 26.4552C16.4611 27.2542 15.601 27.6896 14.7959 27.4207C13.9953 27.1549 13.563 26.2887 13.8303 25.4881C14.0213 24.9137 15.8225 19.8613 19.862 19.8613C23.9014 19.8613 25.7027 24.9137 25.8952 25.4896C26.1625 26.2902 25.7302 27.1564 24.9296 27.4223C24.7677 27.4742 24.6042 27.5002 24.4453 27.5002ZM39.7231 27.5002C39.083 27.5002 38.4871 27.0953 38.2748 26.4552C37.9646 25.54 36.718 22.9169 35.1398 22.9169C33.5173 22.9169 32.2538 25.7081 32.0048 26.4552C31.7374 27.2542 30.8803 27.6896 30.0721 27.4207C29.2731 27.1549 28.8392 26.2887 29.1066 25.4881C29.2991 24.9137 31.0988 19.8613 35.1398 19.8613C39.1807 19.8613 40.9805 24.9137 41.1714 25.4896C41.4388 26.2902 41.0064 27.1564 40.2059 27.4223C40.0455 27.4742 39.882 27.5002 39.7231 27.5002ZM27.5009 33.6113C21.9657 33.6113 18.293 32.9666 13.7509 32.0835C12.7135 31.8834 10.6953 32.0835 10.6953 35.1391C10.6953 41.2502 17.7155 48.8891 27.5009 48.8891C37.2848 48.8891 44.3064 41.2502 44.3064 35.1391C44.3064 32.0835 42.2882 31.8819 41.2509 32.0835C36.7088 32.9666 33.036 33.6113 27.5009 33.6113Z" fill="#664500"/>
<path d="M13.75 35.1387C13.75 35.1387 18.3333 36.6665 27.5 36.6665C36.6667 36.6665 41.25 35.1387 41.25 35.1387C41.25 35.1387 39.1967 45.4512 27.5 45.4512C15.8033 45.4512 13.75 35.1387 13.75 35.1387Z" fill="white"/>
<path d="M27.5002 42.1575C22.0063 42.1575 17.9179 41.5892 15.3742 41.0193L14.1138 38.1609C15.3711 38.6375 20.0553 39.5313 27.5017 39.5313C35.0703 39.5313 39.7804 38.5902 41.0439 38.0982L39.9729 40.9124C37.4765 41.493 33.2217 42.1575 27.5002 42.1575Z" fill="#664500"/>
</svg>',
                                'sad'      => '<svg width="60" height="60" viewBox="0 0 60 60" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M60 30C60 46.5683 46.5683 60 30 60C13.4333 60 0 46.5683 0 30C0 13.4333 13.4333 0 30 0C46.5683 0 60 13.4333 60 30Z" fill="#E7D099"/>
<path d="M28.8533 29.3532C28.5599 29.1149 28.1416 29.1082 27.8366 29.3299C27.8166 29.3449 25.7366 30.8332 21.6666 30.8332C17.5983 30.8332 15.5166 29.3449 15.4999 29.3332C15.1949 29.1049 14.7749 29.1115 14.4816 29.3482C14.1849 29.5849 14.0849 29.9915 14.2383 30.3382C14.3383 30.5632 16.7383 35.8332 21.6666 35.8332C26.5966 35.8332 28.9949 30.5632 29.0949 30.3382C29.2483 29.9932 29.1483 29.5899 28.8533 29.3532ZM45.5199 29.3532C45.2266 29.1149 44.8099 29.1065 44.5033 29.3299C44.4832 29.3449 42.4016 30.8332 38.3333 30.8332C34.2666 30.8332 32.1833 29.3449 32.1666 29.3332C31.8616 29.1049 31.4433 29.1115 31.1483 29.3482C30.8516 29.5849 30.7516 29.9915 30.9049 30.3382C31.0049 30.5632 33.4049 35.8332 38.3333 35.8332C43.2633 35.8332 45.6616 30.5632 45.7616 30.3382C45.9149 29.9932 45.8149 29.5899 45.5199 29.3532ZM36.6666 46.6665H23.3333C22.4133 46.6665 21.6666 45.9215 21.6666 44.9999C21.6666 44.0782 22.4133 43.3332 23.3333 43.3332H36.6666C37.5883 43.3332 38.3333 44.0782 38.3333 44.9999C38.3333 45.9215 37.5883 46.6665 36.6666 46.6665ZM9.99992 23.3332C9.07992 23.3332 8.33325 22.5865 8.33325 21.6665C8.33325 20.7482 9.07492 20.0032 9.99325 19.9999C10.2533 19.9965 15.9416 19.8565 20.3349 13.9999C20.8866 13.2665 21.9299 13.1132 22.6683 13.6665C23.4049 14.2182 23.5533 15.2632 23.0016 15.9999C17.5633 23.2499 10.3066 23.3332 9.99992 23.3332ZM49.9999 23.3332C49.6933 23.3332 42.4383 23.2499 36.9999 15.9999C36.4466 15.2632 36.5966 14.2182 37.3333 13.6665C38.0683 13.1115 39.1116 13.2632 39.6649 13.9999C44.0666 19.8682 49.7666 19.9982 50.0083 19.9999C50.9249 20.0099 51.6649 20.7599 51.6599 21.6749C51.6566 22.5932 50.9166 23.3332 49.9999 23.3332Z" fill="#664500"/>
</svg>',
                                'surprise' => '<svg width="60" height="60" viewBox="0 0 60 60" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M60 30C60 46.5683 46.5683 60 30 60C13.4333 60 0 46.5683 0 30C0 13.4333 13.4333 0 30 0C46.5683 0 60 13.4333 60 30Z" fill="#FFCC4D"/>
<path d="M48.3333 46.6667C52.9357 46.6667 56.6667 42.9357 56.6667 38.3333C56.6667 33.731 52.9357 30 48.3333 30C43.731 30 40 33.731 40 38.3333C40 42.9357 43.731 46.6667 48.3333 46.6667Z" fill="#FF7892"/>
<path d="M11.6668 46.6667C16.2692 46.6667 20.0002 42.9357 20.0002 38.3333C20.0002 33.731 16.2692 30 11.6668 30C7.06446 30 3.3335 33.731 3.3335 38.3333C3.3335 42.9357 7.06446 46.6667 11.6668 46.6667Z" fill="#FF7892"/>
<path d="M40.8334 36.6667C45.896 36.6667 50.0001 32.5626 50.0001 27.5C50.0001 22.4374 45.896 18.3334 40.8334 18.3334C35.7708 18.3334 31.6667 22.4374 31.6667 27.5C31.6667 32.5626 35.7708 36.6667 40.8334 36.6667Z" fill="#F5F8FA"/>
<path d="M19.1667 36.6667C24.2293 36.6667 28.3333 32.5626 28.3333 27.5C28.3333 22.4374 24.2293 18.3334 19.1667 18.3334C14.1041 18.3334 10 22.4374 10 27.5C10 32.5626 14.1041 36.6667 19.1667 36.6667Z" fill="#F5F8FA"/>
<path d="M19.1667 31.6666C21.4679 31.6666 23.3333 29.8012 23.3333 27.5C23.3333 25.1988 21.4679 23.3333 19.1667 23.3333C16.8655 23.3333 15 25.1988 15 27.5C15 29.8012 16.8655 31.6666 19.1667 31.6666Z" fill="#292F33"/>
<path d="M40.8334 31.6666C43.1346 31.6666 45.0001 29.8012 45.0001 27.5C45.0001 25.1988 43.1346 23.3333 40.8334 23.3333C38.5322 23.3333 36.6667 25.1988 36.6667 27.5C36.6667 29.8012 38.5322 31.6666 40.8334 31.6666Z" fill="#292F33"/>
<path d="M36.6665 50H23.3332C22.4132 50 21.6665 49.255 21.6665 48.3333C21.6665 47.4116 22.4132 46.6666 23.3332 46.6666H36.6665C37.5882 46.6666 38.3332 47.4116 38.3332 48.3333C38.3332 49.255 37.5882 50 36.6665 50ZM50.0015 18.3333C49.4932 18.3333 48.9948 18.1033 48.6665 17.6666C44.2665 11.7983 38.5648 11.67 38.3232 11.6666C37.4065 11.6566 36.6665 10.9066 36.6715 9.99165C36.6765 9.07331 37.4165 8.33331 38.3332 8.33331C38.6398 8.33331 45.8948 8.41665 51.3332 15.6666C51.8865 16.4033 51.7365 17.4483 50.9998 18C50.6998 18.225 50.3498 18.3333 50.0015 18.3333ZM9.99817 18.3333C9.6515 18.3333 9.29984 18.225 8.99984 18C8.26317 17.4483 8.11484 16.4033 8.6665 15.6666C14.1032 8.41665 21.3598 8.33331 21.6665 8.33331C22.5865 8.33331 23.3332 9.07998 23.3332 9.99998C23.3332 10.9183 22.5915 11.6633 21.6732 11.6666C21.4148 11.67 15.7265 11.81 11.3332 17.6666C11.0065 18.1033 10.5048 18.3333 9.99817 18.3333Z" fill="#664500"/>
</svg>',
                                'angry'    => '<svg width="60" height="60" viewBox="0 0 60 60" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M60 30C60 46.5683 46.5683 60 30 60C13.4333 60 0 46.5683 0 30C0 13.4333 13.4333 0 30 0C46.5683 0 60 13.4333 60 30Z" fill="#FF6D4D"/>
<path d="M42.475 49.7983C42.4 49.5 40.5284 42.5 30 42.5C19.47 42.5 17.6 49.5 17.525 49.7983C17.4334 50.16 17.5967 50.535 17.92 50.7216C18.245 50.9033 18.6517 50.8533 18.92 50.5933C18.9517 50.5616 22.1767 47.5 30 47.5C37.8234 47.5 41.05 50.5616 41.08 50.5916C41.24 50.75 41.4534 50.8333 41.6667 50.8333C41.8067 50.8333 41.9484 50.7983 42.0767 50.7266C42.4034 50.54 42.5667 50.1616 42.475 49.7983ZM26.1784 28.8216C20.7534 23.3966 12.035 23.3333 11.6667 23.3333C10.7467 23.3333 10.0017 24.0783 10.0017 24.9966C10 25.9166 10.745 26.6633 11.665 26.6666C11.7134 26.6666 14.8734 26.7033 18.3034 27.895C17.315 28.9616 16.6667 30.6183 16.6667 32.5C16.6667 35.7233 18.5317 38.3333 20.8334 38.3333C23.135 38.3333 25 35.7233 25 32.5C25 32.21 24.9684 31.9333 24.9384 31.655C24.96 31.655 24.98 31.6666 25 31.6666C25.4267 31.6666 25.8534 31.5033 26.1784 31.1783C26.83 30.5266 26.83 29.4733 26.1784 28.8216ZM48.3334 23.3333C47.965 23.3333 39.2484 23.3966 33.8217 28.8216C33.17 29.4733 33.17 30.5266 33.8217 31.1783C34.1467 31.5033 34.5734 31.6666 35 31.6666C35.0217 31.6666 35.04 31.655 35.06 31.655C35.0334 31.9333 35 32.21 35 32.5C35 35.7233 36.865 38.3333 39.1667 38.3333C41.4684 38.3333 43.3334 35.7233 43.3334 32.5C43.3334 30.6183 42.685 28.9616 41.6967 27.895C45.1267 26.7033 48.2867 26.6666 48.3367 26.6666C49.2551 26.6633 50 25.9166 49.9984 24.9966C49.9967 24.0783 49.2534 23.3333 48.3334 23.3333Z" fill="#292F33"/>
</svg>',
                            } ?></span>
                        </li>
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
                $.pjax.reload({container: '#meeting', data: {'meta': false}, replace: false});
            }, 1000);
        });
        JS;
        $this->registerJs($script);
        ?>
	<?php else: ?>
        <div class="jumbotron text-center bg-transparent">
            <h1 class="display-4">Кажется такого собрания не существует...</h1>
        </div>
    <?php endif; ?>
</div>
