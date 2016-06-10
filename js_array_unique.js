//数组去重
var isFunction = function (fn) {
    return Object.prototype.toString.call(fn) === '[object Function]';
}
 
Array.prototype.distinct = function (keyThunk) {
    var arr = this;
    var dic = {};
    var result = [];
 
    keyThunk = isFunction(keyThunk) ? keyThunk : function (val) {
        return typeof (val) + val;
    }
 
    var hasUnderfined = false;
    var hasNull = false;
    for (var i = 0; i < arr.length; i++) {
        var type = typeof (arr[i]);
 
        if (arr[i] === null) {
            if (hasNull == true) {
                continue;
            }
            hasNull = true;
        }
 
        if (type === "undefined") {
            if (hasUnderfined) {
                continue;
            }
            hasUnderfined = true;
        }
 
        var key = keyThunk(arr[i]);
        if (!dic[key]) {
            dic[key] = arr[i];
            result.push(arr[i]);
        }
    }
    return result;
}
 
var arr = [{ val: 1 }, { val: 1 }, { val: 3 }];
console.log(arr.distinct().map(function (val) {
    return val.val
}));//[1]
console.log(arr.distinct(function (val) {
    return val.val;
}).map(function (val) {
    return val.val;
})) [1,3]

Array.prototype.distinct = function(){
    var arr = this,
        result = [],
        i,
        j,
        len = arr.length;

    for(i = 0; i < len; i++){
        for(j = i + 1; j < len; j++){
            if(arr[i] === arr[j]){
                j = ++i;
            }
        }
        result.push(arr[i]);
    }
    return result;
}
var arra = [1,2,3,4,4,1,1,2,1,1,1];
arra.distinct();             //返回[3,4,2,1]
Array.prototype.distinct = function (){
    var arr = this,
        i,
        j,
        len = arr.length;

    for(i = 0; i < len; i++){
        for(j = i + 1; j < len; j++){
            if(arr[i] == arr[j]){
                arr.splice(j,1);
                len--; // 删除后，数组的长度也减1
                j--;
            }
        }
    }
    return arr;
};

var a = [1,2,3,4,5,6,5,3,2,4,56,4,1,2,1,1,1,1,1,1,];
var b = a.distinct();
console.log(b.toString()); //1,2,3,4,5,6,56

Array.prototype.distinct = function (){
    var arr = this,
        i,
        obj = {},
        result = [],
        len = arr.length;

    for(i = 0; i< arr.length; i++){
        if(!obj[arr[i]]){    //如果能查找到，证明数组元素重复了
            obj[arr[i]] = 1;
            result.push(arr[i]);
        }
    }
    return result;
};

var a = [1,2,3,4,5,6,5,3,2,4,56,4,1,2,1,1,1,1,1,1,];
var b = a.distinct();
console.log(b.toString()); //1,2,3,4,5,6,56
Array.prototype.distinct = function() {
  var arr = this,
      result = [],
      len = arr.length,
  for (var i = 0; i < len; i++) {
    if (result.indexOf(arr[i]) === -1) {
      result.push(arr[i]);
    }
  }
  return result;
};
var a = [1, 2, 3, 4, 2, 3, 54, 1, 2, 3, 2, 4, 5, 0];
var b = a.distinct();    // [1, 2, 3, 4, 54, 5, 0]
