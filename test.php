<html>
<head>
    <script src="https://www.gstatic.com/firebasejs/3.5.2/firebase-database.js"></script>
    </head>

    <body>
    
        
        
<button onclick="myFunction()">Click me</button>
        
<script src="https://www.gstatic.com/firebasejs/3.6.0/firebase.js"></script>
<script>
  // Initialize Firebase
  var config = {
    apiKey: "AIzaSyC7t2Q8kNIihGVG8b8jyMBZ5GtzBB5tiRc",
    authDomain: "psusmartuniversity-fdaa4.firebaseapp.com",
    databaseURL: "https://psusmartuniversity-fdaa4.firebaseio.com",
    storageBucket: "psusmartuniversity-fdaa4.appspot.com",
    messagingSenderId: "415140475718"
  };
  firebase.initializeApp(config);
    
    
</script>
        
        
        
        <script>
        
            function myFunction() {
       var firebaseRef = firebase.database().ref();
            
            firebaseRef.child("TEST").set("sssss");
            
}
        
        </script>
        
        
    </body>
</html>