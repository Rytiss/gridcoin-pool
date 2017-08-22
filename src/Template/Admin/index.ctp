<div class="container">
<div class="row">
    <div class="col">
        <?= $this->Html->link('Add project', '/projects/add', ['class' => 'btn btn-sm btn-primary float-right']); ?>
        <h2>
            Projects
        </h2>
        <table class="table table-responsive">
            <tr>
                <th>Name</th>
                <th>URL</th>
                <th>Active</th>
                <th>RAC</th>
            </tr>
        <?php foreach ($projects as $project): ?>
            <tr>
                <td><?= h($project['name']); ?></td>
                <td><?= $this->Html->link($project['url'], $project['url']); ?></td>
                <td><?= ($project['active'] ? 'yes' : 'no'); ?></td>
                <td><?= $project['rac']; ?></td>
            </tr>
        <?php endforeach; ?>
        </table>
        
        <h2>Statistics and payouts</h2>
        <?= $this->Html->link('Update statistics', '/admin/update-host-stats', ['class' => 'btn btn-sm btn-primary float-right']); ?>
    </div>
    
    <div class="col">
        <h2>Gridcoin daemon</h2>
        <?php if ($daemonRunning === false): ?>
        <div class="badge badge-danger">DAEMON NOT RUNNING</div>
        <?php else: ?>
        <table class="table table-responsive">
            <tr>
                <th>Balance</th>
                <td><strong><?= $daemonBalance; ?> GRC</strong></td>
            </tr>
            <tr>
                <th>Current block</th>
                <td><?= $daemonStatus->blocks; ?></td>
            </tr>
            <tr>
                <th>CPID</th>
                <td><?= $daemonMiningInfo->CPID; ?></td>
            </tr>
            <tr>
                <th>Mining info</th>
                <td><?= $daemonMiningInfo->{'MiningInfo 5'}; ?></td>
            </tr>
        </table>
        <div><small>
        <?= print_r($daemonStatus, true); ?>
        <?= print_r($daemonMiningInfo, true); ?>
        </small></div>
        <?php endif; ?>
    </div>
</div>
</div>
