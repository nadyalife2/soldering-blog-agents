# SVG-компоненты для Figma и WordPress

> Встави эти SVG напрямую в Figma (справа кнопка **⊕** → Import SVG)
> И в `header.php` для логотипа.

---

## Логотип (жало паяльника)

```svg
<svg width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
  <!-- Рукоятка паяльника -->
  <rect x="14" y="2" width="4" height="14" rx="2" fill="#4A4A45"/>
  <!-- Нагревательный элемент -->
  <rect x="13" y="14" width="6" height="6" rx="1" fill="#4A4A45"/>
  <!-- Жало — акцент -->
  <path d="M16 20 L13 28 L16 26 L19 28 Z" fill="#D4571E"/>
  <!-- Блик жала -->
  <circle cx="16" cy="27" r="2" fill="#F0A500" opacity="0.7"/>
</svg>
```

---

## Иконка бургер-меню

```svg
<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
  <rect x="3" y="5" width="18" height="2" rx="1" fill="#1A1A18"/>
  <rect x="3" y="11" width="18" height="2" rx="1" fill="#1A1A18"/>
  <rect x="3" y="17" width="18" height="2" rx="1" fill="#1A1A18"/>
</svg>
```

---

## Иконка часов (время чтения)

```svg
<svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
  <circle cx="8" cy="8" r="6.5" stroke="#4A4A45" stroke-width="1.5"/>
  <path d="M8 4.5V8L10.5 9.5" stroke="#4A4A45" stroke-width="1.5" stroke-linecap="round"/>
</svg>
```

---

## Иконка FAQ (стрелка раскрытия)

```svg
<!-- Закрыто -->
<svg width="20" height="20" viewBox="0 0 20 20" fill="none">
  <path d="M5 7.5L10 12.5L15 7.5" stroke="#D4571E" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
</svg>

<!-- Открыто -->
<svg width="20" height="20" viewBox="0 0 20 20" fill="none">
  <path d="M15 12.5L10 7.5L5 12.5" stroke="#D4571E" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
</svg>
```

---

## Иконка предупреждения

```svg
<svg width="20" height="20" viewBox="0 0 20 20" fill="none">
  <path d="M10 2L18 17H2L10 2Z" stroke="#F5C842" stroke-width="1.5" stroke-linejoin="round"/>
  <rect x="9.25" y="8" width="1.5" height="5" rx="0.75" fill="#1A1A18"/>
  <rect x="9.25" y="14" width="1.5" height="1.5" rx="0.75" fill="#1A1A18"/>
</svg>
```
