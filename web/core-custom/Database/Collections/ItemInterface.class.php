<?php
/*---------------------------------------------------------------------------
	ItemInterface								2011 Olivine Labs
-----------------------------------------------------------------------------
	Namespace	: Database
	Class		: ItemInterface
	-	Interface to ItemCollection methods
---------------------------------------------------------------------------*/
namespace Database;

interface ItemInterface
{
	public function Load(\Entities\Item $Item);
	public function Save(\Entities\Item $Item);
	public function Delete(\Entities\Item $Item);
	public function ListBy(\Entities\Search $Search);
  public function LoadImage($ImageId);
  public function SaveImage($name);
}
?>
