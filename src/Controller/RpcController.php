<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Rpc Controller
 */
class RpcController extends AppController {
    function getProjectConfig() {
        $this->viewBuilder()->setLayout(false);
        $this->response = $this->response->withType('xml');
        
        $this->set('poolName', \Cake\Core\Configure::read('PoolName', 'GRC Pool'));
    }
}
