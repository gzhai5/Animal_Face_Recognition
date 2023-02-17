from flask import Flask, request, jsonify
import base64

app = Flask(__name__)

@app.route('/process-image', methods=['POST'])
def process_image():
    # Get the photo data from the request body
    data = request.json
    photo_data_url = data['photoDataUrl']

    # Convert the base64-encoded photo data to a binary image file
    _, encoded = photo_data_url.split(';base64,')
    photo_data = base64.b64decode(encoded)
    
    # Save the image to a file
    with open('photo.png', 'wb') as f:
        f.write(photo_data)

    # Process the image with your machine learning model
    # Replace this with your own ML code
    result = 'Some machine learning result'

    # Return the ML result to the front-end as JSON
    return jsonify({'result': result})


if __name__ == '__main__':
    app.run(debug=True, host='0.0.0.0', port=5000)
