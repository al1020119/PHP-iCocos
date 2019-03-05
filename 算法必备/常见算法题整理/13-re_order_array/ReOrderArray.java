/**
 * 1.要想保证原有次序，则只能顺次移动或相邻交换。
 * 2.i从左向右遍历，找到第一个偶数。
 * 3.j从i+1开始向后找，直到找到第一个奇数。
 * 4.将[i,...,j-1]的元素整体后移一位，最后将找到的奇数放入i位置，然后i++。
 * 5.終止條件：j向後遍歷查找失敗。
 */
public void reOrderArray2(int [] a) {
    if(a==null||a.length==0)
        return;
    int i = 0,j;
    while(i<a.length){
        while(i<a.length&&!isEven(a[i]))
            i++;
        j = i+1;
        while(j<a.length&&isEven(a[j]))
            j++;
        if(j<a.length){
            int tmp = a[j];
            for (int j2 = j-1; j2 >=i; j2--) {
                a[j2+1] = a[j2];
            }
            a[i++] = tmp;
        }else{// 查找失敗
            break;
        }
    }
}
boolean isEven(int n){
    if(n%2==0)
        return true;
    return false;
}