<?php
ZN\Inclusion\Style::use('bootstrap', 'awesome'); 
ZN\Inclusion\Script::use('jquery', 'bootstrap');
ZN\Inclusion\Template::use('ExternalTemplateStyles');
?>
<style>
.table-bordered>tbody>tr>td 
{
    border: 1px solid #222;
}
</style>

<div class="col-lg-12" style="z-index:1000000; margin-top:15px">
    <div class="panel panel-default panel-top-header">

        <div class="panel-heading" style="background:#222; border:none;">
            <h3 class="panel-title panel-text h-panel-header">
            <i class="fa fa-clock-o fa-fw"></i> 
            <?php echo '<span class="text-color">UNIT TEST RESULTS</span>' ?>
        </div>
        <?php echo $input; ?>
    </div>
</div>

