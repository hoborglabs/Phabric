<?php
namespace Phabric\Phabric;

use Phabric\Phabric\Datasource\iDatasource;
use Behat\Gherkin\Node\TableNode;

/**
 * @package Phabric
 */
interface iEntity
{
    /**
     * Initialises an instance of the Phabric class.
     *
     * @param $ds
     *
     * @param $bus
     * @param $config
     *
     */
    public function __construct(iDatasource $ds, Phabric $bus, $config = array());

    /**
     * Sets the instance of Phabric\Bus in use by this instance of Phabric.
     *
     * @param Phabric $bus
     *
     * @return void.
     *
     */
    public function setBus(Phabric $bus);

    /**
     * Set the human readable name of the entity
     *
     * @param string $name
     *
     * @return void
     */
    public function setName($name);

    /**
     * Get the human readable name of the entity.
     *
     * @return string
     */
    public function getName();

    /**
     * Creates an entity based on a gherkin table.
     * By default the data is augmented by the default values supplied.
     *
     * @param $table
     * @param boolean $defaultFlag
     *
     * @return void
     */
    public function insertFromTable(TableNode $table, $defaultFlag = true);

    /**
     * Update a previously inserted entity with the new data from a gherkin table.
     *
     * @param $table
     *
     * @return void
     */
    public function updateFromTable(TableNode $table);

}
