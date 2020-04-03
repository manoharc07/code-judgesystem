import coderunner
import sys
src=str(sys.argv[1])
id=str(sys.argv[2])
language = "Python3"
inputfile='../problems/prob'+id+'input.txt'
expected_output='../problems/prob'+id+'output.txt'

r = coderunner.code(src, language, expected_output, inputfile)
r.run()

print("Run r :")
print("Status : " + r.getStatus())
print("Execution Time : " + r.getTime())
print("Memory : " + str(r.getMemory()))
