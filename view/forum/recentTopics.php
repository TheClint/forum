<?php

$topics = $result["data"]['topics'];
$lastPosts = $result["data"]['lastPosts'];


?>
    <h2>Messages récents :</h2>
<?php

foreach($topics as $topic){
    ?>
    <div class="topic-title">    
        <div>Catégorie : <a href="index.php?ctrl=forum&action=ListTopicsByCategorie&id=<?=$topic->getCategorie()->getId() ?>"> <?=$topic->getCategorie()->getName() ?></a> Crée le : <?=$topic->getTopicDate() ?> </div>
        <a href="index.php?ctrl=forum&action=readPostsFromTopic&id=<?= $topic->getId() ?>"><?=$topic->getTitle()?></a>
        <p>Dernière réponse le : <?= $lastPosts[$topics->key()]->getMessageDate() ?> Par : <a href="index.php?ctrl=forum&action=detailUser&id=<?= $lastPosts[$topics->key()]->getUser()->getId() ?>"><?= $lastPosts[$topics->key()]->getUser()->getPseudonyme() ?></a></p>
    </div>
    <?php
    
}



  
