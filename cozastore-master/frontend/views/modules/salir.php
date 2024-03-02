<?php
session_destroy();

if (isset($_SESSION['id_token_google']) && !empty($_SESSION['id_token_google'])) {
  unset($_SESSION['id_token_google']);
}

echo '<script>
	localStorage.removeItem("usuario");
	localStorage.clear();
	window.location = "' . $frontend . '";
</script>';
