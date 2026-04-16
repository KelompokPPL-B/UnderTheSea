# Under The Sea - Performance Baseline

## Load Time Targets

### Page Load Times
- **Homepage**: < 2 seconds (First Contentful Paint)
- **List Pages** (fish, ecosystems, actions): < 2 seconds (First Contentful Paint)
- **Detail Pages**: < 2.5 seconds (First Contentful Paint)
- **Search Results**: < 1.5 seconds (Time to Interactive)

### Core Web Vitals Targets
- **Largest Contentful Paint (LCP)**: < 2.5 seconds
- **Cumulative Layout Shift (CLS)**: < 0.1
- **First Input Delay (FID)**: < 100ms

### Asset Sizes
- **Page HTML**: < 50KB
- **CSS Bundle**: < 30KB
- **JavaScript Bundle**: < 50KB
- **Images**: Lazy loaded, max 200KB per image

## Performance Optimizations Applied

### Image Optimization
- All images use `loading="lazy"` for native browser lazy loading
- JPG/PNG formats with max 2MB file size enforced
- Responsive images using max-width constraints

### CSS & JavaScript
- Tailwind CSS for minimal CSS footprint
- Alpine.js for lightweight interactivity
- JavaScript modules loaded async where possible

### Caching Strategy
- Browser caching headers for static assets
- Query strings on paginated routes preserved
- CSS/JS minification via Laravel Vite

### Database Optimization
- Pagination limited to 10 items per page
- Search queries limited to 10 results
- Eager loading of relationships in detail pages
- UNIQUE constraints prevent duplicate data

## Monitoring

Performance targets are based on typical broadband speeds (10-30 Mbps). Actual performance may vary based on:
- User connection speed
- Device capability
- Server location
- Peak traffic times

---

**Last Updated**: 2026-04-15
**Status**: Baseline Established
