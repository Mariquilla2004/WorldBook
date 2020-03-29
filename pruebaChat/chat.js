$(document).ready(function(){
	toggleSendButton(); 
	sendMessage();
	overflow(); 
	getChatName();
	memberClicked();
	funtionLoadLastToken();
	getHiddenToken();
	scrollDisplay();
	alerts();
	pending();
	openMessages(); 
	openOneMessage(); 
	netWorking();
});

function getHiddenToken(){
  /*	var token = $("#hidden-token").val(); 
	tsk = "getHiddenToken"; 

	if(token == ""){
		return;
	} else{
		$(".loading-mesos").show(); 
		$.post("ajax_.php",{task:tsk}, function(data){
			$(".loading-mesos").fadeOut(); 
			//$(".display-message").html(data);
		}); 
	} */
}
//pendings

function netWorking(){
	var time = 0; 
	var tsk = "newtwork";

	function inTime(){
		setTimeout(inTime, 500);
		//$(".page-header h3").html(time); 

		if(time == 2){
			$.post("ajax_.php",{newtwork:tsk}, function(data){
				$(".net").hide();
			    time = 0; 
			    clearTimeout(inTime);

			    //console.log(data);
			});
		} 

		if(time == 20){
			$(".net").fadeIn();
			time = 0; 
			clearTimeout(inTime); 
		}

		time ++; 
	}

	inTime();
}


function openOneMessage(){
	$("body").on('click','.ready_pending',function(){
		var openONe = "open1"
		var from = $(this).attr("data-token");

		$.post("ajax_.php", {open1:openONe, frm:from}, function(data){
			$(".chat-messages").html(data);

		}); 
	}); 
}

function openMessages(){
	$(".show-messages").click(function(){
		var p = "open"; 
		$(".loading-mesos").show(); 

		$(".loading-mesos h4").html("Openning Messages"); 
		$.post("ajax_.php",{open:p},function(data){

			$(".loading-mesos").fadeOut(); 
		    $(".loading-mesos h4").html("Loading your messages"); 

			if(data == 2){
				$(".show-simples").fadeIn().delay(3000).fadeOut();
				$(".show-simples span").html("You have opened all messages"); 
				return; 
			}
			$(".chat-messages").html(data);
		});
	});
}

function alerts(){
	var time = 0; 
	var tsk = "alerts";

	function inTime(){
		setTimeout(inTime, 500);
		//$(".page-header h3").html(time); 

		if(time == 2){
			$.post("ajax_.php",{task:tsk}, function(data){
				
			    if(data == 1){
			    	var audio = $("#audio")[0]; 
			        audio.play();
			    }

			    time = 0; 
			    clearTimeout(inTime);

			    //console.log(data);
			});
		} 

		if(time == 20){
			time = 0; 
			clearTimeout(inTime); 
		}

		time ++; 
	}

	inTime();
}


function pending(){
	var time = 0; 
	var tsk = "pendings";

	function inTime(){
		setTimeout(inTime, 500);
		//$(".page-header h3").html(time); 

		if(time == 2){
			$.post("ajax_.php",{task:tsk}, function(data){
				if(data > 0){
					$(".show-messages .badge").html(data);
					$(".show-messages .badge").css({"background":"red"});
			        $(".show-messages").css({"color":"red","font-size":"25px"});
				} else {
					$(".show-messages .badge").html("");
					$(".show-messages").css({"color":"black","font-size":"14px"});
				}

				time = 0; 
			    clearTimeout(inTime);
			    
			    //console.log(data);
			});
		} 

		if(time == 20){
			time = 0; 
			clearTimeout(inTime); 
		}

		time ++; 
	}

	inTime();
}

function scrollDisplay(){
	$(".display-message").scrollTop($(".display-message").prop("scrollHeight")); 
}

function funtionLoadLastToken(){
	var tsk = "getLastMessages";
	$(".textarea-message").attr("disabled","disabled"); 
	$(".loading-mesos").show(); 

	$.post("ajax_.php",{task:tsk},function(data){
	    $(".textarea-message").removeAttr("disabled"); 
		$(".loading-mesos").fadeOut(); 
		$(".display-message").html(data);
	   $(".display-message").scrollTop($(".display-message").prop("scrollHeight")); 

	});
}

function memberClicked(){
	$("body").on('click','.sidebar-members',function(){
		//alert("clicked");
		var username = $(this).attr("data-user"); 
		var tk = $(this).attr("data-token");
		var tsk = "tokening"; 
		 $("#hidden-token").val(tk);  
		

		$(".loading-mesos").show(); 
		
		$.post("ajax_.php",{task:tsk, token:tk}, function(data){
			$(".loading-mesos").fadeOut(); 
			$(".active-chat").html(username);
			$(".display-message").html(data);
		}); 

	});
}

function getChatName(){
	$(".loading").show();
	$(".active-chat").hide();

	var tsk ="getName"; 
	$.post("ajax_.php",{task:tsk},function(data){
		$(".loading").hide();
		$(".active-chat").show();
		$(".active-chat").html(data);
	});
}

function toggleSendButton(){
	$("#toggle-btn").click(function(){
		
		if($(this).prop("checked")){
			$("#send-message-click").slideUp();
		} else {
			$("#send-message-click").slideDown();
		}
	});
}

function sendMessage(){
	$("#send-message-click").click(function(){
		var ms = $(".textarea-message").val();
		var tk = $("#hidden-token").val(); 
		var tsk = "sending"; 

		if(ms == ""){
			return;
		}

		if(tk == ""){
			alert("invalid chat token. Your previous chat token was null, Please click on member you want to send message to");
			return; 
		}

	    $(".textarea-message").attr("disabled","disabled");
		$(".loading-mesos").show(); 
		$(".loading-mesos h4").html("Sedning Your Message."); 

		$.post("ajax_.php",{task:tsk, message:ms,token:tk}, function(data){
		    $(".textarea-message").val("");
		    $(".textarea-message").removeAttr("disabled");
		    $(".loading-mesos").fadeOut(); 
		    $(".loading-mesos h4").html("Loading your messages"); 
			$(".display-message").html(data);
	      $(".display-message").scrollTop($(".display-message").prop("scrollHeight")); 

		}); 
		
		

	}); 

	$(".textarea-message").keypress(function(event){
		if($("#toggle-btn").prop("checked")){
			if(event.keyCode == 13 || event.which == 13){
		        $("#send-message-click").click(); 
			    event.preventDefault();
			}
		}
	});
}

function overflow(){
	$(document).on('mousemove', function(){
		
	});
}