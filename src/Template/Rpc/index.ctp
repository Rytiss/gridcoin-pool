<acct_mgr_reply>
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
    </account>
    <?php endforeach; ?>
</acct_mgr_reply>
