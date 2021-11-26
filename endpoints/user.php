<?php

require_once "../libs/Bootstrap.php";

Bootstrap::init();

switch ($_SERVER['REQUEST_METHOD']) {
    case 'POST': { // create
        $createdUser = UserEndpointHandler::create();
        echo json_encode($createdUser->toArray());
        break;
    }
    case 'GET': { // read
        break;
    }
    case 'PUT': { // update
        break;
    }
    case 'DELETE': { // delete
        break;
    }
}
