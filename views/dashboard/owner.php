<nav id="dashboard-nav" class="col-sm-12">
    <div class="btn-group">
        <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Kontrola Vesti
            <span class="caret"></span></button>
        <ul class="dropdown-menu">
            <li><a href="<?= URI ?>/dashboard/addArticle">Dodaj Vest</a></li>
            <li><a href="<?= URI ?>/dashboard/editArticles">Izmeni Vesti</a></li>
        </ul>
    </div>
    <div class="btn-group">
        <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Kontrola Komentara
            <span class="caret"></span></button>
        <ul class="dropdown-menu">
            <li><a href="<?= URI ?>/dashboard/showComments">Prikazi moje komentare</a></li>
            <li><a href="<?= URI ?>/dashboard/showCommentsAll">Prikazi sve komentare</a></li>
        </ul>
    </div>
</nav>
