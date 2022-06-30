<?php

$users = $result["data"]["users"];

?> 

<h2>Liste des utilisateurs</h2>

<table class="table">
  <thead>
    <tr>
      <th scope="col">Id</th>
      <th scope="col">Pseudonyme</th>
      <th scope="col">Role</th>
      <th scope="col">Date d'inscription</th>
    </tr>
  </thead>
  <tbody>
<?php
foreach($users as $user){?>
    <tr>
        <th scope="row"><?= $user->getId() ?></th>
        <td><a href="index.php?ctrl=forum&action=detailUser&id=<?= $user->getId() ?>"><?= $user->getPseudonyme() ?></a></td>
        <td><?= $user->getRole() ?></td>
        <td><?= $user->getRegisterDate() ?></td>
    </tr>
<?php } ?>
  </tbody>
</table>