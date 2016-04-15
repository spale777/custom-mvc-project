<?php
class View
{
    function __construct()
    {
    }

    public function render($name, $more = false)
    {
        require 'views/header.php';
        if ($more) {
            require 'views/' . $more . '.php';
        }
        require 'views/' . $name . '.php';
        require 'views/footer.php';

    }

    public function showNews($data, $returned)
    {
        for ($i = 0, $j = 1; $i < $returned; $i++, $j++) {
            if ($i == 0 || $i % 3 == 0) {
                echo '<div class="row custom">';
            }
            $row = $data[$i];
            ?>

            <div class="col-md-4">
                <a href="<?= URI ?>/news/<?= $row['section'] . '/' . $row['id']?>"><h2><?= $row['title'] ?></h2></a>
                <img class="img-responsive" src="<?= URI ?>/public/images/<?= $row['id'] . '/alt_pic.jpeg'?>">
                <p><?= $row['alt_content'] ?></p>
            </div>

            <?php
            if ($j % 3 == 0 || $returned == $j) {
                echo '</div>';
            }
        }
    }
    public function drawTable($data)
    {

    }
}