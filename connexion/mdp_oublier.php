<div class="php_content">
    <div class="title_categ">Mot de passe oublier </div>
        <div class="bloc_contenu2">
        <p class="texteconection">Cet espace est reservé aux enseignants du lycée Saint-Vincent-Senlis. Si vous n'avez pas encore de compte, veuillez effectuer votre demande directement 
            en envoyant un mail à contact@lyceestvincent.net.  </p>
        
            <form class="box" action="#" method="post" name="login">
                <h1 class="box-title">Connexion</h1>
                <input type="mail" class="box-input" name="email" placeholder="Adresse mail" style="width: 30%; height: 60px;">
                <input type="password" class="box-input" name="password" placeholder="Mot de passe" style="width: 30%; height: 60px;">
                <input type="submit" value="Connexion " name="submit" class="box-button"></input>
                <a href="?mdp_oublier=1">mot de passe oublier</a>
                <p class="box-register">Page d'accueil ? <a href="./index.php">Accueil</a></p>
                <p class="box-register">S'inscrire ? <a href="connexion/register.php">ici</a></p>
                <?php if (!empty($message)) { ?>
                    <p class="errorMessage"><?php echo $message; ?></p>
                <?php } ?>
            </form>










    
        </div>
</div>