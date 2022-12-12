<style>
  .loader-container {
    text-align: center;
  }
  
  .loader {
    position: absolute;
    left: 50%;
    top: 60%;
    z-index: 1;
    width: 150px;
    height: 150px;
    margin: -75px 0 0 -75px;
    border: 16px solid #f3f3f3;
    border-radius: 50%;
    border-top: 16px solid #3498db;
    width: 120px;
    height: 120px;
    -webkit-animation: spin 2s linear infinite;
    animation: spin 2s linear infinite;
  }

  p {
        text-align: center;
        position: absolute;
        left: 50%;
        top: 50%;
        margin-top: -150px;
        margin-left: -100px;
        width: 200px;
      }
  
  @keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
  }
  </style>
  
  <?php
  
  // Print out the HTML for the loading spinner and message
  echo "<div class='loader-container'>";
  echo "<div class='loader'></div>";
  echo "<p>Please Wait...</p>";
  echo "</div>";

  header("refresh: 30; url=loader_loader.php");
  
  ?>
  
