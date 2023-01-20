docker run --rm --name animal -d -p 8083:80 \
    -v /Users/mud/Documents/Animal_Face_Recognition/code:/usr/share/nginx/html:ro \
    nginx