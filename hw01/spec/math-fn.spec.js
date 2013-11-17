describe("Математические функции:", function() {

  // multiply
  it("Функция multiply должна быть определена", function() {
    expect(multiply).toBeDefined();
  });

  it("Результат вызова multiply(5, 6) должен быть равен 30", function() {
    expect(multiply(5, 6)).toBe(30);
  });

  it("Вызов multiply без аргументов должен выбрасывать ошибку \"Invalid arguments\"", function() {
    expect(function(){multiply();}).toThrow(new Error("Invalid arguments"));
  });

  it("Вызов multiply на не числовых аргументах должен выбрасывать ошибку \"Invalid arguments\"", function() {
    expect(function(){multiply("1","2");}).toThrow(new Error("Invalid arguments"));
    expect(function(){multiply(1, NaN);}).toThrow(new Error("Invalid arguments"));
    expect(function(){multiply(null, 3);}).toThrow(new Error("Invalid arguments"));
  });

  // factorial
  it("Функция factorial должна быть определена", function() {
    expect(factorial).toBeDefined();
  });

  it("Вызов factorial на правильных параметрах", function() {
    expect(factorial(5)).toBe(120);
  });

  // nfib
  it("Функция nfib должна быть определена", function() {
    expect(nfib).toBeDefined();
  });

  it("Вызов nfib на правильных параметрах", function() {
    expect(nfib(5)).toBe(3);
  });
});
