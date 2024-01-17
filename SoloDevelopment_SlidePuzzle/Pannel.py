class Pannel:
    def __init__(self,locateX,locateY,correctX,correctY):
        self.locateX = locateX
        self.locateY = locateY
        self.correctX = correctX
        self.correctY = correctY
        
    def getLocateX(self):
        return self.locateX

    def getLocateY(self):
        return self.locateY
        
    def setLocateX(self,locateX):
        self.locateX = locateX
        
    def setLocateY(self,locateY):
        self.locateY =locateY
        
    def getCorrectX(self):
        return self.correctX
    
    def getCorrectY(self):
        return self.correctY
        
    def setCorrectX(self,correctX):
        self.correctX = correctX
    
    def setCorrectY(self,correctY):
        self.correctY = correctY    
        
    
    def ClearChecker(self):
        checker = 1 #実行時にcheckerの総和が0ならクリアにする予定
        if(self.locateX==self.correctX and self.locateY==self.correctY):
            checker = 0
        return checker
        
    def MoveJudge(self,clicked,holeX,holeY):
        if(holeX == self.locateX and abs(clicked[1]-holeY)>=abs(self.locateY-holeY) and ((clicked[1]-holeY)*(self.locateY-holeY))>0):
            return self.MoveY(holeY)
        elif(((clicked[0]-holeX)*(self.locateX-holeX))>0 and abs(clicked[0]-holeX)>=abs(self.locateX-holeX) and holeY == self.locateY):
            return self.MoveX(holeX)
        else:
            return 0

    def MoveX(self,holeX):
        if(holeX > self.locateX):
            self.locateX += 1
            #print("Xは+に動いたはずだよ")
            return 1
        elif(holeX < self.locateX):
            self.locateX -=1
            #print("Xは-に動いたはずだよ")
            return -1
        else:
            print("空きマスと同じX座標を持つパネルが動かされようとして失敗しました")
            
    def MoveY(self,holeY):
        if(holeY > self.locateY):
            self.locateY += 1
            #print("Yは+に動いたはずだよ")
            return 1
        elif(holeY < self.locateY):
            self.locateY -=1
            #print("Yは-に動いたはずだよ")
            return -1
        else:
            print("空きマスと同じY座標を持つパネルが動かされようとして失敗しました")
            