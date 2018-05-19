
<a href="#openUnitTestResult<?php echo $index;?>" class="list-group-item panel-header" data-toggle="collapse">
    <span><i class="fa fa-angle-down fa-fw panel-text"></i>&nbsp;&nbsp;&nbsp;&nbsp; TOTAL</span>
</a>
<div class="panel-body collapse in" id="openUnitTestResult<?php echo $index;?>" style="margin-bottom:-17px;">
    <div class="list-group panel-text">
        <table class="table table-bordered panel-text">
            <tr><td width="20%">Syntax Check</td><td>OK</td></tr>
            <tr><td>Elapsed Time</td><td><?php echo $elapsedTime; ?></td></tr>
            <tr><td>Memory Usage</td><td><?php echo $memoryUsage; ?></td></tr>
            <tr><td>Total Files</td><td><?php echo $totalFileCount; ?></td></tr>
            <tr><td>Total Corrects</td><td><?php echo $totalCorrectCount . '/' . $index; ?></td></tr>
            <tr><td>Total Methods</td><td><?php echo $index; ?></td></tr>
        </table>
    </div>
</div>