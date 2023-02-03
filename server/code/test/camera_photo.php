<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewreport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/webcamjs/1.0.25/webcam.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" />
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
	    margin: 5px		
	    padding: 0
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
		   <h2>Give Yourself a Snapshot</h2>
	           <p>Please save in your image inside the Download directory</p>
		   <br/>
		   <form method="post" action="loader.php">
        	      <div class="dsp row">
            		<div class="col-md-6 dsp">
                	     <div id="web_cam"></div>
                	     <br/>
                	     <input type=button value="Take Snapshot" onClick="take_snapshot()">
                	     <input type="hidden" name="image" class="image-tag">
            	        </div>
            	        <div class="dsp col-md-6">
                	     <div id="response">Your main captured image will appear here</div>
            	        </div>
            		<div class="col-md-12 text-center">
                	<br/>
                	<a href="loader.php">
            		    <button class="btn btn-primary btn-lg">Go Get Your Animal</button>
        		</a>
			<br/>
            		</div>
        	      </div>
    		  </form>
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










     