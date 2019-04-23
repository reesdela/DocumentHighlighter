<head>
  <!-- Insert these scripts at the bottom of the HTML, but before you use any Firebase services -->
<script>
readTextFile("/Users/reesdelahoussaye/Documents/BinarySearch.txt");
    function readTextFile(file)
{
    var rawFile = new XMLHttpRequest();
    rawFile.open("GET", file, false);
    rawFile.onreadystatechange = function ()
    {
        document.write(rawFile);
        if(rawFile.readyState === 4)
        {
            if(rawFile.status === 200 || rawFile.status == 0)
            {
                var allText = rawFile.responseText;
                document.write(allText);
            }
        }
    }
    rawFile.send(null);
}
    
    </script>

  <script src="https://www.gstatic.com/firebasejs/5.10.0/firebase-app.js"></script>

  <script src="https://www.gstatic.com/firebasejs/5.10.0/firebase-storage.js"></script>
  <script src="https://www.gstatic.com/firebasejs/5.10.0/firebase-auth.js"></script>

  <script>
    // TODO: Replace the following with your app's Firebase project configuration
    var firebaseConfig = {
       apiKey: "AIzaSyB-yfHmsfiLEo0es-DN8gXxKQZdvZAXObA",
    authDomain: "superduperdocfinder.firebaseapp.com",
    databaseURL: "https://superduperdocfinder.firebaseio.com",
    projectId: "superduperdocfinder",
    storageBucket: "superduperdocfinder.appspot.com",
    messagingSenderId: "976914820492"
    };
    // Initialize Firebase
    firebase.initializeApp(firebaseConfig);
  </script>
</head>
