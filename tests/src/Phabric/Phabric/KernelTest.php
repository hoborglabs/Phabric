<?php
namespace Phabric\Phabric;

use Mockery;

class KernelTest extends \PHPUnit_Framework_TestCase {

	public function testConstructor() {
		$kernel = new Kernel();
		$this->assertInstanceOf('\\Phabric\\Phabric\\Kernel', $kernel);
	}

	public function testConstructorWithParams() {
		$kernel = new Kernel(array());
		$this->assertInstanceOf('\\Phabric\\Phabric\\Kernel', $kernel);

		$kernel = new Kernel(array('testDS' => Mockery::mock('\\Phabric\\Phabric\\Datasource\\iDatasource')));
		$this->assertInstanceOf('\\Phabric\\Phabric\\Kernel', $kernel);
		$this->assertInstanceOf('\\Phabric\\Phabric\\Datasource\\iDatasource', $kernel->getDatasource('testDS'));
	}

	/**
	 * @expectedException Phabric\Phabric\KernelException
	 */
	public function testConstructorThrowsErrors() {
		$kernel = new Kernel(array('test' => 'not iDatasource'));
	}

	/**
	* @expectedException Phabric\Phabric\EntityException
	*/
	public function testMissingEntityThrowsErrors() {
		$kernel = new Kernel();
		$kernel->getEntity('not-existing-entity-name');
	}
}
