<?php
namespace Phabric\Phabric\Datasource;

use Phabric\iEntity;

/**
 * Storage Datasource interface
 *
 */
interface iStorageDatasource extends iDatasource
{

	/**
	 * Updates data in the datasource.
	 */
	public function update(iEntity $entity, array $data);

	/**
	 * Delete data from the datasource.
	 */
	public function delete($enityName);
}
