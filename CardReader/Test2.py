from time import sleep
from smartcard.scard import *
from smartcard.util import *
from smartcard.CardMonitoring import CardMonitor, CardObserver
import pymysql.cursors
from connection import sql


connection = pymysql.connect(host='localhost',
                             user='root',
                             password='',
                             db='cardreader',
                             charset='utf8mb4',
                             cursorclass=pymysql.cursors.DictCursor)
 
        
class printobserver( CardObserver ):
    def update( self, observable, (addedcards, removedcards) ):
        try:
            with connection.cursor() as cursor:
                for card in addedcards:
                    if addedcards: 
                        hresult, hcontext = SCardEstablishContext(SCARD_SCOPE_USER)
                        assert hresult==SCARD_S_SUCCESS
                        hresult, readers = SCardListReaders(hcontext, [])
                        assert len(readers)>0
                        reader = readers[0]
                        hresult, hcard, dwActiveProtocol = SCardConnect(
                        hcontext,
                        reader,
                        SCARD_SHARE_SHARED,
                        SCARD_PROTOCOL_T1)
                        hresult, response = SCardTransmit(hcard,dwActiveProtocol,[0xFF,0xCA,0x00,0x00,0x04])
                        uid = toHexString(response, format=0)
                        print uid #tarjeta uid
                        cursor.execute("TRUNCATE TABLE pueba")
                        sql = "INSERT INTO `pueba` (`id`) VALUES (%s)"
                        cursor.execute(sql, (uid))                                      
                        connection.commit()
        finally:
            pass
            
            
print "Coloca una tarjeta en el lector"
    

while 1:
    try:
 
        cardmonitor = CardMonitor()
        cardobserver = printobserver() 

        cardmonitor.addObserver( cardobserver )
        cardmonitor.deleteObserver( cardobserver )
        sleep(0.70)
    except (SystemError,AttributeError) as e:
        print(e)
        sleep(0.10)
        
        
    
    
    
    
    
    

