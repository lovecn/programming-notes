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
