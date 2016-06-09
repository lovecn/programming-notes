/**遍历二维数组最外圈 --> 12369874  https://segmentfault.com/q/1010000005659963
 * @param {number[][]}
 * @return {number[]}
 */
var getOuter = function(the2dArr) {
    var result = [];
    var i = j = 0;
    var m = the2dArr.length;
    var n = the2dArr[1].length;
    for(; j < n; j++){
        result.push(the2dArr[i][j]);
    }
    for(j--, ++i; i < m; i++){
        result.push(the2dArr[i][j]);
    }
    for(i--, --j; j >= 0; j--){
        result.push(the2dArr[i][j]);
    }
    for(j++, --i; i > 0; i--){
        result.push(the2dArr[i][j]);
    }
    return result;
};
arr=[[1,2,3],
[4,5,6],
[7,8,9]]
getOuter(arr);//

function wtf(arr) {
  var index = 0, 
      length = arr.length,
      result = [];
  while (true) {
    var item = arr[Math.abs(index)];
    if (index === 0) {
        result = result.concat(item);
    } else if (index == length - 1) {
      index = -index;
      result = result.concat(item.reverse());
    } else {
      var i = index >= 0 ? item.length - 1 : 0;
      result.push(item[i]);
    }
    if (index === -1) {
      break;
    }
    index++;
  }
  return result;
}
