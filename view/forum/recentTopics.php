<?php

$topics = $result["data"]['topics'];


?>
    <h2>Messages récents :</h2>
<?php

foreach($topics as $topic ){
    ?>
    <div class="topic-title">    
        <p><?=$topic->getCategorie()->getName() ?></p>
        <a href="index.php?ctrl=forum&action=read&id=<?= $topic->getId() ?>"><?=$topic->getTitle()?></a>
        <p>Dernières réponses le : 00/00/0000</p>
        <p>Par : Pseudo</p>
    </div>
    <?php
    
}



  
