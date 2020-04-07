function showNotification(){

  if (Notification.permission === 'granted'){

  var notification = new Notification('New notification');
  }

  else if (Notification.permission !== "denied") {

    Notification.requestPermission().then(function (permission) {
      // If the user accepts, let's create a notification
      if (permission === "granted") {

        var notification = new Notification("Hi there!");
      }
    });
  }
}
