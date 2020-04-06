import coderunner
import sys
import datetime
import mysql.connector
conn=mysql.connector.connect(
    host="localhost",
    user="root",
    passwd="",
    database="judgesystem"
)
mycursor=conn.cursor()
src=str(sys.argv[1])
id=str(sys.argv[2])
language =str(sys.argv[3])
user=str(sys.argv[4])
inputfile='../problems/prob'+id+'input.txt'
expected_output='../problems/prob'+id+'output.txt'

#CHECK IF ALREADY SUBMITTED WITH ACCEPTED SOLUTION
sql="SELECT * FROM submissions WHERE prob_id="+id+" AND UID="+user+" AND result='ACC'"
mycursor.execute(sql)
if(len(mycursor.fetchall())>0):
    #POST QUERY TO RESPONSE
    exit(0)

#IF NO ACCEPTED SOLUTIONB IS PRESENT RUN THE PROGRAM

r = coderunner.code(src, language, expected_output, inputfile)
r.run()
print(r.getStatus())
#POST SUBMISSION WORK

keywords={"Accepted":"ACC","Wrong Answer":"WA","Time Limit Exceeded":"TLE","Compilation Error":"CE"}
mycursor.execute("SELECT prob_name FROM problems WHERE prob_id="+id)
result=mycursor.fetchall()
prob_name=result[0][0]
status=keywords[r.getStatus()]
error=r.getError()
run_time=r.getTime()
memory=str(r.getMemory())

sql="INSERT INTO submissions (prob_id,UID,prob_name,Language,run_time,memory,result) VALUES (%s,%s,%s,%s,%s,%s,%s)"
values=(id,user,prob_name,language,run_time,memory,status)
mycursor.execute(sql,values)

if(status=="ACC"):

    #UPDATE SCORE OF USER
    sql="SELECT score from problems WHERE prob_id="+id
    mycursor.execute(sql)
    result=mycursor.fetchall()
    score=result[0][0]
    sql="UPDATE profile SET score = score+"+str(score)+" WHERE UID="+user
    mycursor.execute(sql)

    #CHANGE ACCEPTANCE AND ATTEMPTS
    sql="UPDATE problems SET acceptance =(((acceptance * attempts)+ 1)/(attempts+1)) WHERE prob_id="+id
    mycursor.execute(sql)
    sql="UPDATE problems SET attempts = attempts + 1 WHERE prob_id="+id
    mycursor.execute(sql)
else:
    sql="UPDATE problems SET acceptance =(((acceptance * attempts))/(attempts+1)) WHERE prob_id="+id
    mycursor.execute(sql)
    sql="UPDATE problems SET attempts = attempts + 1 WHERE prob_id="+id
    mycursor.execute(sql)
conn.commit()
