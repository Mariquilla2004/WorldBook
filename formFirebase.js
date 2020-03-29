var firebaseConfig = {
    apiKey: "AIzaSyA5Cxc4-ZNC-fwxOBRzd8mAkHGjk3gaxRo",
    authDomain: "worldbook-web.firebaseapp.com",
    databaseURL: "https://worldbook-web.firebaseio.com",
    projectId: "worldbook-web",
    storageBucket: "worldbook-web.appspot.com",
    messagingSenderId: "486504973247",
    appId: "1:486504973247:web:5b7a5210411964df"
  };
  // Initialize Firebase
  firebase.initializeApp(firebaseConfig);



//Reference messages collection

var messagesRef = firebase.database().ref("Sugerencias")


//Listen for form submit

document.getElementById("contactForm").addEventListener("submit", submitForm);


//Submit form
function submitForm(e){

    e.preventDefault();
    
    //Get values
    var name = getInputVal("name")
    var email = getInputVal("email")
    var subject = getInputVal("subject")
    var message = getInputVal("message")

    
    //Save message
    saveMessage(name, email, subject, message);


    

    //Show alert
     document.querySelector(".alert").style.display = "block";

     //Hide after 3 seconds
      setTimeout(function(){
          document.querySelector(".alert").style.display = "none";
      }, 3000);    


      //Clear form
      document.getElementById('contactForm1').reset();

    }


//Function to get form values
function getInputVal(id){
    return document.getElementById(id).value;
}


//Save message to firebase

function saveMessage(name, email, subject, message){

    var newMessageRef = messagesRef.push()
    newMessageRef.set({
        name: name,
        email: email,
        subject: subject,
        message: message
    });
}

