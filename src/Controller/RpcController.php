<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Rpc Controller
 */
class RpcController extends AppController {
    public function beforeFilter(\Cake\Event\Event $event) {
        parent::beforeFilter($event);
        $this->Auth->allow(['getProjectConfig', 'index']);
    }
    
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
        
        $this->loadModel('Projects');
        $projects = $this->Projects->find('all', [
            'conditions' => [
                'authenticator IS NOT' => null,
            ],
        ]);
        $this->set('projects', $projects);
    }
}
