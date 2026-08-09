# Гайд по стилю изображений SolderBlog

## Принцип

Все иллюстрации сайта выполнены в **скетч-стиле** (pencil sketch / hand-drawn technical illustration).
Этот стиль:

- не нарушает ничьих авторских прав — изображения генерируются специально для сайта;
- создаёт уникальный визуальный почерк;
- хорошо работает с тёплой палитрой темы;
- читается как «сделано с душой, а не скопировано».

---

## Технические параметры

| Параметр | Значение |
|---|---|
| Формат | `.webp` |
| Размер hero | 1600 × 900 px |
| Размер inline | 1200 × 675 px (16:9) |
| Размер comparison | 1200 × 900 px (4:3) |
| Макс. вес | 150 KB для hero, 80 KB для inline |
| Alt-текст | Описывает содержание, не ключи |

---

## Базовый промпт для генерации

Используй как основу и добавляй тему конкретного изображения:

```
pencil sketch technical illustration, hand-drawn style,
warm beige paper texture background (#FDFAF6),
soldering topic: [ТЕМА],
black ink linework with warm orange accent highlights (#D4571E),
no text, no watermarks, no logos,
clean composition, white space,
technically accurate tools and components,
crisп fine lines, cross-hatching shading
```

**Негативный промпт:**
```
photo, photorealistic, 3d render, cartoon, anime,
text, watermark, logo, extra fingers, blurry,
low quality, noisy, overexposed
```

---

## Типы изображений и промпты по ролям

### Hero (обложка статьи)

```
pencil sketch, hand-drawn, warm beige paper background,
soldering iron with glowing tip touching PCB joint,
orange accent on hot tip, fine cross-hatching shadows,
wide composition 16:9, no text
```

### Process (пошаговый процесс)

```
pencil sketch, technical illustration, step-by-step view,
[описание действия: e.g. applying flux to SMD pad],
hand holding soldering iron from side angle,
ink linework, warm paper texture, no text
```

### Defect (дефект пайки)

```
pencil sketch, close-up of soldering defect:
[тип дефекта: cold joint / bridging / solder ball],
cross-section diagram style,
annotation arrows WITHOUT text labels,
warm paper texture, orange accent on problem area
```

### Comparison (сравнение)

```
pencil sketch, side-by-side comparison,
left: [вариант A], right: [вариант B],
center divider line, hand-drawn style,
warm beige background, no text
```

### Tool (инструмент)

```
pencil sketch, isolated technical drawing of [название инструмента],
3/4 view, detailed linework, cross-hatching,
warm beige paper background, orange accent details
```

### Scheme (схема)

```
pencil sketch, hand-drawn circuit/wiring diagram,
[описание схемы],
clean technical illustration style,
warm paper background, orange accents on key nodes,
no component labels (labels will be added in HTML)
```

---

## Инструменты для генерации

| Инструмент | Рекомендуется для |
|---|---|
| Midjourney v6 | Hero и comparison |
| DALL·E 3 | Process и defect |
| Stable Diffusion (SDXL) | Batch-генерация схем |
| Adobe Firefly | Если нужна коммерческая лицензия без вопросов |

**Важно:** Все сгенерированные изображения принадлежат вам. Не используйте чужие фотографии без лицензии CC0 или собственной лицензии.

---

## Проверка перед публикацией

- [ ] Изображение в формате `.webp`
- [ ] Нет постороннего текста на изображении
- [ ] Нет водяных знаков
- [ ] Размер не превышает норму
- [ ] Alt-текст заполнен в WordPress
- [ ] Соответствует теме статьи
- [ ] Технически корректно (инструменты расположены правильно)
- [ ] Тёплый фон или нейтральный — не белый и не чёрный
