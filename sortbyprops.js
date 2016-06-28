function SortByProps(item1, item2) {
    "use strict";
    var props = [];
    for (var _i = 2; _i < arguments.length; _i++) {
        props[_i - 2] = arguments[_i];
    }
        
    var cps = []; // 存储排序属性比较结果。https://segmentfault.com/a/1190000005717963
    // 如果未指定排序属性，则按照全属性升序排序。    
    var asc = true;
    if (props.length < 1) {
        for (var p in item1) {
            if (item1[p] > item2[p]) {
                cps.push(1);
                break; // 大于时跳出循环。
            } else if (item1[p] === item2[p]) {
                cps.push(0);
            } else {
                cps.push(-1);
                break; // 小于时跳出循环。
            }
        }
    } else {
        for (var i = 0; i < props.length; i++) {
            var prop = props[i];
            for (var o in prop) {
                asc = prop[o] === "asc";
                if (item1[o] > item2[o]) {
                    cps.push(asc ? 1 : -1);
                    break; // 大于时跳出循环。
                } else if (item1[o] === item2[o]) {
                    cps.push(0);
                } else {
                    cps.push(asc ? -1 : 1);
                    break; // 小于时跳出循环。
                }
            }
        }
    }        
         
    for (var j = 0; j < cps.length; j++) {
        if (cps[j] === 1 || cps[j] === -1) {
            return cps[j];
        }
    }
    return 0;          
}
 // -------------测试用例------------------------------
    
    var items = [   { name: 'Edward', value: 21 },
                    { name: 'Sharpe', value: 37 },
                    { name: 'And', value: 45 },
                    { name: 'Edward', value: -12 },
                    { name: 'Magnetic', value: 21 },
                    { name: 'Zeros', value: 37 }
                ];
                
    function test(propOrders) {
        items.sort(function (a, b) {
            return SortByProps(a, b, propOrders);
        });
        console.log(items);
    }
    
    function testAsc() {
        test({ "name": "asc", "value": "asc" });
    }
    
    function testDesc() {
        test({ "name": "desc", "value": "desc" });
    }
    
    function testAscDesc() {
        test({ "name": "asc", "value": "desc" });
    }
    
    function testDescAsc() {
        test({ "name": "desc", "value": "asc" });
    }
