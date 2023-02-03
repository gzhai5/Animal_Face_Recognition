<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewreport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        *{
	    margin: 0;
	    padiing: 0;
	    text-decoraction: none;
	    list-style: none;
        }
	.header,.nav,.container,.footer{
	    float: left;
            width: 100%;
	    box-sizing: border-box;
        }
        .header{
            background-color: powderblue;
            padding: 20px;
            text-align: center;
        }
	.content{
	    padding: 5px
	    box-sizing: border-box;
	    text-align: center;
	}
	.footer{
	    padding: 10px;
	    background: #ccc;
	    text-align: center;
	}
	@media screen and (max-width:700px) {
	    .content{
		width: 100%;
		margin: 0px;
	    }
	}
    </style>
</head>
<body>
    <div class="main">
         <div class="header">
              <h1>See which Animal is Your Face</h1>
              <p><img src="./index_imgs/cat.jpeg" alt="error: no cat" width="90" height="90">
		 <img src="./index_imgs/kola.jpeg" alt="error: no kola" width="90" height="90">
	         <img src="./index_imgs/lion.jpeg" alt="error: no lion" width="90" height="90">
		 <img src="./index_imgs/dog.jpeg" alt="error: no dog" width="90" height="90">
		 <img src="./index_imgs/rabbit.jpeg" alt="error: no rabbit" width="90" height="90">
		 <img src="./index_imgs/tiger.jpeg" alt="error: no tiger" width="90" height="90">
		 <img src="./index_imgs/fox.jpeg" alt="error: no fox" width="90" height="90"> 
	      </p>
         </div>
	 <div class="container">
	      <div class="content">
		   <h2>Upload one of your head image</h2>
	           <p>show a file-selected dield which allows a file to be chosen for upload</p>
		   </br>
		   <form sction="save_file.php">
		     <label for="myfile">Select a file:</label>
		     </br>
	             <input type="file">
			<img src="./index_imgs/upload.png" id="mylife" name="mylife">
		     </input><br><br>
		     <input type="submit" value="Submit">
		   </form>
		   <br/>
		   <br/>
	      </div>	
	 </div>
	 <div class="footer">
	      <p>© Created by Guangxun Zhai, Cynthia Li in 2022</p>
	      <p>ECE 5725 Project</p>
	 </div>
    </div>

<!-- Configure a few settings and attach camera -->
<script language="JavaScript">
    Webcam.set({
        width: 490,
        height: 390,
        image_format: 'jpeg',
        jpeg_quality: 90
    });
  
    Webcam.attach( '#web_cam' );
  
    function take_snapshot() {
        Webcam.snap( function(web_cam_data) {
            $(".image-tag").val(web_cam_data);
            document.getElementById('response').innerHTML = '<img src="'+web_cam_data+'"/>';
        } );
    }
</script>

</body>
</html>










     