<div id="content">
    <?php
    $err = isset($_GET['err']) ? $_GET['err'] : false;

    if ($err) {
        switch ($err) {
            case $err == '1':
                echo '<h2>Doslo je do greske prilikom citanja iz baze</h2>';
                break;
            default:
                echo '<h2>Doslo je do nepredvidjene greske</h2>';
                break;
        }
    }
    $data = $this->data;
    $returned = count($data);

    $this->showNews($data, $returned);
    ?>
</div>