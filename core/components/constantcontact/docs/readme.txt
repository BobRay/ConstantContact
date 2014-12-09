
ConstantContact


Author: Bob Ray <http://bobsguides.com>
Copyright 2014

Official Documentation: http://bobsguides.com/constantcontact-tutorial.html

Bugs and Feature Requests: https://github.com:BobRay/ConstantContact

Questions: http://forums.modx.com

Created by MyComponent

This package was made possible through the generous support of Fountainhead, LLC dba RS Design.

The package provides a custom System Event, a property set, and a plugin that adds contacts to mailing lists at [Constant Contact](http://www.constantcontact.com/index.jsp) using the Constant Contact API V1.

Usage


You need a Constant Contact username and password. You don't need an API key. Set the username and password in the ccProperties property set.

At the point in your code where you want to add the contact, create an array of fields for the user and invoke the OnCustomerOrder event.

Example

You want to add a user to your mailing list when he or she completes an eCommerce purchase.

At the point where you confirm the user's purchase, add code like this using the information you have for the user:

        $contact = array(
            /* Required */
            'OptInSource'   => 'ACTION_BY_CUSTOMER',
            'Status'        => 'ACTIVE',
            'ContactList'   => 1,
            'Email'         => $email,
            'FirstName'     => $firstName,
            'LastName'      => $lastName,
            /* Optional */
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


The plugin checks to make sure there is no user with that email address, then adds the user. Using the class that comes with the package, it's also possible to update or remove existing users, but the plugin itself will only add them.
