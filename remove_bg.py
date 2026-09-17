import os
import zipfile
from PIL import Image
from rembg import remove

# Unzip your file
zip_path = 'full.zip'
extracted_path = 'unzipped_images'
output_path = 'bg_removed_png'

with zipfile.ZipFile(zip_path, 'r') as zip_ref:
    zip_ref.extractall(extracted_path)

# Output folder
os.makedirs(output_path, exist_ok=True)

# Locate images inside '1' folder
image_folder = os.path.join(extracted_path, '1')
image_files = [f for f in os.listdir(image_folder) if f.lower().endswith(('.webp', '.jpg', '.jpeg', '.png'))]

# Convert to PNG & remove background
for filename in image_files:
    input_path = os.path.join(image_folder, filename)
    base_name = os.path.splitext(filename)[0]
    output_file = f"{base_name}.png"

    try:
        with Image.open(input_path).convert("RGBA") as img:
            output = remove(img)
            output.save(os.path.join(output_path, output_file))
            print(f"✅ {filename} → {output_file}")
    except Exception as e:
        print(f"❌ Error with {filename}: {e}")
