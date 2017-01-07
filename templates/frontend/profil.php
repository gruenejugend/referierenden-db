<table border="0" cellpadding="5" cellspacing="0" width="100%" style="border-spacing: 10px;border-collapse: separate;">
	<tr>
		<td rowspan="6" width="200"><?php echo get_avatar($referierende->ID); ?></td>
		<td colspan="2"><h1><?php echo $referierende->first_name . ' ' . $referierende->last_name; ?></h1></td>
	</tr>
	<tr>
		<td width="200"><b>Twitter:</b></td>
		<td><?php echo $referierende->twitter; ?></td>
	</tr>
	<tr>
		<td><b>Facebook:</b></td>
		<td><?php echo $referierende->facebook; ?></td>
	</tr>
	<tr>
		<td><b>Aus:</b></td>
		<td><?php echo implode(", ", $referierende->wohnort); ?></td>
	</tr>
	<tr>
		<td><b>FIT-Mensch:</b></td>
		<td><?php echo $referierende->gender == 'true' ? "Ja":"Nein"; ?></td>
	</tr>
	<tr>
		<td><b>In den Ländern:</b></td>
		<td><?php 
		
		$wohnort_laender_neu = array();
		foreach($referierende->wohnort_laender AS $laender) {
			$explode = explode("-", $laender);
			$land_neu = array();
			foreach($explode AS $land) {
				$land_neu[] = ucfirst($land);
			}
			$wohnort_laender_neu[] = implode("-", $land_neu);
		}
		
		echo implode(", ", $wohnort_laender_neu);
		
		?></td>
	</tr>
	<tr>
		<td colspan="3"><b>Themen:</b><br>
		
			<?php echo implode(", ", $referierende->themen); ?>
			<br><br>
		
		</td>
	</tr>
	<tr>
		<td colspan="3"><b>Beschreibung:</b><br>
		
			<?php echo wpautop($referierende->description); ?>
			<br><br>
		
		</td>
	</tr>
	<tr>
		<td colspan="3"><b>&Auml;mter:</b><br>
		
			<?php echo implode(", ", $referierende->aemter); ?>
			<br><br>
		
		</td>
	</tr>
	<tr>
		<td colspan="3"><b>Referenzen:</b><br>
		
			<table border="0" cellpadding="5" cellspacing="0" width="100%">
				<tr>
					<td><b>Name</b></td>
					<td><b>Ort</b></td>
					<td><b>Veranstalter_in</b></td>
					<td><b>Datum</b></td>
				</tr>
			<?php
			
			foreach($referierende->referenzen AS $referenz) {
				?>
				
				<tr>
					<td><?php echo $referenz->name; ?></td>
					<td><?php echo $referenz->ort; ?></td>
					<td><?php echo $referenz->veranstalter_in; ?></td>
					<td><?php echo $referenz->datum; ?></td>
				</tr>
				
				<?php
			}
			
			?>
			</table>
			<br><br>
		
		</td>
	</tr>
	<tr>
		<td colspan="3">
			<b>Kontakt:</b><br>
			
			<?php 
			
			if(!in_array("erfolg", $error)) {
				if(in_array("mail", $error)) {
					echo '<b>Die Mail-Adresse ist ungültig.</b><br>';
				}
				
				if(in_array("name", $error)) {
					echo '<b>Es wurde kein Absender*in-Name angegeben.</b><br>';
				}
				
				if(in_array("text", $error)) {
					echo '<b>Es wurde kein Text angegeben.</b><br>';
				}
			
			?>
			
			<form action="http://<?php echo $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"]; ?>" method="post">
			<?php wp_nonce_field('ref_profil', 'ref_profil_nonce'); ?>
			<table border="0" cellpadding="5" cellspacing="0" width="100%">
				<tr>
					<td width="30%">Dein Name:</td>
					<td width="70%"><input type="text" name="kontakt_name" size="20"></td>
				</tr>
				<tr>
					<td width="30%">Dein Mail-Adresse:</td>
					<td width="70%"><input type="email" name="kontakt_mail" size='20'></td>
				</tr>
				<tr>
					<td width="30%">Dein Text:<br><i>Denke daran bei der Abfrage den Zeitpunkt sowie die Veranstaltung anzugeben.</i></td>
					<td width="70%"><textarea cols="20" rows="10" name="kontakt_text">Deine Nachricht</textarea></td>
				</tr>
				<tr>
					<td width="30%"></td>
					<td width="70%"><input type="submit" name="kontakt_submit" value="Abschicken"></td>
				</tr>
			</table>
			</form>
			
			<?php } else {
					echo '<b>Vielen Dank für deine Anfrage!</b><br>';
			}
			
			?>
			
		</td>
	</tr>
</table>