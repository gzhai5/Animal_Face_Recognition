import subprocess
print("start")

cmd = "libcamera-still -c 640:480 -o /home/pi/final_proj/path/photo.jpg"

# Use the `call()` function to run the command and wait for it to complete
result = subprocess.run(cmd, shell=True, capture_output=True)
print(result)#("output: " + result.stdout)
print("end")