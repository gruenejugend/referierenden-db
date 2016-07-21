<?php

/**
 * Description of test_referierende
 *
 * @author KWM
 */
class test_referierende extends PHPUnit_Framework_TestCase {
	public static $referierende = array();
	
	public function test_control_create() {
		self::$referierende[0] = Referierende_Control::create(array(
			'first_name'		=> 'Tester1',
			'last_name'			=> 'Test1',
			'user_email'		=> 'test1@test1.de',
			'user_url'			=> 'test1.de',
			'gender'			=> 'true',
			'twitter'			=> '@test1',
			'facebook'			=> 'Tester1 Test1',
			'themen'			=> array(
				'TestThema1', 'TestThema2'
			),
			'wohnort'			=> array(
				'TestOrt1', 'TestOrt2'
			),
			'wohnort_laender'	=> array(
				'TestLand1', 'TestLand2'
			),
			'description'		=> 'Teeest',
			'aemter'			=> array(
				'Test1', 'Test2'
			)
		));
		
		$user = get_userdata(self::$referierende[0]);
		$this->assertEquals('Tester1',				$user->first_name);
		$this->assertEquals('Test1',				$user->last_name);
		$this->assertEquals('test1@test1.de',		$user->user_email);
		$this->assertEquals('http://test1.de',		$user->user_url);
		$this->assertEquals('true',					get_user_meta(self::$referierende[0], 'ref_gender', true));
		$this->assertEquals('@test1',				get_user_meta(self::$referierende[0], 'ref_twitter', true));
		$this->assertEquals('Tester1 Test1',		get_user_meta(self::$referierende[0], 'ref_facebook', true));
		$themen = get_user_meta(self::$referierende[0], 'ref_thema', false);
		foreach($themen AS $thema) {
			$this->assertTrue($thema == 'TestThema1' || $thema == 'TestThema2');
		}
		$wohnorte = get_user_meta(self::$referierende[0], 'ref_wohnort', false);
		foreach($wohnorte AS $wohnort) {
			$this->assertTrue($wohnort == 'TestOrt1' || $wohnort == 'TestOrt2');
		}
		$laender = get_user_meta(self::$referierende[0], 'ref_land', false);
		foreach($laender AS $land) {
			$this->assertTrue($land == 'TestOrt1' || $land == 'TestOrt2');
		}
		$this->assertEquals('Teeest',				get_user_meta(self::$referierende[0], 'description', true));
		$aemter = get_user_meta(self::$referierende[0], 'ref_amt', false);
		foreach($aemter AS $amt) {
			$this->assertTrue($amt == 'Test1' || $amt == 'Test2');
		}
		
		self::$referierende[1] = Referierende_Control::create(array(
			'first_name'		=> 'Tester2',
			'last_name'			=> 'Test2',
			'user_email'		=> 'test2@test2.de',
			'user_url'			=> 'test2.de',
			'gender'			=> 'false',
			'twitter'			=> '@test2',
			'facebook'			=> 'Tester2 Test2',
			'themen'			=> array(
				'TestThema3', 'TestThema4'
			),
			'wohnort'			=> array(
				'TestOrt3', 'TestOrt4'
			),
			'wohnort_laender'	=> array(
				'TestLand3', 'TestLand4'
			),
			'description'		=> 'Teeest',
			'aemter'			=> array(
				'Test3', 'Test4'
			)
		));
		
		$user = get_userdata(self::$referierende[1]);
		$this->assertEquals('Tester2',				$user->first_name);
		$this->assertEquals('Test2',				$user->last_name);
		$this->assertEquals('test2@test2.de',		$user->user_email);
		$this->assertEquals('http://test2.de',		$user->user_url);
		$this->assertEquals('false',				get_user_meta(self::$referierende[1], 'ref_gender', true));
		$this->assertEquals('@test2',				get_user_meta(self::$referierende[1], 'ref_twitter', true));
		$this->assertEquals('Tester2 Test2',		get_user_meta(self::$referierende[1], 'ref_facebook', true));
		$themen = get_user_meta(self::$referierende[1], 'ref_thema', false);
		foreach($themen AS $thema) {
			$this->assertTrue($thema == 'TestThema3' || $thema == 'TestThema4');
		}
		$wohnorte = get_user_meta(self::$referierende[1], 'ref_wohnort', false);
		foreach($wohnorte AS $wohnort) {
			$this->assertTrue($wohnort == 'TestOrt3' || $wohnort == 'TestOrt4');
		}
		$laender = get_user_meta(self::$referierende[1], 'ref_land', false);
		foreach($laender AS $land) {
			$this->assertTrue($land == 'TestOrt3' || $land == 'TestOrt4');
		}
		$this->assertEquals('Teeest',				get_user_meta(self::$referierende[1], 'description', true));
		$aemter = get_user_meta(self::$referierende[1], 'ref_amt', false);
		foreach($aemter AS $amt) {
			$this->assertTrue($amt == 'Test3' || $amt == 'Test4');
		}
	}
	
	public function test_control_update() {
		Referierende_Control::update(self::$referierende[0], 'user_email', 'test3@test3.de');
		Referierende_Control::update(self::$referierende[0], 'user_url', 'test3.de');
		Referierende_Control::update(self::$referierende[0], 'gender', 'false');
		Referierende_Control::update(self::$referierende[0], 'twitter', '@test3');
		Referierende_Control::update(self::$referierende[0], 'facebook', 'Tester3 Test3');
		Referierende_Control::update(self::$referierende[0], 'themen', array(
			'TestThema5', 'TestThema6'
		));
		Referierende_Control::update(self::$referierende[0], 'wohnort', array(
			'TestOrt5', 'TestOrt6'
		));
		Referierende_Control::update(self::$referierende[0], 'wohnort_laender', array(
			'TestLand5', 'TestLand6'
		));
		Referierende_Control::update(self::$referierende[0], 'description', 'Teeest');
		Referierende_Control::update(self::$referierende[0], 'aemter', array(
			'Test5', 'Test6'
		));
		
		$user = get_userdata(self::$referierende[0]);
		$this->assertEquals('Tester1',				$user->first_name);
		$this->assertEquals('Test1',				$user->last_name);
		$this->assertEquals('test3@test3.de',		$user->user_email);
		$this->assertEquals('http://test3.de',		$user->user_url);
		$this->assertEquals('false',				get_user_meta(self::$referierende[0], 'ref_gender', true));
		$this->assertEquals('@test3',				get_user_meta(self::$referierende[0], 'ref_twitter', true));
		$this->assertEquals('Tester3 Test3',		get_user_meta(self::$referierende[0], 'ref_facebook', true));
		$themen = get_user_meta(self::$referierende[0], 'ref_thema', false);
		foreach($themen AS $thema) {
			$this->assertTrue($thema == 'TestThema5' || $thema == 'TestThema6');
		}
		$wohnorte = get_user_meta(self::$referierende[0], 'ref_wohnort', false);
		foreach($wohnorte AS $wohnort) {
			$this->assertTrue($wohnort == 'TestOrt5' || $wohnort == 'TestOrt6');
		}
		$laender = get_user_meta(self::$referierende[0], 'ref_land', false);
		foreach($laender AS $land) {
			$this->assertTrue($land == 'TestLand5' || $land == 'TestLand6');
		}
		$this->assertEquals('Teeest',				get_user_meta(self::$referierende[0], 'description', true));
		$aemter = get_user_meta(self::$referierende[0], 'ref_amt', false);
		foreach($aemter AS $amt) {
			$this->assertTrue($amt == 'Test5' || $amt == 'Test6');
		}
	}
	
	public function test_control_addReferenz() {
		Referierende_Control::addReferenz(self::$referierende[0], "Test1", "TestOrt1", "TestVeranstalter_in1", "11.11.2015");
		Referierende_Control::addReferenz(self::$referierende[0], "Test2", "TestOrt2", "TestVeranstalter_in2", "22.11.2015");
		Referierende_Control::addReferenz(self::$referierende[1], "Test1", "TestOrt1", "TestVeranstalter_in1", "11.11.2015");
		
		$post_id[0] = get_page_by_title("Test1", OBJECT, Referenz_Control::POST_TYPE)->ID;
		$post_id[1] = get_page_by_title("Test2", OBJECT, Referenz_Control::POST_TYPE)->ID;
		
		$this->assertTrue(in_array($post_id[0], get_user_meta(self::$referierende[0], 'ref_referenz')));
		$this->assertTrue(in_array($post_id[1], get_user_meta(self::$referierende[0], 'ref_referenz')));
		$this->assertTrue(in_array($post_id[0], get_user_meta(self::$referierende[1], 'ref_referenz')));
	}
	
	public function test_model() {
		$referierende = new Referierende(self::$referierende[0]);
		
		$this->assertEquals(self::$referierende[0],				$referierende->ID);
		$this->assertEquals('Tester1',							$referierende->first_name);
		$this->assertEquals('Test1',							$referierende->last_name);
		$this->assertEquals('test3@test3.de',					$referierende->user_email);
		$this->assertEquals('test3.de',							$referierende->user_url);
		$this->assertEquals('false',							$referierende->gender);
		$this->assertEquals('@test3',							$referierende->twitter);
		$this->assertEquals('Tester3 Test3',					$referierende->facebook);
		$themen = $referierende->themen;
		foreach($themen AS $thema) {
			$this->assertTrue($thema == 'TestThema5' || $thema == 'TestThema6');
		}
		$wohnorte = $referierende->wohnort;
		foreach($wohnorte AS $wohnort) {
			$this->assertTrue($wohnort == 'TestOrt5' || $wohnort == 'TestOrt6');
		}
		$laender = $referierende->wohnort_laender;
		foreach($laender AS $land) {
			$this->assertTrue($land == 'TestLand5' || $land == 'TestLand6');
		}
		$this->assertEquals('Teeest',							$referierende->description);
		$aemter = $referierende->aemter;
		foreach($aemter AS $amt) {
			$this->assertTrue($amt == 'Test5' || $amt == 'Test6');
		}
		$this->assertEquals('false', $referierende->aktiviert);
		$this->assertEquals('false', $referierende->frei_admin);
		$this->assertEquals('false', $referierende->frei_selbst);
		
		$this->assertEquals(2, count($referierende->referenzen));
		$geprueft = array();
		foreach($referierende->referenzen AS $referenz) {
			$this->assertTrue(
					$referenz->name == 'Test1' && !$geprueft['Test1'] ||
					$referenz->name == 'Test2' && !$geprueft['Test2']
			);
			$geprueft[$referenz->name] = true;
		}
	}
	
	public function test_control_freigabe() {
		self::$referierende[2] = Referierende_Control::create(array(
			'first_name'		=> 'Teste4',
			'last_name'			=> 'Test4',
			'user_email'		=> 'test4@test4.de',
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
			'description'		=> 'Teeest',
			'aemter'			=> array(
				'Test7', 'Test8'
			)
		));
		
		self::$referierende[3] = Referierende_Control::create(array(
			'first_name'		=> 'Teste5',
			'last_name'			=> 'Test5',
			'user_email'		=> 'test5@test5.de',
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
			'description'		=> 'Teeest',
			'aemter'			=> array(
				'Test9', 'Test10'
			)
		));
		
		self::$referierende[4] = Referierende_Control::create(array(
			'first_name'		=> 'Teste6',
			'last_name'			=> 'Test6',
			'user_email'		=> 'test6@test6.de',
			'user_url'			=> 'test6.de',
			'gender'			=> 'true',
			'twitter'			=> '@test6',
			'facebook'			=> 'Tester6 Test6',
			'themen'			=> array(
				'TestThema11', 'TestThema12'
			),
			'wohnort'			=> array(
				'TestOrt11', 'TestOrt12'
			),
			'wohnort_laender'	=> array(
				'TestLand11', 'TestLand12'
			),
			'description'		=> 'Teeest',
			'aemter'			=> array(
				'Test11', 'Test12'
			)
		));
		
		self::$referierende[5] = Referierende_Control::create(array(
			'first_name'		=> 'Teste7',
			'last_name'			=> 'Test7',
			'user_email'		=> 'test7@test7.de',
			'user_url'			=> 'test7.de',
			'gender'			=> 'true',
			'twitter'			=> '@test7',
			'facebook'			=> 'Tester7 Test7',
			'themen'			=> array(
				'TestThema13', 'TestThema14'
			),
			'wohnort'			=> array(
				'TestOrt13', 'TestOrt14'
			),
			'wohnort_laender'	=> array(
				'TestLand13', 'TestLand14'
			),
			'description'		=> 'Teeest',
			'aemter'			=> array(
				'Test13', 'Test14'
			)
		));
		
		$referierende[0] = new Referierende(self::$referierende[0]); //0
		$referierende[1] = new Referierende(self::$referierende[1]); //0
		$referierende[2] = new Referierende(self::$referierende[2]); //0
		$referierende[3] = new Referierende(self::$referierende[3]); //0
		$referierende[4] = new Referierende(self::$referierende[4]); //1
		$referierende[5] = new Referierende(self::$referierende[5]); //1
		
		
		
		Referierende_Control::freigabe(self::$referierende[0]);
		Referierende_Control::freigabe(self::$referierende[1]);
		Referierende_Control::freigabe(self::$referierende[2]);
		Referierende_Control::freigabe(self::$referierende[3]);
		
		$this->assertEquals('true', $referierende[0]->frei_admin);
		$this->assertEquals('true', $referierende[1]->frei_admin);
		$this->assertEquals('true', $referierende[2]->frei_admin);
		$this->assertEquals('true', $referierende[3]->frei_admin);
		$this->assertEquals('false', $referierende[4]->frei_admin);
		$this->assertEquals('false', $referierende[5]->frei_admin);
		
		Referierende_Control::freigabe(self::$referierende[4]);
		Referierende_Control::freigabe(self::$referierende[5]);
		
		$this->assertEquals('true', $referierende[4]->frei_admin);
		$this->assertEquals('true', $referierende[5]->frei_admin);
		
		$this->assertEquals('false', $referierende[0]->aktiviert);
		$this->assertEquals('false', $referierende[1]->aktiviert);
		$this->assertEquals('false', $referierende[2]->aktiviert);
		$this->assertEquals('false', $referierende[3]->aktiviert);
		$this->assertEquals('false', $referierende[4]->aktiviert);
		$this->assertEquals('false', $referierende[5]->aktiviert);
		
		
		
		Referierende_Control::aktivieren(self::$referierende[0]);
		Referierende_Control::aktivieren(self::$referierende[1]);
		Referierende_Control::aktivieren(self::$referierende[2]);
		Referierende_Control::aktivieren(self::$referierende[3]);
		
		$this->assertEquals('true', $referierende[0]->frei_selbst);
		$this->assertEquals('true', $referierende[1]->frei_selbst);
		$this->assertEquals('true', $referierende[2]->frei_selbst);
		$this->assertEquals('true', $referierende[3]->frei_selbst);
		$this->assertEquals('false', $referierende[4]->frei_selbst);
		$this->assertEquals('false', $referierende[5]->frei_selbst);
		
		$this->assertEquals('false', $referierende[0]->aktiviert);
		$this->assertEquals('false', $referierende[1]->aktiviert);
		$this->assertEquals('false', $referierende[2]->aktiviert);
		$this->assertEquals('false', $referierende[3]->aktiviert);
		$this->assertEquals('false', $referierende[4]->aktiviert);
		$this->assertEquals('false', $referierende[5]->aktiviert);
		
		$this->assertEquals(0, Referierende_Control::getGenderNFIT());
		$this->assertEquals(0, Referierende_Control::getGenderFIT());
		
		Referierende_Control::aktivieren(self::$referierende[4]);
		
		$this->assertEquals('true', $referierende[4]->frei_selbst);
		
		$this->assertEquals('true', $referierende[0]->aktiviert);
		$this->assertEquals('false', $referierende[1]->aktiviert);
		$this->assertEquals('false', $referierende[2]->aktiviert);
		$this->assertEquals('false', $referierende[3]->aktiviert);
		$this->assertEquals('true', $referierende[4]->aktiviert);
		$this->assertEquals('false', $referierende[5]->aktiviert);
		
		$this->assertEquals(1, Referierende_Control::getGenderNFIT());
		$this->assertEquals(1, Referierende_Control::getGenderFIT());
		
		Referierende_Control::aktivieren(self::$referierende[5]);
		
		$this->assertEquals('true', $referierende[5]->frei_selbst);
		
		$this->assertEquals('true', $referierende[0]->aktiviert);
		$this->assertEquals('true', $referierende[1]->aktiviert);
		$this->assertEquals('false', $referierende[2]->aktiviert);
		$this->assertEquals('false', $referierende[3]->aktiviert);
		$this->assertEquals('true', $referierende[4]->aktiviert);
		$this->assertEquals('true', $referierende[5]->aktiviert);
		
		$this->assertEquals(2, Referierende_Control::getGenderNFIT());
		$this->assertEquals(2, Referierende_Control::getGenderFIT());
		
		update_user_meta(self::$referierende[2], "ref_aktiviert", "true");
		update_user_meta(self::$referierende[3], "ref_aktiviert", "true");
	}
	
	public function test_control_suche() {
		$referierende[0] = new Referierende(self::$referierende[0]); //0 TestThema1,  TestThema2  TestOrt1  TestOrt2  TestLand1  TestLand2
		$referierende[1] = new Referierende(self::$referierende[1]); //0 TestThema1,  TestThema2  TestOrt3  TestOrt4  TestLand3  TestLand4
		$referierende[2] = new Referierende(self::$referierende[2]); //0 TestThema7,  TestThema8  TestOrt3  TestOrt4  TestLand7  TestLand8
		$referierende[3] = new Referierende(self::$referierende[3]); //0 TestThema10, TestThema11 TestOrt9  TestOrt10 TestLand7  TestLand8
		$referierende[4] = new Referierende(self::$referierende[4]); //1 TestThema1,  TestThema2  TestOrt11 TestOrt12 TestLand7  TestLand8
		$referierende[5] = new Referierende(self::$referierende[5]); //1 TestThema13, TestThema14 TestOrt3  TestOrt4  TestLand13 TestLand14
		
		//Themen, Wohnort, Wohnort-Laender ändern, Zusammenfassen, Quote beachten
		
		Referierende_Control::update(self::$referierende[0], 'themen', array('TestThema1', 'TestThema2'));
		Referierende_Control::update(self::$referierende[1], 'wohnort_laender', array('TestLand1', 'TestLand2'));
		Referierende_Control::update(self::$referierende[1], 'themen', array('TestThema1', 'TestThema2'));
		Referierende_Control::update(self::$referierende[2], 'wohnort', array('TestOrt3', 'TestOrt4'));
		Referierende_Control::update(self::$referierende[3], 'wohnort_laender', array('TestLand7', 'TestLand8'));
		Referierende_Control::update(self::$referierende[4], 'themen', array('TestThema1', 'TestThema2'));
		Referierende_Control::update(self::$referierende[4], 'wohnort_laender', array('TestLand7', 'TestLand8'));
		Referierende_Control::update(self::$referierende[5], 'wohnort', array('TestOrt3', 'TestOrt4'));
		
		
		
		$suche[0] = Referierende_Control::suche(array(
			'FIT'			=> 'true'
		));
		
		$this->assertEquals(2, count($suche[0]));
		$geprueft = array();
		$ids = array(4,5);
		foreach($suche[0] AS $ergebnis) {
			$this->assertTrue(
					($referierende[$ids[0]]->equals($ergebnis) && !$geprueft[$referierende[$ids[0]]->ID]) ||
					($referierende[$ids[1]]->equals($ergebnis) && !$geprueft[$referierende[$ids[1]]->ID])
			);
			$geprueft[$ergebnis->ID] = true;
		}
		
		
		
		$suche[1] = Referierende_Control::suche(array(
			'themen'		=> array('TestThema1')
		));
		
		$this->assertEquals(3, count($suche[1]));
		$geprueft = array();
		$ids = array(0,1,4);
		foreach($suche[1] AS $ergebnis) {
			$this->assertTrue(
					($referierende[$ids[0]]->equals($ergebnis) && !$geprueft[$referierende[$ids[0]]->ID]) ||
					($referierende[$ids[1]]->equals($ergebnis) && !$geprueft[$referierende[$ids[1]]->ID]) ||
					($referierende[$ids[2]]->equals($ergebnis) && !$geprueft[$referierende[$ids[2]]->ID])
			);
			$geprueft[$ergebnis->ID] = true;
		}
		
		
		
		$suche[2] = Referierende_Control::suche(array(
			'wohnort'		=> array('TestOrt3')
		));
		
		$this->assertEquals(3, count($suche[2]));
		$geprueft = array();
		$ids = array(1,2,5);
		foreach($suche[2] AS $ergebnis) {
			$this->assertTrue(
					($referierende[$ids[0]]->equals($ergebnis) && !$geprueft[$referierende[$ids[0]]->ID]) ||
					($referierende[$ids[1]]->equals($ergebnis) && !$geprueft[$referierende[$ids[1]]->ID]) ||
					($referierende[$ids[2]]->equals($ergebnis) && !$geprueft[$referierende[$ids[2]]->ID])
			);
			$geprueft[$ergebnis->ID] = true;
		}
		
		
		
		$suche[3] = Referierende_Control::suche(array(
			'wohnort_land'	=> array('TestLand7')
		));
		
		$this->assertEquals(3, count($suche[3]));
		$geprueft = array();
		$ids = array(2,3,4);
		foreach($suche[3] AS $ergebnis) {
			$this->assertTrue(
					($referierende[$ids[0]]->equals($ergebnis) && !$geprueft[$referierende[$ids[0]]->ID]) ||
					($referierende[$ids[1]]->equals($ergebnis) && !$geprueft[$referierende[$ids[1]]->ID]) ||
					($referierende[$ids[2]]->equals($ergebnis) && !$geprueft[$referierende[$ids[2]]->ID])
			);
			$geprueft[$ergebnis->ID] = true;
		}
		
		
		
		$suche[4] = Referierende_Control::suche(array(
			'FIT'			=> 'true',
			'themen'		=> array('TestThema1')
		));
		
		$this->assertEquals(1, count($suche[4]));
		$geprueft = array();
		$ids = array(4);
		foreach($suche[4] AS $ergebnis) {
			$this->assertTrue($referierende[$ids[0]]->equals($ergebnis) && !$geprueft[$referierende[$ids[0]]->ID]);
			$geprueft[$ergebnis->ID] = true;
		}
		
		
		
		$suche[5] = Referierende_Control::suche(array(
			'FIT'			=> 'true',
			'wohnort'		=> array('TestOrt3')
		));
		
		$this->assertEquals(1, count($suche[5]));
		$geprueft = array();
		$ids = array(5);
		foreach($suche[5] AS $ergebnis) {
			$this->assertTrue($referierende[$ids[0]]->equals($ergebnis) && !$geprueft[$referierende[$ids[0]]->ID]);
			$geprueft[$ergebnis->ID] = true;
		}
		
		
		
		$suche[6] = Referierende_Control::suche(array(
			'FIT'			=> 'true',
			'wohnort_land'	=> array('TestLand7')
		));
		
		$this->assertEquals(1, count($suche[6]));
		$geprueft = array();
		$ids = array(4);
		foreach($suche[6] AS $ergebnis) {
			$this->assertTrue($referierende[$ids[0]]->equals($ergebnis) && !$geprueft[$referierende[$ids[0]]->ID]);
			$geprueft[$ergebnis->ID] = true;
		}
		
		
		
		$suche[7] = Referierende_Control::suche(array(
			'themen'		=> array('TestThema1', 'TestThema7')
		));
		
		$this->assertEquals(4, count($suche[7]));
		$geprueft = array();
		$ids = array(0,1,2,4);
		foreach($suche[7] AS $ergebnis) {
			$this->assertTrue(
					($referierende[$ids[0]]->equals($ergebnis) && !$geprueft[$referierende[$ids[0]]->ID]) ||
					($referierende[$ids[1]]->equals($ergebnis) && !$geprueft[$referierende[$ids[1]]->ID]) ||
					($referierende[$ids[2]]->equals($ergebnis) && !$geprueft[$referierende[$ids[2]]->ID]) ||
					($referierende[$ids[3]]->equals($ergebnis) && !$geprueft[$referierende[$ids[3]]->ID])
			);
			$geprueft[$ergebnis->ID] = true;
		}
		
		
		
		$suche[8] = Referierende_Control::suche(array(
			'wohnort'		=> array('TestOrt3', 'TestOrt9')
		));
		
		$this->assertEquals(4, count($suche[8]));
		$geprueft = array();
		$ids = array(1,2,3,5);
		foreach($suche[8] AS $ergebnis) {
			$this->assertTrue(
					($referierende[$ids[0]]->equals($ergebnis) && !$geprueft[$referierende[$ids[0]]->ID]) ||
					($referierende[$ids[1]]->equals($ergebnis) && !$geprueft[$referierende[$ids[1]]->ID]) ||
					($referierende[$ids[2]]->equals($ergebnis) && !$geprueft[$referierende[$ids[2]]->ID]) ||
					($referierende[$ids[3]]->equals($ergebnis) && !$geprueft[$referierende[$ids[3]]->ID])
			);
			$geprueft[$ergebnis->ID] = true;
		}
		
		
		
		$suche[9] = Referierende_Control::suche(array(
			'wohnort_land'	=> array('TestLand7', 'TestLand1')
		));
		
		$this->assertEquals(4, count($suche[9]));
		$geprueft = array();
		$ids = array(2,3,4,1);
		foreach($suche[9] AS $ergebnis) {
			$this->assertTrue(
					($referierende[$ids[0]]->equals($ergebnis) && !$geprueft[$referierende[$ids[0]]->ID]) ||
					($referierende[$ids[1]]->equals($ergebnis) && !$geprueft[$referierende[$ids[1]]->ID]) ||
					($referierende[$ids[2]]->equals($ergebnis) && !$geprueft[$referierende[$ids[2]]->ID]) ||
					($referierende[$ids[3]]->equals($ergebnis) && !$geprueft[$referierende[$ids[3]]->ID])
			);
			$geprueft[$ergebnis->ID] = true;
		}
		
		
		
		$suche[10] = Referierende_Control::suche(array(
			'themen'		=> array('TestThema1', 'TestThema13')
		));
		
		$this->assertEquals(4, count($suche[10]));
		$geprueft = array();
		$ids = array(0,1,4,5);
		foreach($suche[10] AS $ergebnis) {
			$this->assertTrue(
					($referierende[$ids[0]]->equals($ergebnis) && !$geprueft[$referierende[$ids[0]]->ID]) ||
					($referierende[$ids[1]]->equals($ergebnis) && !$geprueft[$referierende[$ids[1]]->ID]) ||
					($referierende[$ids[2]]->equals($ergebnis) && !$geprueft[$referierende[$ids[2]]->ID]) ||
					($referierende[$ids[3]]->equals($ergebnis) && !$geprueft[$referierende[$ids[3]]->ID])
			);
			$geprueft[$ergebnis->ID] = true;
		}
		
		
		
		$suche[11] = Referierende_Control::suche(array(
			'wohnort'		=> array('TestOrt3', 'TestOrt11')
		));
		
		$this->assertEquals(4, count($suche[11]));
		$geprueft = array();
		$ids = array(1,2,4,5);
		foreach($suche[11] AS $ergebnis) {
			$this->assertTrue(
					($referierende[$ids[0]]->equals($ergebnis) && !$geprueft[$referierende[$ids[0]]->ID]) ||
					($referierende[$ids[1]]->equals($ergebnis) && !$geprueft[$referierende[$ids[1]]->ID]) ||
					($referierende[$ids[2]]->equals($ergebnis) && !$geprueft[$referierende[$ids[2]]->ID]) ||
					($referierende[$ids[3]]->equals($ergebnis) && !$geprueft[$referierende[$ids[3]]->ID])
			);
			$geprueft[$ergebnis->ID] = true;
		}
		
		
		
		$suche[12] = Referierende_Control::suche(array(
			'wohnort_land'	=> array('TestLand7', 'TestLand13')
		));
		
		$this->assertEquals(4, count($suche[12]));
		$geprueft = array();
		$ids = array(2,3,4,5);
		foreach($suche[12] AS $ergebnis) {
			$this->assertTrue(
					($referierende[$ids[0]]->equals($ergebnis) && !$geprueft[$referierende[$ids[0]]->ID]) ||
					($referierende[$ids[1]]->equals($ergebnis) && !$geprueft[$referierende[$ids[1]]->ID]) ||
					($referierende[$ids[2]]->equals($ergebnis) && !$geprueft[$referierende[$ids[2]]->ID]) ||
					($referierende[$ids[3]]->equals($ergebnis) && !$geprueft[$referierende[$ids[3]]->ID])
			);
			$geprueft[$ergebnis->ID] = true;
		}
		
		
		$suche[14] = Referierende_Control::suche(array(
			'themen'		=> array('TestThema1', 'TestThema13'),
			'wohnort'		=> array('TestOrt3', 'TestOrt11'),
			'wohnort_land'	=> array('TestLand7', 'TestLand1')
		));
		
		$this->assertEquals(2, count($suche[14]));
		$geprueft = array();
		$ids = array(1,4);
		foreach($suche[14] AS $ergebnis) {
			$this->assertTrue(
					($referierende[$ids[0]]->equals($ergebnis) && !$geprueft[$referierende[$ids[0]]->ID]) ||
					($referierende[$ids[1]]->equals($ergebnis) && !$geprueft[$referierende[$ids[1]]->ID]) 
			);
			$geprueft[$ergebnis->ID] = true;
		}
	}
	
	public function test_control_sucheGleich() {
		$referierende[0] = new Referierende(self::$referierende[0]); //0 TestThema1,  TestThema2  TestOrt1  TestOrt2  TestLand1  TestLand2
		$referierende[1] = new Referierende(self::$referierende[1]); //0 TestThema1,  TestThema2  TestOrt3  TestOrt4  TestLand3  TestLand4
		$referierende[2] = new Referierende(self::$referierende[2]); //0 TestThema7,  TestThema8  TestOrt3  TestOrt4  TestLand7  TestLand8
		$referierende[3] = new Referierende(self::$referierende[3]); //0 TestThema10, TestThema11 TestOrt9  TestOrt10 TestLand7  TestLand8
		$referierende[4] = new Referierende(self::$referierende[4]); //1 TestThema1,  TestThema2  TestOrt11 TestOrt12 TestLand7  TestLand8
		$referierende[5] = new Referierende(self::$referierende[5]); //1 TestThema13, TestThema14 TestOrt3  TestOrt4  TestLand13 TestLand14
		
		
		$suche[0] = Referierende_Control::sucheGleich(array(
			'FIT'			=> 'true'
		));
		
		$this->assertEquals(2, count($suche[0]));
		$geprueft = array();
		$ids = array(4,5);
		foreach($suche[0] AS $ergebnis) {
			$this->assertTrue(
					($referierende[$ids[0]]->equals($ergebnis) && !$geprueft[$referierende[$ids[0]]->ID]) ||
					($referierende[$ids[1]]->equals($ergebnis) && !$geprueft[$referierende[$ids[1]]->ID])
			);
			$geprueft[$ergebnis->ID] = true;
		}
		
		
		
		$suche[1] = Referierende_Control::sucheGleich(array(
			'themen'		=> array('TestThema1')
		));
		
		$this->assertEquals(2, count($suche[1]));
		$geprueft = array();
		$ids = array(0,4);
		foreach($suche[1] AS $ergebnis) {
			$this->assertTrue(
					($referierende[$ids[0]]->equals($ergebnis) && !$geprueft[$referierende[$ids[0]]->ID]) ||
					($referierende[$ids[1]]->equals($ergebnis) && !$geprueft[$referierende[$ids[1]]->ID]) 
			);
			$geprueft[$ergebnis->ID] = true;
		}
		
		
		
		$suche[2] = Referierende_Control::sucheGleich(array(
			'wohnort'		=> array('TestOrt3')
		));
		
		$this->assertEquals(2, count($suche[2]));
		$geprueft = array();
		$ids = array(1,5);
		foreach($suche[2] AS $ergebnis) {
			$this->assertTrue(
					($referierende[$ids[0]]->equals($ergebnis) && !$geprueft[$referierende[$ids[0]]->ID]) ||
					($referierende[$ids[1]]->equals($ergebnis) && !$geprueft[$referierende[$ids[1]]->ID]) 
			);
			$geprueft[$ergebnis->ID] = true;
		}
		
		
		
		$suche[3] = Referierende_Control::sucheGleich(array(
			'wohnort_land'	=> array('TestLand7')
		));
		
		$this->assertEquals(2, count($suche[3]));
		$geprueft = array();
		$ids = array(2,4);
		foreach($suche[3] AS $ergebnis) {
			$this->assertTrue(
					($referierende[$ids[0]]->equals($ergebnis) && !$geprueft[$referierende[$ids[0]]->ID]) ||
					($referierende[$ids[1]]->equals($ergebnis) && !$geprueft[$referierende[$ids[1]]->ID]) 
			);
			$geprueft[$ergebnis->ID] = true;
		}
		
		
		
		$suche[4] = Referierende_Control::sucheGleich(array(
			'FIT'			=> 'true',
			'themen'		=> array('TestThema1')
		));
		
		$this->assertEquals(1, count($suche[4]));
		$geprueft = array();
		$ids = array(4);
		foreach($suche[4] AS $ergebnis) {
			$this->assertTrue($referierende[$ids[0]]->equals($ergebnis) && !$geprueft[$referierende[$ids[0]]->ID]);
			$geprueft[$ergebnis->ID] = true;
		}
		
		
		
		$suche[5] = Referierende_Control::sucheGleich(array(
			'FIT'			=> 'true',
			'wohnort'		=> array('TestOrt3')
		));
		
		$this->assertEquals(1, count($suche[5]));
		$geprueft = array();
		$ids = array(5);
		foreach($suche[5] AS $ergebnis) {
			$this->assertTrue($referierende[$ids[0]]->equals($ergebnis) && !$geprueft[$referierende[$ids[0]]->ID]);
			$geprueft[$ergebnis->ID] = true;
		}
		
		
		
		$suche[6] = Referierende_Control::sucheGleich(array(
			'FIT'			=> 'true',
			'wohnort_land'	=> array('TestLand7')
		));
		
		$this->assertEquals(1, count($suche[6]));
		$geprueft = array();
		$ids = array(4);
		foreach($suche[6] AS $ergebnis) {
			$this->assertTrue($referierende[$ids[0]]->equals($ergebnis) && !$geprueft[$referierende[$ids[0]]->ID]);
			$geprueft[$ergebnis->ID] = true;
		}
		
		
		
		$suche[7] = Referierende_Control::sucheGleich(array(
			'themen'		=> array('TestThema1', 'TestThema7')
		));
		
		$this->assertEquals(2, count($suche[7]));
		$geprueft = array();
		$ids = array(0,4);
		foreach($suche[7] AS $ergebnis) {
			$this->assertTrue(
					($referierende[$ids[0]]->equals($ergebnis) && !$geprueft[$referierende[$ids[0]]->ID]) ||
					($referierende[$ids[1]]->equals($ergebnis) && !$geprueft[$referierende[$ids[1]]->ID]) 
			);
			$geprueft[$ergebnis->ID] = true;
		}
		
		
		
		$suche[8] = Referierende_Control::sucheGleich(array(
			'wohnort'		=> array('TestOrt3', 'TestOrt9')
		));
		
		$this->assertEquals(2, count($suche[8]));
		$geprueft = array();
		$ids = array(1,5);
		foreach($suche[8] AS $ergebnis) {
			$this->assertTrue(
					($referierende[$ids[0]]->equals($ergebnis) && !$geprueft[$referierende[$ids[0]]->ID]) ||
					($referierende[$ids[1]]->equals($ergebnis) && !$geprueft[$referierende[$ids[1]]->ID]) 
			);
			$geprueft[$ergebnis->ID] = true;
		}
		
		
		
		$suche[9] = Referierende_Control::sucheGleich(array(
			'wohnort_land'	=> array('TestLand7', 'TestLand1')
		));
		
		$this->assertEquals(2, count($suche[9]));
		$geprueft = array();
		$ids = array(4,1);
		foreach($suche[9] AS $ergebnis) {
			$this->assertTrue(
					($referierende[$ids[0]]->equals($ergebnis) && !$geprueft[$referierende[$ids[0]]->ID]) ||
					($referierende[$ids[1]]->equals($ergebnis) && !$geprueft[$referierende[$ids[1]]->ID]) 
			);
			$geprueft[$ergebnis->ID] = true;
		}
		
		
		
		$suche[10] = Referierende_Control::sucheGleich(array(
			'themen'		=> array('TestThema1', 'TestThema13')
		));
		
		$this->assertEquals(4, count($suche[10]));
		$geprueft = array();
		$ids = array(0,1,4,5);
		foreach($suche[10] AS $ergebnis) {
			$this->assertTrue(
					($referierende[$ids[0]]->equals($ergebnis) && !$geprueft[$referierende[$ids[0]]->ID]) ||
					($referierende[$ids[1]]->equals($ergebnis) && !$geprueft[$referierende[$ids[1]]->ID]) ||
					($referierende[$ids[2]]->equals($ergebnis) && !$geprueft[$referierende[$ids[2]]->ID]) ||
					($referierende[$ids[3]]->equals($ergebnis) && !$geprueft[$referierende[$ids[3]]->ID])
			);
			$geprueft[$ergebnis->ID] = true;
		}
		
		
		
		$suche[11] = Referierende_Control::sucheGleich(array(
			'wohnort'		=> array('TestOrt3', 'TestOrt11')
		));
		
		$this->assertEquals(4, count($suche[11]));
		$geprueft = array();
		$ids = array(1,2,4,5);
		foreach($suche[11] AS $ergebnis) {
			$this->assertTrue(
					($referierende[$ids[0]]->equals($ergebnis) && !$geprueft[$referierende[$ids[0]]->ID]) ||
					($referierende[$ids[1]]->equals($ergebnis) && !$geprueft[$referierende[$ids[1]]->ID]) ||
					($referierende[$ids[2]]->equals($ergebnis) && !$geprueft[$referierende[$ids[2]]->ID]) ||
					($referierende[$ids[3]]->equals($ergebnis) && !$geprueft[$referierende[$ids[3]]->ID])
			);
			$geprueft[$ergebnis->ID] = true;
		}
		
		
		
		$suche[12] = Referierende_Control::sucheGleich(array(
			'wohnort_land'	=> array('TestLand7', 'TestLand13')
		));
		
		$this->assertEquals(4, count($suche[12]));
		$geprueft = array();
		$ids = array(2,3,4,5);
		foreach($suche[12] AS $ergebnis) {
			$this->assertTrue(
					($referierende[$ids[0]]->equals($ergebnis) && !$geprueft[$referierende[$ids[0]]->ID]) ||
					($referierende[$ids[1]]->equals($ergebnis) && !$geprueft[$referierende[$ids[1]]->ID]) ||
					($referierende[$ids[2]]->equals($ergebnis) && !$geprueft[$referierende[$ids[2]]->ID]) ||
					($referierende[$ids[3]]->equals($ergebnis) && !$geprueft[$referierende[$ids[3]]->ID])
			);
			$geprueft[$ergebnis->ID] = true;
		}
		
		
		$suche[14] = Referierende_Control::sucheGleich(array(
			'themen'		=> array('TestThema1', 'TestThema13'),
			'wohnort'		=> array('TestOrt3', 'TestOrt11'),
			'wohnort_land'	=> array('TestLand7', 'TestLand1')
		));
		
		$this->assertEquals(2, count($suche[14]));
		$geprueft = array();
		$ids = array(1,4);
		foreach($suche[14] AS $ergebnis) {
			$this->assertTrue(
					($referierende[$ids[0]]->equals($ergebnis) && !$geprueft[$referierende[$ids[0]]->ID]) ||
					($referierende[$ids[1]]->equals($ergebnis) && !$geprueft[$referierende[$ids[1]]->ID]) 
			);
			$geprueft[$ergebnis->ID] = true;
		}
	}
	
	public function test_control_delReferenz() {
		$post_id[0] = get_page_by_title("Test1", OBJECT, Referenz_Control::POST_TYPE)->ID;
		$post_id[1] = get_page_by_title("Test2", OBJECT, Referenz_Control::POST_TYPE)->ID;
		
		Referierende_Control::delReferenz(self::$referierende[0], $post_id[0]);
		$this->assertNotNull(get_page_by_title("Test1", OBJECT, Referenz_Control::POST_TYPE));
		Referierende_Control::delReferenz(self::$referierende[0], $post_id[1]);
		$this->assertNull(get_page_by_title("Test2", OBJECT, Referenz_Control::POST_TYPE));
		Referierende_Control::delReferenz(self::$referierende[1], $post_id[0]);
		$this->assertNull(get_page_by_title("Test1", OBJECT, Referenz_Control::POST_TYPE));
		
		$this->assertTrue(!in_array($post_id[0], get_user_meta(self::$referierende[0], 'ref_referenz') == null ? array() : get_user_meta(self::$referierende[0], 'ref_referenz')));
		$this->assertTrue(!in_array($post_id[1], get_user_meta(self::$referierende[0], 'ref_referenz') == null ? array() : get_user_meta(self::$referierende[0], 'ref_referenz')));
		$this->assertTrue(!in_array($post_id[0], get_user_meta(self::$referierende[1], 'ref_referenz') == null ? array() : get_user_meta(self::$referierende[1], 'ref_referenz')));
	}
	
	public function test_control_delete() {
		Referierende_Control::delete(self::$referierende[0]);
		
		$user = get_userdata(self::$referierende[0]);
		$this->assertFalse($user);
		
		Referierende_Control::delete(self::$referierende[1]);
		
		$user = get_userdata(self::$referierende[1]);
		$this->assertFalse($user);
	}
}
