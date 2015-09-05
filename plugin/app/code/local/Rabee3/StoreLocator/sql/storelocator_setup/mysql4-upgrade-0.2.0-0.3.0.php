<?php

$installer = $this;

$installer->startSetup();

$installer->run("
ALTER TABLE {$this->getTable('storelocator/locations')}
ADD COLUMN `phone` VARCHAR(55) NOT NULL AFTER `status`;
");

$installer->endSetup();
