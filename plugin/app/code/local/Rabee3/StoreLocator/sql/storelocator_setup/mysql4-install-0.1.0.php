<?php
 
$installer = $this;
 
$installer->startSetup();
 
$installer->run("
-- DROP TABLE IF EXISTS {$this->getTable('storelocator/locations')};
CREATE TABLE {$this->getTable('storelocator/locations')} (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `address` TEXT NULL,
  `longitude` varchar(255) NULL,
  `latitude` varchar(255) NULL,
  `created_at` datetime NULL,
  `updated_at` datetime NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;");
 
$installer->endSetup();