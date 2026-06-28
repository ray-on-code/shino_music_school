/**
 * WP Simple Booking Calendar - 曜日の色分け補助
 *
 * 開始曜日設定（月曜始まり/日曜始まり）に依存せず、見出しの「日」「土」の
 * 列を検出して該当列にクラスを付与する。月送りのAJAX再描画後にも再適用する。
 */
(function () {
  "use strict";

  function labelToClass(text) {
    var t = (text || "").trim();
    if (t === "日") {
      return "wpsbc-sun";
    }
    if (t === "土") {
      return "wpsbc-sat";
    }
    return "";
  }

  function applyTable(table) {
    var headCells = table.querySelectorAll("thead th");
    if (!headCells.length) {
      return;
    }

    var columnClass = {};
    Array.prototype.forEach.call(headCells, function (th, index) {
      var cls = labelToClass(th.textContent);
      if (cls) {
        columnClass[index] = cls;
        th.classList.add(cls);
      }
    });

    Array.prototype.forEach.call(table.querySelectorAll("tbody tr"), function (row) {
      var cells = row.children;
      Object.keys(columnClass).forEach(function (index) {
        var cell = cells[index];
        if (cell) {
          cell.classList.add(columnClass[index]);
        }
      });
    });
  }

  function applyAll(root) {
    var scope = root || document;
    Array.prototype.forEach.call(
      scope.querySelectorAll(".wpsbc-container table"),
      applyTable
    );
  }

  function init() {
    applyAll(document);

    // 月送り（AJAX）でテーブルが差し替わった後も再適用する。
    // クラス付与は属性変更なので childList のみ監視すればループしない。
    Array.prototype.forEach.call(
      document.querySelectorAll(".wpsbc-container"),
      function (container) {
        var observer = new MutationObserver(function () {
          applyAll(container);
        });
        observer.observe(container, { childList: true, subtree: true });
      }
    );
  }

  if (document.readyState === "loading") {
    document.addEventListener("DOMContentLoaded", init);
  } else {
    init();
  }
})();
