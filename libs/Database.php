<?php
class Database extends PDO
{
    function __construct()
    {
        //Podesavanja se nalaze u config/db.php
        parent::__construct(DB_DSN, DB_USER, DB_PASS);
    }
}