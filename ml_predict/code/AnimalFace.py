import numpy as np
import os, sys
import argparse
from util import *

import warnings
warnings.filterwarnings('ignore')

#image_file_saved_path = "/home/pi/Downloads/input.jpeg"

animal_dict = {
    "cat": 1,
    "dog": 2,
    "fox": 3,
    "koala": 4,
    "lion": 5,
    "rabbit": 6,
    "tiger": 7
}

#print("step 1")

def process_single_image_for_predict(img, target_size):
    from PIL import Image
    img = img.resize(target_size,Image.ANTIALIAS)
    from tensorflow.keras.utils import img_to_array
    img = img_to_array(img)
    img = np.expand_dims(img, axis=0)
    img  = img.astype('float32')
    img /= 255
    return img

def getLabel(prob):
    import json
    with open('%s/index_to_label.txt'%(processed_data_path)) as json_data:
        index_to_label = json.load(json_data)
        json_data.close()

    index_to_label = dict((int(k), v) for k,v in index_to_label.items())
    prediction_index = np.argmax(prob, axis=-1) #multiple categories
    prediction_label = [index_to_label[k] for k in prediction_index]
    return prediction_label

def get_ordered_label():
    import json
    with open('%s/index_to_label.txt'%(processed_data_path)) as json_data:
        index_to_label = json.load(json_data)
        json_data.close()

    index_to_label = dict((int(k), v) for k,v in index_to_label.items())
    return [index_to_label[key] for key in sorted(index_to_label.keys())]

def predict_image(img):
    prob = model.predict(process_single_image_for_predict(img, (IM_WIDTH, IM_HEIGHT)))
    predict_label = getLabel(prob)[0]
    ordered_labels = get_ordered_label()

    print(predict_label)
    f = open("py_result.txt", "w")
    f.write(str(animal_dict[predict_label]))
    f.close()
    if os.path.exists(image_file_saved_path):
        os.remove(image_file_saved_path)
    
'''    import random
    
    label_image_path = random.choice(get_sub_fpaths(os.path.join(image_path_train, predict_label)))
    label_image = read_image_from_path(label_image_path)

    print("{:<10} It is a {}".format('[RESULT]', predict_label.upper()))
    from datetime import datetime
    plot_two_images([img, label_image], title = 'Similarity with %s: %.2f'%(predict_label.upper(), max(prob[0])), display = display,
        save_path = os.path.join(predict_result_save_path, ''.join((datetime.now().strftime("%Y%m%d-%H%M%S"), '-', predict_label, '.jpg'))))
    
    plot_prob_radar(prob[0], ordered_labels, title = 'Similarity with all animals', display = display,
        save_path = os.path.join(predict_result_save_path, ''.join((datetime.now().strftime("%Y%m%d-%H%M%S"), '-', predict_label, '-', 'prob-radar','.jpg'))))
    plot_word_cloud(prob[0], ordered_labels, title = 'Similarity with all animals', display = display,
        save_path = os.path.join(predict_result_save_path, ''.join((datetime.now().strftime("%Y%m%d-%H%M%S"), '-', predict_label, '-', 'word-cloud','.jpg'))))
    plot_prob(prob[0], ordered_labels, title = 'Similarity with all animals', display = display,
        save_path = os.path.join(predict_result_save_path, ''.join((datetime.now().strftime("%Y%m%d-%H%M%S"), '-', predict_label, '-', 'prob','.jpg'))))
'''

#print("step 2")

# Settings
IM_WIDTH, IM_HEIGHT = 150, 150
project_path = os.getcwd()
data_path = os.path.join(project_path, 'DataFile')
image_path_train = os.path.join(data_path, 'ImagesTrain')
image_path_val = os.path.join(data_path, 'ImagesVal')
processed_data_path = os.path.join(project_path, 'ProcessedData') # data_path
model_path = os.path.join(project_path, 'Model') # data_path
image_path_predict = os.path.join(project_path, 'Predict')
predict_result_save_path = os.path.join(project_path, 'PredictResult')
ensure_directory(predict_result_save_path)
display = True



if __name__ == '__main__':
    import os
    #print("step 3")
    while True:
        a = argparse.ArgumentParser()
        a.add_argument("--image_path", help="path to image")
        a.add_argument("--image_url", help="url to image")
        a.add_argument("--model")
        args = a.parse_args()
        #print(type(args.image_path))
        #print(args.image_path)
        image_file_saved_path = args.image_path
        #print("step 3")
        if os.path.exists(image_file_saved_path):
            print("-------input detected--------")
            
            from PIL import Image
            image_old = Image.open(image_file_saved_path)
            if image_old.mode == 'RGBA':
                image_new = image_old.convert('RGB')
                image_new.save(image_file_saved_path)

            a = argparse.ArgumentParser()
            a.add_argument("--image_path", help="path to image")
            a.add_argument("--image_url", help="url to image")
            a.add_argument("--model")
            args = a.parse_args()

            if args.image_path is None and args.image_url is None:
                a.print_help()
                sys.exit(1)

            if args.model is None:
                model_choice = 'VGG16'
                #model_choice = 'InceptionV3'
        #        print("{:<10} The default pretrained model will be used: {}".format('[INFO]', model_choice))
        #        print("{:<10} You can selecting model by adding argument - VGG16, ResNet50, VGG19, InceptionResNetV2, DenseNet201, Xception or InceptionV3 {}".format('', model_choice))
            else:
                model_choice = args.model

            # Load model
        #    print("{:<10} Start loading model".format('[INFO]', model_choice))
            from keras.models import load_model
            tuned_model_path = os.path.join(model_path, model_choice, 'tune', model_choice+'.h5')
            try:
                model = load_model(tuned_model_path)
            except:
        #        print("{:<10} Cannot load model trained from {}".format('[ERROR]', model_choice))
                exit(1)

            # Load image
        #    print("{:<10} Start loading images".format('[INFO]'))
            if args.image_path is None:
                images = [read_image_from_url(args.image_url)]
            else:
                try:
                    image_paths = get_sub_fpaths(args.image_path)
                    image_file_saved_path = args.image_path
                    if len(image_paths) > 3:
                        display = False
                    predict_result_save_path = os.path.join(predict_result_save_path, args.image_path.split('/')[-1])
                    ensure_directory(predict_result_save_path)
                except:
                    image_paths = [args.image_path]
                finally:
                    images = [read_image_from_path(image_path) for image_path in image_paths]


        #    print("{:<10} Start Recognizing".format('[INFO]', model_choice))
            for img in images:
                predict_image(img)
            #sys.exit(1)
                
        #    print("{:<10} Finish Recognizing {} images. Prediction Results are saved to {}".format('[INFO]', len(images), predict_result_save_path))
        else:
            print("-------No Input.jpg--------")
            sys.exit(1)
