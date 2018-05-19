
<a href="#openUnitTestResult<?php echo $index;?>" class="list-group-item panel-header" data-toggle="collapse">
    <span><i class="fa fa-angle-down fa-fw panel-text"></i>&nbsp;&nbsp;&nbsp;&nbsp; <?php echo $class ?>::<?php echo $method?></span>
</a>
<div class="panel-body collapse" id="openUnitTestResult<?php echo $index;?>" style="margin-bottom:-17px;">
    <div class="list-group panel-text">
        <table class="table table-bordered panel-text">
            <tr><td width="20%">Syntax Check</td><td>OK</td></tr>
            <tr><td>Return Type</td><td><?php echo $returnType; ?></td></tr>
            <tr><td>Return Value</td><td><?php echo $returnValue ?: '0'; ?></td></tr>
            <tr><td>Result Correct</td><td><?php echo $isResultCorrect ?: '0'; ?></td></tr>
            <tr><td>Elapsed Time</td><td><?php echo $elapsedTime; ?></td></tr>
        </table>
    </div>
</div>