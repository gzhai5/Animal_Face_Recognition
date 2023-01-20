docker run --name test-php-nginx -p 8083:80 -d \
    -v /Applications/phpstudy/WWW:/www:ro \
    -v /Applications/phpstudy/Extensions/Nginx1.16.1/conf:/nginx/conf/conf.d:ro \
    --link myphp-fpm:php \
    nginx