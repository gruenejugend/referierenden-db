	<tr>
		<td rowspan="4" width="96"><a href="https://<?php echo ref_get_url(true); ?>profile=<?php echo $referierende->ID; ?>"><?php echo get_avatar($referierende->ID, 96); ?></a></td>
		<td><a href="https://<?php echo ref_get_url(true); ?>profile=<?php echo $referierende->ID; ?>"><b><?php echo $referierende->first_name . ' ' . $referierende->last_name; ?></b></a><?php if($referierende->twitter != "") { ?> <i>(<?php echo $referierende->twitter; ?>)</i><?php } ?></td>
	</tr>
	<tr>
		<td><b><?php if($referierende->gender == 'true') { echo 'FIT'; } else { echo 'Nicht-FIT'; } ?></b></td>
	</tr>
	<tr>
		<td>
			<?php
				$values = array();
				$i = 0;
				foreach($referierende->themen AS $key => $thema) {
					$i++;
					$values[$key] = $thema;
					if($i > 9) {
						break;
					}
				}
				
				echo implode(", ", $values);
				
				if(count($referierende->themen) > 9) {
					?>, und noch mehr...<?php
				}
			?>
		</td>
	</tr>
	<tr>
		<td><a href="https://<?php echo ref_get_url(true); ?>profile=<?php echo $referierende->ID; ?>">>>> Zum Profil</a></td>
	</tr>
	<tr>
		<td colspan="2" height="10">&nbsp;</td>
	</tr>