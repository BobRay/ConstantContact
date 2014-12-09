<?php
/**
 * propertySets transport file for ConstantContact extra
 *
 * Copyright 2014-2015 by Bob Ray <http://bobsguides.com>
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
/* @var xPDOObject[] $propertySets */


$propertySets = array();

$propertySets[1] = $modx->newObject('modPropertySet');
$propertySets[1]->fromArray(array (
  'id' => 1,
  'name' => 'ccProperties',
  'description' => 'Property set for ConstantContact plugin',
), '', true, true);

$properties = include $sources['data'].'properties/properties.ccproperties.propertyset.php';
$propertySets[1]->setProperties($properties);
unset($properties);

return $propertySets;
