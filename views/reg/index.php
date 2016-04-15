        <?php
        $err = isset($_GET['err']) ? $_GET['err'] : 'no_error';

        switch ($err) {
            case $err == 'no_error':
                break;
            case $err == 1:
                echo '<h2>Greska prilikom unosa podataka</h2>';
                break;
            case $err == 2;
                echo '<h2>Korisnik vec postoji</h2>';
                break;
            case $err == 3;
                echo '<h2>Greska prilikom upisa u bazu</h2>';
                break;
        }
        ?>

        <form action="<?= URI ?>/reg/run" method="post">
            <label for="username">Korisnicko Ime : </label>
            <input type="text" name="username">
            <label for="password">Sifra : </label>
            <input type="password" name="password">
            <input type="submit" value="Registruj se">
        </form>