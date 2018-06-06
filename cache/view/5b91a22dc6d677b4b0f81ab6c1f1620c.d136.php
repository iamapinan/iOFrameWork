<?php
/* template head */
if (class_exists('Dwoo\Plugins\Functions\PluginInclude')===false)
	$this->getLoader()->loadPlugin('PluginInclude');
/* end template head */ ob_start(); /* template body */ ;
echo $this->classCall('Dwoo\Plugins\Functions\Plugininclude',
                        array('header.tpl', null, null, null, '_root', null));?>

<div class="container-fluid content-wrap" id="root">
    <div class="row align-items-center justify-content-center">
        <div class="col-12 align-self-center">
            <div class="jumbotron">
                <h1>Welcome to Product Page</h1>
                <?php 
$_fh0_data = (isset($this->scope["product"]) ? $this->scope["product"] : null);
if ($this->isTraversable($_fh0_data) == true)
{
	foreach ($_fh0_data as $this->scope['item'])
	{
/* -- foreach start output */
?>

                    <li><?php echo $this->scope["item"]["name"];?></li>
                <?php 
/* -- foreach end output */
	}
}?>

            </div>
            </div>
    </div>
</div>
<?php echo $this->classCall('Dwoo\Plugins\Functions\Plugininclude',
                        array('footer.tpl', null, null, null, '_root', null));
 /* end template body */
return $this->buffer . ob_get_clean();
?>