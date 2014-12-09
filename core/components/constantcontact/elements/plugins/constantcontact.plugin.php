<?php
/**
 * ConstantContact plugin for ConstantContact extra
 *
 * Copyright 2014 by Bob Ray <http://bobsguides.com>
 * Created on 12-06-2014
 *
 * ConstantContact is free software; you can redistribute it and/or modify it under the
 * terms of the GNU General Public License as published by the Free Software
 * Foundation; either version 2 of the License, or (at your option) any later
 * version.
 *
 * ConstantContact is distributed in the hope that it will be useful, but WITHOUT ANY
 * WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR
 * A PARTICULAR PURPOSE. See the GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License along with
 * ConstantContact; if not, write to the Free Software Foundation, Inc., 59 Temple
 * Place, Suite 330, Boston, MA 02111-1307 USA
 *
 * @package constantcontact
 */

/**
 * Description
 * -----------
 * Description: Adds contacts to list at Constant Contact
 *
 * Variables
 * ---------
 * @var $modx modX
 * @var $scriptProperties array
 * @var $contact array
 *
 * @package constantcontact
 **/

/*
 Usage:

    $contact = array(
        // Required
        'OptInSource'   => 'ACTION_BY_CUSTOMER',
        'Status'        => 'ACTIVE',
        'ContactList'   => 1,
        'Email'         => $email,
        'FirstName'     => $firstName,
        'LastName'      => $lastName,
        // Optional
        'City'          => $city,
        'CompanyName'   => $company,
        'JobTitle'      => $title,
        'StateName'     => $stateName,
        'StateCode'     => $stateCode,
        'CountryCode'   => $countryCode,
        'CountryName'   => $countryName,
        'Addr1'         => $addressOne,
        'Addr2'         => $addressTwo,
        'Addr3'         => $addressThree,
        'PostalCode'    => $postalCode,
        'SubPostalCode' => $postalSubCode,
        'HomePhone'     => $homePhone,
        'WorkPhone'     => $workPhone,
    );

    $success = $modx->invokeEvent('OnCustomerOrder', array('contact' => $contact));

More info here:

https://community.constantcontact.com/t5/Documentation/Updating-Opting-in-a-Contact/ba-p/25115

*/


include $modx->getOption('cc.core_path', NULL, $modx->getOption('core_path') . 'components/constantcontact/') . 'model/constantcontact/cc.class.php';

$config = $scriptProperties;

$userName = $modx->getOption('ccUsername', $config, '');

if (empty($userName)) {
    $modx->log(modX::LOG_LEVEL_ERROR, '[ConstantContact] No UserName');
}
$password = $modx->getOption('ccPassword', $config, '');
if (empty($password)) {
    $modx->log(modX::LOG_LEVEL_ERROR, '[ConstantContact] No password');
}


$cc = new cc($userName, $password);
$cc->set_action_type();

$email = strtolower($contact['Email']);
$user = $cc->query_contacts($email);
if ($user !== false) {
    return '';
}
unset($contact['Email']);

$contact_list = $contact['ContactList'];
unset($contact['ContactList']);
$extra_fields = $contact;

$success = $cc->create_contact($email, $contact_list, $extra_fields);

return '';