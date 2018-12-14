import pymysql.cursors

connection = pymysql.connect(host='localhost',
                             user='root',
                             password='',
                             db='cardreader',
                             charset='utf8mb4',
                             cursorclass=pymysql.cursors.DictCursor)

try:
    with connection.cursor() as cursor:
        # Create a new record
        sql = "SELECT * FROM pueba WHERE 1"
        cursor.execute(sql)
        result = cursor.fetchone()
        print(result)
    connection.commit()
finally:
    pass