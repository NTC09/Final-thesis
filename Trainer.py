from pyparsing import empty
from FaceDetectionModule import FaceDetector
import numpy as np
import cv2
import os
import pickle

class Persons():
    def __init__(self, folderNames):
        self.img = []
        self.faces = []
        self.labels = folderNames
        self.ID = 0
        self.imgList = os.listdir(f'{path}/{self.labels}')
        detector = FaceDetector()
        for imgName in self.imgList:
            curImg = cv2.imread(f'{path}/{self.labels}/{imgName}', cv2.IMREAD_UNCHANGED)
            self.img.append(curImg)
            #Get faces
            img, bboxs = detector.findFaces(curImg)
            if len(bboxs) < 1:
                pass
            else:
                x, y, w, h = bboxs[0][1]
                if x<0: x=0
                if y<0: y=0
                #print(imgName, x, y, w, h)
                grayImg = cv2.cvtColor(curImg, cv2.COLOR_BGR2GRAY)
                img_array = np.array(grayImg, "uint8")
                face_array = img_array[y:y+h, x:x+w]
                size = (128, 128)
                face_array = cv2.resize(face_array, size, interpolation=cv2.INTER_AREA)
                self.faces.append(face_array)
                #cv2.imshow("Face", face_array)
                #cv2.waitKey(0)

face_recognizer = cv2.face.LBPHFaceRecognizer_create()

path = 'PersonList'
myList = os.listdir(path)
#print(myList)
people = []
current_id = 0
label_ids = {}
y_labels = []
x_train = []

for name in myList:
    people.append(Persons(name))
for person in people:
    #print(people[i].img)
    #cv2.imshow("Image", person.faces[0])
    #cv2.waitKey(0)

    label_ids[person.labels] = current_id
    person.ID = current_id
    current_id += 1
    for img in person.faces:
        x_train.append(img)
        y_labels.append(label_ids[person.labels])

with open("label.pickle", 'wb') as f:
    pickle.dump(label_ids, f)
print('Data create complete!')
print('Training...')
face_recognizer.train(x_train, np.array(y_labels))
face_recognizer.save('TrainedModel.yml')

print('Training complete!')

'''
cap = cv2.VideoCapture(0)
while True:
    success, frame = cap.read()
    gray = cv2.cvtColor(frame, cv2.COLOR_BGR2GRAY)
    faces = face_cascade.detectMultiScale(gray, scaleFactor=1.5, minNeighbors=5)
    for (x, y, w, h) in faces:
        roi_gray = gray[y:y+h, x:x+w]
        roi_color = frame[y:y+h, x:x+w]

        color = (255, 0, 0)
        stroke = 2
        end_cord_x = x + w
        end_cord_y = y + h
        cv2.rectangle(frame, (x, y), (end_cord_x, end_cord_y), color, stroke)

    cv2.imshow("Result", frame)
    if cv2.waitKey(1) & 0xFF ==ord('q'):
     break'''