<h1>Such-Filter</h1>

<form action="https://<?php echo $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"]; ?>" method="post">
	<?php 
		wp_nonce_field('ref_filter', 'ref_filter_nonce');
	?>
	<table border="0" cellpadding="5" cellspacing="5" width="100%">
	<tr>
		<td width="50%" style="padding: 5px;">
			<label for="gender">Nur FIT-Menschen:</label>
			<input type="checkbox" name="gender" id="gender" value="true" <?php if(isset($_POST['gender']) && $_POST['gender'] == "true") { ?> checked <?php } ?>>
		</td>
		<td width="50%" style="padding: 5px;">
			<label for="thema">Thema <i>(bei mehreren, bitte mit ", " trennen)</i>:</label>
			<input type="text" name="thema" id="thema" size="10"<?php if(isset($_POST['thema'])) { ?> value="<?php echo $_POST['thema']; ?>"<?php } ?>>
		</td>
	</tr>
	<tr>
		<td width="50%" style="padding: 5px;">
			<label for="wohnort">Wohnort <i>(bei mehreren, bitte mit ", " trennen)</i>:</label>
			<input type="text" name="wohnort" id="wohnort" size="10"<?php if(isset($_POST['wohnort'])) { ?> value="<?php echo $_POST['wohnort']; ?>"<?php } ?>>
		</td>
		<td width="50%" style="padding: 5px;">
			<label for="wohnort_laender">Wohnort L&auml;nder:</label>
			<select name="wohnort_laender[]" id="wohnort_laender" multiple>
				<option<?php echo $landChecked[0];  ?> value="baden-wuerttemberg">Baden-Württemberg</option>
				<option<?php echo $landChecked[1];  ?> value="bayern">Bayern</option>
				<option<?php echo $landChecked[2];  ?> value="berlin">Berlin</option>
				<option<?php echo $landChecked[3];  ?> value="brandenburg">Brandenburg</option>
				<option<?php echo $landChecked[4];  ?> value="bremen">Bremen</option>
				<option<?php echo $landChecked[5];  ?> value="hamburg">Hamburg</option>
				<option<?php echo $landChecked[6];  ?> value="hessen">Hessen</option>
				<option<?php echo $landChecked[7];  ?> value="mecklenburg-vorpommern">Mecklenburg Vorpommern</option>
				<option<?php echo $landChecked[8];  ?> value="niedersachsen">Niedersachsen</option>
				<option<?php echo $landChecked[9];  ?> value="nordrhein-westfalen">Nordrhein-Westfalen</option>
				<option<?php echo $landChecked[10]; ?> value="rheinland-pfalz">Rheinland-Pfalz</option>
				<option<?php echo $landChecked[11]; ?> value="saarland">Saarland</option>
				<option<?php echo $landChecked[12]; ?> value="sachsen">Sachsen</option>
				<option<?php echo $landChecked[13]; ?> value="sachsen-anhalt">Sachsen-Anhalt</option>
				<option<?php echo $landChecked[14]; ?> value="schleswig-holstein">Schleswig-Holstein</option>
				<option<?php echo $landChecked[15]; ?> value="thueringen">Thüringen</option>
			</select>
		</td>
	</tr>
	<tr>
		<td colspan="2" width="100%"><input type="submit" name="submit" value="Suchen"></td>
	</tr>
</table>
</form>
<hr>