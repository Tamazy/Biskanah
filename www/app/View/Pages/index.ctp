<?php
/* Page d'acceuil */
?>

<div class="users form register">
    <?php echo $this->Form->create('User', array('controller'=>'users','action'=>'register')); ?>
    <fieldset>
        <legend><?php echo __('S\'enregistrer'); ?></legend>
        <?php
        echo $this->Form->input('username');
        echo $this->Form->input('password');
        echo $this->Form->input('email');
        ?>
    </fieldset>
    <?php echo $this->Form->end(__('Submit')); ?>
</div>
