/*
【过程解析】
1、分析题目
    首先题目给出的是一个二维数组，并且该二维数组是有规律的。每一行向右递增、每一列向下递增。将数组写出来是一个规律矩阵
。因此我们的最优解是从该矩阵的左下角开始遍历判断。
2、结题关键步骤
    假设是j*i的矩阵（二维数组），最开始遍历左下角的数据，大于则j++（向右移）;小于则i--（向上移）
*/
public class SearchInTwoArray {
    public boolean Find(int target, int [][] array) {
        int len = array.length-1;   //列
        int i = 0;                  //行
        while(len >= 0 && i < array[0].length){
            if(array[len][i] > target)
                len--;
            else if(array[len][i] < target)
                i++;
            else
               return true;
        }
        return false;
    }
}