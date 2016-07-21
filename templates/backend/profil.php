<table class="form-table">
	<tr class="form-field" id="ref_gender_tab">
		<th scope="row"><label for="ref_gender">Bist du ein FIT-Mensch:</label></th>
		<td>
			<input type="checkbox" id="ref_gender" name="ref_gender" value="true"<?php if($referierende->gender  == 'true') { echo ' checked'; } ?>>
		</td>
	</tr>
	<tr class="form-field" id="ref_twitter_tab">
		<th scope="row"><label for="ref_twitter">Twitter:</label></th>
		<td>
			<input type="text" id="ref_twitter" name="ref_twitter" value="<?php echo $referierende->twitter; ?>" style="width: 25em;">
		</td>
	</tr>
	<tr class="form-field" id="ref_facebook_tab">
		<th scope="row"><label for="ref_facebook">Facebook:</label></th>
		<td>
			<input type="text" id="ref_facebook" name="ref_facebook" value="<?php echo $referierende->facebook; ?>" style="width: 25em;">
		</td>
	</tr>
	<tr class="form-field" id="ref_themen_tab">
		<th scope="row"><label for="ref_themen">Themen:</label></th>
		<td>
			<textarea cols="20" rows="3" name="ref_themen" id="ref_themen"><?php echo implode(", ", $referierende->themen); ?></textarea><br><br>
			<i><b>Bitte die einzelnen Themen mittels ", " trennen.</b></i>
		</td>
	</tr>
	<tr class="form-field" id="ref_wohnort_tab">
		<th scope="row"><label for="ref_wohnort">Wohnort:</label></th>
		<td>
			<textarea cols="20" rows="3" name="ref_wohnort" id="ref_wohnort"><?php echo implode(", ", $referierende->wohnort); ?></textarea><br><br>
			<i><b>Bitte die einzelnen Wohnorte mittels ", " trennen.</b></i>
		</td>
	</tr>
	<tr class="form-field" id="ref_wohnort_laender_tab">
		<th scope="row"><label for="ref_wohnort_laender">L&auml;nder:</label></th>
		<td>
			<select name="ref_wohnort_laender[]" id="ref_wohnort_laender" multiple>
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
	<tr class="form-field" id="ref_aemter_tab">
		<th scope="row"><label for="ref_aemter">&Auml;mter:</label></th>
		<td>
			<textarea cols="20" rows="3" name="ref_aemter" id="ref_aemter"><?php echo implode(", ", $referierende->aemter); ?></textarea><br><br>
			<i><b>Bitte die einzelne &Auml;mter mittels ", " trennen.</b></i>
		</td>
	</tr>
	<tr class="form-field" id="ref_referenz_tab_1">
		<th scope="row"><label for="ref_referenz_name_1">1. Referenzen:</label></th>
		<td>
			<table border="0" cellpadding="5" cellspacing="0" width="100%">
				<tr>
					<td width="50%">
						Name der Veranstaltung:<br>
						<input type="text" name="ref_referenz_name_1" id="ref_referenz_name_1">
					</td>
					<td width="50%">
						Ort der Veranstaltung:<br>
						<input type="text" name="ref_referenz_ort_1" id="ref_referenz_ort_1">
					</td>
				</tr>
				<tr>
					<td width="50%">
						Name der Veranstalter*innen:<br>
						<input type="text" name="ref_referenz_veranstalter_in_1" id="ref_referenz_veranstalter_in_1">
					</td>
					<td width="50%">
						Datum der Veranstaltung:<br>
						<input type="text" name="ref_referenz_datum_1" id="ref_referenz_datum_1">
					</td>
				</tr>
			</table>
			<input type="hidden" name="ref_referenz_id_1" value="true">
		</td>
	</tr>
	<tr class="form-field" id="ref_freigabe_selbst_tab">
		<th scope="row"><label for="ref_referenz_name_1">Best&auml;tigt:</label></th>
		<td>
			<input type="checkbox" id="ref_freigabe_selbst" name="ref_freigabe_selbst" value="true" disabled<?php if($referierende->frei_selbst == "true") { echo ' checked'; } ?> readonly>
		</td>
	</tr>
	<tr class="form-field" id="ref_freigegeben_admin_tab">
		<th scope="row"><label for="ref_freigabe_admin">Freigegeben:</label></th>
		<td>
			<input type="checkbox" id="ref_freigabe_admin" name="ref_freigabe_admin" value="true" disabled<?php if($referierende->frei_admin == "true") { echo ' checked'; } ?> readonly>
		</td>
	</tr>
	<tr class="form-field" id="ref_aktiviert_tab">
		<th scope="row"><label for="ref_aktiviert">Aktiviert:</label></th>
		<td>
			<input type="checkbox" id="ref_aktiviert" name="ref_aktiviert" value="true" disabled<?php if($referierende->aktiviert == "true") { echo ' checked'; } ?> readonly>
		</td>
	</tr>
</table>