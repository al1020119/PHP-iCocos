/*
分析：
2*n的大矩形，和n个2*1的小矩形
其中target*2为大矩阵的大小
有以下几种情形：
1、target <= 0 大矩形为<= 2*0,直接return 1；
2、target = 1大矩形为2*1，只有一种摆放方法，return1；
3、target = 2 大矩形为2*2，有两种摆放方法，return2；
4、target = n 分为两步考虑：
        第一次摆放一块 2*1 的小矩阵，则摆放方法总共为f(target - 1)
第一次摆放一块1*2的小矩阵，则摆放方法总共为f(target-2)
因为，摆放了一块1*2的小矩阵（用√√表示），对应下方的1*2（用××表示）摆放方法就确定了，所以为f(targte-2)
*/

public class Solution {
    public int RectCover(int target) {
        if (target < 1) {
            return 0;
        } else if (target == 1 || target == 2) {
            return target;
        } else {
            return RectCover(target-1) + RectCover(target-2);
        }
    }
}