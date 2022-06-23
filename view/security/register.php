<h2> Inscription : </h2>

<form action="index.php?ctrl=security&action=submitRegister" method="POST">
    <div class="mb-3">  
        <label for="InputPseudo" class="form-label">Pseudonyme :</label>
        <input type="text" class="form-control" id="InputPseudo" aria-describedby="pseudoHelp" required="required" name="pseudo">
        <div id="pseudoHelp" class="form-text">Veuillez entrer votre pseudonyme</div>
  </div>
  <div class="mb-3">
        <label for="InputEmail1" class="form-label">Adresse mail :</label>
        <input type="email" class="form-control" id="InputEmail1" aria-describedby="emailHelp1" required="required" name="mail1">
        <div id="emailHelp" class="form-text">Veuillez entrer votre email</div>
  </div>
  <div class="mb-3">
        <label for="InputEmail2" class="form-label">Vérification adresse mail :</label>
        <input type="email" class="form-control" id="InputEmail2" aria-describedby="emailHelp2" required="required" name="mail2">
        <div id="emailHelp" class="form-text">Entrez à nouveau votre mail pour vérification</div>
  </div>
  <div class="mb-3">
        <label for="InputPassword1" class="form-label">Mot de passe :</label>
        <input type="password" class="form-control" id="InputPassword1" aria-describedby="passwordHelp1" required="required" name="password1">
        <div id="passwordHelp1" class="form-text">Veuillez entrer votre mot de passe</div>
  </div>
  <div class="mb-3">
        <label for="InputPassword2" class="form-label">Verification mot de passe : </label>
        <input type="password" class="form-control" id="InputPassword2" aria-describedby="passwordHelp2" required="required" name="password2">
        <div id="passwordHelp2" class="form-text">Entrez à nouveau votre mot de passe pour vérification</div>
  </div>
  <button type="submit" name="register" class="btn btn-primary">S'inscrire</button>
</form>