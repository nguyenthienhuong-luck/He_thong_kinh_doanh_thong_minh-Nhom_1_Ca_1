from flask import Flask, request, jsonify
import cv2
import pytesseract
import re
from datetime import datetime
import os

app = Flask(__name__)

# Configure Tesseract path
pytesseract.pytesseract.tesseract_cmd = r'D:\Apps\Tesseract-OCR\tesseract.exe'

def extract_info_from_image(image_file):
    try:
        # Save temporary file
        temp_path = "temp_" + image_file.filename
        image_file.save(temp_path)
        
        # Read image
        img_cv = cv2.imread(temp_path)
        if img_cv is None:
            return {
                "success": False,
                "message": "Không thể đọc được ảnh",
                "is_valid": False
            }
        
        img = cv2.cvtColor(img_cv, cv2.COLOR_BGR2RGB)
        
        # Improve image quality
        img = cv2.resize(img, None, fx=2, fy=2)
        img = cv2.GaussianBlur(img, (3,3), 0)
        
        # Extract text
        text = pytesseract.image_to_string(img, lang="vie")
        
        # Extract name and term
        name_pattern = r"Họ tên:\s*([^\n]+)"
        term_pattern = r"Khóa học:\s*(\d{4})-(\d{4})"
        
        name_match = re.search(name_pattern, text)
        term_match = re.search(term_pattern, text)
        
        if not name_match or not term_match:
            return {
                "success": True,
                "message": "Không tìm thấy thông tin sinh viên trong ảnh",
                "is_valid": False
            }
        
        extracted_name = name_match.group(1).strip()
        start_year = int(term_match.group(1))
        end_year = int(term_match.group(2))
        
        return {
            "success": True,
            "extracted_name": extracted_name,
            "term": f"{start_year}-{end_year}",
            "start_year": start_year,
            "end_year": end_year
        }
        
    except Exception as e:
        return {
            "success": False,
            "message": f"Lỗi xử lý ảnh: {str(e)}",
            "is_valid": False
        }
    finally:
        # Cleanup temporary file
        if os.path.exists(temp_path):
            os.remove(temp_path)

@app.route('/verify-student', methods=['POST'])
def verify_student():
    try:
        if 'image' not in request.files:
            return jsonify({
                "success": False,
                "message": "Không tìm thấy file ảnh",
                "is_valid": False
            })
            
        if 'name' not in request.form:
            return jsonify({
                "success": False,
                "message": "Thiếu thông tin tên sinh viên",
                "is_valid": False
            })
            
        image_file = request.files['image']
        input_name = request.form['name']
        
        # Extract information from image
        result = extract_info_from_image(image_file)
        
        if not result["success"]:
            return jsonify(result)
            
        # Normalize names for comparison
        input_name = ' '.join(input_name.strip().split())
        extracted_name = ' '.join(result["extracted_name"].strip().split())
        
        # Check if names match
        if input_name.lower() != extracted_name.lower():
            return jsonify({
                "success": True,
                "message": "Tên trong thẻ sinh viên không khớp",
                "is_valid": False
            })
        
        # Check if student term is valid
        current_year = datetime.now().year
        if result["start_year"] <= current_year <= result["end_year"]:
            return jsonify({
                "success": True,
                "message": "Xác thực sinh viên thành công",
                "is_valid": True
            })
        else:
            return jsonify({
                "success": True,
                "message": "Thẻ sinh viên đã hết hạn",
                "is_valid": False
            })
            
    except Exception as e:
        return jsonify({
            "success": False,
            "message": f"Lỗi hệ thống: {str(e)}",
            "is_valid": False
        })

if __name__ == '__main__':
    app.run(host='0.0.0.0', port=5000)