#import smartcard.System
#print smartcard.System.listreaders()
from smartcard.System import readers
print readers()
#['ACS ACR122U 00 00']

"""
Smart Cards
Monitoring Smart Cards

You can monitor the insertion or removal of cards using the CardObserver interface.

To monitor card insertion and removal, create a CardObserver object that implements an update() method that will be called upon card insertion/removal. The following sample code implements a CardObserver that simply prints the inserted/removed cards on the standard output, named printobserver. To monitor card insertion/removal, simply add the card observer to the CardMonitor:
"""

"""
Sample script that monitors smartcard insertion/removal.

__author__ = "http://www.gemalto.com"

Copyright 2001-2012 gemalto
Author: Jean-Daniel Aussel, mailto:jean-daniel.aussel@gemalto.com

This file is part of pyscard.

pyscard is free software; you can redistribute it and/or modify
it under the terms of the GNU Lesser General Public License as published by
the Free Software Foundation; either version 2.1 of the License, or
(at your option) any later version.

pyscard is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU Lesser General Public License for more details.

You should have received a copy of the GNU Lesser General Public License
along with pyscard; if not, write to the Free Software
Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
"""

from time import sleep
from smartcard.scard import *
from smartcard.util import *
from smartcard.CardMonitoring import CardMonitor, CardObserver
from smartcard.util import toHexString
from smartcard.System import readers
from smartcard.ATR import ATR
from smartcard.CardType import AnyCardType
import sys

if len(sys.argv) < 2:
    print "usage: nfcTool.py <command>\nList of available commands: help, mute, unmute, getuid, info, loadkey, read, firmver"
    sys.exit()

r = readers()
if len(r) < 1:
    print "error: No readers available!"
    sys.exit()

print "Available readers: ", r

reader = r[0]
print "Using: ", reader

connection = reader.createConnection()
connection.connect()
# a simple card observer that prints inserted/removed cards
class PrintObserver(CardObserver):
    """A simple card observer that is notified
    when cards are inserted/removed from the system and
    prints the list of cards
    """
   
    def update(self, observable, actions):
        (addedcards, removedcards) = actions
        data, sw1, sw2 = connection.transmit([0xFF, 0xCA, 0x00, 0x00, 0x00])
        for card in addedcards:
            print "getuid:" + toHexString(data)
            #print("+Inserted: ", toHexString(card.atr))
        for card in removedcards:
            print("-Removed: ", toHexString(data))

if __name__ == '__main__':
    print("Insert or remove a smartcard in the system.")
    print("This program will exit in 10 seconds")
    print("")
    cardmonitor = CardMonitor()
    cardobserver = PrintObserver()
    cardmonitor.addObserver(cardobserver)

    sleep(10)

    # don't forget to remove observer, or the
    # monitor will poll forever...
    cardmonitor.deleteObserver(cardobserver)

    import sys
    if 'win32' == sys.platform:
        print('press Enter to continue')
        sys.stdin.read(1)



