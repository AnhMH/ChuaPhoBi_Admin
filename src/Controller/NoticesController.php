<?php

namespace App\Controller;

use Cake\Event\Event;

/**
 * Notices page
 */
class NoticesController extends AppController {
    
    /**
     * Notices page
     */
    public function index() {
        include ('Bus/Notices/index.php');
    }
    
    /**
     * Add/update info
     */
    public function update($id = '') {
        include ('Bus/Notices/update.php');
    }
}
