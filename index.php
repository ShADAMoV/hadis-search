<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Проверка хадисов на достоверность. Поиск хадиса. Узнать иснад и передатчиков хадиса."/>
    <meta property="og:title" content="Найти хадис"/>
    <meta property="og:url" content="https://shadamov.store"/>
    <meta property="og:image" content="assets/images/logo.png"/>
    <meta property="og:description" content="Данный сайт призван помочь найти, проверить и разъяснить хадисы."/>
    <meta name="DC.title" content=" Найти хадис " />
    <meta name="DC.creator" content="ShAM Team" />
    <meta name="DC.subject" content="проверка, достоверность, иснад, хадис, поиск" />
    <meta name="DC.description" content="Проверка хадиса на достоверность. Поиск хадиса." />
    <meta name="DC.date" content="2022-11-12" />
    <meta name="DC.language" content="ru-RU" />
    <meta name="DC.format" content="text/html" />
    <meta name="DC.identifier" content="https://shadamov.store" />
    <title>Проверка достоверности х'адисов</title>
    <link href="styles.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link type="image/x-icon" rel="shortcut icon" href="assets/images/favicon.ico">
</head>
<body>
    <header class="header">
        <div class="header__container">
            <a href="#" class="logo">
                <div class="logo__img">
                    <img src="assets/images/logo.png" alt="logo">
                </div>
                <div class="logo__txt">
                    Hadis-Search
                </div>
            </a>
            <div class="header__contacts">
                <a href="tg://resolve?domain=ShADAMoV" class="contact__telegram">
                    <img src="assets/images/telegram.png" alt="logo">
                </a>
                <a href="https://api.whatsapp.com/send?phone=79258365636" class="contact__whatsapp">
                    <img src="assets/images/whatsapp.png" alt="logo">
                </a>
            </div>
        </div>
    </header>
    <main class="main">
        <div class="main__container">
            <h1 class="main__title">
                Поиск хадисов
            </h1>
            <div class="main__subtitle">
                “Не следуй тому, чего ты не знаешь. Воистину, слух, зрение и сердце - все они будут призваны к ответу.”
                (Не руководствуйся тем, что не подтверждается ясными знаниями, а говори и делай только то, в чем ты уверен.)
                Сура 17:36 
            </div>
            <form action="index.php" class="search" method="post">
                <input type="search" name="hadisSearch" id="hadisSearch" class="search__hadis" placeholder="Введите хадис">
                <input type="submit" class="search__button" value="Проверить">
            </form>
            <?php
                $input = str_replace(" ", " ", trim(preg_replace('| +|', ' ', preg_replace('/[^\x{0400}-\x{04FF}]+/u', ' ' ,$_POST['hadisSearch']))));
                $servername = "localhost";
                $database = "shadamov_hadises";
                $username = "shadamov_hadises";
                $password = "Alhamdulillah1";
            
            
                $mysqli = mysqli_connect($servername, $username, $password, $database);
            
                // Проверяем соединение
                if (!$mysqli) {
                    die("Connection failed: " . mysqli_connect_error());
                }
            
                $query = "SELECT * FROM `Сахих аль-Джами’ ас-сагъир` WHERE MATCH(`russian_text`) AGAINST('.$input')";
            
                $result = mysqli_query($mysqli, $query);
                
                $isnad = "";
                $arabic_text = "";
                $russian_text = "";
                $comments = "";
                $muhaddises = "";
                
                
                while ($row = $result->fetch_assoc()) {
                    $isnad = $row["isnad"];;
                    $arabic_text = $row["arabic_text"];;
                    $russian_text = $row["russian_text"];;
                    $comments = $row["comments"];;
                    $muhaddises = $row["muhaddises"];
                    echo "<div class='hadis__box'>
                            <div class='hadis__reliable'>$isnad</div>
                            <div class='hadis__arabic-text'>$arabic_text</div>
                            <div class='hadis__translate-text'>$russian_text</div>
                            <div class='hadis__explanation-box'>
                                <div class='hadis__explanation-text'>$comments</div>
                            </div>
                            <div class='hadis__muhadisis'>$muhaddises</div>
                          </div>";
                }
                
                $mysqli->close();
            ?>
        </div>
    </main>
    <footer></footer>
    <script src="script.js"></script>
</body>
</html>

<?php

/*
*************************************************************************
	Evolution CMS Content Management System and PHP Application Framework ("EVO")
	Managed and maintained by Dmytro Lukianenko and the	EVO community
*************************************************************************
	EVO is an opensource PHP/MySQL content management system and content
	management framework that is flexible, adaptable, supports XHTML/CSS
	layouts, and works with most web browsers.

	EVO is distributed under the GNU General Public License
*************************************************************************

	This file and all related or dependant files distributed with this file
	are considered as a whole to make up EVO.

	EVO is free software; you can redistribute it and/or modify
	it under the terms of the GNU General Public License as published by
	the Free Software Foundation; either version 2 of the License, or
	(at your option) any later version.

	EVO is distributed in the hope that it will be useful,
	but WITHOUT ANY WARRANTY; without even the implied warranty of
	MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
	GNU General Public License for more details.

	You should have received a copy of the GNU General Public License
	along with EVO (located in "/assets/docs/"); if not, write to the Free Software
	Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1335, USA

	For more information on EVO please visit https://evo.im/
	Github: https://github.com/evolution-cms/evolution/

**************************************************************************
	Based on MODX Evolution CMS and Application Framework
	Copyright 2005 and forever thereafter by Raymond Irving & Ryan Thrash.
	All rights reserved.

	MODX Evolution is originally based on Etomite by Alex Butter
**************************************************************************
*/

/**
 * Initialize Document Parsing
 * -----------------------------
 */
if (!isset($_SERVER['REQUEST_TIME_FLOAT'])) {
    $_SERVER['REQUEST_TIME_FLOAT'] = microtime(true);
}
$mstart = memory_get_usage();

$config = [
    'core' => __DIR__ . '/core',
    'manager' => __DIR__ . '/manager',
    'root' => __DIR__
];

if (file_exists(__DIR__ . '/config.php')) {
    $config = array_merge($config, require __DIR__ . '/config.php');
}
if (!defined('IN_INSTALL_MODE') && !file_exists($config['core'] . '/.install')) {
    header('HTTP/1.1 503 Service Temporarily Unavailable');
    header('Status: 503 Service Temporarily Unavailable');
    header('Retry-After: 3600');

    $path = __DIR__ . '/install/src/template/not_installed.tpl';
    if (file_exists($path)) {
        readfile($path);
    } else {
        echo '<h3>Unable to load configuration settings</h3>';
        echo 'Please run the Evolution CMS install utility';
    }

    exit;
}

if (!defined('IN_INSTALL_MODE')) {
    define('IN_INSTALL_MODE', false);
}
if (IN_INSTALL_MODE) {
// set some settings, and address some IE issues
    @ini_set('url_rewriter.tags', '');
    @ini_set('session.use_trans_sid', 0);
    @ini_set('session.use_only_cookies', 1);
}

require $config['core'] . '/bootstrap.php';

if (IN_INSTALL_MODE == false) {
    header('P3P: CP="NOI NID ADMa OUR IND UNI COM NAV"'); // header for weird cookie stuff. Blame IE.
    header('Cache-Control: private, must-revalidate');
}
ob_start();

/**
 *    Filename: index.php
 *    Function: This file loads and executes the parser. *
 */

define('IN_PARSER_MODE', true);
if (!defined('IN_MANAGER_MODE')) {
    define('IN_MANAGER_MODE', false);
}
if (!defined('MODX_API_MODE')) {
    define('MODX_API_MODE', false);
}
if (!defined('MODX_CLI')) {
    define('MODX_CLI', false);
}

// initiate a new document parser
$modx = evolutionCMS();

// set some parser options
$modx->minParserPasses = 1; // min number of parser recursive loops or passes
$modx->maxParserPasses = 10; // max number of parser recursive loops or passes
$modx->dumpSQL = false;
$modx->dumpSnippets = false; // feed the parser the execution start time
$modx->dumpPlugins = false;
$modx->mstart = $mstart;

// Debugging mode:
$modx->stopOnNotice = false;

// Don't show PHP errors to the public
if (!isset($_SESSION['mgrValidated']) || !$_SESSION['mgrValidated']) {
    @ini_set("display_errors", "0");
}

if (is_cli()) {
    @set_time_limit(0);
    @ini_set('max_execution_time', 0);
}

// execute the parser if index.php was not included
if (!MODX_API_MODE && !MODX_CLI) {
    $modx->processRoutes();
}
?>

