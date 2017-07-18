<pre>
    <?php echo Lang::select('IndividualStructures', 'user:username').": ".$usernameColumn; ?>

    <?php echo Lang::select('IndividualStructures', 'user:password').": ".$newPassword; ?>

    <a href="<?php echo $returnLinkPath; ?>"><?php echo Lang::select('IndividualStructures', 'user:learnNewPassword'); ?></a>
</pre>
