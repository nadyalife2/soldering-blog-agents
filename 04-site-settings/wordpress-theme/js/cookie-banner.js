(function () {
  'use strict';

  var CONSENT_KEY = 'sb_cookie_consent';
  var CONSENT_VAL = '1';

  // Проверяем, дано ли согласие ранее
  function hasConsent() {
    return document.cookie.split(';').some(function (c) {
      return c.trim().startsWith(CONSENT_KEY + '=');
    });
  }

  // Записываем куку на 365 дней
  function setConsent() {
    var expires = new Date();
    expires.setFullYear(expires.getFullYear() + 1);
    document.cookie =
      CONSENT_KEY + '=' + CONSENT_VAL +
      '; expires=' + expires.toUTCString() +
      '; path=/; SameSite=Lax';
  }

  // Удаляем куку (отказ)
  function revokeConsent() {
    document.cookie =
      CONSENT_KEY + '=; expires=Thu, 01 Jan 1970 00:00:00 GMT; path=/; SameSite=Lax';
  }

  // Создаём баннер
  function createBanner() {
    var banner = document.createElement('div');
    banner.className = 'cookie-banner';
    banner.setAttribute('role', 'dialog');
    banner.setAttribute('aria-label', 'Согласие на использование cookies');
    banner.setAttribute('aria-live', 'polite');
    banner.innerHTML =
      '<p>Мы используем куки для аналитики (Яндекс.Метрика) и улучшения сайта.' +
      ' <a href="/privacy/" target="_blank" rel="noopener">Политика конфиденциальности</a>.</p>' +
      '<div class="cookie-banner__actions">' +
      '<button class="btn btn--primary btn--sm js-cookie-accept">Принять</button>' +
      '<button class="btn btn--secondary btn--sm js-cookie-decline">Отказаться</button>' +
      '</div>';
    return banner;
  }

  // Инициализация Метрики (если функция определена в functions.php)
  function initMetrika() {
    if (typeof window.solderblog_init_ym === 'function') {
      window.solderblog_init_ym();
    }
  }

  // Показываем баннер
  function showBanner() {
    var banner = createBanner();
    document.body.appendChild(banner);

    banner.querySelector('.js-cookie-accept').addEventListener('click', function () {
      setConsent();
      initMetrika();
      banner.remove();
    });

    banner.querySelector('.js-cookie-decline').addEventListener('click', function () {
      revokeConsent();
      banner.remove();
    });
  }

  // Точка входа
  document.addEventListener('DOMContentLoaded', function () {
    if (hasConsent()) {
      initMetrika(); // Метрика уже разрешена ранее
    } else {
      showBanner();
    }
  });

})();
