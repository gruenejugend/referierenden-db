<?php

/**
 * Description of test_all
 *
 * @author KWM
 */
class test_all extends PHPUnit_Framework_TestSuite {
	public static function suite() {
		$suite = new test_all();
		
		$suite->addTestFile('tests/phpunit/tests/normal/test_referierende.php');
		$suite->addTestFile('tests/phpunit/tests/normal/test_referenz.php');
		
		return $suite;
	}
}
