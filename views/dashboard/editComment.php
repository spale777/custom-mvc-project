<?php
    $data = $this->data;

    $err = isset($_GET['err']) ? $_GET['err'] : false;

    if ($err) {
        switch ($err) {
            case $err == 'no_error':
                echo '<h2 class="text-center"><span class="label label-success">Operacija uspesno izvrsena</span></h2>';
                break;
            case $err == '1':
                echo '<h2 class="text-center"><span class="label label-danger">Doslo je do greske prilikom citanja iz baze</span></h2>';
                break;
            case $err == '2':
                echo '<h2 class="text-center"><span class="label label-warning">Komentar koji pokusavate da izmenite ne postoji</span></h2>';
                break;
            case $err == '3':
                echo '<h2 class="text-center"><span class="label label-warning">Sadrzaj ne moze biti prazan</span></h2>';
                break;
            case $err == '4':
                echo '<h2 class="text-center"><span class="label label-danger">Greska prilikom upisa u bazu</span></h2>';
                break;
            default:
                echo '<h2 class="text-center"><span class="label label-danger">Doslo je do nepredvidjene greske</span></h2>';
                break;
        }
    }
?>

<div id="content">

    <form class="form-horizontal col-sm-12" action="<?= URI ?>/dashboard/editCommentRun/<?= $data['id'] ?>" method="post" style="margin-top: 10px;">
        <div class="form-group">
            <label class="control-label col-sm-2 col-sm-offset-2" for="username">Korisnik :</label>
            <div class="col-sm-4">
                <input type="text" disabled class="form-control" id="username" name="username" value="<?= $data['username'] ?>">
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-2 col-sm-offset-2" for="content">Sadrzaj :</label>
            <div class="col-sm-4">
                <textarea class="form-control" id="comment_content" name="content" rows="6"><?= $data['content'] ?></textarea>
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-4 col-md-5">
                <button type="submit" class="btn btn-default">Izmeni</button>
            </div>
        </div>
    </form>


</div>
