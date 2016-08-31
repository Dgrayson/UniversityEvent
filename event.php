<?php 

	require_once('base.php');

	if(session_status() == PHP_SESSION_NONE){
		session_start(); 
	}


	if(isset($_POST['rating'])){

		$rating = (int)$_POST['ratings'];
		$userID = $_SESSION['id'];	
		$name = $_SESSION['eName']; 
		$des = $_SESSION['des']; 
		$date = $_SESSION['date']; 
		$phone = $_SESSION['phone'];
		$email = $_SESSION['e-Email']; 

		$sql = "SELECT * FROM event_ratings Where user_id = '$userID'"; 

		$result = mysqli_query($connection, $sql);
		$count = mysqli_num_rows($result);

		if($count == 1){
			$sql = "UPDATE event_ratings SET rating = " . $rating . " WHERE user_id = '$userID'";

				if($connection->query($sql) == TRUE){
				//echo "<script type='text/javascript'>alert('Rating added');</script>";
				}
				else{
					echo "<script type='text/javascript'>alert('rating failed');</script>"; 
					echo "Error " . $sql . "<br>" . "Error: " . mysqli_error($connection) . "<br>";
				}
		}else{

			$sql = "INSERT INTO event_ratings (rating, user_id, eName) Values ($rating, '$userID', '$name')";

			if($connection->query($sql) == TRUE){
				//echo "<script type='text/javascript'>alert('Rating added');</script>";
			}
			else{
				echo "<script type='text/javascript'>alert('rating failed');</script>"; 
				echo "Error " . $sql . "<br>" . "Error: " . mysqli_error($connection) . "<br>";
			}
		}
	}

	if(isset($_POST['view'])){

		$name = $_POST['events']; 
		$_SESSION['eName'] = $name; 

		$sql = "SELECT * FROM Event WHERE Name = '$name'"; 
		$result = $connection->query($sql); 

		$event = $result->fetch_assoc();

		$name = $event['Name']; 
		$des = $event['Description']; 
		$date = $event['DateTime']; 
		$phone = $event['contact_phone'];
		$email = $event['contact_email']; 

		$_SESSION['des'] = $des; 
		$_SESSION['date'] = $date; 
		$_SESSION['phone'] = $phone; 
		$_SESSION['e-Email'] = $email; 

		$sql = "SELECT * FROM location WHERE Name = '$name'"; 
		$result = $connection->query($sql); 

		if($connection->query($sql) == TRUE){
			//echo "<script type='text/javascript'>alert('Rating added');</script>";
		}
		else{
			echo "<script type='text/javascript'>alert('rating failed');</script>"; 
			echo "Error " . $sql . "<br>" . "Error: " . mysqli_error($connection) . "<br>";
		}
		$loc = $result->fetch_assoc();

		$lat = $loc['lat']; 
		$lng = $loc['lng']; 

		$_SESSION['lat'] = $lat; 
		$_SESSION['lng'] = $lng; 
	}

	if(isset($_POST['postComment'])){

		$comment = mysqli_real_escape_string($connection, $_POST['comment']); 
		$userID = mysqli_real_escape_string($connection, $_SESSION['id']);	
		$name = mysqli_real_escape_string($connection, $_SESSION['eName']); 
		$des = mysqli_real_escape_string($connection, $_SESSION['des']); 
		$date = mysqli_real_escape_string($connection, $_SESSION['date']); 
		$phone = mysqli_real_escape_string($connection, $_SESSION['phone']);
		$email = mysqli_real_escape_string($connection, $_SESSION['e-Email']); 

		$fname = mysqli_real_escape_string($connection, $_SESSION['fname']); 
		$lname = mysqli_real_escape_string($connection, $_SESSION['lname']); 

		$fullName = $fname . " " . $lname; 

		$sql = "INSERT INTO comments (userName, text, eName) Values ('$fullName', '$comment', '$name')"; 

		if($connection->query($sql) == TRUE){
			//echo "<script type='text/javascript'>alert('Comment added');</script>";
		}
		else{
			echo "<script type='text/javascript'>alert('Comment failed');</script>"; 
			echo "Error " . $sql . "<br>" . "Error: " . mysqli_error($connection) . "<br>";
		}
	}

	// calculate avg rating

	$avgRating = 0;
	$name = $_SESSION['eName'];
	$sql = "SELECT * from event_ratings where eName = '$name'";
	$sum = 0; 

	$result = $connection->query($sql);
	$count = mysqli_num_rows($result); 

	while($row = $result->fetch_assoc()){
		$sum = $sum + $row['rating']; 
	}

	if($count != 0)
		$avgRating = $sum / $count; 

	if(isset($_SESSION['lat'])){
		$lat = $_SESSION['lat'];
		$lng = $_SESSION['lng'];  
	}


?>

<html>
	<head>
		<meta charset="UTF-8">
		<title>Event</title>
		<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBptXfGTx925uxPd0LsdbybRozzEMZE5n4"
            type="text/javascript"></script>
    <script type="text/javascript">
    //<![CDATA[

    var customIcons = {
      place: {
        icon: 'http://labs.google.com/ridefinder/images/mm_20_blue.png'
      },
      bar: {
        icon: 'http://labs.google.com/ridefinder/images/mm_20_red.png'
      }
    };

    function load() {

    	var lat = <?php echo json_encode($lat); ?>;
    	var lng = <?php echo json_encode($lng); ?>;

    	lat = parseFloat(lat); 
    	lng = parseFloat(lng); 

    	var myLatLng = {lat: lat, lng: lng}; 

      var map = new google.maps.Map(document.getElementById("map"), {
        center: new google.maps.LatLng(lat, lng),
        zoom: 15,
        mapTypeId: 'roadmap'
      });

      var marker = new google.maps.Marker({
      	position: myLatLng,
      	map: map, 
      	title: 'hello'
      })

      // Change this depending on the name of your PHP file
      
    }

    function bindInfoWindow(marker, map, infoWindow, html) {
      google.maps.event.addListener(marker, 'click', function() {
        infoWindow.setContent(html);
        infoWindow.open(map, marker);
      });
    }

    function downloadUrl(url, callback) {
      var request = window.ActiveXObject ?
          new ActiveXObject('Microsoft.XMLHTTP') :
          new XMLHttpRequest;

      request.onreadystatechange = function() {
        if (request.readyState == 4) {
          request.onreadystatechange = doNothing;
          callback(request, request.status);
        }
      };

      request.open('GET', url, true);
      request.send(null);
    }

    function doNothing() {}

    //]]>

  </script>
  <link rel="stylesheet" type="text/css" href="style.css">
	</head>
	
	<body onload="load()">
		<div id="container">
		<h2>
			<?php echo htmlspecialchars($name); ?>
		</h2>

		<form method="post" action="event.php">

		  <?php echo htmlspecialchars($des); ?> 
		  <br />
		  <br />
		  Date: <?php echo htmlspecialchars($date); ?> 

		  <br />
		  <br />

		  Contact Phone: <?php echo htmlspecialchars($phone); ?>

		  <br />
		  <br />

		  Contact Email: <?php echo htmlspecialchars($email); ?>

		  <br />
		  <br /?


		</form>

		<form method = "post" action="event.php">	

		  Avg Rating: <?php echo htmlspecialchars($avgRating); ?>

		  Rating:
		  <select name="ratings">
		  		<option value = "0">0</option>
		  		<option value = "1">1</option>
		  		<option value = "2">2</option>
		  		<option value = "3">3</option>
		  		<option value = "4">4</option>
		  		<option value = "5">5</option>
		  </select>

		  <input type = "submit" name = "rating" value="Submit Rating">
		</form>


		<div id="map" style="width: 500px; height: 300px"></div>

		<form method="post" action="event.php">
		  <div id = "comments">

		  	<?php
		  		$sql = "SELECT * from comments where eName = '$name'"; 

				$result = $connection->query($sql); 

				while($row = $result->fetch_assoc()){
					echo htmlspecialchars($row['userName']) . " " . htmlspecialchars($row['timeposted']) . "<br /><br /> " . htmlspecialchars($row['text']); 
					echo "<br /><br >"; 
				}
			?>
		  </div>
		  comment: <br />
		  <textarea rows = "5" cols = "50" name="comment"></textarea>
		  <br />
		  <br />
		  <input type = "submit" name = "postComment" value = "Post Comment">
		</form>

		<?php
			if($_SESSION['admin'] == true)
				echo "<a href = 'Admin.php'>Home</a>";
			else
				echo "<a href = 'Student.php'>Home</a>";
		?>
		</div>
	</body>
</html>