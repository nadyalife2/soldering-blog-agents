# SolderBlog — Figma Design System

> Файл создаётся вручную по этой инструкции.
> Ссылка на созданный файл появится здесь после создания.

**Figma URL:** _заполнить после создания_

---

## Шаг 1. Создать файл

1. Открой [figma.com](https://figma.com)
2. Новый файл → название: **SolderBlog UI**
3. Структура страниц (в панели слева):

```
📌 00 — Cover
🎨 01 — Tokens & Styles
🧩 02 — Components
🖥 03 — Desktop Frames
📱 04 — Mobile Frames
🔄 05 — States & Interactions
```

---

## Шаг 2. Токены цвета (Local Variables)

Панель → Local variables → Create collection: **Palette**

| Название переменной | HEX | Описание |
|---|---|---|
| `bg/page` | `#FDFAF6` | Фон страницы |
| `bg/surface` | `#FFFFFF` | Карточки, шапка |
| `bg/tag` | `#F5F0E8` | Теги, оглавление |
| `text/primary` | `#1A1A18` | Основной текст |
| `text/secondary` | `#4A4A45` | Мета, описания |
| `accent/hot` | `#D4571E` | Жало, CTA-кнопки |
| `accent/amber` | `#F0A500` | Припой, ссылки в куки |
| `border/default` | `#E2DDD5` | Границы |
| `warn/bg` | `#FEF7E6` | Предупреждение |
| `warn/border` | `#F5C842` | Граница предупреждения |
| `danger/bg` | `#FEF0EE` | Ошибка/опасность |
| `code/bg` | `#1E1E1A` | Фон кода |

---

## Шаг 3. Текстовые стили

Local styles → Text styles:

| Название | Шрифт | Размер | Начертание | Линейная |
|---|---|---|---|---|
| `Heading/H1` | Bitter | 40 | Bold | 50 |
| `Heading/H2` | Bitter | 30 | SemiBold | 38 |
| `Heading/H3` | Bitter | 20 | SemiBold | 26 |
| `Body/Regular` | Inter | 17 | Regular | 29 |
| `Body/Small` | Inter | 15 | Regular | 25 |
| `Body/XSmall` | Inter | 13 | Regular | 20 |
| `Label/Medium` | Inter | 15 | Medium | 22 |
| `Label/Small` | Inter | 13 | Medium | 19 |
| `Code` | JetBrains Mono | 14 | Regular | 22 |

---

## Шаг 4. Эффекты (Effect styles)

| Название | Тип | Параметры |
|---|---|---|
| `Shadow/Card` | Drop shadow | X:2 Y:3 Blur:0 Spread:0 #000 10% |
| `Shadow/Hover` | Drop shadow | X:3 Y:5 Blur:0 Spread:0 #000 14% |
| `Shadow/Cookie` | Drop shadow | X:3 Y:5 Blur:0 Spread:0 #000 25% |

> Скетч-эффект: Blur=0 даёт жёсткую тень, как у нарисованной от руки рамки.

---

## Шаг 5. Компоненты (02 — Components)

### 5.1 Header

**Фрейм:** 1440 × 64px, цвет: `bg/surface`, граница снизу: `border/default`

```
Header
├─ Logo (Auto layout, gap 8)
│   ├─ Icon 32×32 (жало паяльника, SVG)
│   └─ Text: Пайка<span accent>Блог</span>  ← Bitter Bold 22
├─ Nav (Auto layout, gap 4)
│   ├─ NavItem: Статьи
│   ├─ NavItem: Инструменты
│   ├─ NavItem: Гайды
│   ├─ NavItem: О сайте
│   └─ NavItem--CTA: Подборщик   ← bg: accent/hot, цвет: white
└─ BurgerIcon (мобильная версия, скрыт по умолчанию)
```

**NavItem** (компонент с вариантами):
- Default: bg transparent, text `text/secondary`
- Hover/Active: bg `bg/tag`, text `text/primary`
- Паддинг: 6px 14px, радиус: 4px

---

### 5.2 Footer

**Фрейм:** 1440 × auto, `bg/surface`, граница сверху: `border/default`

```
Footer
├─ FooterGrid (3 столбца, gap 32, padding 40px 24px)
│   ├─ Col 1: О сайте
│   │   ├─ Logo
│   │   └─ Описание (макс 200px)
│   ├─ Col 2: Разделы
│   │   ├─ Title: SECTIONS (Label/Small, text/secondary, uppercase)
│   │   └─ Links...
│   └─ Col 3: Полезное
│       ├─ Title: TOOLS
│       └─ Links...
└─ FooterBottom (border top, 1px `border/default`)
    ├─ Copyright ← Body/XSmall, text/secondary
    └─ Links: Политика | Куки
```

---

### 5.3 PostCard

**Фрейм:** 340 × auto  
**Вид:** Auto layout, direction: vertical, gap 12, padding 22px 24px  
**Фон:** `bg/surface`  
**Border:** 1px `border/default`, radius 6px  
**Shadow:** `Shadow/Card`

```
PostCard
├─ Thumbnail (16:9, radius 5px)
│   └─ [sketch image placeholder]
├─ Meta (Auto layout, gap 8)
│   ├─ Tag (компонент)
│   └─ ReadTime ← Body/XSmall, text/secondary
├─ Title ← Heading/H3, 2 строки
├─ Excerpt ← Body/Small, text/secondary, 3 строки
└─ ReadMore ← Label/Small, accent/hot
```

**States:** Default → Hover (translateY -2px, Shadow/Hover)

---

### 5.4 Button

**Варианты:** Primary, Secondary, Small  
**Auto layout:** gap 8, padding 10px 20px (sm: 6px 14px), radius 4px

| Вариант | Фон | Текст |
|---|---|---|
| Primary | `accent/hot` | White |
| Secondary | `bg/tag` | `text/primary` + border `border/default` |
| Ghost | transparent | `accent/hot` + border `accent/hot` |

---

### 5.5 Tag

**Auto layout:** gap 0, padding 3px 10px, radius 3px  
**Default:** bg `bg/tag`, border `border/default`, text `text/secondary`, Label/Small  
**Accent:** bg `#FEF0E6`, border `#F5C9A8`, text `accent/hot`

---

### 5.6 Cookie Banner

**Фрейм:** 560 × auto, позиция: fixed bottom center  
**Фон:** `#1A1A18` (text/primary)  
**Border radius:** 8px  
**Shadow:** X:3 Y:5 Blur:0 #000 25%  
**Padding:** 18px 24px

```
CookieBanner
├─ Text (Body/Small, white 90%)
│   └─ Link “Политика” ← accent/amber
└─ Actions (Auto layout, gap 10)
    ├─ Button: Принять ← Primary sm
    └─ Button: Отказаться ← bg transparent, border white/25%, text white/75%
```

---

### 5.7 Callout (предупреждение)

**Варианты:** Warn, Danger, Info  
**Auto layout:** direction horizontal, gap 14, padding 16px 20px, radius 6px

```
Callout
├─ Icon ← 24px emoji (⚠️ для warn, ❗ для danger, ℹ️ для info)
└─ Content
    ├─ Title ← Label/Medium, text/primary (optional)
    └─ Text ← Body/Small, text/secondary
```

---

### 5.8 TOC (оглавление)

**Фон:** `bg/tag`, border `border/default`, radius 6px, padding 20px 24px

```
TOC
├─ Title: Содержание ← Label/Medium, text/primary
└─ List (numbered, gap 6)
    └─ TOCItem ← Body/Small, text/secondary
```

---

### 5.9 FAQ Item

**Border bottom:** 1px `border/default`  
**Padding:** 14px 0

```
FAQItem
├─ Summary (Auto layout, justify space-between)
│   ├─ Question ← Label/Medium, text/primary
│   └─ Icon “+” / “−” ← accent/hot, 18px
└─ Answer (Body/Small, text/secondary, padding-top 10px) ← скрыт по умолчанию
```

---

### 5.10 InteractiveTool Result

**Фон:** `bg/tag`, border-left 3px `accent/hot`, border остальные: `border/default`  
**Radius:** 6px, padding 20px 24px

```
ToolResult
├─ Title ← Heading/H3
└─ Body ← Body/Regular
```

---

## Шаг 6. Desktop фреймы (03 — Desktop Frames)

Создай фреймы 1440 × auto, bg: `bg/page`:

```
① Home — главная страница
   Header
   Hero (2 колонки: текст + sketch-иллюстрация)
   Секция “Последние статьи” (PostCards x3)
   Секция “Инструменты” (PostCards x4 маленькие)
   Footer

② Article — страница статьи
   Header
   Breadcrumbs
   ArticleLayout (2 колонки: контент + sidebar)
   Footer

③ Tool — интерактивный инструмент
   Header
   Breadcrumbs
   H1 + описание
   ToolForm
   ToolResult
   Related articles
   Footer

④ Category — категория
   Header
   H1 + описание
   PostCards grid
   Footer

⑤ Privacy — политика
   Header
   ContentPage (одна колонка, max-width 760px)
   Footer
```

---

## Шаг 7. Overlays (всплывающие)

На отдельном фрейме (800×auto) рядом с Desktop:

```
① CookieBanner — в низу по центру, fixed
② MobileMenu — навигация на мобильных (ширина 100%, сверху)
```

---

## Шаг 8. Mobile фреймы (04 — Mobile Frames)

Создай фреймы 390 × auto (iPhone 14 Pro):

```
① Mobile Home
② Mobile Article
③ Mobile Tool
④ Mobile Menu (overlay, bg surface, full width)
```

---

## Шаг 9. States (05 — States & Interactions)

Компоненты с вариантами (Figma Variants):

| Компонент | Варианты |
|---|---|
| NavItem | Default / Hover / Active |
| Button | Default / Hover / Disabled |
| PostCard | Default / Hover |
| FAQItem | Closed / Open |
| ToolResult | Hidden / Visible |
| CookieBanner | Visible / Hidden |

---

## Чеклист после создания

- [ ] Добавить ссылку на файл в этот README
- [ ] Подключить шрифты Bitter + Inter + JetBrains Mono (плагин Figma → Google Fonts)
- [ ] Создать Local Variables (Local styles → Tokens)
- [ ] Создать все Text styles
- [ ] Создать Effect styles (тени)
- [ ] Сборка компонентов
- [ ] Desktop фреймы
- [ ] Mobile фреймы
- [ ] Overlays (cookie, mobile menu)
