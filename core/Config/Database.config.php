<?php
//Session Settings
$Settings = new \Database\Settings();
$Settings->Name			  = 'Sessions';
$Settings->Driver		  = 'MongoDB';
$Settings->Host			  = 'localhost';
$Settings->Port			  = 27017;
$Settings->User			  = 'Mint';
$Settings->Password		= 'Impervious*1';
$Settings->Database		= 'Mint';
$Settings->Collection	= 'Sessions';
$Settings->ClassName	= '\Database\Collections\MongoDB\SessionCollection';
$this->addCollection($Settings);

//User Settings
$Settings = new \Database\Settings();
$Settings->Name			  = 'Users';
$Settings->Driver		  = 'MongoDB';
$Settings->Host			  = 'localhost';
$Settings->Port			  = 27017;
$Settings->User			  = 'Mint';
$Settings->Password		= 'Impervious*1';
$Settings->Database		= 'Mint';
$Settings->Collection	= 'Users';
$Settings->ClassName	= '\Database\Collections\MongoDB\UserCollection';
$this->addCollection($Settings);

//Quotes Settings
$Settings = new \Database\Settings();
$Settings->Name			  = 'Quotes';
$Settings->Driver		  = 'MongoDB';
$Settings->Host			  = 'localhost';
$Settings->Port			  = 27017;
$Settings->User			  = 'Mint';
$Settings->Password		= 'Impervious*1';
$Settings->Database		= 'Mint';
$Settings->Collection	= 'Quotes';
$Settings->ClassName	= '\Database\Collections\MongoDB\QuoteCollection';
$this->addCollection($Settings);

//Domain Settings
$Settings = new \Database\Settings();
$Settings->Name			  = 'Domains';
$Settings->Driver		  = 'MongoDB';
$Settings->Host			  = 'localhost';
$Settings->Port			  = 27017;
$Settings->User			  = 'Mint';
$Settings->Password		= 'Impervious*1';
$Settings->Database		= 'Mint';
$Settings->Collection	= 'Domains';
$Settings->ClassName	= '\Database\Collections\MongoDB\DomainCollection';
$this->addCollection($Settings);

//Statistic Settings
$Settings = new \Database\Settings();
$Settings->Name			  = 'Statistics';
$Settings->Driver		  = 'MongoDB';
$Settings->Host			  = 'localhost';
$Settings->Port			  = 27017;
$Settings->User			  = 'Mint';
$Settings->Password		= 'Impervious*1';
$Settings->Database		= 'Mint';
$Settings->Collection	= 'Statistics';
$Settings->ClassName	= '\Database\Collections\MongoDB\StatisticCollection';
$this->addCollection($Settings);

//Log Settings
$Settings = new \Database\Settings();
$Settings->Name			  = 'Logs';
$Settings->Driver		  = 'MongoDB';
$Settings->Host			  = 'localhost';
$Settings->Port			  = 27017;
$Settings->User			  = 'Mint';
$Settings->Password		= 'Impervious*1';
$Settings->Database		= 'Mint';
$Settings->Collection	= 'Logs';
$Settings->ClassName	= '\Database\Collections\MongoDB\LogCollection';
$this->addCollection($Settings);
?>
