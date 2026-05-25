# Jahari Safaris Wild Route

A premium, luxury safari and adventure travel frontend website built with HTML5, Vanilla JS, Tailwind CSS, and GSAP. 

## 🌍 Features
- **Zero Frameworks:** Pure, fast-loading HTML, CSS, and JS.
- **Tailwind CSS:** Utilized via CDN for rapid utility-first styling with custom brand variables.
- **GSAP Animations:** High-end scroll-triggered animations (`fade-up`), custom infinite marquees, and rotating badges.
- **Currency Switcher:** Local `localStorage`-based KSh ↔ USD switcher recalculating prices seamlessly.
- **WhatsApp Integration:** "Request Quote" forms instantly format and direct inquiries to WhatsApp.
- **Fully Responsive:** Mobile-first architecture converting cleanly to multi-column desktop layouts.

## 📁 File Structure
- `/assets/css/style.css` - Global styling, custom keyframes, and root variables.
- `/assets/js/main.js` - Global functions, mobile nav toggles, form validation, and currency logic.
- `/assets/js/animations.js` - Global GSAP config and scroll triggers.
- `index.html` - Homepage with Hero video, Destinations, Stories, and more.
- `accommodations.html` - Lodge and BNB listings.
- `camping.html` - Public and private camping sites.
- `car-hire.html` - 4x4 safari fleet.
- `tents.html` - Tent rentals and bundles.
- `about.html` - Company timeline, mission, and team.
- `privacy-policy.html` & `terms-of-service.html` - Legal pages.

## 🚀 Running Locally
Because it's pure HTML/JS/CSS, no build step is strictly required. 
To avoid CORS issues with local fonts/images (if applicable), use a simple local server:
```bash
# Using Python
python -m http.server 8000

# Using Node.js
npx serve .
```

## ▲ Deploying To Vercel
This project is configured for static hosting on Vercel.

1. Push this project to GitHub (or GitLab/Bitbucket).
2. In Vercel, click **Add New Project** and import the repository.
3. Keep the default settings:
   - Framework Preset: **Other**
   - Build Command: *(leave empty)*
   - Output Directory: *(leave empty)*
4. Click **Deploy**.

After deploy:
- Add your custom domain in **Vercel Project Settings → Domains**.
- Ensure DNS points to Vercel.

Notes:
- `vercel.json` is already added for static headers/caching.
- `.vercelignore` excludes `backend/` and local/dev files from deployment.
- PHP endpoints in `backend/` are not deployed on this static Vercel setup.

## 🎨 Brand Identity
- **Primary:** Safari Green `#00A651`
- **Accent:** Adventure Orange `#FF6200`
- **Typography:** Playfair Display (Headings), Inter (Body), Cormorant Garamond (Accents).
