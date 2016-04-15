<div id="content" class="col-sm-12">
    <?php
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
                echo '<h2 class="text-center"><span class="label label-warning">Nema selektovanog clanka</span></h2>';
                break;
            case $err == '3':
                echo '<h2 class="text-center"><span class="label label-warning">Nepravilno unsesen ili nepostojeci clanak</span></h2>';
                break;
            default:
                echo '<h2 class="text-center"><span class="label label-danger">Doslo je do nepredvidjene greske</span></h2>';
                break;
        }
    }
    $data = $this->data;
    $returned = count($data);
    ?>
    <table class="table-hover col-sm-8 col-sm-offset-2" style="margin-top: 10px;">
        <thead>
            <tr>
                <th class="text-center">#</th>
                <th>ID</th>
                <th>Naslov</th>
                <th>Objavljena</th>
                <th>Link</th>
                <th class="text-center">#</th>
            </tr>
        </thead>
        <tbody>
        <?php
        for ($i = 0; $i < $returned; $i++){
            $row = $data[$i];
            ?>
            <tr>
                <td class="col-sm-1 text-center"><a class="btn btn-warning" href="<?= URI ?>/dashboard/editArticle/<?= $row['id']?>">Izmeni</a></td>
                <td><?= $row['id'] ?></td>
                <td><?= $row['title'] ?></td>
                <td><?= $row['created'] ?></td>
                <td><a href="<?= URI . '/news/' . $row['section'] . '/' . $row['id'] ?>">Link</a></td>
                <td class="col-sm-1 text-center"><a class="btn btn-danger" href="<?= URI ?>/dashboard/deleteArticle/<?= $row['id']?>">Obrisi</a></td>
            </tr>
        <?php
        }
        ?>
        </tbody>

    </table>
</div>