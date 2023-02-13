FROM python:3.7

RUN pip install tensorflow==2.10.0 tensorflow-io==0.27.0
RUN pip install Pillow

VOLUME /animal_predict

WORKDIR /animal_predict

CMD python AnimalFace.py --image_path ./random_test_imgs/fatcat.jpeg

# COPY code code
# COPY requirements.txt requirements.txt
# COPY fatcat.jpg fatcat.jpg
# COPY dog.jpg dog.jpg