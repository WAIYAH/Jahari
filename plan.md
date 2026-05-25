# Jahari Safaris Wild Route - Project Plan

## 1. Folder & File Structure Tree
```text
/jahari-safaris
│
├── index.html                 # Home Page
├── accommodations.html        # BNBs & Lodges
├── camping.html               # Camping Sites
├── car-hire.html              # Vehicle Hire
├── tents.html                 # Tents for Hire
├── about.html                 # About Us
│
├── /assets
│   ├── /css
│   │   └── style.css          # Custom CSS overrides, Tailwind extensions, animations
│   ├── /js
│   │   ├── main.js            # Global logic (navbar, footer, loader, currency switcher)
│   │   ├── animations.js      # GSAP global and shared animations
│   │   └── pages/             # Page-specific JS logic
│   │       ├── home.js
│   │       ├── accommodations.js
│   │       ├── camping.js
│   │       ├── car-hire.js
│   │       ├── tents.js
│   │       └── about.js
│   └── /images                # Local placeholder images (if needed, otherwise Unsplash/Pexels via CDN)
│       └── logo.svg           # Brand Logo
```

## 2. Color Palette
- **Safari Green**: `#00A651` - Primary brand color (buttons, highlights, active states)
- **Adventure Orange**: `#FF6200` - Secondary/Accent color (alerts, badges, secondary CTA)
- **Deep Earth**: `#1A1A1A` - Text primary, footer background, dark sections
- **Warm Sand**: `#F5E6C8` - Secondary background, subtle card backgrounds, alternate sections
- **Ivory White**: `#FAFAF7` - Main background, text on dark sections

## 3. Typography Scale
- **Headings**: `Playfair Display` (Serif, Elegant)
- **Body**: `Inter` (Sans-serif, Clean, Readable)
- **Accent**: `Cormorant Garamond` (Italic, Quotes)

**Scale (Desktop):**
- `h1`: 5rem (80px), Weight: 700, Line-Height: 1.1
- `h2`: 3.5rem (56px), Weight: 600, Line-Height: 1.2
- `h3`: 2.5rem (40px), Weight: 600, Line-Height: 1.3
- `h4`: 1.75rem (28px), Weight: 500, Line-Height: 1.4
- `p` (body-large): 1.125rem (18px), Weight: 400, Line-Height: 1.6
- `p` (body-base): 1rem (16px), Weight: 400, Line-Height: 1.6
- `p` (small): 0.875rem (14px), Weight: 400, Line-Height: 1.5

## 4. Component Inventory
- **Navbar**: Sticky, transparent to solid on scroll, logo left, links center, CTA right. Mobile hamburger drawer.
- **Footer**: 4-column layout (About, Links, Contact, Socials), newsletter form, copyright.
- **Buttons**:
  - Primary: Safari Green bg, white text, hover effect (scale up slightly, shadow).
  - Secondary: Transparent with Safari Green border, Safari Green text, hover effect (fill green, white text).
- **Cards**:
  - Image top, content bottom. Warm Sand or White background. Subtle shadow, hover scale image inside container, lift card.
- **Forms**: Input fields with floating labels or clean placeholders, underline or soft border, error states in Adventure Orange.
- **Modals**: Overlay with blur, centered container, close button top right.
- **Loader**: Full screen Ivory White, pulsating logo or simple safari animation, fades out.
- **Currency Switcher**: Toggle or dropdown in Navbar/Footer.
- **Floating WhatsApp**: Fixed bottom-right, pulsing ring animation.

## 5. Page-by-Page Content Outline
- **Home (`index.html`)**:
  1. Hero: Fullscreen, Parallax BG, H1 "Where the Wild Calls You Home", Primary & Secondary CTAs.
  2. Why Choose Us: 3-4 column grid with icons (Expert Guides, Luxury, Safety, Local Heritage).
  3. Featured Packages: 3-card grid (e.g., Maasai Mara, Amboseli, Tsavo).
  4. Stats: Counter animation (Trips, Countries, Satisfaction).
  5. Testimonials: Carousel of guest reviews.
  6. Gallery: Strip of Instagram-style photos.
  7. Newsletter: Simple input + submit.
- **Accommodations (`accommodations.html`)**:
  1. Hero: Medium height, H1 "Luxury Lodges & BNBs".
  2. Filters: Sticky bar below hero (Location, Type, Price).
  3. Grid: Lodge cards (Image, Rating, Title, Location, Price KSh/USD, Amenities, "Enquire").
- **Camping (`camping.html`)**:
  1. Hero: Medium height, H1 "Wilderness Camping Sites".
  2. Map: Embedded Google map (placeholder).
  3. List/Grid: Site cards (Terrain badge, Title, Capacity, Facilities, "Book").
- **Car Hire (`car-hire.html`)**:
  1. Hero: Medium height, H1 "Premium Safari Vehicles".
  2. Filters: Vehicle type, seats, 4WD.
  3. Fleet Grid: Cards (V8, Prado, Safari Van). Details: Specs, Rates KSh/USD, "Request Quote" opening Modal.
- **Tents (`tents.html`)**:
  1. Hero: Medium height, H1 "High-Quality Camping Tents".
  2. Catalog: Tents with specs (capacity, dimensions, inclusions) and price.
  3. Bundles: Packages (e.g., 2-person tent + 2 sleeping bags).
- **About (`about.html`)**:
  1. Hero: Medium height, H1 "Our Story".
  2. Story/Timeline: Text + Image layout.
  3. Mission/Vision: 3-column layout.
  4. Team: Grid of guide/staff cards.
  5. Trust/Badges: Certifications, KTB logo, partners.

## 6. SEO Strategy per Page
- **Global**: Canonical URLs, semantic HTML5 tags, fast loading (lazy loading images, compressed assets).
- **Index**:
  - `<title>`: Luxury Kenya Safaris & Adventures | Jahari Safaris Wild Route
  - Meta Desc: Experience the ultimate luxury safari in Kenya. Book bespoke lodges, camping, and premium 4x4 car hire. Where the wild calls you home.
  - Schema: `LocalBusiness`
- **Accommodations**:
  - `<title>`: Luxury Safari Lodges & BNBs in Kenya | Jahari Safaris
  - Meta Desc: Browse premium safari lodges and bed & breakfasts in Maasai Mara, Amboseli, and across Kenya.
  - Schema: `LodgingBusiness`
- **Camping**:
  - `<title>`: Premium Camping Sites in Kenya | Jahari Safaris
  - Meta Desc: Discover the best wilderness camping sites in Kenya's top national parks.
  - Schema: `TouristAttraction`
- **Car Hire**:
  - `<title>`: 4x4 Safari Car & Land Cruiser Hire Kenya | Jahari Safaris
  - Meta Desc: Rent premium 4x4 safari vehicles, including Land Cruiser V8s and Safari Vans for your Kenyan adventure.
- **Tents**:
  - `<title>`: Safari Tent Hire & Camping Equipment | Jahari Safaris
  - Meta Desc: High-quality canvas tents and camping gear for hire in Kenya.
- **About**:
  - `<title>`: About Jahari Safaris Wild Route | Our Story
  - Meta Desc: Learn about Jahari Safaris, our expert guides, and our commitment to authentic luxury African travel.

## 7. Animation Timeline per Page
- **Global Page Load**:
  1. Loader fades out (0-1.5s).
  2. Navbar slides down (1.5s - 2s).
- **Home**:
  1. Hero H1: Staggered words reveal up (1.5s - 2.5s).
  2. Scroll to "Why Choose Us": Icons pop in, text fades up.
  3. Scroll to Stats: Counter triggers when 80% in viewport.
  4. Scroll to Cards: Staggered fade-up (0.1s delay between cards).
  5. Parallax: Continuous during scroll.
- **Other Pages**:
  1. Hero H1: Simple fade-up reveal on load.
  2. Grid/List items: Staggered fade-up on ScrollTrigger.

## 8. Responsive Breakpoint Strategy
- **Mobile First**: Default styles for 320px - 639px.
- **Tablet (`md:` 768px)**: Adjust padding, switch 1-column layouts to 2-column.
- **Desktop (`lg:` 1024px)**: 3/4 column grids, reveal desktop navbar, hide hamburger.
- **Large Desktop (`xl:` 1280px / `2xl:` 1536px)**: Max-width containers (e.g., `max-w-7xl`), scale typography accordingly.

## 9. Form UX Flow and Validation Rules
- **Fields**: Name (text, required), Email (email format, required), Phone (tel format, required), Dates (Datepicker, start <= end), Subject (Select/Readonly).
- **Validation**:
  - Blur event: Check validity, show error border (Adventure Orange) and small text below if invalid.
  - Submit event: Prevent default, validate all. If valid, show success state, optionally trigger WhatsApp deep link.
- **WhatsApp Deep Link**:
  - Format: `https://wa.me/254XXXXXXXXX?text=URI_ENCODED_STRING`
  - Example Text: "Hello Jahari Safaris, I would like to enquire about [Package Name]. My travel dates are [Start] to [End]."

## 10. Currency Switcher Logic Pseudocode
```javascript
// State
let currentCurrency = localStorage.getItem('jahari_currency') || 'USD';
const exchangeRate = 130; // 1 USD = 130 KSh (Example)

// Initialization
function initCurrency() {
  updateUI(currentCurrency);
  updatePrices(currentCurrency);
}

// Toggle Event
document.getElementById('currency-toggle').addEventListener('change', (e) => {
  currentCurrency = e.target.checked ? 'KSH' : 'USD';
  localStorage.setItem('jahari_currency', currentCurrency);
  updatePrices(currentCurrency);
});

// Update DOM elements
function updatePrices(currency) {
  document.querySelectorAll('[data-price-usd]').forEach(el => {
    const priceUSD = parseFloat(el.getAttribute('data-price-usd'));
    if (currency === 'KSH') {
      el.textContent = 'KSh ' + (priceUSD * exchangeRate).toLocaleString();
    } else {
      el.textContent = '$' + priceUSD.toLocaleString();
    }
  });
}
```
