from cProfile import label
import numpy as np
import cv2
import matplotlib.pyplot as plt
import mediapipe as mp
import time
import tensorflow as tf
from FaceDetectionModule import FaceDetector
from FaceMeshModule import FaceMeshDetector
import pickle
import requests
from threading import Thread
import threading
import imutils

module_id = '000001'
module_password = '123456'
has_request = False
stop_ = False
labels = {}
with open('label.pickle', 'rb') as f:
    og_labels = pickle.load(f)
    labels = {v:k for k,v in og_labels.items()}

repeat = np.zeros(len(labels))

cap = cv2.VideoCapture(0)
cap.set(cv2.CAP_PROP_FRAME_WIDTH, 1600)
cap.set(cv2.CAP_PROP_FRAME_HEIGHT, 960)
recognizer = cv2.face.LBPHFaceRecognizer_create()
recognizer.read('TrainedModel.yml')

'''mpDraw = mp.solutions.drawing_utils
mpFaceMesh = mp.solutions.face_mesh
faceMesh = mpFaceMesh.FaceMesh(max_num_faces=20)
drawSpec = mpDraw.DrawingSpec(thickness=1, circle_radius=2)'''

detector = FaceDetector(minDetectionCon=0)
#meshDetector = FaceMeshDetector(maxFaces=20, minDetectionCon=0.5, minTrackCon=0.5)

def idconv(i):
    s = str(i)
    l = len(s)
    if l == 6:
        return s
    else:
        nl = 6 - l
        while nl > 0:
            s = '0' + s
            nl = nl - 1
        return s
def request():
    global repeat
    global stop_
    global has_request
    while True:
        if stop_ == True:
            break
        #print(repeat)
        if has_request == True:
            for i in range(len(repeat)):
                if repeat[i] >= 20:
                    print(labels[i], time.time())
                    name = labels[i]
                    url = f'https://quan-ly.000webhostapp.com/php/diemdanh.php?id={idconv(i)}'
                    #print(url)
                    x = requests.get(url)
                    print(name, ": ",x.text)
                    repeat[i] = 0
                    has_request = False
def main():    
    pTime = 0
    rstTime = 0
    percent = 40
    size = (128, 128)
    global repeat
    global stop_
    global has_request
    color = (0,255,0)
    stroke = 1
    font = cv2.FONT_HERSHEY_DUPLEX
    while True:
        success, img = cap.read()
        #print(repeat)
        #imgRGB = cv2.cvtColor(img, cv2.COLOR_BGR2RGB)
        img, bboxs = detector.findFaces(img, draw=True, Text=False)
        grayImg = cv2.cvtColor(img, cv2.COLOR_BGR2GRAY)

        if len(bboxs) > 0:
            for i in range(len(bboxs)): 
                x, y, w, h = bboxs[i][1]
                if x<0: x=0
                if y<0: y=0
                face = grayImg[y:y+h, x:x+w]
                face = cv2.resize(face, size, interpolation=cv2.INTER_AREA)
                id_, conf = recognizer.predict(face)
                if conf >=percent:
                    repeat[id_] = repeat[id_] + 1                 
                    name = labels[id_] + ' - ' + str(round(conf)) +'%'
                    cv2.putText(img, name, (x,y-10), font, 0.7, color, stroke, cv2.LINE_AA)            
                else:
                    name = 'Unknown'
                    cv2.putText(img, name, (x,y-10), font, 0.7, color, stroke, cv2.LINE_AA)
                if repeat[id_] >= 20:
                    has_request = True
        #imgMesh, faces = meshDetector.findFaceMesh(imgRGB, draw = True)
        #img = cv2.Canny(img, 150, 200)
        #if len(faces) != 0:
        #    print((faces[0]))
        cTime = time.time()
        if cTime - rstTime > 4:
            repeat = np.zeros(len(labels))
            rstTime = cTime
        fps = 1 / (cTime - pTime)
        pTime = cTime

        cv2.putText(img, f'FPS: {int(fps)}', (20, 50), font, 1, color, 1)
        cv2.imshow("Image", img)
        if cv2.waitKey(1) & 0xFF == ord('q'):
            stop_ = True
            break
    cv2.destroyAllWindows()

#if __name__ == "__main__":
#    main()
try:
    t = time.time()
    th1 = threading.Thread(target=main)
    th2 = threading.Thread(target=request)
    th2.start()
    th1.start()
    th1.join()
    th2.join()
    print('All Thread Started')
except:
    print('Error')
    