<form method="POST" action="capture-photo.php">
    <button type="submit">Capture Photo</button.
</form>

<script>
    document.querySelector('form').addEventListener('submit',function(e) {
        e.preventDefault();
	var xhr = new XMLHttpRequest();
	xhr.open('POST', 'capture-photo',true);
	xhr.send();

	xhr.onload = function() {
	    document.querySelector('#photo').src = "photo.jpg";
	}
    });
</script>