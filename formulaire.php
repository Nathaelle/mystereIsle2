<div class="container perso border border-primary">


    <?php if(isset($_SESSION["message"])): ?>
        <p><?= $_SESSION["message"] ?></p>
        <?php unset($_SESSION["message"]); ?>
    <?php endif ?>

    <p>Nombre de coups : <?= $_SESSION["coups"] ?></p>

    <form action="index.php?route=verif" method="POST">
        <p>
            <label for="nb">Entrez un nombre entre 0 et 100</label>
            <input type="number" id="nb" name="nb" placeholder="Entrez votre nombre" autofocus>
        </p>
        <input type="submit" value="Vérifier !">
    </form>

    <a href="index.php?route=replay">Rejouer</a>
    

</div>
