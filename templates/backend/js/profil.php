<script type='text/javascript' src='https://code.jquery.com/jquery-1.11.3.min.js'></script>
<script type="text/javascript">
	document.addEventListener("DOMContentLoaded", function() { 
		$(".user-last-name-wrap").after($("#ref_gender_tab"));
		$(".user-url-wrap").after($("#ref_twitter_tab"));
		$("#ref_twitter_tab").after($("#ref_facebook_tab"));
		$(".user-description-wrap").after($("#ref_themen_tab"));
		$("#ref_themen_tab").after($("#ref_wohnort_tab"));
		$("#ref_wohnort_tab").after($("#ref_wohnort_laender_tab"));
		$("#ref_wohnort_laender_tab").after($("#ref_aemter_tab"));
		$("#ref_aemter_tab").after($("#ref_referenz_tab_1"));
				
		$("#ref_referenz_name_1").keyup(function() {
			if (!document.getElementById("ref_referenz_name_2")) {
				newReferenz(2);
			}
		});
		
		var referenz_count = <?php echo count($referierende->referenzen); ?>;
		var newReferenz = function(id) {
			var html = '<tr class="form-field" id="ref_referenz_tab_' + id + '">' + $("#ref_referenz_tab_" + (id-1)).html().split("_" + (id-1)).join("_" + id).split((id-1)+".").join(id+".") + "</tr>";
			$("#ref_referenz_tab_" + (id-1)).after(html);
			
			$("#ref_referenz_id").val(id);
				
			$("#ref_referenz_name_" + id).keyup(function() {
				if (!document.getElementById("ref_referenz_name_" + (id+1))) {
					newReferenz((id+1));
				}
			});
		};
		
		for(var i = 1; referenz_count >= i; i++) {
			newReferenz((i+1));
		};
		
		<?php 
		
		foreach($referierende->referenzen AS $key => $referenz) {
			?>
		$("#ref_referenz_name_<?php echo ($key+1); ?>").val('<?php echo $referenz->name; ?>');
		$("#ref_referenz_ort_<?php echo ($key+1); ?>").val('<?php echo $referenz->ort; ?>');
		$("#ref_referenz_veranstalter_in_<?php echo ($key+1); ?>").val('<?php echo $referenz->veranstalter_in; ?>');
		$("#ref_referenz_datum_<?php echo ($key+1); ?>").val('<?php echo $referenz->datum; ?>');
			<?php
		}
		
		?>
		
		$(".user-sessions-wrap").after($("#ref_freigabe_selbst_tab"));
		$("#ref_freigabe_selbst_tab").after($("#ref_freigabe_admin_tab"));
		$("#ref_freigabe_admin_tab").after($("#ref_aktiviert_tab"));
	});
</script>