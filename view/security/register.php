<h2> Inscription : </h2>

<form action="index.php?ctrl=security&action=submitRegister" method="POST">
    <div class="mb-3">  
        <label for="InputPseudo" class="form-label">Pseudonyme :</label>
        <input type="text" class="form-control" id="InputPseudo" required="required" name="pseudo" placeholder="Veuillez entrer votre pseudonyme">
  </div>
  <div class="mb-3">
        <label for="InputEmail1" class="form-label">Adresse mail :</label>
        <input type="email" class="form-control" id="InputEmail1" required="required" name="mail1" placeholder="Veuillez entrer une adresse mail valide">
  </div>
  <div class="mb-3">
        <label for="InputEmail2" class="form-label">Vérification adresse mail :</label>
        <input type="email" class="form-control" id="InputEmail2" required="required" name="mail2" placeholder="Confirmez votre adresse mail">
  </div>
  <div class="mb-3">
        <label for="InputPassword1" class="form-label">Mot de passe :</label>
        <input type="password" class="form-control" id="InputPassword1" aria-describedby="passwordHelp1" required="required" name="password1" placeholder="Veuillez entrer un mot de passe" >
        <div id="passwordHelp1" class="form-text">8 caractères minimum dont un numéro, une minuscule et une majuscule</div>
        
  </div>
  <div class="mb-3">
        <label for="InputPassword2" class="form-label">Verification mot de passe : </label>
        <input type="password" class="form-control" id="InputPassword2" aria-describedby="passwordHelp2" required="required" name="password2" placeholder="Confirmez votre mot de passe">
        <div id="passwordHelp2" class="form-text">8 caractères minimum dont un numéro, une minuscule et une majuscule</div>
  </div>
  <button type="submit" name="register" class="btn btn-primary">S'inscrire</button>
</form>