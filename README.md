# Jeremy Gabriel Portfolio

Personal portfolio website for Jeremy Gabriel L. Batac, IT Student at Universidad De Dagupan.

## Features

- Responsive design with Sukuna/JJK anime theme
- About page with personal information and skills
- Contact page with form submission (PHP local) or contact info display (Vercel)
- PDF resume download
- Mobile-friendly navigation
- **Dual Setup**: PHP for local development, Vercel-compatible for deployment

## Technologies Used

- HTML5
- CSS3 (Custom Sukuna theme)
- JavaScript (ES6+)
- PHP (local development)
- Node.js (Vercel Serverless Functions)
- PDFKit (PDF generation)

## Local Development

### Option 1: PHP Server (Full Dynamic Features)

Run with PHP to test contact form, file handling, and PHP-based resume download:

```bash
# Clone repository
git clone https://github.com/gabriellamsen332-oss/Jeremy-Gabriel-Portfolio.git
cd Jeremy-Gabriel-Portfolio

# Start PHP server
php -S localhost:8000

# Or use npm script
npm run dev:php
```

Visit: `http://localhost:8000/index-local.html`

**Available Features:**
- ✅ Contact form with email sending
- ✅ Message storage to file
- ✅ PHP-based PDF resume
- ✅ Dynamic about page from data/about.txt

### Option 2: Vercel Dev Server (Production Preview)

Test the Vercel deployment environment locally:

```bash
# Install dependencies
npm install

# Install Vercel CLI
npm install -g vercel

# Start Vercel dev server
npm run dev
# or
vercel dev
```

Visit: `http://localhost:3000`

**Available Features:**
- ✅ Serverless PDF resume generation
- ✅ Static contact info display
- ✅ Production-like environment
- ❌ No contact form submission

## File Structure

```
Jeremy-Gabriel-Portfolio/
├── index.html              # Production homepage (for Vercel)
├── index-local.html        # Local development homepage (for PHP)
├── about.html              # Static about page (for Vercel)
├── about.php               # Dynamic about page (for PHP local)
├── contact.html            # Static contact info (for Vercel)
├── contact.php             # Contact form (for PHP local)
├── submit_contact.php      # Form handler (PHP local only)
├── download_resume.php     # PDF resume (PHP local)
├── api/
│   └── resume.js           # Serverless PDF (Vercel)
├── assets/
│   ├── css/
│   │   └── style.css       # Sukuna theme styles
│   ├── js/
│   │   └── main.js         # JavaScript functionality
│   └── img/
│       └── profile.jpeg    # Profile image
├── data/
│   ├── about.txt           # Personal information
│   └── messages.txt        # Contact form submissions (local only)
├── package.json            # Node.js dependencies
└── vercel.json             # Vercel configuration
```

## Quick Commands

```bash
# Run with PHP (full features)
npm run dev:php

# Run with Vercel (production preview)
npm run dev

# Deploy to Vercel
vercel --prod
```

## Deployment to Vercel

When you deploy to Vercel, only the static files (`index.html`, `about.html`, `contact.html`) and the serverless function (`/api/resume.js`) are used. PHP files are ignored.

### Option 1: Deploy via Vercel Dashboard (Easiest)

1. **Push to GitHub**
```bash
git add .
git commit -m "Ready for Vercel deployment"
git push origin main
```

2. **Create a Vercel Account**
   - Go to [vercel.com](https://vercel.com)
   - Sign up with GitHub (recommended)

3. **Import Your Repository**
   - Click "Add New Project"
   - Import your GitHub repository: `Jeremy-Gabriel-Portfolio`

4. **Configure Project**
   - Framework Preset: Other
   - Root Directory: `./`
   - Build Command: (leave empty)
   - Output Directory: (leave empty)

5. **Deploy**
   - Click "Deploy"
   - Wait for deployment to complete
   - Your site will be live at `https://your-project-name.vercel.app`

### Option 2: Deploy via Vercel CLI

```bash
# Login to Vercel
vercel login

# Deploy to preview
vercel

# Deploy to production
vercel --prod
```

## What Works Where?

| Feature | PHP Local | Vercel Production |
|---------|-----------|-------------------|
| Homepage | ✅ index-local.html | ✅ index.html |
| About Page | ✅ about.php (dynamic) | ✅ about.html (static) |
| Contact Form | ✅ contact.php (with submission) | ✅ contact.html (info only) |
| Email Sending | ✅ Yes | ❌ No |
| Message Storage | ✅ Yes (data/messages.txt) | ❌ No |
| PDF Resume | ✅ download_resume.php | ✅ /api/resume (serverless) |

## Important Notes

- **Local Development**: Use `npm run dev:php` to test all features including contact form
- **Production (Vercel)**: Contact page shows static info only (no form submission)
- **Git Ignore**: `index-local.html` and `data/messages.txt` are not pushed to repository
- **PHP Files**: Kept in repository but ignored by Vercel during deployment

## Customization

To update your information:
- Edit `data/about.txt` for personal information (used by both PHP and serverless)
- Modify `contact.html` to update contact details for Vercel
- Modify `contact.php` to update contact details for local PHP
- Edit `api/resume.js` or `download_resume.php` to customize PDF resume content

## License

MIT License - feel free to use this template for your own portfolio!

## Contact

- **Email**: gabriellamsen332@gmail.com
- **School**: Universidad De Dagupan
- **Location**: Arellano St., Pantal, Dagupan City, 2400, Philippines
