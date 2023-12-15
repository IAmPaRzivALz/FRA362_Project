from qr_class import *
import time
# from QR_CODE.subfunction import *

# filename = 'EIEI5'
# data = 'See Kuy'
# Item1 = QR_Code(filename,data)
# Item1.qr_generate()

qr = UART_Reader()
qr.open_serial_port()
while True:
    time.sleep(1)
    
    ##use this fomat if you want to make it start scaning without do something next (just keep data in self.getdat)
    # qr.read_uart()
    
#     ##use this fomat if you want to make it start scaning and when it scaning successfully you want to make it do something put it in statement
    if qr.read_uart() == 1:
        print(qr.getdata)
        with open('output.txt', 'w') as file:
            file.write(qr.getdata)
        print(f'Data written to output.txt: {qr.getdata}')
        file.close
