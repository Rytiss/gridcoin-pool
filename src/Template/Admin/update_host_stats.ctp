<h1>Stats update complete</h1>

<p>Updated projects: <?= $updatedProjects; ?></p>
<p>Updated hosts: <?= $updatedHosts; ?></p>
<div>
    <p>Errors:</p>
    <?php if (count($errors) === 0): ?>
    <p>No errors.</p>
    <?php endif; ?>
    
    <?php foreach ($errors as $error): ?>
    <p><small><?= $error; ?></small></p>
    <?php endforeach; ?>
</div>