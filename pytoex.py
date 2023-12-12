import openpyxl
from openpyxl import load_workbook

import sys
no = sys.argv[1]
locker_no = sys.argv[2]
line_id_and_idcard = sys.argv[3]
check1 = sys.argv[4]
check2 = sys.argv[5]
check3 = sys.argv[6]
check4 = sys.argv[7]
check5 = sys.argv[8]
check6 = sys.argv[9]
check7 = sys.argv[10]
check8 = sys.argv[11]
check9 = sys.argv[12]
wb = openpyxl.load_workbook('test.xlsx')
sheet = wb['Sheet1']

new_data = [no,locker_no,line_id_and_idcard ,check1,check2,check3 ,check4 ,check5 ,check6 ,check7,check8 ,check9 ]
sheet.append(new_data)


wb.save('test.xlsx')