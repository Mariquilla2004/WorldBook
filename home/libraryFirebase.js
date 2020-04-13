  //Reference books collection
  var booksRef = firebase.database().ref("Library");



//Listen for form submit

document.getElementById("bookForm").addEventListener("submit", submitForm);
document.getElementById("bookForm").addEventListener("submit", addBook);

//Submit form
function submitForm(e){

    e.preventDefault();


   //Get values
   var title = getInputVal("title")
    var author = getInputVal("author")
    var ISBN = getInputVal("ISBN")


    //Save book
    saveMessage(title, author, ISBN)
    $('#addModal').modal('hide')

   //Clear form
   document.getElementById('bookForm').reset();


}
//Function to get form values
function getInputVal(id){
   return document.getElementById(id).value;
}

//save the book to firebase

function saveMessage(title, author, ISBN){
   var newBookRef = booksRef.push();
   newBookRef.set({
      title: title,
      author:author,
      ISBN:ISBN
   });
}




//WISHLIST


  //Reference books collection
  var wishlistRef = firebase.database().ref("Wishlist");

//Listen for form submit

document.getElementById("wishlistForm").addEventListener("submit", submitForm1);
document.getElementById("wishlistForm").addEventListener("submit", addBook);

//Submit form
function submitForm1(e){

    e.preventDefault();


   //Get values
   var titlew = getInputVal1("titlew")
    var authorw = getInputVal1("authorw")



    //Save book
    saveMessage1(titlew, authorw)
    $('#wishlistModal').modal('hide')

   //Clear form
   document.getElementById('wishlistForm').reset();
}
//Function to get form values
function getInputVal1(id){
   return document.getElementById(id).value;
}

//Add the book info to the page
function addBook(){
  $("#container-fluid .content:last").before('<div class="rectangle"><i class="fas fa-plus-circle" href="#" data-toggle="modal"></i></div>');
}
//save the book to firebase
function saveMessage1(titlew, authorw){
   var newWishlistRef = wishlistRef.push();
   newWishlistRef.set({
      titlew: titlew,
      authorw:authorw,
   });
}
