import cv2
import mediapipe as mp
import numpy as np
from fastapi import FastAPI, UploadFile, File
import io
from PIL import Image


app = FastAPI()
mp_pose = mp.solutions.pose
pose = mp_pose.Pose(static_image_mode=True)

def fit_clothing(user_img, cloth_img):
    
    # 1. Detect Human Landmarks
    img_rgb = cv2.cvtColor(user_img, cv2.COLOR_BGR2RGB)
    results = pose.process(img_rgb)
    
    if not results.pose_landmarks:
        return user_img # Return original if no human detected

    h, w, _ = user_img.shape
    lm = results.pose_landmarks.landmark

    # 2. Get Key Points (Shoulders and Hips)
    # MediaPipe landmarks: 11=Left Shoulder, 12=Right Shoulder, 23=Left Hip, 24=Right Hip
    r_shoulder = [int(lm[12].x * w), int(lm[12].y * h)]
    l_shoulder = [int(lm[11].x * w), int(lm[11].y * h)]
    r_hip = [int(lm[24].x * w), int(lm[24].y * h)]

    # 3. Calculate Dimensions for the cloth
    cloth_width = int(abs(l_shoulder[0] - r_shoulder[0]) * 1.6) # Scale slightly wider
    cloth_height = int(abs(r_shoulder[1] - r_hip[1]) * 1.2)
    
    # 4. Resize and Overlay
    # Ensure cloth image has 4 channels (RGBA) for transparency
    resized_cloth = cv2.resize(cloth_img, (cloth_width, cloth_height))
    
    # Calculate offset to center the shirt on shoulders
    x_offset = r_shoulder[0] - int(cloth_width * 0.2)
    y_offset = r_shoulder[1] - int(cloth_height * 0.1)

    # Overlay with transparency support
    for c in range(0, 3):
        alpha = resized_cloth[:, :, 3] / 255.0
        user_img[y_offset:y_offset+cloth_height, x_offset:x_offset+cloth_width, c] = \
            alpha * resized_cloth[:, :, c] + (1 - alpha) * user_img[y_offset:y_offset+cloth_height, x_offset:x_offset+cloth_width, c]

    return user_img

@app.post("/process-vfr")
async def process_vfr(user_img: UploadFile = File(...), cloth_img: UploadFile = File(...)):
    return {"image_hex": "00ff"}
    # Read files
    u_bytes = await user_img.read()
    c_bytes = await cloth_img.read()
    
    u_arr = cv2.imdecode(np.frombuffer(u_bytes, np.uint8), cv2.IMREAD_COLOR)
    c_arr = cv2.imdecode(np.frombuffer(c_bytes, np.uint8), cv2.IMREAD_UNCHANGED) # Keep Alpha channel
    
    result_img = fit_clothing(u_arr, c_arr)
    
    _, buffer = cv2.imencode('.png', result_img)
    return {"image_hex": buffer.tobytes().hex()}