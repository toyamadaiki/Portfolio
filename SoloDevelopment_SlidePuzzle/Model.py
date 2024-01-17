from Pannel import *

def shuffle(pannelA,pannelB):
    X1 = pannelA.getLocateX()
    X2 = pannelB.getLocateX()
    Y1 = pannelA.getLocateY()
    Y2 = pannelB.getLocateY()
        
    pannelA.setLocateX(X2)
    pannelB.setLocateX(X1)
    pannelA.setLocateY(Y2)
    pannelB.setLocateY(Y1)
    
def setting(X,Y):
    pannelList = []
    for i in range(Y):
        for j in range(X):
            if (i+1)*(j+1) != X*Y:
                pannel = Pannel(j,i,j,i)
                pannelList.append(pannel)
    return pannelList

def pannelSelector(mouse_x,mouse_y,row_num,col_num):
    if(mouse_x<=10 or mouse_y<=10 or mouse_x>610 or mouse_y >610):
        return None
    else:
        NumX = int(mouse_x//(600/row_num))
        NumY = int(mouse_y//(600/col_num))
        clicked = [NumX,NumY]
        if(NumX==row_num or NumY==col_num):
            return None
        else:
            return clicked

def check(click,holeX,holeY):
    try:
        if(click[0]==holeX and click[1] != holeY):
            return "moveY"
        elif(click[0]!=holeX and click[1] == holeY):
            return "moveX"
        else:
            return "Null"
    except:
        return "Null"