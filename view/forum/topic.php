<?php

use App\Session;

$topic = $result['data']['topic'];
$posts = $result['data']['posts'];


?>
<div id="topic">
  <div id="topic-title">
    <div>
      <?php if(Session::getUser()==$topic->getUser()){ ?>
        <div class=edit-delete-button>
          <?= ($topic->getIsLocked()) ?
          '<!-- Button trigger modal topic unlock -->
          <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#unlockTopicModal">
          <i class="fa-solid fa-unlock"></i>
          </button>' :
          '<!-- Button trigger modal topic lock -->
          <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#lockTopicModal">
          <i class="fa-solid fa-lock"></i>
          </button>' ?>
            <!-- Button trigger modal topic edit -->
          <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editTopicModal">
          <i class="fa-solid fa-pencil"></i>
          </button>
            <!-- Button trigger modal topic delete -->
          <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#deleteTopicModal">
          <i class="fa-solid fa-trash"></i>
          </button>
        </div>

        <!-- Modal topic lock-->
      <div class="modal fade" id="lockTopicModal" tabindex="-1" aria-labelledby="lockTopicModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="lockTopicModalLabel">Verrouiller le topic</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="index.php?ctrl=forum&action=lockTopic&id=<?= $topic->getId() ?>" method="POST">
              <div class="modal-body">
                <p><?= $topic->getTitle() ?></p>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                <button type="submit" name="lockTopic" class="btn btn-primary">Verrouiller le sujet</button>
              </div>
            </form>
          </div>
        </div>
      </div>

      <!-- Modal topic unlock-->
      <div class="modal fade" id="unlockTopicModal" tabindex="-1" aria-labelledby="unlockTopicModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="unlockTopicModalLabel">Deverrouiller le topic</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="index.php?ctrl=forum&action=unlockTopic&id=<?= $topic->getId() ?>" method="POST">
              <div class="modal-body">
                <p><?= $topic->getTitle() ?></p>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                <button type="submit" name="unlockTopic" class="btn btn-primary">Deverrouiller le sujet</button>
              </div>
            </form>
          </div>
        </div>
      </div>

        <!-- Modal topic edit-->
      <div class="modal fade" id="editTopicModal" tabindex="-1" aria-labelledby="editTopicModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="editTopicModalLabel">Modifier le titre</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="index.php?ctrl=forum&action=editTopic&id=<?= $topic->getId() ?>" method="POST">
              <div class="modal-body">
                <input name="title" aria-describedby="inputTopic" value="<?= $topic->getTitle() ?>" >
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                <button type="submit" name="editTopic" class="btn btn-primary">Enregistrer les modifications</button>
              </div>
            </form>
          </div>
        </div>
      </div>

      <!-- Modal topic delete-->
      <div class="modal fade" id="deleteTopicModal" tabindex="-1" aria-labelledby="deleteTopicModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="deleteTopicModalLabel">Supprimer le message</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="index.php?ctrl=forum&action=deleteTopic&id=<?= $topic->getId() ?>" method="POST">
              <div class="modal-body">
                <p><?= $topic->getTitle() ?></p>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                <button type="submit" name="deleteTopic" class="btn btn-primary">Supprimer le message</button>
              </div>
            </form>
          </div>
        </div>
      </div>

      <?php } ?>
    </div>
    <div>
      <div class="lock"><h2><?= $topic->getTitle() ?></h2><?= ($topic->getIsLocked()) ? "<i class='fa-solid fa-lock'></i>" : "" ?></div>
      <p> De : <?= $topic->getUser()->getPseudonyme() ?> Posté le : <?= $topic->getTopicDate() ?></p>
    </div>
  </div>
<?php
if(isset($posts)){
    foreach($posts as $post){?>
        
        <div class="card mb-3">
        <div class="row g-0">
          <div class="col-md-4 profil-picture ">
            <figure>
              <img src="./public/img/avatar-forum-proletarien.jpg" class="img-fluid rounded-start" alt="...">
              <figcaption><h5><?= $post->getUser()->getPseudonyme() ?></h5></figcaption>
            </figure>
          </div>
          <div class="col-md-8">
            <div class="card-body">
              <div class="card-title">
                <?php if(Session::getUser()==$post->getUser()){ ?>
                <div class=edit-delete-button>
                    <!-- Button trigger modal edit -->
                  <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editModal<?= $post->getId() ?>">
                  <i class="fa-solid fa-pencil"></i>
                  </button>
                    <!-- Button trigger modal delete -->
                  <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#deleteModal<?= $post->getId() ?>">
                  <i class="fa-solid fa-trash"></i>
                  </button>
                </div>
                <?php } ?>
              </div>
              <p class="card-text"><?= $post->getText() ?></p>
              <p class="card-text"><small class="text-muted">Posté le : <?= $post->getMessageDate() ?></small></p>
            </div>
          </div>
        </div>
      </div>

      

      <!-- Modal edit-->
      <div class="modal fade" id="editModal<?= $post->getId() ?>" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="editModalLabel">Modifier le message</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="index.php?ctrl=forum&action=editPost&id=<?= $post->getId() ?>" method="POST">
              <div class="modal-body">
                <textarea name="text" aria-label="With textarea" aria-describedby="inputPost"><?= $post->getText() ?></textarea>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                <button type="submit" name="editPost" class="btn btn-primary">Enregistrer les modifications</button>
              </div>
            </form>
          </div>
        </div>
      </div>

      <!-- Modal delete-->
      <div class="modal fade" id="deleteModal<?= $post->getId() ?>" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="deleteModalLabel">Supprimer le message</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="index.php?ctrl=forum&action=deletePost&id=<?= $post->getId() ?>" method="POST">
              <div class="modal-body">
                <p><?= $post->getText() ?></p>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                <button type="submit" name="deletePost" class="btn btn-primary">Supprimer le message</button>
              </div>
            </form>
          </div>
        </div>
      </div>

    <?php 
      
    }
}else{
    echo "il n'y a pas de post";
}

?>
<?= (!$topic->getIsLocked()) ?
'<form id="add-a-post" action="index.php?ctrl=forum&action=addPost&id=<?= $topic->getId() ?>" method="POST">
    <textarea name="text" aria-label="With textarea" aria-describedby="inputPost" placeholder="Ajouter un nouveau message..."></textarea>
    <div><button type="submit" name="addPost" class="btn btn-primary">Poster</button></div>
</form>' : "" ?>

</div>

