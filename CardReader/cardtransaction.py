from __future__ import print_function
from smartcard.scard import *

try:
    hresult, hcontext = SCardEstablishContext(SCARD_SCOPE_USER)
    if hresult != SCARD_S_SUCCESS:
        raise error(
            'Failed to establish context: ' + \
            SCardGetErrorMessage(hresult))
    print('Context established!')

    try:
        hresult, readers = SCardListReaders(hcontext, [])
        if hresult != SCARD_S_SUCCESS:
            raise error(
                'Failed to list readers: ' + \
                SCardGetErrorMessage(hresult))
        print('PCSC Readers:', readers)

        if len(readers) < 1:
            raise error('No smart card readers')

        for zreader in readers:
            print('Trying to perform transaction on card in', zreader)

            try:
                hresult, hcard, dwActiveProtocol = SCardConnect(
                    hcontext,
                    zreader,
                    SCARD_SHARE_SHARED,
                    SCARD_PROTOCOL_T0 | SCARD_PROTOCOL_T1)
                if hresult != SCARD_S_SUCCESS:
                    raise error(
                        'unable to connect: ' + \
                        SCardGetErrorMessage(hresult))
                print('Connected with active protocol', dwActiveProtocol)

                try:
                    hresult = SCardBeginTransaction(hcard)
                    if hresult != SCARD_S_SUCCESS:
                        raise error(
                            'failed to begin transaction: ' + \
                            SCardGetErrorMessage(hresult))
                    print('Beginning transaction')

                    hresult, reader, state, protocol, atr = SCardStatus(hcard)
                    if hresult != SCARD_S_SUCCESS:
                        raise error(
                            'failed to get status: ' + \
                            SCardGetErrorMessage(hresult))
                    print('ATR:', end=' ')
                    for i in range(len(atr)):
                        print("0x%.2X" % atr[i], end=' ')
                    print("")

                finally:
                    hresult = SCardEndTransaction(hcard, SCARD_LEAVE_CARD)
                    if hresult != SCARD_S_SUCCESS:
                        raise error(
                            'failed to end transaction: ' + \
                            SCardGetErrorMessage(hresult))
                    print('Transaction ended')

                    hresult = SCardDisconnect(hcard, SCARD_UNPOWER_CARD)
                    if hresult != SCARD_S_SUCCESS:
                        raise error(
                            'failed to disconnect: ' + \
                            SCardGetErrorMessage(hresult))
                    print('Disconnected')
            except error as message:
                print(error, message)

    finally:
        hresult = SCardReleaseContext(hcontext)
        if hresult != SCARD_S_SUCCESS:
            raise error(
                'failed to release context: ' + \
                SCardGetErrorMessage(hresult))
        print('Released context.')

except error as e:
    print(e)

import sys
if 'win32' == sys.platform:
    print('press Enter to continue')
    sys.stdin.read(1)