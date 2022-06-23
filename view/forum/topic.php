<?php 

$topic = $result['data']['topic'];
$posts = $result['data']['posts'];

?>

<h2><?= $topic->getTitle() ?></h2>

<p> De : <?= $topic->getUser()->getPseudonyme()  ?>

</p>
<p> Le : <?= $topic->getTopicDate() ?></p>
<?php
foreach($posts as $post){
    echo $post->getText();
}