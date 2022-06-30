<?php 

$topic = $result['data']['topic'];
$posts = $result['data']['posts'];


?>

<h2><?= $topic->getTitle() ?></h2>

<p> De : <?= $topic->getUser()->getPseudonyme()  ?>

</p>
<p> Le : <?= $topic->getTopicDate() ?></p>
<?php
if(isset($posts)){
    foreach($posts as $post){?>
        
        <div class="card mb-3" style="max-width: 540px;">
        <div class="row g-0">
          <div class="col-md-4">
            <img src="./public/img/avatar-forum-proletarien.jpg" class="img-fluid rounded-start" alt="...">
          </div>
          <div class="col-md-8">
            <div class="card-body">
              <h5 class="card-title"><?= $post->getUser()->getPseudonyme() ?></h5>
              <p class="card-text"><?= $post->getText() ?></p>
              <p class="card-text"><small class="text-muted">Posté le : <?= $post->getMessageDate() ?></small></p>
            </div>
          </div>
        </div>
      </div>

    <?php 
    }
}else{
    echo "il n'y a pas de post";
}

?>

<form id="add-a-post" action="index.php?ctrl=forum&action=addPost&id=<?= $topic->getId() ?>" method="POST">
    <textarea name="text" aria-label="With textarea" aria-describedby="inputPost" placeholder="Ajouter un message..."></textarea>
    <div><button type="submit" name="addPost" class="btn btn-primary">Poster</button></div>
</form>


