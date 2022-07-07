<?php
    $user = $result['data']['user'];
?>

<h2> Modifier votre profil : </h2>

<form action="index.php?ctrl=security&action=submitEditUser&id=<?= $user->getId() ?>" method="POST">
      <div class="mb-3">  
            <label for="InputPseudo" class="form-label">Nouveau pseudonyme :</label>
            <input type="text" class="form-control" id="InputPseudo" required="required" name="pseudo" placeholder="Veuillez entrer votre nouveau pseudonyme" value="<?= $user->getPseudonyme() ?>">
      </div>
      <div class="mb-3">
            <label for="InputEmail1" class="form-label">Nouvelle adresse mail :</label>
            <input type="email" class="form-control" id="InputEmail1" required="required" name="email1" placeholder="Veuillez votre nouvelle adresse mail valide" value="<?= $user->getEmail() ?>">
      </div>
      <div class="mb-3">
            <label for="InputEmail2" class="form-label">Vérification de l'adresse mail :</label>
            <input type="email" class="form-control" id="InputEmail2" required="required" name="email2" placeholder="Confirmez votre nouvelle adresse mail" value="<?= $user->getEmail() ?>">
      </div>
      <div class="mb-3">
            <label for="InputPassword2" class="form-label">Verification du mot de passe : </label>
            <input type="password" class="form-control" id="InputPassword2" aria-describedby="passwordHelp2" required="required" name="password" placeholder="Confirmez votre mot de passe">
            <div id="passwordHelp2" class="form-text">Entrez votre mot de passe</div>
      </div>
      <button type="submit" name="submitEditUser" class="btn btn-primary">Modifier</button>
</form>