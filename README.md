# Project Title: Animal_Face_Recognition

In this project, our group invented an animal face recognition system using Raspberry Pi 4 and an attached legacy camera module. The whole software system is mainly separated into two sections: a web server on RPi-4 and a machine learning algorithm. We have first constructed a basic server and trained a simple machine learning algorith, then implemented more features of the server such as button interaction, page jumping, camera streaming, etc, and improved the ML model, and finally connected the two sections together.<br><br>

In the final prototype, the users are able to interact with the server to take photos of themselves, save it to a local path and analyze the result, which, in this case, is the animal that is most similar to the face in that photo. Finally, the result data will be updated to the server and showcased to audiences. This project is viewed as an embedded system since it includes software and hardware parts and could be easily divided into I/O, memory, and computer processor components.

## Project Objective

Face recognition filter is trending on many social media, such as Instagram, etc. Training the machine learning model and conduct recognition process is computationally expensive and takes a long time. Therefore, we are interested in simplifying the animal face recognition system on a server built on Raspberry Pi 4 whose CPU and memory is less powerful. Out ultimate goal are:<br><br>

* Build up a server and implement basic functions including showing webpages, jumping through webpages, running camera module, etc.

* Train a model that finds the most similar animal face type among multiple classes given an input image

* Combine webpages and machine learning together to provide animal face recognition service to users

## Design and Testing Procedures

### Server Implementation

In order to have a showing interface to demo the result of our animal face recognization and also to have a more easily- understood using process, we dedcided to build a server on Pi, and use webapges as the more integradted interface for users to more easily experience our service. Overall, for this part, we are separated into 3 major key points: setting up the server, designing the webpages, interaction with the camera. The interaction with the face recognization algorithm would be discuused later in this section.

#### Set up the Server

We have choosen to set up a Apache server directly on Pi. The reason why we chose Apache Server is that our group initially have poor experience on developing web or server. So we would like to choose a popular server since we will more easily to find more documents of it from Google. Besides, Apache Sever is an open-source server, so it is free and just suits our beginners. The whole porcess of setting up the server isn't that hard. We mostly follow a tutorial provided in the below reference and eventually get a index.html for our web mainpage code.

#### Design Webpage

As mentioned above, we initially just have an index.html for the mainpage. Then we tried our best to learn how to write html code for the webpage from Youtube. After getting a brief idea what http and its basic syntax, we started to look for some example html template, and made adjustment on it. It took us almost two weeks to get familiar with the html code, most of the design element is done by the "style" tag inside html. And whenever we encountered any problem: we looked the issue up in the tutorial from w3schools website, tried the example code, and modified the code to fit our demands.

#### Interact with Camera

We followed the totrial listed in the below reference and installed the camera moduel. The only thing that need to be mentional for the installation here is: for the 32-bit pi operating system, it is possible to get camera data to the web and use camerastill command at the same time. However, since the installation of Tensorflow requires a 64-bit OS, and for a 64-bit Pi, we use libcamera instead of camerastill for commad lines. Moreover, the use of libcamera requires user to unenable the legacy camera in the interface setting, and after unenabling the legacy camera, the webpage will have no method to get the camera images from the web code.<br><br>

For the interaction between webpage and camera, we used javascript to get image data from the camera module, and keep streaming it onto the webpage. And also, we need to enable the legacy camera in the interface setting, though we will lose the right to use cmd to capture the photo. In addition, for our webpage, we also used javascript to print out our photo and have the feature for downloading the photo to a local path.

### Face Recognition Algorithm

Developing the face recognition algorithm has 3 steps: obtaining dataset, tuning model, designing comparison algorithm of input image to the ML model.

#### Obtain Dataset

At first, we tried to write program that generates url and extracts multiple desired images from the Google Chrome with the number of images specified by an input argument. However, this has many problems. The resources we looked up suggested using webdriver such as chromium or selenium where we lack of experience and the debugging tools for selenium is relatively limited. Also, many of the downloaded images weren't desired: it might include multiple targets, distracting objects (such as human), partial objects, watermarks, etc. and the downloaded format are messy. In the end, the efficiency of using volume downloading seems to be no more than manually creating the dataset. Therefore, we finally still chose to manually select the data set.<br><br>

For the dataset, there are several things to consider: 1. number of classes; 2. the size of the dataset; 3. format of the dataset; 4. data selection. We decided that 7 classes of animals (cat, dog, fox, lion, tiger, rabbit, koala) has enough diversity for use. Also, since we are downloading the images manually, we decided that 100 images in each class are sufficient. They are divided into 80 images for training, 10 images for validation, and 10 images for testing based on 80- 10-10 rule. Last, we decided that jpg, jpeg, and png format are used. Particularly, I looked into 10 different breeds in each class to better represent the class and included 10 images of each breed in the dataset except for koala, which seems to only have 1 breed. It is worth noticing that the breed variance in class cat and dog is much larger than all the other classes.<br><br>

In testing the training model program, we started using a small dataset with only 2 classes and 2 image in each class as it is simple model and therefore more time efficient.

#### Tune Model

There are many libraries that have face recognition functions. Originally, we tried to implement the model with SIFT based on last year's SmartKart project [1]. SIFT is desirable as it is fast, insensitive to scale and orientation, and it can extract many crucial key points even on small objects even with no prior segmentation. However, the SIFT library in OpenCV has already expired, we need to build SIFT model completely on our own. Based on the condition of algorithm complication and lack of experience, we decided to explore Keras library and use existing ML models.<br><br>

From Keras API, we found many fully established models, including the trending VGG, Inception algorithms, etc. With the strong API references and other online guidelines on each step of building Keras model, creating and debugging the model tuning program wasn't the hard part. After ensuring the functionality of the model tuning program, I expanded the dataset from 10 in each class to 100 in each class as described in the previous section and started tuning. The models we looked at include VGG16, VGG19, ResNet50, InceptionV3, Xception. Since we have a small validation dataset, I tried batch normalization with batch size of 1, 3, 5 and find that batch size of 5 seems to perform the best on all models. I also tuned each model with different epoch number. In the end, VGG16, InceptionV3, and Xception seems to have the optimal results, all having the accuracy around 90% (A detailed accuracy table is in the lab report). The accuracy here is absolute accuracy: the portion of correctly classified validation image number divide by the total number of validation set. Therefore, these 3 models are all good to use. These models have different back-propagation methods and do not require prior segmentation. For example, for VGG16 model, the training process already included segmentation at different levels for deeper feature extractions and is insensitive scale, orientation, etc. which improves the accuracy and saves large computation cost on preprocessing the images.

#### Face Recognition Algorithm

The face recognition algorithm is basically extracting an input image (human face) from local path, extracting the tuned (selected) model from local path, analyzing the input image by passing it to the model for comparison, and writing the result to the file specified. The program is relatively simple. We first tested the program on JupyterHub (on our own computer) and it could execute properly. After we ensured the functionality of the program, we copied the dataset, and the model to test the program on R-Pi, which gave many dependency error messages. However, even after we attempted to install keras and tensorflow it still have the same problem. We checked the Keras and Tensorflow version on JupyterHub which is on python 3.7, so we tried to downgrade python on R-Pi, which still couldn't solve the problem. In the end, we found that Tensorflow is not compatible to 32-bit system, so we reinstalled the R-Pi system to 64-bit kernel and reinitialized R-Pi as in Lab 1 and Lab 2. One hard part of this section is that we don't know if the human face is classified correctly or not, we can only trust the previous validation accuracy which is tested on animal faces. Also, from testing with human faces downloaded from Google, most people are classified to cat and dogs. This makes sense because the variation among the 10 breeds of cat or dog is much larger than other classes, which makes their features more diverse than all the others.

### Connecting Server And Recognition Algorithm

For transmiting data from server to the local python code, we failed to use the traditonal way of internet port. And we also tried to used php code to directly call the python code to run, however, the running of python code takes long, and it seems that the webpage cannot easily wait for the final result of the python running. After several tries, we decided to run the python code of the Recognition Algorithm at first in the background. And what does the python code do it to keep scanning a local path and waiting for the caputured photo being saved down, and as soon as it finds the photo in that directory, it will run the model, write the final result into a local txt file. This python code analyzing process will takes around 20s. And we just added a loading page (loading for 30s for safe), and after this 30s, we utilzied php to read the string inside that txt file, and jump to different animal result webpages depending on the output string from the python code.

## Result

Overall, our program has achieved our goal. The server and the background running in the background can successfully interact with each other to complete the face recognition function shown in the flowchard below in Fig. 2 and a physical button is able to shut down the background program as bail out. However, it is true that the ML model did not work as well as we planned. First, Raspberry Pi 4 camera is sensitive to light settings, the photo it takes seems to be relatively redder than appears in regular camera, which lead to many people classified to "Tiger". This is also because that the ML model considers color as crucial features as well. Second, currently the server jumps to a loading page which is set to 30 seconds once starts analyzing rather than responding to the background python program immediately.

## Conclusion

From the result, we believe we have finsihed almost everything planned in the beginning proposal, and we are able to provide a whole web service for people to know which animal does they most look like. The service content itself is also intriguing and has achived our goal. Things that we haven't achieved would be: first, for a server, we cannot access the service from any other computers since the saving photo feature saves the photo to the local pc. Besides, we orignially planned to have a better and more detailed result animal webpage, however due to the lacking of time and limitation of the machine learning model, we simplified the result page to single texts combined with single animal background.

## Future Work

With additional time, we can improve both the server and machine learning model. For the server, we could explore how to make page jump once the recognition algorithm finishes. In addition, we can also explore implementing the uploading feature, which allows the users to upload their own pictures (rather than taking photos from the camera) and analyze them using the algorithm, allowing any users with the same WiFi to play with the face recognition system. We have tried to build this feature but were stuck with where the uploaded pictures should go (to cloud or to local path) and how R-Pi should access the uploaded photo.<br><br>

For the ML algorithm, we may add segmentation and face recognition features to preprocess the input image to improve accuracy and explore how to deal with light sensitivity of the camera and the color sensitivity of ML model. Besides, we can also try to implement the ML model with SIFT so that viewpoint may affect the result less. Last, we can implement the feature to return the most similar animal face in the dataset and similarity (in number) to the users.

## deploying angulus docker part
https://markfknight.dev/posts/angular-in-docker/
