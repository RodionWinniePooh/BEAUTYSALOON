function sortTable(n) {
  var table, rows, switching, i, x, y, shouldSwitch, dir, switchcount = 0;
  table = document.getElementById("myTable");
  switching = true;
  // Установить направление сортировки по возрастанию:
  dir = "asc";
  /* Сделать цикл, который будет продолжаться до
     переключение не было выполнено: */
  while (switching) {
    // Начнем с того, что переключение не выполняется:
    switching = false;
    rows = table.rows;
    /* Перебрать все строки таблицы (кроме
           первый, который содержит заголовки таблицы): */
    for (i = 1; i < (rows.length - 1); i++) {
      // Начнем с того, что не должно быть переключения:
      shouldSwitch = false;
      /* Получить два элемента, которые вы хотите сравнить,
             один из текущего ряда и один из следующего: */
      x = rows[i].getElementsByTagName("TD")[n];
      y = rows[i + 1].getElementsByTagName("TD")[n];
      /* Проверьте, должны ли два ряда поменяться местами,
             в зависимости от направления, asc или desc: */
      if (dir == "asc") {
        if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
          // Если это так, пометить как переключатель и разорвать цикл:
          shouldSwitch = true;
          break;
        }
      } else if (dir == "desc") {
        if (x.innerHTML.toLowerCase() < y.innerHTML.toLowerCase()) {
          // Если это так, пометить как переключатель и разорвать цикл:
          shouldSwitch = true;
          break;
        }
      }
    }
    if (shouldSwitch) {
      /* Если переключатель был отмечен, сделайте переключатель
             и отметьте, что переключение было сделано: */
      rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
      switching = true;
      // Каждый раз, когда выполняется переключение, увеличиваем это число на 1:
      switchcount++;
    } else {
      /* Если переключение не было выполнено И направление "asc",
             установите направление на «desc» и снова запустите цикл while. */
      if (switchcount == 0 && dir == "asc") {
        dir = "desc";
        switching = true;
      }
    }
  }
}
