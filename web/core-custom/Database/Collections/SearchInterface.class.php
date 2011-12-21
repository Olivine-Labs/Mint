<?php
/*---------------------------------------------------------------------------
	SearchInterface								2011 Olivine Labs
-----------------------------------------------------------------------------
	Namespace	: Database
	Class		: SearchInterface
	-	Interface to SearchCollection methods
---------------------------------------------------------------------------*/
namespace Database;

interface SearchInterface
{
	public function Load(\Entities\Search $Search);
	public function Save(\Entities\Search $Search);
	public function Delete(\Entities\Search $Search);
	public function ListBy($Owner, $Limit = 10, $Skip = 0);
}
?>
