from Pannel import *
from Model import *
from Hole import *
import random
import tkinter
import tkinter.ttk as ttk
import re
from tkinter import messagebox
import time

clickCount = 0

#キャンバス作成
def Cvs():
    global cvs
    cvs = tkinter.Canvas(width=620,height=620,bg="#9acd32")
    cvs.pack()

#スタート画面 
def Start():
    global info,row_area,col_area,x_label,start_btn
    info = tkinter.Label(master=cvs,text="横x縦のマス数を入れてstart",bg="#9acd32")
    info.place(x=230,y=280)
    row_area = tkinter.Entry(master=cvs,width=5)
    row_area.place(x=250,y=300)
    col_area = tkinter.Entry(master=cvs,width=5)
    col_area.place(x=320,y=300)
    x_label = tkinter.Label(master=cvs,text="x",bg="#9acd32")
    x_label.place(x=295,y=300)
    start_btn = tkinter.Button(master=cvs,text="start",command=gatekeeper)
    start_btn.place(x=285,y=330)
    
def mouse_move(e): # マウスが動いた時に実行
    global mouse_x, mouse_y
    mouse_x = e.x # 現在のマウスカーソルのX、Y座標に代入
    mouse_y = e.y
    
#作られる予定のマス数をチェックして過少/過剰に警告を出す
def gatekeeper():
    try:
        inputX = int(row_area.get())
        inputY = int(col_area.get())
        if(inputX<=0 or inputY <=0):
            messagebox.showwarning("","入力値は2以上10以下の整数に限ります")
        elif(inputX==1 or inputY==1):
            messagebox.showwarning("","1列または1行では遊べません")
        elif(inputX>=11 or inputY>=11):
            messagebox.showwarning("","11行or11列を超えると数字が判読できなくなるため、不可としています")
        elif(inputX*inputY<=6 or inputX*inputY>=50):
            res = messagebox.askyesno(title="確認",message="パネルが{}枚になりますが、よろしいですか？".format(inputX*inputY-1))
            if(res):
                kickoff()
            else:
                pass
        else:
            kickoff()
    except:
        messagebox.showwarning("","整数を入力してください")

def shuffleAndCheck():
    flag = 0
    for i in range(row_num*col_num*2):
        cut = random.sample(pannelList,2)
        shuffle(cut[0],cut[1])
    for i in pannelList:
        flag += i.ClearChecker()
    if flag == 0:
        shuffleAndCheck()

#マス作成
def kickoff():
    #パネルインスタンスの準備とシャッフル（今は直接指定でいったん実装）
    global row_num,col_num
    global pannelList
    global hole
    try:
        row_num = int(row_area.get())
        col_num = int(col_area.get())
    except:
        pass
    cvs.create_line(10,10,10,610,width=0.5)
    cvs.create_line(10,10,610,10,width=0.5)
    cvs.create_line(610,10,610,610,width=0.5)
    cvs.create_line(10,610,610,610,width=0.5)
    #マス目のライン作成
    for i in range(0,row_num+1):
        cvs.create_line(i*600/row_num+10,10,i*600/row_num+10,610,width=0.5)
    for j in range(0,col_num+1):
        cvs.create_line(10,j*600/col_num+10,610,j*600/col_num+10,width=0.5)
    #初期ボタンの削除
    info.destroy()
    row_area.destroy()
    col_area.destroy()
    x_label.destroy()
    start_btn.destroy()
    
    #パネルUIの作成
    pannelList=setting(row_num,col_num)
    hole = Hole(row_num-1,col_num-1)

    shuffleAndCheck()

    for i in pannelList:
        createPannel(i.locateX,i.locateY,i.correctX,i.correctY,row_num,col_num)
        
    global startTime,clickCount
    clickCount=0
    startTime = time.time()
    root.bind("<Motion>", mouse_move)
    root.bind("<ButtonPress>", movePannel)
        
#シャッフルしたインスタンスのパラメータ通りにパネルを作る関数
def createPannel(locateX,locateY,correctX,correctY,row_num,col_num):
    rectX1 = locateX*600/row_num
    rectY1 =locateY*600/col_num
    rectX2 = (locateX+1)*600/row_num
    rectY2 =(locateY+1)*600/col_num
    pannelNum = correctX+1+correctY*row_num
    cvs.create_rectangle(rectX1+15,rectY1+15,rectX2+5,rectY2+5,fill="#666666",tag="pannel{}".format(pannelNum))
    cvs.create_rectangle(rectX1+20,rectY1+20,rectX2,rectY2,fill="#696969",tag="pannel{}".format(pannelNum))
    cvs.create_text((rectX1+rectX2)/2+10,(rectY1+rectY2)/2+10,text=pannelNum,font=("HG丸ｺﾞｼｯｸM-PRO",int(min(int((rectX2-rectX1-20)/3),int((rectY2-rectY1-20)/3)))),tag="pannel{}".format(pannelNum))

#パネル移動
def movePannel(self):
    global clickCount
    clickCount += 1
    clicked = pannelSelector(mouse_x,mouse_y,row_num,col_num)
    checker = check(clicked,hole.holeX,hole.holeY)
    try:
        for i in pannelList:
            temp = [i.getLocateX(),i.getLocateY(),i.getCorrectX(),i.getCorrectY()]
            if(checker =="moveX" and temp[1]==clicked[1]):
                ret = i.MoveJudge(clicked,hole.holeX,hole.holeY)
                cvs.move("pannel{}".format(temp[2]+1+temp[3]*row_num),ret*600/row_num,0)
            elif(checker =="moveY" and temp[0]==clicked[0]):
                ret = i.MoveJudge(clicked,hole.holeX,hole.holeY)            
                cvs.move("pannel{}".format(temp[2]+1+temp[3]*row_num),0,ret*600/col_num)
            else:
                pass
        if(checker != "Null"):
            hole.holeX,hole.holeY = clicked[0],clicked[1]
        flag = 0
        for i in pannelList:
            flag += i.ClearChecker()
        if flag == 0:
            global endTime
            endTime = time.time()
            end()
    except:
        pass
        
#クリアウィンドウ
def end():
    global msg_win
    msg_win = tkinter.Toplevel(master=root)
    geo = re.findall(r"\d+",msg_win.master.geometry())
    msg_win.geometry("300x150+{}+{}".format(int(geo[2])+170,int(geo[3])+220))
    msg_win.resizable(False, False)
    msg_win.attributes("-topmost", True)
    msg_win.grab_set()
    msg_win.focus_set()
    msg_win.wm_protocol('WM_DELETE_WINDOW','delfunc() execution')
    label_clr= tkinter.Label(msg_win,text="{}秒、クリック{}回でクリアしました！もう一度？".format(int(endTime-startTime),clickCount))
    label_clr.pack()
    btn1 = tkinter.Button(msg_win,text="マス数を変える",command=restart)
    btn1.place(x=30,y=100)
    btn2 = tkinter.Button(msg_win,text="もう一度プレイ",command=retry)
    btn2.place(x=115,y=100)
    btn3 = tkinter.Button(msg_win,text="ゲームをやめる",command=close)
    btn3.place(x=200,y=100)

def restart():
    global pannelList
    cvs.destroy()
    del pannelList
    Cvs()
    Start()
    msg_win.destroy()
    
def retry():
    cvs.destroy()
    Cvs()
    kickoff()
    msg_win.destroy()
    
def close():
    root.destroy()
    
#ウィンドウ作成+マウス位置とクリックで呼び出す関数指定
root=tkinter.Tk()
root.title("Slide Puzzle")
root.geometry("620x620")
root.resizable(False, False)
Cvs()
Start()
root.mainloop()