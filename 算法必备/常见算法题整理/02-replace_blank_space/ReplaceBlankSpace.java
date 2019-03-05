// 方法一
public class ReplaceBlankSpace {
    public String replaceSpace(StringBuffer str) {
        if(str == null){
            return null;
        }
        StringBuilder newStr = new StringBuilder();   //可变字符
        //遍历字符串查找
        for(int i=0;i<str.length();i++){
            if(str.charAt(i)==' '){
                newStr.append('%');
                newStr.append('2');
                newStr.append('0');
            }else{
                newStr.append(str.charAt(i));
            }
        }
        return newStr.toString();
    }
}

// 方法二
/*
问题1：替换字符串，是在原来的字符串上做替换，还是新开辟一个字符串做替换！
问题2：在当前字符串替换，怎么替换才更有效率（不考虑java里现有的replace方法）。
      从前往后替换，后面的字符要不断往后移动，要多次移动，所以效率低下
      从后往前，先计算需要多少空间，然后从后往前移动，则每个字符只为移动一次，这样效率更高一点。
*/
class ReplaceBlankSpace_2 {
    public String replaceSpace(StringBuffer str) {
        int spacenum = 0;                            //spacenum为计算空格数
        for(int i=0;i<str.length();i++){
            if(str.charAt(i)==' ')
                spacenum++;
        }
        int indexold = str.length()-1;                //indexold为为替换前的str下标
        int newlength = str.length() + spacenum*2;    //计算空格转换成%20之后的str长度
        int indexnew = newlength-1;                   //indexold为为把空格替换为%20后的str下标
        str.setLength(newlength);                     //使str的长度扩大到转换成%20之后的长度,防止下标越界
        for(;indexold>=0 && indexold<newlength;--indexold){ 
                if(str.charAt(indexold) == ' '){
                str.setCharAt(indexnew--, '0');
                str.setCharAt(indexnew--, '2');
                str.setCharAt(indexnew--, '%');
                }else{
                    str.setCharAt(indexnew--, str.charAt(indexold));
                }
        }
        return str.toString();
    }
}