<div class="row">
    <div class="col-sm-6">
        <?= $this->Html->link('Add project', '/projects/add', ['class' => 'btn btn-sm btn-primary float-right']); ?>
        <h2>
            Projects
        </h2>
        <table class="table">
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
    </div>
    
    <div class="col-sm-6">
        <h2>Gridcoin daemon</h2>
        <?php if ($daemonRunning === false): ?>
        <div class="badge badge-danger">DAEMON NOT RUNNING</div>
        <?php else: ?>
        <?php endif; ?>
    </div>
</div>