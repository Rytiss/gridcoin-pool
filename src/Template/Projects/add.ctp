<div class="projects form large-9 medium-8 columns content">
    <?= $this->Form->create($project) ?>
    <fieldset>
        <legend><?= __('Add Project') ?></legend>
        <?php
            echo $this->Form->control('name');
            echo $this->Form->control('url');
            echo $this->Form->control('url_signature');
            echo $this->Form->control('active');
            echo $this->Form->control('authenticator');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
