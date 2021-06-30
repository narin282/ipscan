import subprocess
import socket
import datetime
import time

file = open("ipconfig.txt", "r")
ipconfig = file.read()
i = 0
x = ''
while i == 0:
    for ping in range(201,255):
        address = ipconfig + str(ping)
        process = subprocess.Popen(['ping', '-n', '2', address], stdout=subprocess.PIPE)
        out, err = process.communicate()
        res = str(out)
        x = datetime.datetime.now()
        if(res.find("unreachable")!= -1):
            text = '{\n"status":"0",\n "hostname":"null",\n "date":"'+x.strftime("%x")+'",\n "time":"'+x.strftime("%X")+'"\n}'
            f = open(address+".json", "w")
            f.write(text);
            print(address, " : unreachable")
        elif(res.find("Request timed out")!= -1):
            try:
                host = socket.gethostbyaddr(address)
                if host[0] != "":
                    text = '{\n"status":"1",\n "hostname":"'+host[0]+'",\n "date":"'+x.strftime("%x")+'",\n "time":"'+x.strftime("%X")+'"\n}'
                    f = open(address+".json", "w")
                    f.write(text);
                    print(address, " : OK")
                else:
                    text = '{\n"status":"2",\n "hostname":"null",\n "date":"'+x.strftime("%x")+'",\n "time":"'+x.strftime("%X")+'"\n}'
                    f = open(address+".json", "w")
                    f.write(text);
                    print(address, " : Request timed out")
            except:
                text = '{\n"status":"2",\n "hostname":"null",\n "date":"'+x.strftime("%x")+'",\n "time":"'+x.strftime("%X")+'"\n}'
                f = open(address+".json", "w")
                f.write(text);
                print(address, " : Request timed out")
        else:
            try:
                host = socket.gethostbyaddr(address)
                text = '{\n"status":"1",\n "hostname":"'+host[0]+'",\n "date":"'+x.strftime("%x")+'",\n "time":"'+x.strftime("%X")+'"\n}'
                f = open(address+".json", "w")
                f.write(text);
                print(address, " : OK")
            except:
                text = '{\n"status":"1",\n "hostname":"null",\n "date":"'+x.strftime("%x")+'",\n "time":"'+x.strftime("%X")+'"\n}'
                f = open(address+".json", "w")
                f.write(text);
                print(address, " : OK")
