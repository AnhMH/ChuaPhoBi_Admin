<?php

namespace App\Controller;

use Cake\Event\Event;

/**
 * Weblinks page
 */
class WeblinksController extends AppController {
    
    /**
     * Weblinks page
     */
    public function index() {
        include ('Bus/Weblinks/index.php');
    }
    
    /**
     * Add/update info
     */
    public function update($id = '') {
        include ('Bus/Weblinks/update.php');
    }
}
