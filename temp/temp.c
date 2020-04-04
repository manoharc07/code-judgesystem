#include<stdio.h>
int main(){
    int i,n,x,sum=0;
    scanf("%d",&n);
    for(i=0;i<n;i++){
        scanf("%d",&x);
        sum+=x;
    }
    printf("%d",sum);
    return 0;
}