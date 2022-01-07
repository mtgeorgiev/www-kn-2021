<?php

require_once "../libs/Bootstrap.php";

Bootstrap::init();

switch ($_SERVER['REQUEST_METHOD']) {
    case 'GET': {
        $websiteConfig = Config::getConfig()['website'];
        
        if (!isset($_GET['key'])) {
            throw new BadRequestException('Параметърът key е задължителен');
        }
        
        $wantedConfigKey = $_GET['key'];

        if (isset($websiteConfig[$wantedConfigKey])) { // if the website config key is configured
            echo json_encode(['value' => $websiteConfig[$wantedConfigKey]]);
        } else {
            throw new NotFoundException('Конфигурацията не е налична');
        }
    }
}

