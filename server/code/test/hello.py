import sys
import base64
import io
from matplotlib import pyplot as plt
from array import array
import numpy as np

file = sys.argv[1]
f = open(file)
base_64 = f.read()

plt.imshow(i, interpolation='nearest')
plt.show() 





# print (base_64)

#image_64_encode = base_64
#with open("image.jpg","wb") as fh:
#   fh.write(base64.decodebytes(image_64_encode))