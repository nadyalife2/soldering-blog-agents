# Руководство: Скетч-иллюстрации для SolderBlog

## Концепция

Все изображения на сайте — в стиле **карандашного наброска** (pencil sketch)  
на **бежевом/крафтовом фоне** (`#FDFAF6` или `#F5F0E8`).

Это даёт:
- Уникальный визуальный стиль (нельзя спутать с фотостоком)
- Нет проблем с авторскими правами (рисунки оригинальные)
- Соответствует теме «ручная работа» — пайка, ремонт

---

## Бесплатные инструменты для генерации

### 1. Kling AI (klingai.com) — ЛУЧШИЙ ВЫБОР
**Промпт на English:**
```
pencil sketch illustration of [subject], hand-drawn style, 
warm beige background #FDFAF6, fine line art, 
no color except warm sepia tones, technical drawing aesthetic, 
clean white margins, 16:9 ratio
```

**Пример для паяльника:**
```
pencil sketch of a soldering iron tip with solder joint, 
hand-drawn technical illustration, warm beige background, 
fine crosshatching, sepia ink lines, no photography, 
cartoon technical art style, clean composition
```

### 2. Adobe Firefly (бесплатный план) — для Hero
**Промпт:**
```
hand-drawn pencil sketch, soldering tools on craft paper,
technical illustration style, warm paper texture background,
black ink lines, no photography
```

### 3. Stable Diffusion (локально, бесплатно)
**Модель:** `dreamshaper` или `anything-v5`  
**LoRA:** `pencil_sketch_style`

**Промпт:**
```
(pencil sketch:1.4), (hand drawn:1.2), soldering iron,
warm beige background, fine lineart, technical illustration,
(no color:1.3), sepia tones
Negative: photo, realistic, colorful, digital art, 3d
```

---

## Размеры для WordPress

| Шаблон | Размер | Использование |
|---|---|---|
| `solderblog-hero` | 1600×900px | Hero на главной, шапка статьи |
| `solderblog-card` | 720×405px | Карточки постов (16:9) |
| `solderblog-thumb` | 400×225px | Превью в сайдбаре |

---

## Организация файлов

```
wp-content/uploads/sketches/
├── hero/
│   └── hero-soldering-tools.png
├── guides/
│   ├── flux-types-sketch.png
│   ├── solder-joint-types.png
│   └── ...
├── tools/
│   ├── calculator-icon.png
│   └── ...
└── categories/
    ├── category-basics.png
    └── ...
```

---

## Постобработка (Photoshop / GIMP бесплатно)

1. Открой сгенерированное изображение
2. Измени цвет фона на `#FDFAF6` если нужно
3. Слой → Flatten
4. Сохрани как PNG (прозрачный фон не нужен)
5. Загрузи в WordPress Media через обычный Upload

---

## Права и лицензии

- Изображения, сгенерированные **Kling AI** и **Adobe Firefly**, можно использовать коммерчески
- Stable Diffusion: проверь лицензию модели (обычно разрешено)
- **НЕ используй** готовые фото с Unsplash/Pexels без проверки лицензии
- Все генерации — оригинальные произведения, авторских прав третьих лиц нет
