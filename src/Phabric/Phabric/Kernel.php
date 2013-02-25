<?php
namespace Phabric\Phabric;

use Phabric\Phabric\Datasource\iDatasource;

/**
 * Phabric Kernel.
 *
 */
class Kernel {

	/**
	 * Hash with available named datasources.
	 * @var array
	 */
	protected $datasources = array();

	/**
	 * Hash with created entities.
	 * @var array
	 */
	protected $entities = array();

	protected $config = array();

	public function __construct(array $datasources = array()) {
		foreach ($datasources as $name => $datasource) {
			if (! $datasource instanceof iDatasource) {
				throw new KernelException("'{$name}' datasource is not instance of Phabric\Phabric\Datasource\iDatasource'");
			}
			$this->setDatasource($name, $datasource);
		}
	}

	public function loadConfiguration($configurationFile) {

	}

	/**
	 * Sets named dataasource. This function will overwrite existing datasource with the same name.
	 *
	 * @param string $name
	 * @param iDatasource $datasource
	 */
	public function setDatasource($name, iDatasource $datasource) {
		$this->datasources[$name] = $datasource;
	}

	public function getDatasource($name) {
		if (!isset($this->datasources[$name])) {
			throw new \Exception("Datasource '{$name}' not found.");
		}

		return $this->datasources[$name];
	}

	/**
	 * Lazy getter for Entities.
	 *
	 * @param string $name
	 */
	public function getEntity($name) {
		if (isset($this->entities[$name])) {
			return $this->entities[$name];
		}

		// check in config
		if (!isset($this->config['entities'][$name])) {
			throw new EntityException("Entity '{$name}' not found in Phabric configuration");
		}

		$entitiyConf = $this->config['entities'][$name];
		$className = isset($entitiyConf['class']) ? $entitiyConf['class'] : 'Phabric\\Phabric\\StorageEntity';
		$datasourceName = isset($entitiyConf['datasource']) ? $entitiyConf['datasource'] : 'default';
		$ds = $this->getDatasource($datasourceName);
		$this->entities[$name] = new $className($ds, $this);
	}
}
