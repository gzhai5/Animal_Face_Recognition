docker build . -t animal_predict
docker run -it -v $(pwd)/code:/animal_predict animal_predict 