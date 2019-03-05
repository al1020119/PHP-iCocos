
// 第一种方法
/*
使用递归实现
*/

import java.util.ArrayList;

import java.util.ArrayList;
import java.util.Stack;

public class PrintList {
	ArrayList<Integer> arrayList = new ArrayList<Integer>();

	public ArrayList<Integer> printListFromTailToHead(ListNode listNode) {
		if (listNode != null) {
			this.printListFromTailToHead(listNode.next);
			arrayList.add(listNode.val);
		}
		return arrayList;
	}
}

// 第二种方法
/*
 * 使用堆后进先出的原理，进行实现
 */
class PrintList_2 {
	public ArrayList<Integer> printListFromTailToHead(ListNode listNode) {
		Stack<Integer> stack = new Stack<Integer>();
		while (listNode != null) {
			stack.push(listNode.val);
			listNode = listNode.next;
		}

		ArrayList<Integer> list = new ArrayList<Integer>();
		while (!stack.isEmpty()) {
			list.add(stack.pop());
		}
		return list;
	}
}

class ListNode {
	int val;
	ListNode next = null;
	ListNode(int val) {
		this.val = val;
	}
}
