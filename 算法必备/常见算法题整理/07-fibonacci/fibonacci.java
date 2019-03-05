/*
1、尽量避免使用递归，当系统采用一个超大的n来测试时将会Stack Overflow
2、使用迭代方式
*/
public class fibonacci {
    public int Fibonacci(int n) {         
        int fn1 = 1;
        int fn2 = 1;  
        //考虑出错情况
        if (n <= 0) {
            return 0;
        }
        //第一和第二个数直接返回
        if (n == 1 || n == 2) {
            return 1;
        }
        //当n>=3时，走这里，用迭代法算出结果
        //这里也说明了，要用三个数操作的情况，其实也可以简化为两
        //个数，从而节省内存空间
        while (n-- > 2) {
            fn1 += fn2;
            fn2 = fn1 - fn2;
        }
        return fn1;
    }
}