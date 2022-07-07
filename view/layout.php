<!DOCTYPE html>
<html lang="en">
    <?php
    use App\Session;
    ?>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content=<?= Session::getTokenCSRF() ?>>
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="public\css\style.css">
    <script type="text/javascript" src="http://code.jquery.com/jquery-latest.min.js"></script>
    <script src="https://kit.fontawesome.com/490620123f.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="public\js\script.js" async></script>
</head>
<body>
    <nav id="nav-categorie">
        <?php
        foreach($result["data"]["categories"] as $categorie){?>
            <a href="index.php?ctrl=forum&action=ListTopicsByCategorie&id=<?= $categorie->getId() ?>"><?= $categorie->getName() ?></a>
    <?php } ?>
    </nav>
    <header>
        <h1>Le Forum</h1>
        <div id="menu-burger">
            <div id="rectangle1"></div>
            <div id="rectangle2"></div>
            <div id="rectangle3"></div>
        </div>
        <div id="menu-burger-wrapper" class="none">
            <nav id="nav-burger">
                <?php if(isset($_SESSION['user'])){ ?> <a href="index.php?ctrl=forum&action=detailUser&id=<?= $_SESSION['user']->getId() ?>"> <?=$_SESSION['user']->getPseudonyme()?> </a> <?php }else{ ?> <a href="index.php?ctrl=security&action=register">S'inscrire</a> <?php } ?>
                <a href="index.php?ctrl=forum&action=index">Messages récents</a>
                <!-- <div class="btn-group dropstart">
                    <button type="button" class="btn btn-dark dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                        Catégories
                    </button>
                    <ul class="dropdown-menu dropdown-menu-dark">
                        <?php
                        //  foreach($result["data"]["categories"] as $categorie){
                            ?>
                            <a href="index.php?ctrl=forum&action=ListTopicsByCategorie&id=
                            <?= ""
                            // $categorie->getId() 
                            ?>
                            ">
                            <?= ""
                            //  $categorie->getName() 
                            ?>
                            </a>
                            <?php 
                        // } 
                        ?>
                    </ul>
                </div> -->
                <a id="lien-categorie">Catégories
                
                </a>
                <a href="index.php?ctrl=forum&action=listUsers">Utilisateurs</a>
                <?php if(isset($_SESSION['user'])){ ?> <a href="index.php?ctrl=security&action=logout">Se déconnecter</a> <?php }else{ ?> <a href="index.php?ctrl=security&action=index">Se connecter</a> <?php } ?> 
            </nav>
        </div>        
    </header>
    <main id="forum">
        <div id=wrapper>
            <div class="alert-danger"><?= Session::getFlash(Session::CATEGORIE_ERROR) ?></div>
            <div class="alert-success"><?= Session::getFlash(Session::CATEGORIE_SUCCESS) ?></div>
            <?= $page ?>
        </div>
    </main>
    <footer>
        <nav>
            <a href="">Règlement du forum</a>
            <a href="">Mentions légales</a>
        </nav>
        <h2>2022 Le Forum</h2>
    </footer>
</body>
</html>