<?php ZN\Inclusion\Style::use('bootstrap'); ?>

<table class="table table-bordered">
    <tr>
        <th colspan="2"><?php echo ZN\Lang::select('IndividualStructures', 'user:verificationEmail')?></th>
    </tr>
    <tr>
        <td><?php echo ZN\Lang::select('IndividualStructures', 'user:username')?></td>
        <td><?php echo $usernameColumn; ?></td>
    </tr>
    <tr>
        <td><?php echo ZN\Lang::select('IndividualStructures', 'user:password')?></td>
        <td><?php echo $newPassword; ?></td>
    </tr>

    <tr>
        <td colspan="2">
            <a href="<?php echo $returnLinkPath; ?>"><?php echo ZN\Lang::select('IndividualStructures', 'user:learnNewPassword'); ?></a>
        </td>
    </tr>
</pre>