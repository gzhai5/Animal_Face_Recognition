FROM tensorflow/tensorflow

# RUN pip install tensorflow==2.10.0 tensorflow-io==0.27.0
RUN pip install Pillow

VOLUME /animal_predict

WORKDIR /animal_predict

RUN pip install flask requests
RUN pip install flask-cors

EXPOSE 5000

CMD ["flask", "run", "--host=0.0.0.0"]

# COPY code code
# COPY requirements.txt requirements.txt
# COPY fatcat.jpg fatcat.jpg
# COPY dog.jpg dog.jpg