<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Speedy Rentals - Drive the Future</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
  <style>
  :root {
  --bg-color: linear-gradient(135deg, #dbe9ff, #f0f4ff);
  --text-color: #1c1c1e;
  --nav-bg: rgba(255, 255, 255, 0.6);
  --nav-scroll-bg: rgba(255, 255, 255, 0.85);
  --highlight: #007aff;
  --hero-shadow: rgba(0, 0, 0, 0.1);
  --button-bg: #007aff;
  --button-hover: #005ecc;
  --form-bg: #ffffff;
  --input-bg: #f2f2f7;
  --input-text: #1c1c1e;
}

body.light {
  --bg-color: linear-gradient(135deg, #ffffff, #f5f5f7);
  --text-color: #1c1c1e;
  --nav-bg: rgba(255, 255, 255, 0.9);
  --nav-scroll-bg: rgba(255, 255, 255, 1);
  --highlight: #007aff;
  --hero-shadow: rgba(0, 0, 0, 0.05);
  --button-bg: #007aff;
  --button-hover: #005ecc;
  --form-bg: #ffffff;
  --input-bg: #f0f0f3;
  --input-text: #1c1c1e;
}

* {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
}

html, body {
  height: 100%;
  font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Oxygen;
  background: var(--bg-color);
  color: var(--text-color);
  overflow-x: hidden;
  scroll-behavior: smooth;
  transition: background 0.3s, color 0.3s;
}

.video-bg {
  display: none;
}

.fallback-bg {
  display: none;
}

.navbar {
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: 20px 60px;
  position: fixed;
  width: 100%;
  z-index: 100;
  background: var(--nav-bg);
  backdrop-filter: blur(12px);
  transition: background 0.3s ease, box-shadow 0.3s ease;
}

.navbar.scrolled {
  background: var(--nav-scroll-bg);
  box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
}

.navbar h1 {
  font-size: 28px;
  color: var(--highlight);
  display: flex;
  align-items: center;
  gap: 10px;
}

.navbar a {
  color: var(--text-color);
  text-decoration: none;
  margin-left: 25px;
  font-size: 17px;
  position: relative;
  transition: color 0.3s;
}

.navbar a::after {
  content: '';
  position: absolute;
  width: 0%;
  height: 2px;
  background: var(--highlight);
  bottom: -5px;
  left: 0;
  transition: 0.3s ease-in-out;
}

.navbar a:hover::after {
  width: 100%;
}

.navbar a:hover {
  color: var(--highlight);
}

.hero {
  min-height: 100vh;
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: center;
  text-align: center;
  padding: 20px;
  background: transparent;
}

.hero h2 {
  font-size: 56px;
  font-weight: 700;
  color: #000;
  text-shadow: 0 2px 4px var(--hero-shadow);
}

.hero p {
  margin-top: 15px;
  font-size: 20px;
  max-width: 600px;
  color: #444;
}

.btn {
  margin-top: 30px;
  padding: 14px 36px;
  background: var(--button-bg);
  border: none;
  font-size: 18px;
  border-radius: 14px;
  color: white;
  font-weight: 600;
  box-shadow: 0 8px 20px rgba(0, 122, 255, 0.2);
  cursor: pointer;
  transition: all 0.3s ease;
}

.btn:hover {
  background: var(--button-hover);
  transform: translateY(-2px);
  box-shadow: 0 12px 24px rgba(0, 90, 200, 0.3);
}

footer {
  position: relative;
  bottom: 0;
  width: 100%;
  text-align: center;
  font-size: 14px;
  color: #666;
  padding: 20px;
  background: transparent;
}

#contact {
  padding: 60px 20px;
  background: var(--form-bg);
  text-align: center;
  box-shadow: 0 -8px 16px rgba(0, 0, 0, 0.05);
}

input, textarea {
  width: 100%;
  padding: 14px;
  margin-bottom: 15px;
  border-radius: 10px;
  border: 1px solid #ccc;
  background: var(--input-bg);
  color: var(--input-text);
  font-size: 16px;
  box-shadow: inset 0 2px 4px rgba(0, 0, 0, 0.05);
}

#backToTop {
  position: fixed;
  bottom: 30px;
  right: 30px;
  background: var(--button-bg);
  color: white;
  border: none;
  padding: 12px 16px;
  border-radius: 50%;
  font-size: 18px;
  display: none;
  cursor: pointer;
  box-shadow: 0 4px 10px rgba(0, 122, 255, 0.3);
  z-index: 200;
}

#backToTop:hover {
  background: var(--button-hover);
}

#themeToggle {
  position: fixed;
  top: 20px;
  right: 30px;
  background: none;
  border: none;
  font-size: 22px;
  color: var(--text-color);
  cursor: pointer;
  z-index: 1000;

}

@media (max-width: 768px) {
  .hero h2 {
    font-size: 38px;
  }

  .hero p {
    font-size: 18px;
  }

  .navbar {
    flex-direction: column;
    gap: 10px;
    padding: 20px;
  }

  .navbar a {
    margin: 10px 0;
  }
}

  </style>
</head>
<body>

<video autoplay muted loop class="video-bg">
  <source src="assets/bg.mp4" type="video/mp4">
</video>
<div class="fallback-bg"></div>

<!-- 🌗 Theme Toggle -->
<button id="themeToggle" title="Toggle Theme">🌙</button>

<!-- Navbar -->
<div class="navbar" id="navbar">
  <h1><i class="fas fa-car"></i> Speedy Rentals</h1>
  <div>
    <a href="user/login.php">User Login</a>
    <a href="admin/login.php">Admin Login</a>
    <a href="#contact">Contact</a>
  </div>
</div>

<!-- Hero Section -->
<div class="hero">
  <h2>Welcome to Speedy Rentals</h2>
  <p>Explore our fleet of premium cars tailored for your journey. Ride in style, drive with confidence.</p>
  <a href="user/login.php"><button class="btn">Book a Car</button></a>
</div>

<!-- Footer -->
<footer>
  &copy; <?php echo date("Y"); ?> Speedy Rentals. All rights reserved.
</footer>

<!-- Contact Section -->
<section id="contact">
  <h2 style="color: var(--highlight); font-size: 36px; margin-bottom: 20px;">Get in Touch</h2>
  <p style="color: #ccc; max-width: 600px; margin: auto;">Have questions, feedback, or need help with bookings? We'd love to hear from you.</p>

  <form id="contactForm" style="margin-top: 30px; max-width: 500px; margin-left: auto; margin-right: auto;">
    <input type="text" placeholder="Your Name" required>
    <input type="email" placeholder="Your Email" required>
    <textarea placeholder="Your Message" rows="5" required></textarea>
    <button class="btn" type="submit">Send Message</button>
  </form>
</section>

<!-- Back to Top Button -->
<button id="backToTop" title="Back to Top"><i class="fas fa-chevron-up"></i></button>

<!-- Scripts -->
<script>
  // Navbar scroll + Back to Top
  window.addEventListener('scroll', function () {
    const navbar = document.getElementById('navbar');
    if (window.scrollY > 50) {
      navbar.classList.add('scrolled');
    } else {
      navbar.classList.remove('scrolled');
    }

    document.getElementById('backToTop').style.display = window.scrollY > 300 ? 'block' : 'none';
  });

  document.querySelectorAll('.navbar a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function (e) {
      e.preventDefault();
      document.querySelector(this.getAttribute('href')).scrollIntoView({ behavior: 'smooth' });
    });
  });

  document.getElementById('backToTop').addEventListener('click', () => {
    window.scrollTo({ top: 0, behavior: 'smooth' });
  });

  // Contact form (Demo)
  document.getElementById('contactForm').addEventListener('submit', function (e) {
    e.preventDefault();
    alert("Thanks for reaching out! We'll get back to you soon. 🚗");
    this.reset();
  });

  // Theme Toggle
  const toggleBtn = document.getElementById("themeToggle");
  const body = document.body;

  function updateIcon() {
    toggleBtn.textContent = body.classList.contains("light") ? "🌙" : "☀️";
  }

  const savedTheme = localStorage.getItem("theme");
  if (savedTheme === "light") {
    body.classList.add("light");
  }
  updateIcon();

  toggleBtn.addEventListener("click", () => {
    body.classList.toggle("light");
    const theme = body.classList.contains("light") ? "light" : "dark";
    localStorage.setItem("theme", theme);
    updateIcon();
  });
</script>

</body>
</html>
