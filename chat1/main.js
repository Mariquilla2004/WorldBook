// Your web app's Firebase configuration
var firebaseConfig = {
    apiKey: "AIzaSyCoeo2E8ghPR9G6BYiqri5yDri2UaeoY4Q",
    authDomain: "my-test-project-77dc9.firebaseapp.com",
    databaseURL: "https://my-test-project-77dc9.firebaseio.com",
    projectId: "my-test-project-77dc9",
    storageBucket: "my-test-project-77dc9.appspot.com",
    messagingSenderId: "418704226119",
    appId: "1:418704226119:web:0d38ae3b275fd64fd03e62"
  };
  // Initialize Firebase
  firebase.initializeApp(firebaseConfig);

  var myName = prompt("Enter your name");

function sendMessage() { 
    //get message
    var message = document.getElementById("messaage").value;

    //Save in database
    firebase.database().ref("messages").push().set({
        "sender": myName,
        "message": message
    })

    //prvent form from submitting
    return false;
}


//listen for incoming messages
firebase.database().ref("messages").on("child_added", function (snapshot){

var html = "";
//give each message a unique ID
html += "<li id='message-" + snapshot.key + "'>";
    //show delete button if message is sent by me
    if (snapshot.val().sender == myName) {
        html += "<button data-id='" + snapshot.key + "' onclick='deleteMessage(this);'>";
            html += "Delete";
        html += "</button>"
    }
    html += snapshot.val().sender + ": " + snapshot.val().message;
html += "</li>";


document.getElementById("messages").innerHTML += html;

});

function deleteMessage(self) {
    //get message ID
    var messageId = self.getAttribute("data-id");

    //delete message
    firebase.database().ref("messages").child(messageId).remove();
}

//attach listener for delete message
firebase.database().ref("messages").on("child_removed", function (snapshot){
    //remove message node
    document.getElementById("message-" + snapshot.key).innerHTML = "This message has been removed.";
});