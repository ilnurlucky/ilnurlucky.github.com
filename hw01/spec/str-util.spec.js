describe("Функции для работы со строками:", function() {
  // format
  it("Функция format должна быть определена", function() {
    expect(format).toBeDefined();
  });

  it("Вызов format на правильных параметрах", function() {
    expect(format("Hello, {0} {1}", "JS", "World")).toBe("Hello, JS World");
  });

  it("Вызов format на строке, не содержащей wildcards", function() {
    expect(format("without wildcards", "JS", "World")).toBe("without wildcards");
  });

  it("Вызов format без достаточного количества параметров", function() {
    expect(function(){format("Hello, {0} {1}", "JS");}).toThrow(new Error("Invalid arguments count"));
  });

  // repeat
  it("Функция repeat должна быть определена", function() {
    expect(repeat).toBeDefined();
  });

  it("Вызов repeat на правильных параметрах", function() {
    expect(repeat('hello', 3, '-')).toBe('hello-hello-hello');
    expect(repeat('hello', 3)).toBe('hellohellohello');
    expect(repeat('hello', 0)).toBe('');
  });

  // toGetParams
  it("Функция toGetParams должна быть определена", function() {
    expect(toGetParams).toBeDefined();
  });

  it("Вызов toGetParams на правильных параметрах", function() {
    expect(toGetParams({p1: 1, p2: 'hello'})).toBe('p1=1&p2=hello');
    expect(toGetParams({})).toBe('');
  });

  // formatUrl
  it("Функция formatUrl должна быть определена", function() {
    expect(formatUrl).toBeDefined();
  });

  it("Вызов formatUrl на правильных параметрах", function() {
    expect(formatUrl('http://example.com', {a: 1, b: 2})).toBe('http://example.com?a=1&b=2');
  });

  // startsWith
  it("Функция startsWith должна быть определена", function() {
    expect(startsWith).toBeDefined();
  });

  it("Вызов startsWith на правильных параметрах", function() {
    expect(startsWith('homework', 'home')).toBe(true);
    expect(startsWith('homework', '')).toBe(true);
    expect(startsWith('homework', 'house')).toBe(false);
  });

  // endsWith
  it("Функция endsWith должна быть определена", function() {
    expect(endsWith).toBeDefined();
  });

  it("Вызов endsWith на правильных параметрах", function() {
    expect(endsWith('homework', 'work')).toBe(true);
    expect(endsWith('homework', '')).toBe(true);
    expect(endsWith('homework', 'task')).toBe(false);
  });

});