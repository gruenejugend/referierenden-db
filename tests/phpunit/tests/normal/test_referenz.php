<?php

/**
 * Description of test_referenz
 *
 * @author KWM
 */
class test_referenz extends PHPUnit_Framework_TestCase {
	public static $referierende = array();
	public static $referenz = array();
	
	public function test_control_create() {
		self::$referenz[0] = Referenz_Control::create("Test1", "TestOrt1", "TestVeranstalter_in1", "11.11.2015");
		self::$referenz[1] = Referenz_Control::create("Test2", "TestOrt2", "TestVeranstalter_in2", "22.11.2015");
		
		$post = get_post(self::$referenz[0]);
		$this->assertEquals("Test1",					$post->post_title);
		$this->assertEquals("TestOrt1",					get_post_meta($post->ID, "ref_referenz_ort", true));
		$this->assertEquals("TestVeranstalter_in1",		get_post_meta($post->ID, "ref_referenz_veranstalter_in", true));
		$this->assertEquals("11.11.2015",				get_post_meta($post->ID, "ref_referenz_datum", true));
		
		$post = get_post(self::$referenz[1]);
		$this->assertEquals("Test2",					$post->post_title);
		$this->assertEquals("TestOrt2",					get_post_meta($post->ID, "ref_referenz_ort", true));
		$this->assertEquals("TestVeranstalter_in2",		get_post_meta($post->ID, "ref_referenz_veranstalter_in", true));
		$this->assertEquals("22.11.2015",				get_post_meta($post->ID, "ref_referenz_datum", true));
	}
	
	public function test_model() {
		$referenz[0] = new Referenz(self::$referenz[0]);
		
		$this->assertEquals(self::$referenz[0],			$referenz[0]->ID);
		$this->assertEquals("Test1",					$referenz[0]->name);
		$this->assertEquals("TestOrt1",					$referenz[0]->ort);
		$this->assertEquals("TestVeranstalter_in1",		$referenz[0]->veranstalter_in);
		$this->assertEquals("11.11.2015",				$referenz[0]->datum);
		
		$referenz[1] = new Referenz(self::$referenz[1]);
		
		$this->assertEquals(self::$referenz[1],			$referenz[1]->ID);
		$this->assertEquals("Test2",					$referenz[1]->name);
		$this->assertEquals("TestOrt2",					$referenz[1]->ort);
		$this->assertEquals("TestVeranstalter_in2",		$referenz[1]->veranstalter_in);
		$this->assertEquals("22.11.2015",				$referenz[1]->datum);
	}
	
	public function test_control_count() {
		$referierende[0] = Referierende_Control::create(array(
			'first_name'		=> 'Teste8',
			'last_name'			=> 'Test8',
			'user_email'		=> 'test8@test8.de',
			'user_url'			=> 'test4.de',
			'gender'			=> 'false',
			'twitter'			=> '@test4',
			'facebook'			=> 'Tester4 Test4',
			'themen'			=> array(
				'TestThema7', 'TestThema8'
			),
			'wohnort'			=> array(
				'TestOrt7', 'TestOrt8'
			),
			'wohnort_laender'	=> array(
				'TestLand7', 'TestLand8'
			),
			'biografie'			=> 'Teeest',
			'aemter'			=> array(
				'Test7', 'Test8'
			)
		));
		
		$referierende[1] = Referierende_Control::create(array(
			'first_name'		=> 'Teste9',
			'last_name'			=> 'Test9',
			'user_email'		=> 'test9@test9.de',
			'user_url'			=> 'test5.de',
			'gender'			=> 'false',
			'twitter'			=> '@test5',
			'facebook'			=> 'Tester5 Test5',
			'themen'			=> array(
				'TestThema9', 'TestThema10'
			),
			'wohnort'			=> array(
				'TestOrt9', 'TestOrt10'
			),
			'wohnort_laender'	=> array(
				'TestLand9', 'TestLand10'
			),
			'biografie'			=> 'Teeest',
			'aemter'			=> array(
				'Test9', 'Test10'
			)
		));
		
		Referierende_Control::addReferenz($referierende[0], "Test3", "TestOrt1", "TestVeranstalter_in1", "11.11.2015");
		Referierende_Control::addReferenz($referierende[0], "Test4", "TestOrt2", "TestVeranstalter_in2", "22.11.2015");
		
		$this->assertEquals(1, Referenz_Control::count(get_page_by_title("Test3", OBJECT, Referenz_Control::POST_TYPE)->ID));
		$this->assertEquals(1, Referenz_Control::count(get_page_by_title("Test4", OBJECT, Referenz_Control::POST_TYPE)->ID));
		
		Referierende_Control::addReferenz($referierende[1], "Test3", "TestOrt1", "TestVeranstalter_in1", "11.11.2015");
		
		$this->assertEquals(2, Referenz_Control::count(get_page_by_title("Test3", OBJECT, Referenz_Control::POST_TYPE)->ID));
		$this->assertEquals(1, Referenz_Control::count(get_page_by_title("Test4", OBJECT, Referenz_Control::POST_TYPE)->ID));
		
		Referierende_Control::addReferenz($referierende[0], "Test3", "TestOrt1", "TestVeranstalter_in1", "11.11.2015");
		Referierende_Control::addReferenz($referierende[0], "Test4", "TestOrt2", "TestVeranstalter_in2", "22.11.2015");
		
		$this->assertEquals(2, Referenz_Control::count(get_page_by_title("Test3", OBJECT, Referenz_Control::POST_TYPE)->ID));
		$this->assertEquals(1, Referenz_Control::count(get_page_by_title("Test4", OBJECT, Referenz_Control::POST_TYPE)->ID));
		
		Referierende_Control::delReferenz($referierende[0], get_page_by_title("Test3", OBJECT, Referenz_Control::POST_TYPE)->ID);
		
		$this->assertEquals(1, Referenz_Control::count(get_page_by_title("Test3", OBJECT, Referenz_Control::POST_TYPE)->ID));
		$this->assertEquals(1, Referenz_Control::count(get_page_by_title("Test4", OBJECT, Referenz_Control::POST_TYPE)->ID));
		
		Referierende_Control::delReferenz($referierende[1], get_page_by_title("Test3", OBJECT, Referenz_Control::POST_TYPE)->ID);
		
		$this->assertEquals(0, Referenz_Control::count(get_page_by_title("Test3", OBJECT, Referenz_Control::POST_TYPE)->ID));
		$this->assertEquals(1, Referenz_Control::count(get_page_by_title("Test4", OBJECT, Referenz_Control::POST_TYPE)->ID));
	}
	
	public function test_control_exist() {
		function testExist($input) {
			if($input == false) {
				return false;
			}
			return true;
		}
		$this->assertTrue(testExist(Referenz_Control::exists("Test1", "TestOrt1", "TestVeranstalter_in1", "11.11.2015")));
		$this->assertTrue(testExist(Referenz_Control::exists("Test2", "TestOrt2", "TestVeranstalter_in2", "22.11.2015")));
		$this->assertFalse(testExist(Referenz_Control::exists("Test5", "TestOrt5", "TestVeranstalter_in3", "23.11.2015")));
	}
	
	public function test_control_delete() {
		Referenz_Control::delete(self::$referenz[0]);
		Referenz_Control::delete(self::$referenz[1]);
		
		$this->assertNull(get_post(self::$referenz[0]));
		$this->assertNull(get_post(self::$referenz[1]));
	}
}
