function fibonacci(n) {
  var num;
  if (n >= 2) {
    num = fibonacci(n - 1) + fibonacci(n - 2);
  } 
  else {
    num = n
  }
  return num;
}
console.log(fibonacci(6));