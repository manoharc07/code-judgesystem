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
    print(user+" ALREADY SUBMITTED PROBLEM:"+id+" IN "+language)
    status="none"

else:

    #IF NO ACCEPTED SOLUTIONB IS PRESENT RUN THE PROGRAM
    r = coderunner.code(src, language, expected_output, inputfile)
    r.run()
    #POST SUBMISSION WORK
    keywords={"Accepted":"ACC","Wrong Answer":"WA","Time Limit Exceeded":"TLE","Compilation Error":"CE"}
    mycursor.execute("SELECT prob_name FROM problems WHERE prob_id="+id)
    result=mycursor.fetchall()
    prob_name=result[0][0]
    if(r.getStatus() in keywords.keys()):
        status=keywords[r.getStatus()]
    else:
        status="RE"
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
    print(user+" SUBMITTED PROBLEM:" +id+" in "+language+" Result:"+status)
conn.commit()


file=open(r"..\temp\output.html","w")
file.write(r'<script src="https://kit.fontawesome.com/f7f3f5bec2.js" crossorigin="anonymous"></script>')
file.write('\n')

if status=="ACC":
    file.write('<div class="success-msg"><i class="fa fa-check"></i><p class="mssg">Testcase Passed. Your program ran in '+run_time+'s with memory '+memory+' Bytes.<br>You have been awared '+str(score)+' points.</p></div>')
elif status=="none":
    file.write('<div class="info-msg"><i class="fa fa-info-circle"></i><p class="mssg">Looks like you already solved the problem.<br>That\'s a good thing, Check out other problems and Rank up!</p></div>')
elif status=="WA":
    file.write('<div class="error-msg"><i class="fas fa-exclamation-triangle"></i><p class="mssg">Wrong Answer. Testcase validation failed.</p></div>')
elif status=="TLE":
    file.write('<div class="error-msg"><i class="fas fa-exclamation-triangle"></i><p class="mssg">Time Limit Exceeded<br>Your program is taking more than 1 sec for Testcase validation. Optimize your code and submit again.<br>Tip:Did you think about boundary case?</p></div>')
else:
    file.write('<div class="error-msg"><i class="fas fa-exclamation-triangle"></i><p class="mssg">Error<br>There seems to be Errors in your code, Please correct them and submit again.This might be Compilation Error or Runtime Error.</p></div>')
file.close()
