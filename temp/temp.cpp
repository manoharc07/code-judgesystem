#include<iostream>
using namespace std;
int main(){
    int x,sum=0,n;
    cin>>n;
    for(int i=0;i<n;i++){
        cin>>x;
        sum+=x;
    }
	cout<<sum;
    return 0;
}