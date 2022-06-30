<?php

$topics = $result["data"]['topics'];
$lastPosts = $result["data"]['lastPosts'];
$categorie = $result["data"]['categorie'];


?>
    <h2><?=$categorie->getName() ?></h2>
<?php

foreach($topics as $topic){
    ?>
    <div class="topic-title">    
        <a href="index.php?ctrl=forum&action=readPostsFromTopic&id=<?= $topic->getId() ?>"><?=$topic->getTitle()?></a>
        <p>Dernière réponse le : <?= $lastPosts[$topics->key()]->getMessageDate() ?> Par : <a href="index.php?ctrl=forum&action=detailUser&id=<?= $lastPosts[$topics->key()]->getUser()->getId() ?>"><?= $lastPosts[$topics->key()]->getUser()->getPseudonyme() ?></a></p>
    </div>
    <?php
    
}