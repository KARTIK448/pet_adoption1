<head>
    <link rel="stylesheet" href="css/styles.css">
</head>
</ul>
        </nav>
    </header>
    <footer>
  <!-- CONTACT SECTION START -->
<section class="contact-section">
  <div class="contact-wrapper">
    <h2>💌 Contact Us</h2>
    <p class="contact-intro">Have a question? Want to adopt a furry friend? Drop us a message below and we’ll get back to you pawsitively fast!</p>
    
    <form action="contact_submit.php" method="post" class="contact-form">
      <div class="form-group">
        <label for="name">Your Name</label>
        <input type="text" name="name" id="name" required>
      </div>

      <div class="form-group">
        <label for="email">Email Address</label>
        <input type="email" name="email" id="email" required>
      </div>

      <div class="form-group">
        <label for="message">Your Message</label>
        <textarea name="message" id="message" rows="5" required></textarea>
      </div>

      <button type="submit" class="button">Send Message</button>
    </form>
  </div>
</section>
    </form>
        <p>&copy; <?php echo date("Y"); ?> Pet Adoption Website. All rights reserved.</p>
    </footer>
</body>
</html>