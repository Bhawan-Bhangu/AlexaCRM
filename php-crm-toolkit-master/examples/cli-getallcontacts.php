<?php
/**
 * Copyright (c) 2016 AlexaCRM.
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Lesser General Public License as
 * published by the Free Software Foundation, version 3.
 *
 * This program is distributed in the hope that it will be useful, but
 * WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU
 * Lesser General Lesser Public License for more details.
 *
 * You should have received a copy of the GNU Lesser General Public License
 * along with this program. If not, see <http://www.gnu.org/licenses/>.
 */

use AlexaCRM\CRMToolkit\Client;
use AlexaCRM\CRMToolkit\Entity\MetadataCollection;
use AlexaCRM\CRMToolkit\Settings;

/*
 * Enable autoloading for the toolkit.
 *
 * CRM Toolkit for PHP is a PSR-4 compliant package.
 * If you installed the package via Composer, please use
 * its own autoloader which is generally placed in vendor/autoload.php
 *
 * See: https://getcomposer.org/doc/01-basic-usage.md#autoloading
 */

require_once '../init.php';

/*
 * Specify whether we retrieve the contact record by its e-mail (emailaddress1) or ID
 *
 * NOTICE. For retrieval by e-mail to work, you should first create an entity key for Contact entity
 * where [emailaddress1] would be a key attribute.
 *
 * It is possible to get all entity keys for given entity from its metadata ($entity->metadata()->keys)
 */
$isRetrievedByEmail = false;


$clientOptions = include('config.php');
$clientSettings = new Settings($clientOptions);
$client = new Client($clientSettings);
$metadata = MetadataCollection::instance($client);

$contacts = $client->retrieveMultipleEntities("contact", $allPages = false, $pagingCookie = null, $limitCount = 10, $pageNumber = 1, $simpleMode = false);

    echo PHP_EOL . '------------------' . PHP_EOL;


    foreach ($contacts->Entities as $contact) {

        echo PHP_EOL . '------------------' . PHP_EOL;
        echo "{$contact->fullname} <{$contact->emailaddress1}>" . PHP_EOL;
        if (!is_null($contact->jobtitle) && !is_null($contact->parentcustomeridname)) {
            echo $contact->jobtitle . ' at ' . $contact->parentcustomeridname . PHP_EOL;
        }
        echo PHP_EOL . $contact->address1_composite . PHP_EOL;
        if (!is_null($contact->telephone1)) {
            echo PHP_EOL . 'Phone: ' . $contact->telephone1 . PHP_EOL;
        }

}


