<?php

$lang  = ZN\Lang::select('IndividualStructures'); 

ZN\Inclusion\Style::use('bootstrap', 'awesome', 'external-template-style'); 
ZN\Inclusion\Script::use('jquery', 'bootstrap');
ZN\Inclusion\Template::use('ExternalTemplateStyles');
?>
<style>
.table-bordered>tbody>tr>td 
{
    border: 1px solid #222; color : #ccc; font-size:14px;
}
</style>

<div class="col-lg-12" style="z-index:1000000; margin-top:15px">
    <div class="panel panel-default panel-top-header">

        <div class="panel-heading" style="background:#222; border:none;">
            <h3 class="panel-title panel-text h-panel-header">
            <i class="fa fa-clock-o fa-fw"></i> 
            <?php echo '<span class="text-color">BENCHMARK</span>' ?>
            <?php echo $message ?? NULL; ?></h3>
        </div>
        <a href="#openBenchmark<?php echo $key?>" class="list-group-item panel-header" data-toggle="collapse">
            <span><i class="fa fa-angle-down fa-fw panel-text"></i>&nbsp;&nbsp;&nbsp;&nbsp; Benchmark Result</span>
        </a>
        <div class="panel-body collapse in" id="openBenchmark" style="margin-bottom:-17px;">
            <div class="list-group panel-text">
                <table class="table table-bordered">
                    <tr><td width="20%"><?php echo $lang['benchmark:elapsedTime']; ?></td><td><?php echo $elapsedTime." ".$lang['benchmark:second']; ?></td></tr>
                    <tr><td><?php echo $lang['benchmark:memoryUsage']; ?></td><td><?php echo $memoryUsage." ".$lang['benchmark:byte']; ?></td></tr>
                    <tr><td><?php echo $lang['benchmark:maxMemoryUsage']; ?></td><td><?php echo $maxMemoryUsage." ".$lang['benchmark:byte']; ?></td></tr>
                    <tr><td><?php echo $lang['benchmark:countFile']; ?></td><td><?php echo count(get_required_files()); ?></td></tr>
                </table>
            </div>
        </div>

        <a href="#openServerData" class="list-group-item panel-header" data-toggle="collapse">
            <span><i class="fa fa-angle-down fa-fw panel-text"></i>&nbsp;&nbsp;&nbsp;&nbsp; Server Request Data</span>
        </a>
        <div class="panel-body collapse" id="openServerData" style="margin-bottom:-17px;">
            <div class="list-group panel-text">
                <table class="table table-bordered">
                    <?php foreach( $_SERVER as $key => $value ): ?>
                    <tr><td width="20%" class=><?php echo $key ?? NULL ?></td><td><?php echo $value ?? NULL ?></td></tr>
                    <?php endforeach; ?>
                
                </table>
            </div>
        </div>
    </div>
</div>

