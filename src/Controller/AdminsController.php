<?php

namespace App\Controller;

use Cake\Event\Event;

/**
 * Admins page
 */
class AdminsController extends AppController {
    
    /**
     * Admins page
     */
    public function updateprofile() {
        include ('Bus/Admins/updateprofile.php');
    }
    
    /**
     * Admins page
     */
    public function setting($languageType = 1) {
        include ('Bus/Admins/setting.php');
    }
}
