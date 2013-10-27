var arr = [1,4,5,7,3,9,15,6,999,1,0,-5,-999];
arr.sort(function(a,b) 
	{return(a-b); });
console.log(arr.join());