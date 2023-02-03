docker run --rm --name animal -d -p 8083:80 \
    -v "$(pwd)/code":/usr/share/nginx/html:ro \
    nginx

open http://localhost:8083