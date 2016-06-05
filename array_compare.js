var arr1 = [{id:1,name:"a",y:true},{id:2,name:"b",y:true},{id:3,name:"c",y:true},{id:4,name:"d",y:true},{id:5,name:"e",y:true}];
var arr2 = [{id:1,name:"a",y:true},{id:2,name:"b",y:true},{id:4,name:"b",y:true}];
//https://segmentfault.com/q/1010000004329153
var x = [];

arr1.forEach(v => x[v.id] = v);

arr2.forEach(v => x[v.id] && (x[v.id].y = false));

x = null;

console.log(arr1);  
