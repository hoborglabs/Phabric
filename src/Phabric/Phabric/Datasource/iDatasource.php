<?php
namespace Phabric\Phabric\Datasource;

use Phabric\Phabric\iEntity;

/**
 * Storage Datasource interface
 *
 */
interface iDatasource
{
	/**
	 * Resets the data to it's previous state
	 */
	public function reset();

	/**
	 * Inserts Data into the data source.
	 */
	public function insert(iEntity $entity, array $data);
}
