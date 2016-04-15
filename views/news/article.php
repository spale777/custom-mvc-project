<?php
$data = $this->data;
$article = $data[0];

$comments = $this->comments;

if (empty($article)) {
    header('Location:' . URI . '/error');
}

$err = isset($_GET['err']) ? $_GET['err'] : false;

if ($err) {
    switch ($err) {
        case $err == 'no_error':
            echo '<h2 class="col-sm-offset-2">
                    <span class="label label-success">Uspesno ste dodali komentar</span>
                  </h2>';
            break;
        case $err == 'no_error_comment_deleted':
            echo '<h2 class="col-sm-offset-2">
                    <span class="label label-success">Uspesno ste obrisali komentar</span>
                  </h2>';
            break;
        case $err == '1':
            echo '<h2 class="col-sm-offset-2">
                    <span class="label label-danger">Greska Prilikom upisa komentara u bazu</span>
                  </h2>';
            break;
        default:
            echo '<h2 class="col-sm-offset-2">
                    <span class="label label-danger">Doslo je do nepredvidjene greske</span>
                  </h2>';
            break;
    }
}

?>
<div id="content" class="col-sm-12 row custom">
    <div id="article-<?= $article['id'] ?>" class="col-sm-offset-2 col-sm-8 row">
        <h2 id="title" class="text-left"><?= $article['title'] ?></h2>
        <img id="main_content_img"
             class="img-responsive col-sm-6 col-md-6 col-lg-6"
             src="<?= URI . '/public/images/' . $article['id'] . '/' . 'main_pic.jpeg'?>"
             alt="Main Article Img">

        <?= $article['main_content'] ?>
        <hr>
    </div>

    <div id="comment-section" class="row">
        <?php if (Session::get('logged')): ?>
        <div id="form-container" class="col-sm-offset-2 col-sm-8 row">
            <form id="comment-form" action="<?= URI . '/news/postComment/' . $article['section'] . '/' . Session::get('id') . '/' . $article['id']; ?>" method="post">
                <div class="panel panel-default">
                    <div class="panel-heading">Ostavi Komentar</div>
                    <div class="panel-body">
                        <textarea name="comment" id="comment-input" class="form-control" rows="3"></textarea>
                        <button type="submit" class="btn btn-submit" value="submit">Postavi</button>
                    </div>
                </div>
            </form>
        </div>
        <?php endif ?>
        <div id="comment-container" class="col-sm-offset-2 col-sm-8 row">
            <?php if($comments == 'error'): ?>
            <h2><span class="label label-danger">Greska prilikom preuzimanja komentara iz baze</span></h2>
            <?php elseif ($comments == null): ?>
            <h2><span class="label label-warning">Nema komentara za ovu vest</span></h2>
            <?php else: ?>
            <h2 id="comments-count"><span class="label label-primary">Broj Komentara : <?= count($comments) ?></span></h2>
            <?php for($i=0; $i < count($comments); $i++){
                    $comment = $comments[$i];
            ?>
            <div id="comment_<?= $comment['comment_id'] ?>" class="panel panel-default">
                <div class="panel-heading">
                    <p class="col-sm-6 col-xs-5 text-left custom-comment-head posted-by">Objavio : <?= $comment['username'] ?></p>
                    <p class="text-right custom-comment-head">Objavljen : <?= $comment['created'] ?></p>
                </div>
                <div class="panel-body">
                    <?= $comment['comment'] ?>
                </div>

                <?php if (
                    Session::get('logged') &&
                    Session::get('username') == $comment['username'] ||
                    Session::get('type') == 'admin' ||
                    Session::get('type') == 'owner'): ?>

                <div class="panel-footer text-right">
                    <?php if (Session::get('username') == $comment['username'] && Session::get('type') == 'owner' || Session::get('type') == 'admin'): ?>
                    <a class="btn btn-sm btn-warning"  href="<?= URI . '/dashboard/editComment' . '/' . $comment['comment_id']?>">
                        Izmeni
                    </a>
                    <?php endif ?>
                    <a class="btn btn-sm btn-danger" href="<?= URI . '/dashboard/deleteComment/' . $article['section'] . '/' . $article['id'] . '/' . $comment['comment_id']?>">
                        Obrisi
                    </a>
                </div>

                <?php endif ?>

            </div>
            <?php }?>
            <?php endif ?>
        </div>

    </div>
</div>