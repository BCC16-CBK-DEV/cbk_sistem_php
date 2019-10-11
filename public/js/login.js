$(function() {

	$("#formulario_login").submit(function() {

		$.ajax({
			type: "post",
			url: BASE_URL + "login_controller/acesso",
			dataType: "json",
			data: $(this).serialize(),
			beforeSend: function() {
			// 	clearErrors();
				// $(".help-block").html("Verificando...");
			},
			success: function(json) {
				if (json["status"] == 1) {
					//clearErrors();
					// $(".help-block").html("Logando...");
					window.location = BASE_URL + "Inicio";
				} else {
					$(".help-block").html("<p class='alert alert-danger'>Usuário e/ou Senha Incorreta!</p>");
				}
			},
			error: function(response) {
				console.log(response);
			}
		})

		return false;
	})

})

function logout_usuario() {
	location.href = BASE_URL + "Login_Controller/logout";
}

