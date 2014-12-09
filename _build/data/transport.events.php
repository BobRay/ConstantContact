<?php
/**
 * events transport file for ConstantContact extra
 *
 * Copyright 2014 by Bob Ray <http://bobsguides.com>
 * Created on 12-06-2014
 *
 * @package constantcontact
 * @subpackage build
 */

if (! function_exists('stripPhpTags')) {
    function stripPhpTags($filename) {
        $o = file_get_contents($filename);
        $o = str_replace('<' . '?' . 'php', '', $o);
        $o = str_replace('?>', '', $o);
        $o = trim($o);
        return $o;
    }
}
/* @var $modx modX */
/* @var $sources array */
/* @var xPDOObject[] $events */


$events = array();

$events[1] = $modx->newObject('modEvent');
$events[1]->fromArray(array (
  'name' => 'OnCustomerOrder',
  'service' => 1,
  'groupname' => 'ConstantContact',
), '', true, true);
return $events;
