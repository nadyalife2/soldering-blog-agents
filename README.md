# Soldering Blog Agents

**Три + два агента для автоматического создания и управления SEO-контентом блога о пайке.**

Система генерирует статьи, проверяет их на AI-паттерны, экспортирует в WordPress и создаёт интерактивные инструменты — без бэкенда, без платных API.

---

## Архитектура

```
semantic_core.xlsx  ← единый источник правды
        │
        ├── raw_data        — исходные URL/темы
        ├── clusters        — тематические кластеры
        ├── competitors     — конкурентный анализ
        ├── content_plan    — план публикаций (приоритет, статус)
        ├── interlinking_map — карта перелинковки
        ├── статьи          — готовые тексты
        ├── briefs_ТЗ       — ТЗ + GEO/SEO-брифы (SKILL-04)
        ├── wp_export       — шаблоны для WordPress (SKILL-04 → SKILL-05)
        └── interactive_tools — 13 инструментов (SKILL-05)
```

---

## Агенты (SKILLs)

| # | Файл | Название | Запуск | Что делает |
|---|------|----------|--------|------------|
| 01 | [SKILL-01-seo-researcher.md](./SKILL-01-seo-researcher.md) | solder-seo-researcher | Еженедельно | Собирает ключи, кластеризует, пишет ТЗ в `content_plan` |
| 02 | [SKILL-02-content-analyzer.md](./SKILL-02-content-analyzer.md) | solder-content-analyzer | По запросу | Анализирует конкурентов, находит контентные пробелы |
| 03 | [SKILL-03-article-writer.md](./SKILL-03-article-writer.md) | solder-article-writer | По запросу | Пишет статью по ТЗ из `briefs_ТЗ`, сохраняет в `статьи` |
| 04 | [SKILL-04-article-reviewer.md](./SKILL-04-article-reviewer.md) | solder-article-reviewer | После SKILL-03 | Проверяет 18 AI-паттернов, чеклист, экспортирует в `wp_export` |
| 05 | [SKILL-05-interactive-tools.md](./SKILL-05-interactive-tools.md) | solder-interactive-tools | По запросу `/tool <slug>` | Генерирует HTML/JS-код 13 интерактивных инструментов |

---

## Рабочий процесс

```
1. SKILL-01  →  ключи и ТЗ в content_plan / briefs_ТЗ
2. SKILL-03  →  текст статьи в лист «статьи»
3. SKILL-04  →  проверка + WordPress-шаблон в wp_export
4. SKILL-05  →  /tool <slug> → HTML/JS-код инструмента
5. Публикация в WordPress (вручную или через API)
```

---

## Интерактивные инструменты (SKILL-05)

13 инструментов без бэкенда, без платных сервисов:

### 🔴 Высокий приоритет (делать первыми)
| Slug | Название | UX |
|------|----------|----|
| `/podbor-flyusa/` | Подборщик флюса | Wizard 3 шага |
| `/podbor-pripoya/` | Подборщик припоя | Форма + результат |
| `/kalkulator-temperatury-pajki/` | Калькулятор температуры жала | Слайдеры |
| `/podbor-payalnika/` | Подборщик паяльника | Квиз 4 шага |

### 🟡 Средний приоритет
| Slug | Название | UX |
|------|----------|----|
| `/diagnostika-defekta/` | Диагностика дефекта | Чекбоксы + аккордеон |
| `/tablica-zhala-payalniki/` | Таблица совместимости жал | Фильтруемая таблица |
| `/kalkulator-moschnosti/` | Калькулятор мощности | Форма |
| `/pasta-ili-provod/` | Паста или проволока | Радиокнопки |
| `/test-svoya-pajka/` | Тест «Проверь свою пайку» | Квиз с картинками |

### 🟢 Низкий приоритет
| Slug | Название | UX |
|------|----------|----|
| `/kalkulator-termousadki/` | Калькулятор термоусадки | 3 поля |
| `/sravnenie-stancij/` | Сравнение станций | Мультиселект + таблица |
| `/cheklistt-pered-pajkoj/` | Чеклист перед пайкой | Чекбоксы + прогресс-бар |
| `/glossarij-pajki/` | Глоссарий пайки | Instant search |

---

## Листы semantic_core.xlsx

### `wp_export` — шаблон экспорта в WordPress
Каждая готовая статья из SKILL-04 добавляет строку:
- `H1`, `meta_description`, `[BODY]` в Markdown
- `[FEATURED IMAGE ALT]`, теги из LSI-брифа
- Yoast/RankMath поля: Focus Keyword, SEO Title ≤60 символов, Canonical URL
- Чеклист перелинковки, итог AI-паттернов

### `interactive_tools` — 13 инструментов с приоритетами
Для каждого: входные параметры, выходной результат, тип UX, связанные slug-статьи, технология (JS/React без бэкенда).

### `briefs_ТЗ` — ТЗ + 5 новых GEO/SEO-колонок (SKILL-04)
- `SKILL_04_GEO_SEO_ТЗ` — требования к GEO-оптимизации
- `SKILL_04_Техпроверка` — чеклист перед публикацией
- `SKILL_04_AI_Crawlability` — инструкция по доступности для AI-ботов
- `SKILL_04_Schema_JSONLD` — требования к Schema.org JSON-LD
- `SKILL_04_IndexNow` — инструкция по быстрой индексации

---

## Технические требования

- **Инструменты:** Vanilla JS или React (нет бэкенда, нет платных API)
- **Core Web Vitals:** LCP < 2.5s, нет тяжёлых бандлов
- **Адаптив:** от 320px
- **SEO:** статический HTML-fallback для краулеров
- **AI-боты:** GPTBot, PerplexityBot, ClaudeBot — не блокировать в robots.txt

---

## Статус проекта

| Компонент | Статус |
|-----------|--------|
| SKILL-01 SEO Researcher | ✅ Готов |
| SKILL-02 Content Analyzer | ✅ Готов |
| SKILL-03 Article Writer | ✅ Готов |
| SKILL-04 Article Reviewer | ✅ Готов |
| SKILL-05 Interactive Tools | ✅ Готов (генерация по команде `/tool <slug>`) |
| semantic_core.xlsx — wp_export | ✅ Добавлен |
| semantic_core.xlsx — interactive_tools | ✅ Добавлен (13 инструментов) |
| Первая статья «Как паять паяльником» | ✅ Написана |
