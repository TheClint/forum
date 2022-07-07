<?php
use App\Session;
    $user = $result['data']['user'];
?>

<h2> Modifier votre mot de passe : </h2>

<form action="index.php?ctrl=security&action=submitEditPassword&id=<?= $user->getId() ?>" method="POST">
  <div class="mb-3">
        <label for="InputPasswordOld" class="form-label">Verification du mot de passe : </label>
        <input type="password" class="form-control" id="InputPasswordOld" aria-describedby="passwordHelp2" required="required" name="password" placeholder="Confirmez votre mot de passe">
        <div id="passwordHelp2" class="form-text">Entrez votre mot de passe</div>
  </div>
  <div class="mb-3">
        <label for="InputPassword1" class="form-label">Nouveau mot de passe :</label>
        <input type="password" class="form-control" id="InputPassword1" aria-describedby="passwordHelp1" required="required" name="password1" placeholder="Veuillez entrer votre nouveau mot de passe" >
        <div id="passwordHelp1" class="form-text">8 caractères minimum dont un numéro, une minuscule et une majuscule</div>    
  </div>
  <div class="mb-3">
        <label for="InputPassword2" class="form-label">Verification du nouveau mot de passe : </label>
        <input type="password" class="form-control" id="InputPassword2" aria-describedby="passwordHelp2" required="required" name="password2" placeholder="Veuillez confirmer votre nouveau mot de passe">
        <div id="passwordHelp2" class="form-text">8 caractères minimum dont un numéro, une minuscule et une majuscule</div>
  </div>
  <button type="submit" name="submitEditPassword" class="btn btn-primary">Modifier</button>
</form>