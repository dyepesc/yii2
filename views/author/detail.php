<?php
use yii\helpers\Html; //to write HTML inside PHP
?>
<h1>Detalle de author</h1>
<h2><?= $author->toString() ?></h2>

<h2>Books: </h2>
<ol>
    <?php foreach($author->books as $book) {?>
        <li><?= Html::a($book->title, ['book/detail','id'=> $book->id]) ?></li>
    <?php }?>
</ol>
