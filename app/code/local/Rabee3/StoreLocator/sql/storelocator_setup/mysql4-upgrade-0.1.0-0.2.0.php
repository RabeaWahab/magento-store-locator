<?php
 
$installer = $this;
 
$installer->startSetup();
 
$installer->run("
ALTER TABLE {$this->getTable('storelocator/locations')} 
ADD COLUMN `zipcode` VARCHAR(100) NOT NULL AFTER `address`,
ADD COLUMN `status` INT(2) NOT NULL AFTER `zipcode`;
");
 
$installer->endSetup();