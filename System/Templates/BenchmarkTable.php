<style type="text/css">
	.generalBenchmarkTable
	{
		top:50%;
		left:50%;
		margin-left:-400px;
		margin-top:-200px;
		border:solid 1px #E1E4E5;
		background:#FEFEFE;
		padding:10px;
		font-family:Calibri, Ebrima, Century Gothic, Consolas, "Courier New", Courier, monospace, Tahoma, Arial;
		color:#666;
		width:800px;
		font-size:14px;
		position:absolute;
	}
	.importantColorBenchmarkTable{ color:#900; }
	.keywordColorBenchmarkTable{ color:#090; }
</style>

<?php $lang = lang('Benchmark'); ?>

<div class="generalBenchmarkTable">
<table>
    <tr><td colspan='2' class="importantColorBenchmarkTable"><?php echo $lang['resultTable']; ?></td></tr>
    <tr><td><?php echo $lang['elapsedTime']; ?></td><td>: <b><?php echo $elapsedTime." ".$lang['second']; ?></b></td></tr>
    <tr><td><?php echo $lang['memoryUsage']; ?></td><td>: <b><?php echo $memoryUsage." ".$lang['byte']; ?></b></td></tr>
    <tr><td><?php echo $lang['maxMemoryUsage']; ?></td><td>: <b><?php echo $maxMemoryUsage." ".$lang['byte']; ?></b></td></tr>
    <tr><td><?php echo $lang['countFile']; ?></td><td>: <b><?php echo count(get_required_files()); ?></b></td></tr>
    <tr><td colspan='2'></td></tr><tr><td colspan='2'></td></tr><tr><td colspan='2'></td></tr>
    <tr><td colspan='2' class="importantColorBenchmarkTable"><?php echo $lang['performanceTips']; ?></td></tr>
    <tr><td colspan='2'><?php echo $lang['laterProcess']; ?></td></tr>
    <tr>
        <td><?php echo $lang['configHtaccess']; ?></td>
        <td>: <strong>$config[<span class="importantColorBenchmarkTable">'Htaccess'</span>][<span class="importantColorBenchmarkTable">'createFile'</span>] = <span class="keywordColorBenchmarkTable">false</span>;</strong>
        </td>
    </tr>
</table>
</div>