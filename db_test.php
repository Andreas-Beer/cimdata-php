<?php

include_once './config.inc.php';

include_once PATH_FILE_DBCONNECT;

echo '<pre style="text-align: left;">' . "\n";

//print_r(getDataFromDB($sql_select_films));

var_dump(getDataFromDB($sql_select_movieByMovieId(1)));

var_dump(getDataFromDB($sql_select_movieByMovieId(2)));

echo "\n</pre>\n";



