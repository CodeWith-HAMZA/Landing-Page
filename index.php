 <?php
$servername = "localhost";
$username = "root";
$password = ""; 

// Create a connection
$conn = mysqli_connect($servername, $username, $password, "hamzanotesapp");
 

// Check the connection
if (!$conn) {
  die("Connection failed: ");
}else{
echo "SUCCESS";
}
// $createDatabase = "CREATE DATABASE Hmzai"; //* creating a database
// $createTable = "CREATE TABLE Hmzai.custoeuemeers (
//     id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
//     firstname VARCHAR(30) NOT NULL,
//     lastname VARCHAR(30) NOT NULL,
//     email VARCHAR(50),
//     reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
// )";
// "INSERT INTO customerss (firstname, lastname, email)
// values ('hamza', 'shaikh', 'hs5924414@gmail.com')";
// $insertData = "INSERT INTO Hmzai.customers (firstname, lastname, email)
// VALUES ('Hmz', 'Doeuee', 'john.doe@example.com')";


// $sql = "INSERT INTO Notes (title, description) VALUES ('$title', '$description')";
 
if ($_SERVER["REQUEST_METHOD"] == "GET") { 
 
  if(isset($_GET["title"]) && isset($_GET["desc"])){

    $title = $_GET["title"];
    $description= $_GET["desc"];
    $sql = "INSERT INTO nnotes (title, description) VALUES ('$title', '$description')";
    // $description = $_POST["desc"];
    if ($conn->query($sql) === TRUE) {
      echo "New note added successfully.";
    } else {
      echo "Error: " . $sql . "<br>" . $conn->error;
    }
  }
}

// Check if the note ID was provided
if (isset($_GET["id"])) {
  // Retrieve the note ID from the query parameter
  $noteId = $_GET["id"];

  // Prepare the DELETE query
  $sql = "DELETE FROM nnotes WHERE id = $noteId";

  // Execute the DELETE query
  if ($conn->query($sql) === TRUE) {
      echo "Note deleted successfully:";
  } else {
      echo "Error deleting note:" . $conn->error;
  }
}

// echo var_dump($_SERVER["REQUEST_METHOD"]);
 
 
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
</head>
<body>
  <!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <form action="/phpt" method="post">
            <div class="mb-3">
           <label for="exampleFormControlInput1" class="form-label"> Note</label>
           <input type="text" class="form-control" name="noteTitle" id="exampleFormControlInput1" placeholder="Write Title here">
         </div>
         <div class="mb-3">
           <label for="exampleFormControlTextarea1" class="form-label">Description</label>
           <textarea class="form-control" placeholder="Write Description Here" name="noteDescription" id="exampleFormControlTextarea1" rows="3"></textarea>
         </div>
         <button class="btn btn-primary">Updte Note</button>
    
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>
     
    <div class="container">
        <form action="/phpt" method="GET">
            <div class="mb-3">
           <label for="exampleFormControlInput1" class="form-label"> Note</label>
           <input type="text" class="form-control" name="title" id="exampleFormControlInput1" placeholder="Write Title here">
         </div>
         <div class="mb-3">
           <label for="exampleFormControlTextarea1" class="form-label">Description</label>
           <textarea class="form-control" placeholder="Write Description Here" name="desc" id="exampleFormControlTextarea1" rows="3"></textarea>
         </div>
         <button class="btn btn-primary" type="submit">Add Note</button>
    
        </form>
    </div>

  <div class="container">
  <table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Title</th>
      <th scope="col">Desc</th>
      <th scope="col">  

      </th>
    </tr>
  </thead>
  <tbody>
    

    <?php 
    
    try{
        $sql = "SELECT * FROM nnotes";
         $result = $conn->query($sql);
        
         while ($row = $result->fetch_assoc()) {
          
            $id = $row["id"];
            $title = $row["title"];
            $description = $row["description"];
    
            // Output the data
            echo "<tr>
            <th scope='row'>$id</th>
            <td>$title</td>
            <td>$description</td>
            <td>
            <button type='button' class='editbtn btn btn-primary' data-bs-toggle='modal' data-bs-target='#exampleModal'>
             edit
          </button>
          
             <a href='/phpt/?id=$id'>Delete</a></td>
          </tr>";
        }
    
     }catch(Exception $e){
        echo "ERROR: " . $e->getMessage();
    
     }
    ?>
    
  </tbody>
</table>
  </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
    <script>
      
      const editbtn = document.getElementsByClassName('editbtn')
       
       Array.from(editbtn).forEach(_ => {
        _.addEventListener('click', function(e){
           console.log(parseInt(e.target.parentNode.parentNode.innerText))
        })
      })
    </script>

</body>
</html>