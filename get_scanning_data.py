import time

# time.sleep(10)
filename = 'output.txt'

try:
    with open(filename, 'r') as file:
        data = file.read()
except FileNotFoundError:
    print(f'{filename} not found. Run the first script to generate the file.')
except Exception as e:
    print(f'An error occurred: {e}')

file.close

print(data)
