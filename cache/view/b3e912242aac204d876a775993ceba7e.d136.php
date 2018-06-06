<?php
/* template head */
/* end template head */ ob_start(); /* template body */ ;
echo $this->assignInScope('iO Framwork 1.0rc', 'site_name');?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>
        <?php if ((isset($this->scope["page_title"]) ? $this->scope["page_title"] : null) == '') {
?>

            <?php echo $this->scope["site_name"];?>

        <?php 
}
else {
?>

            <?php echo $this->scope["page_title"];?>

        <?php 
}?>

    </title>
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="//use.fontawesome.com/releases/v5.0.10/css/all.css" integrity="sha384-+d0P83n9kaQMCwj8F4RJB66tzIwOKmrdb46+porD/OvrJ+37WqIM7UoBtwHO6Nlg"
        crossorigin="anonymous">
    <link rel="stylesheet" href="assets/style.css">
</head>
<body><?php  /* end template body */
return $this->buffer . ob_get_clean();
?>