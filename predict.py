import cv2
import numpy as np
import tensorflow as tf
import keras
import sys

inp = sys.argv[1]

# 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

image_size = 200
labels = ['Normal','Parkinsons']

im = cv2.cvtColor(cv2.resize(cv2.imread(inp),(image_size,image_size)),cv2.COLOR_BGR2GRAY)/255


model = keras.models.load_model("model.h5")

pred = model.predict(np.array([im]),verbose=0)


disease = np.round(pred)

print(int(disease))