/**
 * SolderBlog — main.js
 * Бургер-меню + прочие глобальные интеракции
 */
(function () {
  'use strict';

  /* ---- БУРГЕР-МЕНЮ ---- */
  var toggle = document.querySelector('.nav-toggle');
  var nav    = document.querySelector('.site-nav');

  if (toggle && nav) {
    toggle.addEventListener('click', function () {
      var expanded = toggle.getAttribute('aria-expanded') === 'true';
      toggle.setAttribute('aria-expanded', String(!expanded));
      nav.classList.toggle('open');
      toggle.setAttribute('aria-label', expanded ? 'Открыть меню' : 'Закрыть меню');
    });

    // Закрываем при нажатии Escape
    document.addEventListener('keydown', function (e) {
      if (e.key === 'Escape' && nav.classList.contains('open')) {
        nav.classList.remove('open');
        toggle.setAttribute('aria-expanded', 'false');
        toggle.focus();
      }
    });
  }

  /* ---- FAQ ---- */
  // HTML-элемент <details> работает нативно,
  // но добавляем плавность через CSS transition.
  // Скрипт только дописывает aria-expanded для совместимости.
  document.querySelectorAll('.faq-item').forEach(function (item) {
    item.addEventListener('toggle', function () {
      var summary = item.querySelector('summary');
      if (summary) summary.setAttribute('aria-expanded', String(item.open));
    });
  });

  /* ---- SMOOTH SCROLL ДЛЯ ЯКОРЕЙ ---- */
  document.querySelectorAll('a[href^="#"]').forEach(function (link) {
    link.addEventListener('click', function (e) {
      var id  = link.getAttribute('href').slice(1);
      var el  = document.getElementById(id);
      if (!el) return;
      e.preventDefault();
      el.scrollIntoView({ behavior: 'smooth', block: 'start' });
      history.pushState(null, '', '#' + id);
    });
  });

})();
