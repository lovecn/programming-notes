//error
function A() {
    $.ajax({
        url: '/api/test',
        type: 'POST',
        data: {...},
        success: function(res) {
            position = res.position;
        }
    })
}

function B() {
    $('.test').text(position);
}
//done

function A(callback) {
    $.ajax({
        url: '/api/test',
        type: 'POST',
        data: {...},
        success: function(res) {
            position = res.position;
            callback && callback();
        }
    })
}

function B() {
    $('.test').text(position);
}
//A(B);
function first() {
    setTimeout(function() {
        console.log('first');
    }, 2000);
}
function second() {
    console.log('second');
}
//second在first之后执行
function first() {
    // 1
    var defer = $.Deferred();
    setTimeout(function() {
        console.log('first');
        // 2
        defer.resolve();
    }, 2000);
    
    // 3
    return defer.promise();
}
$.when(first())
 .done(second());
 
 // 常规写法
 $.ajax({
     url: '/api/test',
     type: 'POST',
     data: {...},
     success: function(res) {
         // dosomething
     },
     fail: function(res) {
         // dosomething
     },
     complete: function() {
         // dosomething
     }
 })

// 新的写法https://segmentfault.com/a/1190000005607968
$.ajax({
     url: '/api/test',
     type: 'POST',
     ...
 })
 .done(function(res) {
     // success and do something
 })
 .fail(function(res) {
     // fail and do something
 })
 .always(function() {})



