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
                <h1>Welcome to I/O Framework</h1>
                <subtitle>version 1.0rc</subtitle>
                <p align="center">
                    <a href="https://iotech.co.th">iOTech Enterprise</a> | 
                    <a href="#">Documents</a> | 
                    <a href="https://github.com/iotech-thailand/ioFramework">Contributes</a>
                </p>
            </div>
            </div>
    </div>
</div>
<?php echo $this->classCall('Dwoo\Plugins\Functions\Plugininclude',
                        array('footer.tpl', null, null, null, '_root', null));
 /* end template body */
return $this->buffer . ob_get_clean();
?>