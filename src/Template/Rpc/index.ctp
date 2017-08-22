<acct_mgr_reply>
    <?php if ($error): ?>
    <error_msg><?= $error; ?></error_msg>
    <?php endif; ?>
    <name><?= h($poolName); ?></name>
    <signing_key>
<?= $publicKey; ?>
    </signing_key>
    <?php foreach ($projects as $project): ?>
    <account>
        <url><?= $project['url']; ?></url>
        <url_signature>
<?= $project['url_signature']; ?>
        </url_signature>
        <authenticator><?= $project['authenticator']; ?></authenticator>
        <dont_request_more_work><?= ($project['active'] ? '0' : '1'); ?></dont_request_more_work>
    </account>
    <?php endforeach; ?>
</acct_mgr_reply>
