from PIL import Image, ImageDraw, ImageFont
import config as c
import os
def QR_update(name = 'none',data = 'none'):
    try:
            with open(c.Path + 'log.txt', 'r') as file:
                lines = file.readlines()
                if lines:
                    last_line = lines[-1]
                    last_order_number = int(last_line.split()[0])
                    order_number = last_order_number + 1
                else:
                    order_number = 1
    except FileNotFoundError:
        order_number = 1

    # Append the new order to the log
    with open(c.Path + 'log.txt', 'a') as file:
        file.write(f'{order_number} {name} {data}\n')

def add_serial_On_Image(image_fliename,image_path = c.Path, text = 'none', font_size=c.font_size, text_color=c.text_color):
    # Construct the full path to the image file
    full_image_fliename = image_fliename + f'.png'
    image_path = os.path.join(image_path, full_image_fliename)

    # Open the image
    image = Image.open(image_path)

    # Get image dimensions
    image_width, image_height = image.size
    
    # Create a drawing object
    draw = ImageDraw.Draw(image)

    # Choose a font (you can specify the path to a TTF file if needed)
    font = ImageFont.truetype("arial.ttf", font_size)

    # Calculate the position to place text at the center at the bottom
    text_width, text_height = draw.textsize(text, font=font)
    position = ((image_width - text_width) // 2, (image_height - 8) - text_height)
    
    # Specify the position, font, and color of the text
    draw.text(position, text, font=font, fill=text_color)

    # Save or display the modified image
    image.save(c.Path + f'{image_fliename}_serial.png')
    image.show()
    