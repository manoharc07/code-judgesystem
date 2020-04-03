#include<iostream>
using namespace std;
int main(){
    int n,sum=0,x,i;
    cin>>n;
    for(i=0;i<n;i++){
        cin>>x;
        sum+=x;
    }
    cout<<sum;
    return 0;
}