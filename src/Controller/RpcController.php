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
        
        $request = file_get_contents('php://input');
        $request = simplexml_load_string($request);

        $this->set('poolName', \Cake\Core\Configure::read('PoolName', 'GRC Pool'));
        $this->set('publicKey', file_get_contents('../keys/public'));
        
        $this->loadModel('Projects');
        $projects = $this->Projects->find('all', [
            'conditions' => [
                'authenticator IS NOT' => null,
            ],
        ])->toArray();
        $this->set('projects', $projects);
        
        // Get user ID of the currently attached user
        $this->loadModel('Users');
        $user = $this->Users->find('all', [
            'conditions' => [
                'email' => $request->name,
            ],
        ])->first();
        if (!$user) {
            $this->set('error', 'User nor found');
            return;
        }
        
        // Check if the host entry is already in the hosts table (it needs to be there for payment)
        $this->loadModel('UserHosts');
        foreach ($request->project as $boincProject) {
            if ($boincProject->attached_via_acct_mgr == 0) {
                continue;
            }
            
            $projectId = false;
            foreach ($projects as $project) {
                if ($boincProject->url == $project['url']) {
                    $projectId = $project['id'];
                    break;
                }
            }
            if ($projectId === false) { // Project attached to client but is not in the pool DB
                continue;
            }
            
            $host = $this->UserHosts->find('all', [
                'conditions' => [
                    'user_id' => $user['id'],
                    'project_id' => $projectId,
                    'host_id' => (int)$boincProject->hostid,
                ],
            ])->count();
            if ($host === 0) { // Insert new host entry
                $host = $this->UserHosts->newEntity();
                $host['user_id'] = $user['id'];
                $host['project_id'] = $projectId;
                $host['host_id'] = (int)$boincProject->hostid;
                $this->UserHosts->save($host);
            }
        }
    }
}
