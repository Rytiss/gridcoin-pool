<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Rpc Controller
 */
class RpcController extends AppController {
    /**
     * Attach/configuration RPC
     */
    function getProjectConfig() {
        $this->viewBuilder()->setLayout(false);
        $this->response = $this->response->withType('xml');
        
        $this->set('poolName', \Cake\Core\Configure::read('PoolName', 'GRC Pool'));
    }
    
    /**
     * Main BOINC RPC
     */
    function index() {
        $this->viewBuilder()->setLayout(false);
        $this->response = $this->response->withType('xml');
        
        $request = simplexml_load_file('php://input');

        $this->set('poolName', \Cake\Core\Configure::read('PoolName', 'GRC Pool'));
        $this->set('publicKey', file_get_contents('../keys/public'));
    }
}
