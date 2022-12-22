<?php

$action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_STRING);
echo $action;

switch ($action) {
    case 'selectionnerFiche': 
        include 'vues/v_selectionnerFiche.php';
        break;

    
}
