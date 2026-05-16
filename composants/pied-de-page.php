<footer>
  <span class="footer-copy">© 2025 Mahamat Dillo Berkou — @bavarois</span>
  <div class="footer-socials">
    <a href="https://www.facebook.com/profile.php?id=100080874432473" target="_blank" title="Facebook">
      <i class="fab fa-facebook"></i>
    </a>
    <a href="https://www.instagram.com/bavaroiscriminos/" target="_blank" title="Instagram">
      <i class="fab fa-instagram"></i>
    </a>
    <a href="mailto:bavbavarois@gmail.com" title="Gmail">
      <i class="fas fa-envelope"></i>
    </a>
  </div>
</footer>

<script>
  const reveals = document.querySelectorAll('.reveal');
  const observer = new IntersectionObserver((entries) => {
    entries.forEach(e => { if (e.isIntersecting) e.target.classList.add('visible'); });
  }, { threshold: 0.1 });
  reveals.forEach(r => observer.observe(r));
</script>
