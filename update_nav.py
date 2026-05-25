import os
import re

html_files = [f for f in os.listdir('.') if f.endswith('.html') and f != 'index.html']

new_nav = '''    <header id="navbar" class="fixed w-full top-0 z-50 transition-all duration-300 py-6 text-white bg-dark">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center">
                <a href="index.html" class="flex-shrink-0 flex items-center gap-2">
                    <span class="font-heading font-bold text-2xl tracking-wider">JAHARI</span>
                </a>
                <nav class="hidden lg:flex space-x-8">
                    <a href="index.html" class="hover:text-primary transition-colors">Home</a>
                    <a href="accommodations.html" class="hover:text-primary transition-colors">Lodges & BNBs</a>
                    <a href="camping.html" class="hover:text-primary transition-colors">Camping</a>
                    <a href="car-hire.html" class="hover:text-primary transition-colors">Car Hire</a>
                    <a href="tents.html" class="hover:text-primary transition-colors">Tents</a>
                    <a href="about.html" class="hover:text-primary transition-colors">About Us</a>
                </nav>
                <div class="hidden lg:flex items-center space-x-4">
                    <div class="flex items-center gap-2 text-sm">
                        <span class="currency-label font-bold" data-currency="USD">USD</span>
                        <label class="relative inline-flex items-center cursor-pointer">
                            <input type="checkbox" id="currency-toggle" class="sr-only peer">
                            <div class="w-9 h-5 bg-gray-600 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-4 after:w-4 after:transition-all peer-checked:bg-primary"></div>
                        </label>
                        <span class="currency-label" data-currency="KSH">KSH</span>
                    </div>
                    <a href="#book" class="btn-primary">Book Now</a>
                </div>
            </div>
        </div>
    </header>

    <!-- Hamburger Button (Fixed Top Right) -->
    <button id="mobile-menu-btn" aria-label="Toggle Mobile Menu" class="lg:hidden fixed top-4 right-4 z-[9999] w-12 h-12 flex items-center justify-center bg-dark/50 backdrop-blur-md rounded-full focus:outline-none touch-manipulation">
        <div class="hamburger-lines">
            <span></span><span></span><span></span>
        </div>
    </button>

    <!-- Mobile Nav Overlay -->
    <div id="mobile-menu" class="mobile-nav-overlay lg:hidden">
        <nav class="flex flex-col space-y-2 mt-4 flex-1">
            <a href="index.html" class="mobile-link-item"><i class="fa-solid fa-house w-8 text-center mr-2 text-lg"></i> Home</a>
            <a href="accommodations.html" class="mobile-link-item"><i class="fa-solid fa-bed w-8 text-center mr-2 text-lg"></i> Lodges & BNBs</a>
            <a href="camping.html" class="mobile-link-item"><i class="fa-solid fa-campground w-8 text-center mr-2 text-lg"></i> Camping</a>
            <a href="car-hire.html" class="mobile-link-item"><i class="fa-solid fa-car w-8 text-center mr-2 text-lg"></i> Car Hire</a>
            <a href="tents.html" class="mobile-link-item"><i class="fa-solid fa-tent w-8 text-center mr-2 text-lg"></i> Tents</a>
            <a href="about.html" class="mobile-link-item"><i class="fa-solid fa-users w-8 text-center mr-2 text-lg"></i> About Us</a>
        </nav>
        
        <div class="px-8 mt-auto pb-4 space-y-6">
            <div class="flex items-center justify-between text-sm text-sand border-t border-gray-800 pt-6">
                <span>Currency</span>
                <div class="flex items-center gap-2">
                    <span class="currency-label font-bold text-white" data-currency="USD">USD</span>
                    <label class="relative inline-flex items-center cursor-pointer">
                        <input type="checkbox" id="mobile-currency-toggle" class="sr-only peer">
                        <div class="w-11 h-6 bg-gray-600 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-primary"></div>
                    </label>
                    <span class="currency-label" data-currency="KSH">KSH</span>
                </div>
            </div>
            
            <div class="flex gap-4 text-white text-xl">
                <a href="#" aria-label="WhatsApp" class="hover:text-accent"><i class="fa-brands fa-whatsapp"></i></a>
                <a href="#" aria-label="Instagram" class="hover:text-accent"><i class="fa-brands fa-instagram"></i></a>
                <a href="#" aria-label="Email" class="hover:text-accent"><i class="fa-regular fa-envelope"></i></a>
            </div>
            
            <a href="#book" class="block w-full text-center bg-accent text-white font-bold py-4 rounded-lg text-lg touch-manipulation active:scale-95 transition-transform">Book Now</a>
        </div>
    </div>'''

for f in html_files:
    with open(f, 'r', encoding='utf-8') as file:
        content = file.read()
    
    # Use regex to find <header id="navbar" ...> to the end of <div id="mobile-menu" ...> </div>
    pattern = re.compile(r'<header id="navbar".*?</header>\s*<!-- Mobile Menu -->\s*<div id="mobile-menu".*?</div>', re.DOTALL)
    
    new_content = pattern.sub(new_nav, content)
    
    with open(f, 'w', encoding='utf-8') as file:
        file.write(new_content)

print("Replacement complete.")
