<?php
$data = $this->data;
$user_type = Session::get('type');
$err = isset($_GET['err']) ? $_GET['err'] : false;

if ($err) {
    switch ($err) {
        case $err == 'no_error':
            echo '<h2 class="col-sm-offset-2">
                            <span class="label label-success">Uspesno ste obrisali komentar</span>
                      </h2>';
            break;
        case $err == 'no_error_comment_deleted':
            echo '<h2 class="col-sm-offset-2">
                            <span class="label label-success">Uspesno ste obrisali komentar</span>
                      </h2>';
            break;
        case $err == '1':
            echo '<h2 class="col-sm-offset-2">
                            <span class="label label-danger">Greska prilikom citanja komentara iz baze</span>
                      </h2>';
            break;
        case $err == '2':
            echo '<h2 class="col-sm-offset-2">
                            <span class="label label-danger">Morate prvo selektovati komentar</span>
                      </h2>';
            break;
        case $err == '3':
            echo '<h2 class="col-sm-offset-2">
                            <span class="label label-danger">/span>
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

<div id="content">
    <?php if($data == 'error'): ?>
        <h2 class="text-center">
            <span class="label label-danger">Doslo je do greske prilikom citanja komentara iz baze</span>
        </h2>
    <?php elseif($data == null): ?>
        <h2 class="text-center">
            <span class="label label-warning">Korisnik nije objavio nijedan komentar</span>
        </h2>
    <?php else: ?>
        <h2 class="text-center"><span class="label label-primary">Komentari korisnika : <?= $data[0]['username'] ?></span></h2>
        <table class="table-hover col-sm-8 col-sm-offset-2" style="margin-top: 10px;">
            <thead>
            <th class="text-center col-sm-1">#</th>
            <th class="text-center">Komentar</th>
            <th class="text-center">Objavljen</th>
            <th class="text-center col-sm-1">Link</th>
            </thead>
            <tbody>
            <?php for ($i = 0; $i < count($data); $i++){ $row = $data[$i]; ?>
                <tr>
                    <td><a class="btn btn-danger" href="<?= URI . '/dashboard/deleteComment/' . $row['news_section'] . '/' . $row['news_id'] . '/' . $row['comment_id']?>" role="button">Obrisi</a></td>
                    <td class="text-left"><?= $row['content'] ?></td>
                    <td class="text-center"><?= $row['created'] ?></td>
                    <td><a class="btn btn-default" href="<?= URI . '/news/' . $row['news_section'] . '/' . $row['news_id'] .'#comment_' . $row['comment_id'] ?>" target="_blank">Link</a></td>
                </tr>
            <?php } ?>

            </tbody>

        </table>

    <?php endif ?>


</div>
