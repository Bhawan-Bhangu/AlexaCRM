<?php
/**
 * Created by PhpStorm.
 * User: Bhawanjeet
 * Date: 2018-05-15
 * Time: 12:50 PM
 */
echo 'hii';
require_once '../vendor/autoload.php';

use AlexaCRM\CRMToolkit\Client as OrganizationService;
use AlexaCRM\CRMToolkit\Settings;

$contactId = '1d2fc62f-1c56-448b-b546-edfb6d6fec5c';
$options = [

    // Dynamics CRM URL
    'serverUrl' => 'https://crm303540.crm.dynamics.com',

    // System user name
    'username'  => 'admin@CRM303540.onmicrosoft.com',

    // System user password
    'password'  => 'dennis@5800',

    // CRM type (OnlineFederation for CRM Online, Federation for IFD)
    'authMode'  => 'OnlineFederation',
];

$serviceSettings = new Settings( $options );
$service = new OrganizationService( $serviceSettings );



// retrieve a contact and update its fields
/*$contact = $service->entity( 'contact', $guid );
$contact->firstname = explode( '@', $contact->emailaddress1 )[0];
$contact->update();
printf( 'Info for %s %s updated.', $contact->firstname, $contact->lastname );

// create a new contact
$contact = $service->entity( 'contact' );
$contact->firstname = 'Dennis';
$contact->lastname = 'Sis';
$contact->emailaddress1 = 'dennis@sis.com';
$contactId = $contact->create();
printf( 'test contact id  is %s',$contactId);
// delete a contact
//$contact->delete();

// execute an action
$whoAmIResponse = $service->executeAction( 'WhoAmI' );
echo 'Organization ID: ' . $whoAmIResponse->OrganizationId;  */



//retrieve all contacts and print info
$contacts = $service->retrieveMultipleEntities("contact", $allPages = true, $pagingCookie = null, $limitCount = 10, $pageNumber = 1, $simpleMode = false);



foreach ($contacts->Entities as $contact) {




    echo "{$contact->fullname} <{$contact->emailaddress1}> " . PHP_EOL;
    if (!is_null($contact->jobtitle) && !is_null($contact->parentcustomeridname)) {
        echo $contact->jobtitle . ' at ' . $contact->parentcustomeridname . PHP_EOL ;
    }
    echo PHP_EOL . $contact->address1_composite . PHP_EOL;
    if (!is_null($contact->telephone1)) {
        echo PHP_EOL . 'Phone: ' . $contact->telephone1 . PHP_EOL;
    }

}



