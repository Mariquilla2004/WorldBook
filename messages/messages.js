
/*
      MESSAGE ANIMATIONS.
*/
$(".messages").animate({ scrollTop: $(document).height() }, "fast");

$("#profile-img").click(function() {
	$("#status-options").toggleClass("active");
});

$("#status-options ul li").click(function() {
	$("#profile-img").removeClass();
	$("#status-online").removeClass("active");
	$("#status-away").removeClass("active");
	$("#status-busy").removeClass("active");
	$("#status-offline").removeClass("active");
	$(this).addClass("active");

	if($("#status-online").hasClass("active")) {
		$("#profile-img").addClass("online");
	} else if ($("#status-away").hasClass("active")) {
		$("#profile-img").addClass("away");
	} else if ($("#status-busy").hasClass("active")) {
		$("#profile-img").addClass("busy");
	} else if ($("#status-offline").hasClass("active")) {
		$("#profile-img").addClass("offline");
	} else {
		$("#profile-img").removeClass();
	};

	$("#status-options").removeClass("active");
});

var docHeight = $(document).height();
function newMessage() {

  message = $(".message-input input").val();
  if ($.trim(message) == '') {

    return false;
  }

  $('<li class="sent"><img src="http://emilcarlsson.se/assets/mikeross.png" alt="" /><p>' + message + '</p></li>').appendTo($('.messages ul'));
  $('.message-input input').val(null);
  $('.contact.active .preview').html('<span>You: </span>' + message);
  $(".messages").animate({scrollTop: docHeight + 93}, "fast");

  docHeight += 93;
  }

$('.submit').click(function() {
  newMessage();
});

$(window).on('keydown', function(e) {
  if (e.which == 13) {
    newMessage();
    return false;
  }
});
/*
  END OF MESSAGE ANIMATIONS.
*/


function sendNewMessage(){

  var pubnub = new PubNub({publishKey : 'pub-c-50b23216-7455-4899-ad62-a37fca4b074c', subscribeKey : 'sub-c-bfb3de44-b839-11e9-b6f7-eea0353b68c5'}); // Your PubNub keys here. Get them from https://dashboard.pubnub.com.
  var box = document.getElementById("box");
  var input = document.getElementById("message-input");
  var channel = 'chat';

  pubnub.subscribe({channels: [channel]}); // Subscribe to a channel.

  pubnub.addListener({message: function(m) {
       box.innerHTML = (''+m.message).replace( /[<>]/g, '' ) + '<br>' + box.innerHTML; // Add message to page.
  }});

  input.addEventListener('keypress', function (e) {

      (e.keyCode || e.charCode) === 13 && pubnub.publish({ // Publish new message when enter is pressed.
          channel : channel, message : input.value, x : (input.value='')
      });
  });
}
