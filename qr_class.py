import qrcode
import serial
import config as c
from subfunction import *

class QR_Code:
    def __init__(self, name = 'none', data = "none") :
        self.name = name #Public Variable can call from outside
        self.__data = data #Private Variable can only call from inside
       
    def qr_generate(self):
        qr = qrcode.QRCode(
            version=1,
            error_correction= qrcode.constants.ERROR_CORRECT_L,
            box_size=c.QR_size,
            border=c.QR_border,
            )
        qr.add_data(self.__data)
        qr.make(fit=True)
        img = qr.make_image(fill_color=c.QR_color, back_color="white")
        img.save(c.Path + f'{self.name}.png')
        
        #update to log
        QR_update(self.name,self.__data)
        add_serial_On_Image(image_fliename=self.name,text=self.__data)
        # img = qrcode.make(self.data)
        # img.save("james.png")
        
    def change_infomat(self,new_name = 'none',new_data = 'none'):
        if new_name != 'none':
            self.name = new_name #Actually just call self.name = _____ form outside for change data of Public Variable
        if new_data != 'none':
            self.__data = new_data #This is the only way to change data of Private Variable
            
class UART_Reader:
    def __init__(self,port=c.COM, baudrate=c.BaudRate):
        self.__Com = port
        self.__BaudRate = baudrate
        self.delay_data = 'starting' #just for check double scan
    
    def open_serial_port(self):
        # Open the serial port for reading
        print(f"Set UART from {self.__Com} at baudrate {self.__BaudRate}")
        self.serial_port = serial.Serial(self.__Com, self.__BaudRate,timeout=0)

    def close_serial_port(self):
        # Close the serial port
        if self.serial_port and self.serial_port.is_open:
            self.serial_port.close()
    
    def read_uart(self):
            # Read data from the serial port
            raw_data = self.serial_port.readline()
                
            self.getdata = raw_data.decode('utf-8').strip()
            
            if self.getdata:
                if self.getdata != getattr(self, '_last_received_data', None):  
                    # print("Received from UART:", self.getdata)
                    
                    # Update the last received data
                    setattr(self, '_last_received_data', self.getdata)
                    
                    return 1 #scaning successful
                else:
                    # print("Received the same data as before. Skipping processing.")
                    return 0 #scaning unsuccessful
            else:
                # print("Received data is None. Skipping processing.")
                return 0 #scaning unsuccessful
            # Process the received data as needed