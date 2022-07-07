<?php

use App\Session;

$topics = $result["data"]['topics'];
$lastPosts = $result["data"]['lastPosts'];
$categorie = $result["data"]['categorie'];


?>
    <h2><?=$categorie->getName() ?></h2>
<?php

foreach($topics as $topic){
    ?>
    <div class="topic-title">    
        <div class="lock"><a href="index.php?ctrl=forum&action=readPostsFromTopic&id=<?= $topic->getId() ?>"><?=$topic->getTitle()?></a><?= ($topic->getIsLocked()) ? "<i class='fa-solid fa-lock'></i>" : "" ?></div>
        <p>Dernière réponse le : <?= $lastPosts[$topics->key()]->getMessageDate() ?> Par : <a href="index.php?ctrl=forum&action=detailUser&id=<?= $lastPosts[$topics->key()]->getUser()->getId() ?>"><?= $lastPosts[$topics->key()]->getUser()->getPseudonyme() ?></a></p>
    </div>
    <?php   
} 
    if(Session::getUser()){?>
        <!-- Button trigger modal add topic -->
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addTopicModal">
            <i class="fa-solid fa-plus"></i>
        </button>

        <!-- Modal topic add-->
      <div class="modal fade" id="addTopicModal" tabindex="-1" aria-labelledby="addTopicModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="addTopicModalLabel">Créer un sujet</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="index.php?ctrl=forum&action=addTopic&id=<?= $categorie->getId() ?>" method="POST">
              <div class="modal-body">
                <input name="title" aria-describedby="inputTopic">
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                <button type="submit" name="addTopic" class="btn btn-primary">Créer ce nouveau sujet</button>
              </div>
            </form>
          </div>
        </div>
      </div>

<?php  }
?>

