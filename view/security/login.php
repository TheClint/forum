<h2>Connexion :</h2>

<form action="index.php?ctrl=security&action=submitLogin" method="POST">
 
  <div class="mb-3">
        <label for="InputEmail1" class="form-label">Adresse mail :</label>
        <input type="email" class="form-control" id="InputEmail1" required="required" name="mail" placeholder="Veuillez entrer votre email">
  </div>
  <div class="mb-3">
        <label for="InputPassword" class="form-label">Mot de passe : </label>
        <input type="password" class="form-control" id="InputPassword" required="required" name="password" placeholder="Veuillez entrer votre mot de passe">
  </div>
  <button type="submit" name="login" class="btn btn-primary">Se connecter</button>
</form>

<a href="index.php?ctrl=security&action=register">Pas encore inscrit ?</a>
