<?php namespace ZN\Database;
#-------------------------------------------------------------------------
# This file automatically created and updated
#-------------------------------------------------------------------------

class Persons
{
	const table = 'persons';

	use \ZN\Ability\Facade;

	const target = 'ZN\Database\PersonsGrandModel';
}

#-------------------------------------------------------------------------