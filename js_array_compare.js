var arr1 = [
    "574417bc79df540065d92df7",
    "574424e5df0eea0063adefc6",
    "57442329a3413100625f194f",
    "5744242bc4c971005d5ff04e",
    "574a841d1532bc006068c6c9",
    "574a97fe2b51e90056e423c0"
];
var arr2 = [
    "574417bc79df540065d92df7",
    "57442329a3413100625f194f",
    "5744242bc4c971005d5ff04e",
    "574424e5df0eea0063adefc6",
    "574a841d1532bc006068c6c9"
];
var lessArr,maxArr;
if(arr1.length>arr2.length) {
    lessArr = arr2; 
    maxArr = arr1; 
}else{
    lessArr = arr1; 
    maxArr = arr2; 
}
var lessStr = lessArr.join('|');
var diffArr = [];
for(var i=0;i<maxArr.length;i++) {
    if(lessStr.indexOf(maxArr[i]) == -1) {
        diffArr.push(maxArr[i]);
    }
}
console.log(diffArr.join(','));//"574a97fe2b51e90056e423c0"

const ans = [], temp = {};
for(let i = 0; i < arr1.length; i++) {
    temp[arr1[i]] = true;
}
for(let i = 0; i < arr2.length; i++) {
    if(!temp.hasOwnProperty(arr2[i])) {
        ans.push(arr2[i]);
    }
}

var arr1 = [1,2,3];
var arr2 = [1,4,5];

_.difference(arr1, arr2);    //返回存在于arr1中，而不存在于arr2中的元素集合 https://segmentfault.com/q/1010000005662869
// return [2,3]

采用es6的Set结构
var set = new Set(arr2);
arr1.filter(v=>!set.has(v));
