(function () {
  'use strict';

  /* -----------------------------------------------
     БУРГЕР-МЕНЮ
  ----------------------------------------------- */
  var toggle = document.querySelector('.nav-toggle');
  var nav    = document.querySelector('.site-nav');
  if (toggle && nav) {
    toggle.addEventListener('click', function () {
      var open = nav.classList.toggle('open');
      toggle.setAttribute('aria-expanded', String(open));
    });
  }

  /* -----------------------------------------------
     ПЛАВНЫЙ СКРОЛЛ ДЛЯ ОГЛАВЛЕНИЯ
  ----------------------------------------------- */
  document.querySelectorAll('.toc a[href^="#"]').forEach(function (link) {
    link.addEventListener('click', function (e) {
      var target = document.querySelector(this.getAttribute('href'));
      if (target) {
        e.preventDefault();
        target.scrollIntoView({ behavior: 'smooth', block: 'start' });
      }
    });
  });

  /* -----------------------------------------------
     АКТИВНАЯ ССЫЛКА В НАВИГАЦИИ
  ----------------------------------------------- */
  var currentPath = window.location.pathname;
  document.querySelectorAll('.site-nav a').forEach(function (link) {
    if (link.getAttribute('href') === currentPath) {
      link.classList.add('active');
    }
  });

  /* -----------------------------------------------
     ЛЕНИВАЯ ЗАГРУЗКА ИЗОБРАЖЕНИЙ (fallback для старых браузеров)
  ----------------------------------------------- */
  if ('IntersectionObserver' in window) {
    var imgObserver = new IntersectionObserver(function (entries) {
      entries.forEach(function (entry) {
        if (entry.isIntersecting) {
          var img = entry.target;
          if (img.dataset.src) {
            img.src = img.dataset.src;
            img.removeAttribute('data-src');
          }
          imgObserver.unobserve(img);
        }
      });
    }, { rootMargin: '200px' });
    document.querySelectorAll('img[data-src]').forEach(function (img) {
      imgObserver.observe(img);
    });
  }

})();
