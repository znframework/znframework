<pre>
    <?php echo ZN\IndividualStructures\Lang::select('IndividualStructures', 'user:username').": ".$usernameColumn; ?>

    <?php echo ZN\IndividualStructures\Lang::select('IndividualStructures', 'user:password').": ".$newPassword; ?>

    <a href="<?php echo $returnLinkPath; ?>"><?php echo ZN\IndividualStructures\Lang::select('IndividualStructures', 'user:learnNewPassword'); ?></a>
</pre>
