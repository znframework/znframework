<?php
/**
 * ZN PHP Web Framework
 * 
 * "Simplicity is the ultimate sophistication." ~ Da Vinci
 * 
 * @package ZN
 * @license MIT [http://opensource.org/licenses/MIT]
 * @author  Ozan UYKUN [ozan@znframework.com]
 */

$method   = strtoupper($properties['method'] ?? 'post');
$url      = $properties['url']               ?? NULL;
$selector = $properties['selector']          ?? 'document.documentElement.innerHTML';
$success  = $properties['success']           ?? NULL;
$error    = $properties['error']             ?? NULL;
$async    = $properties['async']             ?? 'true';
$data     = $properties['data']              ?? NULL;
?>

<script>
function <?php echo $function; ?>() 
{
    var xhttp = new XMLHttpRequest();
    
    xhttp.onreadystatechange = function() 
    {
        if( this.readyState === 4 && this.status === 200 ) 
        {
            <?php if( $success === NULL): ?>
            <?php echo $selector;?> = this.responseText;
            <?php else: ?>
            <?php echo $success;?>;
            <?php endif;?>
        }
        <?php if( $error !== NULL): ?>
        else
        {
            <?php echo $error;?>;
        }
        <?php endif;?>
    };

    xhttp.open('<?php echo $method; ?>', '<?php echo ZN\Services\URL::site($url) ?>', <?php echo $async?>);
    <?php if( isset($data) ): ?>
        xhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    <?php endif; ?>
    xhttp.send(<?php echo isset($data) ? '\''.ZN\Services\URL::buildQuery($data).'\'' : NULL;?>);
}
</script>