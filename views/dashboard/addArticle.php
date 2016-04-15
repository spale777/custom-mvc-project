<div id="content">
    <?php
    $err = isset($_GET['err']) ? $_GET['err'] : false;
    if ($err) {
        switch ($err) {
            case $err === 'no_error':
                echo '<h2>Vest uspesno dodata u bazu</h2>';
                break;
            case $err === '1':
                echo '<h2>Greska prilikom unosa podataka ili niste uneli sve podatke</h2>';
                break;
            case $err === '2':
                echo '<h2>Uneti fajlovi nistu uploadovani / Fajlovi preveliki ili nisu odgovarajuceg formata</h2>';
                break;
            case $err === '3':
                echo '<h2>Doslo je do greske prilikom upisa podataka u bazu</h2>';
                break;
        }
    }
    ?>
    <form class="form-horizontal col-sm-12" action="<?= URI ?>/dashboard/addArticleRun" method="post" enctype="multipart/form-data" >
        <div class="form-group">
            <label class="control-label col-sm-2 col-sm-offset-2" for="title">Naslov :</label>

            <div class="col-sm-4">
                <input type="text" class="form-control" id="title" name="title" placeholder="Naslov">
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-2 col-sm-offset-2" for="alt_content">Opis :</label>

            <div class="col-sm-4">
                <textarea type="text" class="form-control" id="alt_content" placeholder="Opis" name="alt_content" rows="5"></textarea>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-2 col-sm-offset-2" for="alt_content">TIP :</label>

            <div class="col-sm-4">
                <select name="section" class="form-control" id="section">
                    <option value="IT">IT</option>
                    <option value="Sport">Sport</option>
                    <option value="Various">Ostalo</option>
                </select>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-2 col-sm-offset-2" for="alt_pic">Slika opisa :</label>

            <div class="col-sm-4">
                <input type="file" class="form-control" id="alt_pic" name="alt_pic">
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-2 col-sm-offset-2" for="main_pic">Slika vesti :</label>

            <div class="col-sm-4">
                <input type="file" class="form-control" id="main_pic" name="main_pic">
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-2 col-sm-offset-2" for="main_content">Vest :</label>

            <div class="col-sm-4">
                <textarea class="form-control" id="main_content" placeholder="Vest" name="main_content" rows="12"></textarea>
            </div>
        </div>

        <div class="form-group">
            <div class="col-sm-offset-4 col-md-5">
                <button type="submit" class="btn btn-default">Dodaj</button>
            </div>
        </div>
    </form>
</div>