<?php
namespace Phabric\Phabric;

use Phabric\iEntity;

use Phabric\Phabric\Datasource\iDatasource;
use Behat\Gherkin\Node\TableNode;

/**
 * @package Phabric
 */
interface iStorageEntity extends iEntity
{

    /**
     * Update a previously inserted entity with the new data from a gherkin table.
     *
     * @param $table
     *
     * @return void
     */
    public function updateFromTable(TableNode $table);

}
