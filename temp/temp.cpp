#include<bits/stdc++.h>
using namespace std;
string isBalanced(string s) {
    stack<char> st;
    st.push('@');
    for(int i=0;i<s.length();i++){
        if(s[i]=='(' || s[i]=='[' || s[i]=='{'){
            st.push(s[i]);
            continue;
        }    
        if((s[i]=='}'&&st.top()=='{')||(s[i]==')'&&st.top()=='(')||(s[i]==']'&&st.top()=='['))
            st.pop();
        else {
            return "NO";
        }    
    }
    if(st.top()=='@')
        return "YES";
    return "NO";
}
int main(){
    int t;
    string s;
    cin>>t;
    while(t--){
        cin>>s;
        cout<<isBalanced(s)<<endl;
    }
    return 0;
}