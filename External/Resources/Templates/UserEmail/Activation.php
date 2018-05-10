<?php ZN\Inclusion\Style::use('bootstrap'); ?>

<table class="table table-bordered">
    <tr>
        <th><?php echo ZN\Lang::select('Authentication', 'activationProcess')?></th>
    </tr>

    <tr>
        <td>
            <a href="<?php echo $url.'user/'.$user.'/pass/'.$pass; ?>"> <?php echo ZN\Lang::select('Authentication', 'activation')?> </a>
        </td>
    </tr>
</table>

