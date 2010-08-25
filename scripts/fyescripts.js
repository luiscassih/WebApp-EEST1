/**
 * @author Luis Cassih
 * @version 0.7.10
 */
$(function(){
	$("#login").live('submit', function() {
		$.ajax({
		  type: "POST",
		  url:  "login.php",
		  data: $(this).serialize(),
		  success: function(res) {
				if (res==1){
					$('#userinfo').fadeOut(function(){
						$(this).load('userinfo.php').fadeIn();
					});
				} else {
					$('#userinfo').fadeOut(function(){
						$(this).html("<span style='color: red;'><br><br><br>Usuario y/o contrasenia incorrecta.</span><br>").fadeIn().delay(1500);
							$('#userinfo').fadeOut(function(){
									$("#userinfo").load("userinfo.php").fadeIn();
							});
						
					});
				}
		  }
		});
		return false;
	});

	$("#logoutlink").live('click', function(){
		$.ajax({
			url: "logout.php",
			async: false
		});
		$("#userinfo").fadeOut(function(){
			$("#userinfo").load("userinfo.php").fadeIn();
		});
		return false;
	});

	$("#contentlink").live('click', function(){
		$.ajax({
			url: "getcontent.php",
			type: "GET",
			data: "idname=" + $(this).attr("idname"),
			success: function(response) {
				$("#content").fadeOut(function(){
						$(this).html(response).fadeIn();
				})
			}
		});
		return false;
	});

	$("#newslink").live('click', function(){
		$.ajax({
			url: "news.php",
			type: "GET",
			data: "idname=" + $(this).attr("idname"),
			success: function(response) {
				$("#content").fadeOut(function(){
						$(this).html(response).fadeIn();
				})
			}
		});
		return false;
	});
	
	$("#applicationlink").live('click', function(){
		$("#content").fadeOut(function(){
				$(this).load($("#applicationlink").attr("applicationsource")).fadeIn();
		});
		return false;
	});

	$("#menuizqlink").live('click', function(){
		$.ajax({
			url: "getcontent.php",
			type: "GET",
			data: "id_izq=" + $(this).attr("id_izq"),
			success: function(response) {
				$("#content").fadeOut(function(){
						$(this).html(response).fadeIn();
				})
			}
		});
		return false;
	});

});
