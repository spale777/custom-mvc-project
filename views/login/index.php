        <div id="content">
            <?php
            $err = isset($_GET['err']) ? $_GET['err'] : 'no_error';

            switch ($err) {
                case $err == 'no_error':
                    break;
                case $err == 1:
                    echo '<h2>Morate uneti Korisnicko ime i Sifru</h2>';
                    break;
                case $err == 2:
                    echo '<h2>Nalog ne postoji kliknite <a href="reg">ovde</a> da se registrujete</h2>';
                    break;
                case $err == 3;
                    echo '<h2>Uneti podaci se ne slazu</h2>';
                default:
                    break;
            }
            ?>
            <form name="login" action="<?= URI ?>/login/run" method="post">
                <label for="username">Korisnicko Ime : </label>
                <input type="text" name="username">
                <label for="password">Sifra : </label>
                <input type="password" name="password">
                <input type="submit" value="Prijavi Se">
            </form>
            <h3>Nemate nalog? <a href="reg">Kliknite ovde da se registrujete</a></h3>
        </div>