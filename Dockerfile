FROM --platform=linux/arm64/v8 ubuntu:latest

RUN apt-get update
RUN apt install -y nano wget
RUN apt install -y nginx
RUN apt-get install -y php7.4
RUN apt install -y vim

CMD service nginx restart
CMD service php restart

EXPOSE 80