<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Admin Controller
 *
 *
 * @method \App\Model\Entity\Admin[] paginate($object = null, array $settings = [])
 */
class AdminController extends AppController {
    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index() {
        $this->loadModel('Projects');
        $this->set('projects', $this->Projects->find('all', ['order' => 'name']));
        
        $daemonRunning = false;
        $info = [];
        exec('gridcoinresearchd -rpcuser=rpcuser -rpcpassword=rpcpassword getinfo 2>&1', $info, $retval);
        if ($retval === 0) {
            $daemonRunning = true;
            
            $status = json_decode(implode('', $info));
            $this->set('daemonStatus', $status);
            
            $info = [];
            exec('gridcoinresearchd -rpcuser=rpcuser -rpcpassword=rpcpassword getmininginfo 2>&1', $info, $retval);
            $miningInfo = json_decode(implode('', $info));
            $this->set('daemonMiningInfo', $miningInfo);
            
            $info = [];
            exec('gridcoinresearchd -rpcuser=rpcuser -rpcpassword=rpcpassword getbalance 2>&1', $info, $retval);
            $this->set('daemonBalance', $info[0]);
        }
        $this->set('daemonRunning', $daemonRunning);
    }
    
    /**
     * Iterates over projects and updates RAC of each host in the database
     */
    public function updateHostStats() {
        $this->loadModel('Projects');
        $this->loadModel('UserHosts');
        
        $projects = $this->Projects->find('all', [
            'conditions' => [
                'active' => true,
            ],
        ]);

        $projectsUpdated = 0;
        $hostsUpdated = 0;
        $errors = [];
        foreach ($projects as $project) {
            $hosts = $this->UserHosts->find('all', [
                'conditions' => [
                    'project_id' => $project['id'],
                ],
            ]);
            foreach ($hosts as $host) {
                $stats = file_get_contents($project['url'].'show_host_detail.php?hostid='.$host['host_id']);
                if (preg_match('/fieldname>Average credit<\/td><td class=fieldvalue>(\d+\.\d+)<\/td>/', $stats, $matches)) {
                    $host->rac = $matches[1];
                    $host->rac_update_time = date('Y-m-d H:i:s');
                    $this->UserHosts->save($host);
                    $hostsUpdated++;
                    
                    sleep(1);
                    continue;
                }       
                
                $errors[] = 'Could not update host '.$host['host_id'].' on project '.$project['name'];
            }
            
            $projectsUpdated++;
        }
        
        $this->set('errors', $errors);
        $this->set('updatedProjects', $projectsUpdated);
        $this->set('updatedHosts', $hostsUpdated);
    }
}
