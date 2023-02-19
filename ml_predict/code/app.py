from flask import Flask, request, jsonify
from flask_cors import CORS
import base64
import subprocess

app = Flask(__name__)
CORS(app)

@app.route('/process-image', methods=['POST'])
def process_image():
    # Get the photo data from the request body
    data = request.data.decode('utf-8')
    photo_data_url = data

    # Convert the base64-encoded photo data to a binary image file
    _, encoded = photo_data_url.split(';base64,')
    photo_data = base64.b64decode(encoded)
    
    # Save the image to a file
    with open('photo.png', 'wb') as f:
        f.write(photo_data)

    # Process the image with your machine learning model
    # Replace this with your own ML code
    result = 'Some machine learning result'
    subprocess.run(["python", "AnimalFace.py", "--image_path", "photo.png"])
    with open('py_result.txt') as f:
        result = f.read()

    # Return the ML result to the front-end as JSON
    response = {'result': result}
    print(response)
    return jsonify(response)


if __name__ == '__main__':
    app.run(debug=True, host='0.0.0.0', port=5000)
