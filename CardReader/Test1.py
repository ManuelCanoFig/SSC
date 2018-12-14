from smartcard.System import readers
from smartcard.util import toHexString
from smartcard.ATR import ATR
from smartcard.CardType import AnyCardType
from smartcard.scard import *



#del metodo readers nos ayuda a encontrar nuestro cardreader
r= readers()
print r

#creamos una conexion con el reader a travez de r[0]
reader = r[0]
print "Using: ", reader

connection = reader.createConnection()
connection.connect()


#intentamos obtener el uid de una tarjeta
getuidx = [0xFF, 0xCA, 0x00, 0x00, 0x00]
data, sw1, sw2 = connection.transmit(getuidx)
print "EL UID ES: " + toHexString(data)
print "Status words: %02X %02X" % (sw1, sw2)
    