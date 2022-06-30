<?php

use App\Session;

$user = $result["data"]["user"];
$posts = $result["data"]["posts"];

?>

<h2>Pseudo : <?= $user->getPseudonyme() ?> </h2><?php if(Session::getUser()==$user){?><a class="estVisible"><i class="fa-solid fa-pen"></i></a><?php } ?>
<h3>Rôle : <?= $user->getRole() ?></h3>
<!-- image -->
<img src="./public/img/avatar-forum-proletarien.jpg" class="img-fluid rounded-start" alt="..."><?php if(Session::getUser()==$user){?><a class="estVisible"><i class="fa-solid fa-pen"></i></a><?php } ?>
<?= $user->getEstBanni() ? "est banni" : "" ?>

<?php

if(Session::getUser()==$user){?>
  <button id="activer-modification-profil">modifier le profil</button>
  <h3>Email : <?= $user->getEmail() ?></h3><a class="estVisible" href=""><i class="fa-solid fa-pen"></i></a>
  <h3>Mot de passe</h3><a class="estVisible" href=""><i class="fa-solid fa-pen"></i></a>
<?php }


if(isset($posts)){
    foreach($posts as $post){?>
        
        <div class="card mb-3" style="max-width: 540px;">
        <div class="row g-0">
          <div class="col-md-8">
            <div class="card-body">
              <h5 class="card-title"><?= $post->getTopic()->getTitle() ?></h5>
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

