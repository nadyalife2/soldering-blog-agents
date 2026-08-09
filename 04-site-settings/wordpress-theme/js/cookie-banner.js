/**
 * SolderBlog — cookie-banner.js
 * Показывает баннер если не было ответа.
 * При «Принять» запускает Яндекс Метрику (если ID задан).
 */
(function () {
  'use strict';

  var COOKIE_KEY = 'sb_cookie_consent';

  function getCookie(name) {
    var match = document.cookie.match(new RegExp('(?:^|; )' + name + '=([^;]*)'));
    return match ? decodeURIComponent(match[1]) : null;
  }
  function setCookie(name, value, days) {
    var d = new Date();
    d.setTime(d.getTime() + days * 24 * 60 * 60 * 1000);
    document.cookie = name + '=' + encodeURIComponent(value) + '; expires=' + d.toUTCString() + '; path=/; SameSite=Lax';
  }

  if (getCookie(COOKIE_KEY)) return;

  // Получаем строки из wp_localize_script
  var S  = (typeof SolderBlog !== 'undefined' && SolderBlog.strings) ? SolderBlog.strings : {};
  var privacyUrl = (typeof SolderBlog !== 'undefined') ? SolderBlog.privacyUrl : '/privacy/';

  var text    = S.cookieText    || 'Мы используем куки для аналитики.';
  var accept  = S.cookieAccept  || 'Принять';
  var decline = S.cookieDecline || 'Отказаться';
  var prLink  = S.privacyLink   || 'Политика конфиденциальности';

  // Создаём баннер
  var banner = document.createElement('div');
  banner.className = 'cookie-banner';
  banner.setAttribute('role', 'dialog');
  banner.setAttribute('aria-label', 'Cookie');
  banner.innerHTML =
    '<p class="cookie-banner__text">' + text +
    ' <a href="' + privacyUrl + '" class="cookie-banner__link">' + prLink + '</a></p>' +
    '<div class="cookie-banner__actions">' +
    '<button class="btn btn--primary btn--sm" id="sb-cookie-accept">' + accept + '</button>' +
    '<button class="btn btn--sm cookie-banner__decline" id="sb-cookie-decline">' + decline + '</button>' +
    '</div>';

  document.body.appendChild(banner);

  // Анимация появления
  requestAnimationFrame(function () {
    requestAnimationFrame(function () { banner.classList.add('visible'); });
  });

  function dismiss(value) {
    setCookie(COOKIE_KEY, value, 365);
    banner.classList.remove('visible');
    setTimeout(function () { banner.remove(); }, 300);
  }

  document.getElementById('sb-cookie-accept').addEventListener('click', function () {
    dismiss('accepted');
    // Если Яндекс Метрика уже загружена — разрешаем отслеживание
    if (typeof ym === 'function') ym('reachGoal', 'cookie_accepted');
  });

  document.getElementById('sb-cookie-decline').addEventListener('click', function () {
    dismiss('declined');
  });

  // Закрытие по Escape
  document.addEventListener('keydown', function handler(e) {
    if (e.key === 'Escape') { dismiss('dismissed'); document.removeEventListener('keydown', handler); }
  });

})();
