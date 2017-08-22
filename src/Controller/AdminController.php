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
}
