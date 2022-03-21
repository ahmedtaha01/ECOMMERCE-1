<?php

namespace PHPMVC;
session_start();

require_once realpath("../vendor/autoload.php");

use PHPMVC\LIB\Database;
use PHPMVC\LIB\FrontController;

require_once "../app/config.php";
require_once "../app/lib/FileUpload.php";



$front = new FrontController();
