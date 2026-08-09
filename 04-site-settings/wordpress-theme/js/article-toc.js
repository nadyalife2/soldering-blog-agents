(function () {
  'use strict';

  var tocList = document.getElementById('toc-list');
  var tocSidebar = document.getElementById('toc-sidebar');
  var article = document.querySelector('.article-body');

  if (!tocList || !article) return;

  var headings = article.querySelectorAll('h2, h3');
  if (headings.length < 3) {
    if (tocSidebar) tocSidebar.style.display = 'none';
    return;
  }

  headings.forEach(function (h, i) {
    if (!h.id) h.id = 'section-' + i;
    var li = document.createElement('li');
    li.className = h.tagName === 'H3' ? 'toc__item toc__item--sub' : 'toc__item';
    li.innerHTML = '<a href="#' + h.id + '">' + h.textContent + '</a>';
    tocList.appendChild(li);
  });

  // Подсветка активного раздела
  var observer = new IntersectionObserver(function (entries) {
    entries.forEach(function (entry) {
      var link = tocList.querySelector('a[href="#' + entry.target.id + '"]');
      if (!link) return;
      if (entry.isIntersecting) {
        tocList.querySelectorAll('a').forEach(function (a) { a.classList.remove('active'); });
        link.classList.add('active');
      }
    });
  }, { rootMargin: '-20% 0px -70% 0px' });

  headings.forEach(function (h) { observer.observe(h); });

})();
