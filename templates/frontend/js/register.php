	<p id="new_user_login">
	
	</p>

<script type="text/javascript">
	document.addEventListener("DOMContentLoaded", function() { 
		$("#user_login").prop('readonly', 'true');
		$("#new_user_login").append($("label[for='user_login']"));
		$("label[for='user_login']").html($("label[for='user_login']").html().replace('Benutzername', 'Benutzer*innenname (wird generiert)'));
	});
			
	var userLoginUmlauts = function(str) {
		value =   str.split('ä').join('ae');
		value = value.split('ü').join('ue');
		value = value.split('ö').join('oe');
		value = value.split('Ä').join('Ae');
		value = value.split('Ü').join('Ue');
		value = value.split('Ö').join('Oe');
		value = value.split('ß').join('ss');

		return value;
	};
</script>