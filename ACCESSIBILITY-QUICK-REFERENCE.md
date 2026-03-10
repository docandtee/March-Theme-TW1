# WCAG 2.2 Quick Reference Guide

Quick patterns and examples for maintaining accessibility in this theme.

---

## Common Patterns

### Images

#### ✅ Good - Descriptive alt text
```php
<img src="report.jpg" alt="2024 Annual Report cover showing growth charts">
```

#### ❌ Bad - Generic alt text
```php
<img src="report.jpg" alt="image">
<img src="report.jpg" alt="report">
```

#### ✅ Good - Decorative image
```php
<img src="divider.png" alt="" role="presentation">
```

---

### Links

#### ✅ Good - Descriptive link text
```php
<a href="report.pdf">Download 2024 Annual Report (PDF, 2MB)</a>
<a href="/about">Learn about our mission and values</a>
```

#### ❌ Bad - Generic link text
```php
<a href="report.pdf">Click here</a>
<a href="/about">Read more</a>
<a href="/contact">Here</a>
```

#### ✅ Good - External links
```php
<a href="https://example.com" target="_blank" rel="noopener noreferrer">
    Visit Example.com (opens in new tab)
</a>
```

---

### Buttons

#### ✅ Good - Semantic buttons
```php
<!-- For actions (not navigation) -->
<button type="button" onclick="doSomething()">Save Changes</button>
<button type="submit">Submit Form</button>
```

#### ✅ Good - Icon buttons
```php
<button type="button" aria-label="Close dialog">
    <svg aria-hidden="true">
        <path d="..."/>
    </svg>
</button>
```

#### ❌ Bad - Link as button or vice versa
```php
<!-- Don't use links for actions -->
<a href="#" onclick="save()">Save</a>

<!-- Don't use buttons for navigation -->
<button onclick="location.href='/page'">Go to page</button>
```

---

### Forms

#### ✅ Good - Proper form labels
```php
<label for="email">Email Address</label>
<input type="email" id="email" name="email" required>

<!-- Or with hidden label -->
<label for="search" class="sr-only">Search</label>
<input type="search" id="search" placeholder="Search...">
```

#### ✅ Good - Required fields
```php
<label for="name">
    Full Name <span aria-label="required">*</span>
</label>
<input type="text" id="name" required aria-required="true">
```

#### ✅ Good - Error messages
```php
<label for="email">Email</label>
<input type="email" id="email" aria-invalid="true" aria-describedby="email-error">
<span id="email-error" role="alert">Please enter a valid email address</span>
```

---

### Headings

#### ✅ Good - Proper hierarchy
```html
<h1>Page Title</h1>
    <h2>Section 1</h2>
        <h3>Subsection 1.1</h3>
        <h3>Subsection 1.2</h3>
    <h2>Section 2</h2>
        <h3>Subsection 2.1</h3>
```

#### ❌ Bad - Skipping levels
```html
<h1>Page Title</h1>
    <h4>Section</h4>  <!-- Skipped h2 and h3 -->
```

---

### Modals/Dialogs

#### ✅ Good - Accessible modal
```php
<div role="dialog" 
     aria-modal="true" 
     aria-labelledby="dialog-title">
    <h2 id="dialog-title">Confirm Action</h2>
    <p>Are you sure?</p>
    <button type="button">Confirm</button>
    <button type="button" aria-label="Close dialog">Close</button>
</div>
```

---

### Navigation

#### ✅ Good - Landmark regions
```php
<header>
    <nav aria-label="Primary navigation">
        <ul>...</ul>
    </nav>
</header>

<main id="content">
    <!-- Main content -->
</main>

<footer>
    <nav aria-label="Footer navigation">
        <ul>...</ul>
    </nav>
</footer>
```

---

### Lists

#### ✅ Good - Semantic lists
```html
<!-- Unordered lists -->
<ul>
    <li>Item 1</li>
    <li>Item 2</li>
</ul>

<!-- Ordered lists -->
<ol>
    <li>Step 1</li>
    <li>Step 2</li>
</ol>

<!-- Definition lists -->
<dl>
    <dt>Term</dt>
    <dd>Definition</dd>
</dl>
```

#### ❌ Bad - Div soup
```html
<div>
    <div>Item 1</div>
    <div>Item 2</div>
</div>
```

---

### Tables

#### ✅ Good - Accessible table
```php
<table>
    <caption>Sales Report Q4 2024</caption>
    <thead>
        <tr>
            <th scope="col">Month</th>
            <th scope="col">Sales</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <th scope="row">October</th>
            <td>$5,000</td>
        </tr>
    </tbody>
</table>
```

---

### Videos

#### ✅ Good - Video with fallback
```php
<video controls aria-label="Product demo video">
    <source src="demo.mp4" type="video/mp4">
    <track kind="captions" src="captions.vtt" srclang="en" label="English">
    <p>Your browser doesn't support HTML5 video. 
       <a href="demo.mp4">Download the video</a>.</p>
</video>
```

---

### Icons

#### ✅ Good - Decorative icon
```php
<button type="button">
    <svg aria-hidden="true">
        <path d="..."/>
    </svg>
    <span>Save</span>
</button>
```

#### ✅ Good - Icon-only button
```php
<button type="button" aria-label="Delete item">
    <svg aria-hidden="true">
        <path d="..."/>
    </svg>
</button>
```

#### ✅ Good - Informative icon
```php
<svg role="img" aria-labelledby="icon-title">
    <title id="icon-title">Warning</title>
    <path d="..."/>
</svg>
```

---

### Skip Links

#### ✅ Good - Skip to main content
```php
<a href="#content" class="sr-only focus:not-sr-only focus:absolute focus:top-0">
    Skip to main content
</a>

<!-- Later in the page -->
<main id="content">
    <!-- Main content here -->
</main>
```

---

## Color & Contrast

### Checking Contrast

**Minimum Ratios:**
- Normal text: 4.5:1
- Large text (18pt+): 3:1
- UI components: 3:1

**Tools:**
- [WebAIM Contrast Checker](https://webaim.org/resources/contrastchecker/)
- Chrome DevTools (inspect element → accessibility panel)

#### ✅ Good - Sufficient contrast
```css
/* Dark text on light background */
color: #1f2937; /* Dark gray */
background-color: #ffffff; /* White */
/* Contrast: 16.1:1 ✓ */
```

#### ❌ Bad - Insufficient contrast
```css
/* Light gray on white */
color: #cccccc;
background-color: #ffffff;
/* Contrast: 1.6:1 ✗ */
```

---

## ARIA Attributes Quick Reference

### Common ARIA Attributes

```html
<!-- Labels -->
aria-label="Close menu"
aria-labelledby="title-id"
aria-describedby="description-id"

<!-- States -->
aria-expanded="true|false"
aria-hidden="true|false"
aria-current="page|step|location"
aria-selected="true|false"
aria-checked="true|false"

<!-- Properties -->
aria-controls="element-id"
aria-required="true"
aria-invalid="true"
aria-live="polite|assertive"

<!-- Roles -->
role="navigation"
role="search"
role="button"
role="dialog"
role="alert"
```

---

## Testing Checklist

### Quick Manual Tests

#### Keyboard Navigation
```
1. Press Tab → Should see focus indicator
2. Tab through all links/buttons
3. Press Enter on focused link → Should navigate
4. Press Space on focused button → Should activate
5. Press Escape in modal → Should close
```

#### Screen Reader (VoiceOver on Mac)
```
1. Cmd+F5 → Enable VoiceOver
2. Tab through page → Listen to announcements
3. Ctrl+Option+U → Open rotor
4. Check headings make sense
5. Check links are descriptive
```

#### Zoom Test
```
1. Cmd/Ctrl + → Zoom to 200%
2. Verify all content is readable
3. Verify no horizontal scrolling
4. Verify buttons/links still work
```

---

## Common Mistakes to Avoid

### ❌ Don't Do This

```php
<!-- Empty alt text on informative images -->
<img src="chart.png" alt="">

<!-- Generic link text -->
<a href="/page">Click here</a>

<!-- Placeholder as label -->
<input type="text" placeholder="Name"> <!-- No label! -->

<!-- Div/span as button -->
<div onclick="save()">Save</div>

<!-- Empty headings -->
<h2>&nbsp;</h2>

<!-- Color-only information -->
<p style="color: red">Required fields</p> <!-- No * or text -->

<!-- Low contrast -->
<p style="color: #999; background: #fff;">Text</p>

<!-- Auto-playing audio -->
<audio src="music.mp3" autoplay>

<!-- Opening links in new window without warning -->
<a href="..." target="_blank">Link</a>
```

---

## WordPress Gutenberg Tips

### Using Built-in Accessibility Features

1. **Images**
   - Always fill in "Alt Text" field in media library
   - Use "Decorative" option for decorative images

2. **Headings**
   - Use Heading block, not Paragraph with large text
   - Check document outline in settings

3. **Buttons**
   - Use Button block, not Link styled as button
   - Fill in "Link rel" for external links

4. **Tables**
   - Enable "Header section" in table settings
   - Add table caption

---

## Getting Help

### Resources in This Theme

1. **ACCESSIBILITY.md** - Full documentation
2. **WCAG-COMPLIANCE-SUMMARY.md** - What we've implemented
3. **resources/css/accessibility.css** - Accessibility styles

### External Resources

- [WCAG 2.2 Guidelines](https://www.w3.org/TR/WCAG22/)
- [WebAIM Articles](https://webaim.org/articles/)
- [A11y Project](https://www.a11yproject.com/)
- [MDN Accessibility Guide](https://developer.mozilla.org/en-US/docs/Web/Accessibility)

### Testing Tools

- [WAVE Browser Extension](https://wave.webaim.org/extension/)
- [axe DevTools](https://www.deque.com/axe/devtools/)
- [Lighthouse](https://developers.google.com/web/tools/lighthouse)
- [Color Contrast Checker](https://webaim.org/resources/contrastchecker/)

---

**Quick Tip:** When in doubt, ask yourself: "Could I use this website with only my keyboard?" and "Would this make sense if I couldn't see the screen?"

**Last Updated:** October 9, 2025

