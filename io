#!/usr/bin/env php
<?php
/* I/O Framework CLI menu
 *
 * (The MIT license)
 * Copyright (c) 2014 Rob Morgan
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated * documentation files (the "Software"), to
 * deal in the Software without restriction, including without limitation the
 * rights to use, copy, modify, merge, publish, distribute, sublicense, and/or
 * sell copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING
 * FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS
 * IN THE SOFTWARE.
 */
use PhpSchool\CliMenu\CliMenu;
use PhpSchool\CliMenu\CliMenuBuilder;
use PhpSchool\CliMenu\MenuItem\AsciiArtItem;
use IO\Framework\Loader;

require_once('vendor/autoload.php');

$version = Loader::version(true);

$art = <<<ART

###   ######  
#    #    #  I/O FRAMEWORK: The fast MVC PHP framework build for everyone.
#    #    #  version: $version
###   ######  

ART;

$itemCallable = function (CliMenu $menu) {
    echo $menu->getSelectedItem()->getText() . ' is comming soon.';
};

$menu = (new CliMenuBuilder)
    ->setTitle('I/O Framework CLI Menu')
    ->addAsciiArt($art)
    ->setUnselectedMarker(' ')
    ->setSelectedMarker('⇢')
    ->addLineBreak("=")
    ->addSubMenu('Create Controller [+]')
        ->setTitle('Create Controller')
        ->addItem('Just controller (basic)', $itemCallable)
        ->addItem('Controller with route path', $itemCallable)
        ->addItem('Controller with template', $itemCallable)
        ->addItem('Controller with everything', $itemCallable)
        ->end()
    ->addItem('Create Middleware', $itemCallable)
    ->addSubMenu('Create Route [+]')
        ->setTitle('Create Route')
        ->addItem('API Route', $itemCallable)
        ->addItem('Web Route', $itemCallable)
        ->end()
    ->addSubMenu('Database setup [+]')
        ->setTitle('Database setup')
        ->addItem('Create migration', $itemCallable)
        ->addItem('Create seed', $itemCallable)
        ->addItem('Migrate tables', $itemCallable)
        ->addItem('Re-create tables', $itemCallable)
        ->end()
    ->addItem('Setup Authentication', $itemCallable)
    ->addItem('Setup Backend UI', $itemCallable)
    ->addItem('Setup complete CMS', $itemCallable)
    ->addItem('Generate secrete key', $itemCallable)
    ->addItem('Set permission', $itemCallable)
    ->addItem('Clear cache', $itemCallable)
    ->addLineBreak('-')
    ->addItem('[?] Help ', $itemCallable)
    ->addItem('[*] Credits', $itemCallable)
    ->setWidth(100)
    ->setBackgroundColour('cyan')
    ->setForegroundColour('black')
    ->setExitButtonText("|]| Exit")
    ->build();
    
$menu->open();