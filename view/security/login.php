<h2>Connexion :</h2>

<form action="index.php?ctrl=security&action=submitLogin" method="POST">
 
  <div class="mb-3">
        <label for="InputEmail1" class="form-label">Adresse mail :</label>
        <input type="email" class="form-control" id="InputEmail1" aria-describedby="emailHelp1" required="required" name="mail">
        <div id="emailHelp" class="form-text">Veuillez entrer votre email</div>
  </div>
  <div class="mb-3">
        <label for="InputPassword" class="form-label">Mot de passe : </label>
        <input type="password" class="form-control" id="InputPassword" aria-describedby="passwordHelp" required="required" name="password">
        <div id="passwordHelp" class="form-text">Veuillez entrer votre mot de passe</div>
  </div>
  <button type="submit" name="login" class="btn btn-primary">Se connecter</button>
</form>

<a href="index.php?ctrl=security&action=register">Pas encore inscrit ?</a>
