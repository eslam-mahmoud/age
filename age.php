<?php
	//https://en.wikipedia.org/wiki/List_of_countries_by_life_expectancy
	//http://waitbutwhy.com/2016/03/my-ted-talk.html
	function get_life_expectancy($country) {
		return 69;
	}
	try {
		$dob = $_GET['dob'];
		$dob = new DateTime($dob);
		$now = new DateTime();
		// var_dump($now->diff($dob));
		$diff_dob = $now->diff($dob)->days;
		// var_dump($diff_dob/7);
		$country = $_GET['country'];
		$life_expectancy = get_life_expectancy($country);
		// var_dump(date('Y M d', strtotime(date("Y-m-d") .' -'.$life_expectancy.' years')));
		// die;
		$date = date('Y-m-d', strtotime(date("Y-m-d") .' -'.$life_expectancy.' years'));
		$life_expectancy = new DateTime($date);
		// var_dump($life_expectancy);
		$diff_life = $now->diff($life_expectancy)->days;
		// var_dump($diff_life/7);
		echo '<b>'.round($diff_dob/$diff_life*100,2).'%</b>';
		echo '<div style="width:80%;margin: 0 auto;">';
		for ($i=0; $i < $diff_life/7; $i++) {
			if ($i < $diff_dob/7) echo '<img src="./Heart_Red.png" />';
			else echo '<img src="./Heart_Green.png" />';
		}
		echo '</div>';
		// $week_expectancy = date('W', strtotime());
		
		// print_r(get_class_vars($diff_dob));
		// print_r(get_class_methods($diff_dob));
		die;
		// echo $week_lived . ' ' . $week_expectancy;
		// for ($i=0; $i < $week_expectancy; $i++) {
		// 	echo ' - ';
		// }
	} catch (Exception $e) {
		var_dump($e);
	}
?>