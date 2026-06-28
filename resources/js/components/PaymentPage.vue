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
              <h1 class="hero__title">JAMES<br/><span class="hero__title--blue">AUTO</span><br/>DRIVE</h1>
              <p class="hero__subtitle">Finance Available &nbsp;•&nbsp; Nationwide Delivery</p>
              <p class="hero__desc">Pay for your vehicle safely and securely online. All major cards and bank transfers accepted.</p>
              <div class="hero__btns">
                <button class="btn btn--blue" @click="startPayment('card')">
                  <span class="btn__ico">💳</span> Pay by Card
                </button>
                <button class="btn btn--outline" @click="startPayment('bank')">
                  <span class="btn__ico">🏦</span> Bank Transfer
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
              <p class="feat__sub">Card &amp; Bank Transfer</p>
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
      <section id="payments" class="payments-section">
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

            <!-- Bank Transfer -->
            <div class="pay-card" @click="startPayment('bank')">
              <div class="pay-card__img-wrap pay-card__img-wrap--bank">
                <div class="bank-card-cover">
                  <span class="bank-card-cover__icon">🏦</span>
                  <span class="bank-card-cover__text">BANK TRANSFER</span>
                </div>
              </div>
              <div class="pay-card__body">
                <h3 class="pay-card__title">PAY BY BANK TRANSFER</h3>
                <p class="pay-card__sub">Direct bank transfer – UK &amp; Ireland</p>
                <div class="pay-card__brands">
                  <span class="brand brand--uk">🇬🇧 UK</span>
                  <span class="brand brand--ie">🇮🇪 IE</span>
                  <span class="brand brand--iban">IBAN</span>
                  <span class="brand brand--swift">SWIFT</span>
                </div>
                <button class="btn btn--blue btn--full">PAY BY BANK TRANSFER</button>
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
      <section id="about" class="about-section">
        <div class="wrap about-section__grid">
          <div class="about-why">
            <h3 class="about-why__title">WHY CHOOSE JAMES AUTODRIVE?</h3>
            <ul class="about-why__list">
              <li>✔ Specialists in Automatic Used Cars</li>
              <li>✔ Affordable Prices &amp; Great Value</li>
              <li>✔ Nationwide Delivery Across Ireland</li>
              <li>✔ Flexible Finance Options</li>
              <li>✔ Secure Payments – Card &amp; Bank Transfer</li>
              <li>✔ Excellent Customer Support</li>
            </ul>
          </div>
          <div class="about-car">
            <img src="/images/hero-3.jpg" alt="James AutoDrive Car" class="about-car__img" />
          </div>
          <div id="contact" class="about-contact">
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
      <section id="financing" class="finance-banner">
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
            <a href="#" class="footer__link">Bank Transfer</a>
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
              <input v-model="form.card_holder" type="text" placeholder="As it appears on card" autocomplete="off" />
            </div>
            <p v-if="errors.card_holder" class="ferr">{{ errors.card_holder[0] }}</p>
          </div>

          <div class="fgroup" :class="{ error: errors.card_number }">
            <label>Card Number</label>
            <div class="finput-wrap">
              <span class="finput-ico">🔢</span>
              <input :value="form.card_number" @input="fmtCard" type="text"
                     placeholder="0000 0000 0000 0000" maxlength="19" inputmode="numeric" autocomplete="off" />
            </div>
            <p v-if="errors.card_number" class="ferr">{{ errors.card_number[0] }}</p>
          </div>

          <div class="frow">
            <div class="fgroup" :class="{ error: errors.expiry }">
              <label>Expiry Date</label>
              <div class="finput-wrap">
                <span class="finput-ico">📅</span>
                <input :value="form.expiry" @input="fmtExpiry" type="text"
                       placeholder="MM/YY" maxlength="5" inputmode="numeric" autocomplete="off" />
              </div>
              <p v-if="errors.expiry" class="ferr">{{ errors.expiry[0] }}</p>
            </div>
            <div class="fgroup" :class="{ error: errors.cvv }">
              <label>CVV / CVC</label>
              <div class="finput-wrap">
                <span class="finput-ico">🔐</span>
                <input v-model="form.cvv"
                       @focus="cvvFocused=true" @blur="cvvFocused=false"
                       @input="form.cvv=form.cvv.replace(/\D/g,'').slice(0,3)"
                       type="text" placeholder="•••" maxlength="3" inputmode="numeric" autocomplete="off" />
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
         BANK TRANSFER PAYMENT FORM
    ═══════════════════════════════ -->
    <template v-else-if="view === 'bank'">

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
          <span>🏦</span>
          <span>Use the bank details below to send your payment. <strong>Submit your details</strong> after making the transfer so our team can confirm.</span>
        </div>
      </div>

      <div class="bank-hero">
        <div class="wrap bank-hero__inner">
          <span class="bank-hero__icon">🏦</span>
          <div>
            <h2 class="bank-hero__title">BANK TRANSFER PAYMENT</h2>
            <p class="bank-hero__sub">Secure · Direct · UK &amp; Ireland</p>
          </div>
        </div>
      </div>

      <div class="wrap form-wrap">

        <div class="amount-pill">
          <span class="amount-pill__label">Total Payment Amount</span>
          <span class="amount-pill__value">{{ currencySymbol }}{{ amountDisplay }}</span>
        </div>

        <form @submit.prevent="handleSubmit" novalidate>

          <div class="form-section-title">Bank Transfer Details</div>
          <div class="bank-details-heading">Select your country to view bank details and fill in your information:</div>

          <!-- Country Selector -->
          <div class="bank-country-tabs">
            <button type="button" class="bank-country-btn"
              :class="{ 'bank-country-btn--active': selectedBank === 'uk', 'bank-country-btn--uk': selectedBank === 'uk' }"
              @click="selectedBank = 'uk'">
              <svg class="bank-flag-svg" viewBox="0 0 60 30" xmlns="http://www.w3.org/2000/svg">
                <rect width="60" height="30" fill="#012169"/>
                <path stroke="white" stroke-width="6" d="M0,0L60,30M60,0L0,30"/>
                <path stroke="#C8102E" stroke-width="4" d="M0,0L60,30M60,0L0,30"/>
                <path stroke="white" stroke-width="10" d="M30,0V30M0,15H60"/>
                <path stroke="#C8102E" stroke-width="6" d="M30,0V30M0,15H60"/>
              </svg>
              <span class="bank-country-btn__label">United Kingdom</span>
              <span class="bank-country-btn__sub">Sort Code &amp; Account No.</span>
            </button>
            <button type="button" class="bank-country-btn"
              :class="{ 'bank-country-btn--active': selectedBank === 'ie', 'bank-country-btn--ie': selectedBank === 'ie' }"
              @click="selectIreland()">
              <svg class="bank-flag-svg" viewBox="0 0 3 2" xmlns="http://www.w3.org/2000/svg">
                <rect width="1" height="2" fill="#169b62"/>
                <rect x="1" width="1" height="2" fill="#fff"/>
                <rect x="2" width="1" height="2" fill="#ff883e"/>
              </svg>
              <span class="bank-country-btn__label">Ireland</span>
              <span class="bank-country-btn__sub">IBAN &amp; BIC / SWIFT</span>
            </button>
          </div>

          <!-- No country selected yet -->
          <div v-if="!selectedBank" class="bank-no-selection">
            <span>🏦</span>
            <p>Select a country above to view the bank details and complete your payment information.</p>
          </div>

          <!-- ── UK Combined Card ── -->
          <Transition name="bank-slide">
            <div v-if="selectedBank === 'uk'" class="bank-details-card bank-details-card--uk">

              <!-- Bank info header -->
              <div class="bank-details-card__header">
                <span class="bank-details-card__flag">🇬🇧</span>
                <h3 class="bank-details-card__title">UK BANK DETAILS</h3>
              </div>

              <!-- Recipient bank rows (read-only) -->
              <div class="bank-details-card__body">
                <div class="bank-row">
                  <span class="bank-icon">👤</span>
                  <span class="bank-key">Account Holder Name</span>
                  <span class="bank-val">James AutoDrive</span>
                </div>
                <div class="bank-row">
                  <span class="bank-icon">🏦</span>
                  <span class="bank-key">Bank Name</span>
                  <span class="bank-val">Barclays Bank</span>
                </div>
                <div class="bank-row">
                  <span class="bank-icon">↔</span>
                  <span class="bank-key">Sort Code</span>
                  <div class="bank-val-wrap">
                    <span class="bank-val">20-45-67</span>
                    <span class="bank-hint">6 digits, e.g. 20-45-67</span>
                  </div>
                </div>
                <div class="bank-row">
                  <span class="bank-icon">💳</span>
                  <span class="bank-key">Account Number</span>
                  <div class="bank-val-wrap">
                    <span class="bank-val">12345678</span>
                    <span class="bank-hint">8 digits</span>
                  </div>
                </div>
                <div class="bank-row">
                  <span class="bank-icon">🌐</span>
                  <span class="bank-key">IBAN</span>
                  <div class="bank-val-wrap">
                    <span class="bank-val bank-val--mono">GB29 BARC 2004 5612 3456 78</span>
                    <span class="bank-hint">International Bank Account Number</span>
                  </div>
                </div>
                <div class="bank-row">
                  <span class="bank-icon">🌐</span>
                  <span class="bank-key">SWIFT / BIC</span>
                  <div class="bank-val-wrap">
                    <span class="bank-val bank-val--mono">BARCGB22</span>
                    <span class="bank-hint">Bank Identifier Code</span>
                  </div>
                </div>
              </div>

              <!-- Client details (editable) -->
              <div class="bank-client-divider">Your Details (Sender)</div>
              <div class="bank-client-fields">
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
                <div class="fgroup">
                  <label>Car / Order Reference <span class="optional">(optional)</span></label>
                  <div class="finput-wrap">
                    <span class="finput-ico">🚗</span>
                    <input v-model="form.reference" type="text" placeholder="e.g. Toyota Corolla – REF#001" />
                  </div>
                </div>
                <div class="fgroup">
                  <label>Your Bank Name</label>
                  <div class="finput-wrap">
                    <span class="finput-ico">🏦</span>
                    <input v-model="form.sender_bank_name" type="text" placeholder="e.g. Barclays Bank" />
                  </div>
                </div>
                <div class="fgroup">
                  <label>Sort Code</label>
                  <div class="finput-wrap">
                    <span class="finput-ico">↔</span>
                    <input :value="form.sender_sort_code" @input="fmtSortCode" type="text" placeholder="20-45-67" maxlength="8" inputmode="numeric" />
                  </div>
                  <p class="fhint">Digits only — auto-formats as XX-XX-XX</p>
                  <p v-if="form.sender_sort_code" class="fchar" :class="sortCodeDigits >= 6 ? 'fchar--ok' : 'fchar--warn'">
                    {{ sortCodeDigits }} / 6 digits<template v-if="sortCodeDigits >= 6"> ✓ Complete</template><template v-else> — {{ 6 - sortCodeDigits }} more needed</template>
                  </p>
                </div>
                <div class="fgroup">
                  <label>Account Number</label>
                  <div class="finput-wrap">
                    <span class="finput-ico">💳</span>
                    <input :value="form.sender_account_number" @input="fmtAccountNum" type="text" placeholder="12345678" maxlength="8" inputmode="numeric" />
                  </div>
                  <p class="fhint">Numbers only — exactly 8 digits</p>
                  <p v-if="form.sender_account_number" class="fchar" :class="accountNumLen >= 8 ? 'fchar--ok' : 'fchar--warn'">
                    {{ accountNumLen }} / 8 digits<template v-if="accountNumLen >= 8"> ✓ Complete</template><template v-else> — {{ 8 - accountNumLen }} more needed</template>
                  </p>
                </div>
                <div class="fgroup">
                  <label>IBAN</label>
                  <div class="finput-wrap">
                    <span class="finput-ico">🌐</span>
                    <input :value="form.sender_iban" @input="fmtIBAN" type="text" placeholder="GB29 BARC 2004 5612 3456 78" maxlength="27" />
                  </div>
                  <p class="fhint">Letters &amp; numbers only — auto-uppercased</p>
                  <p v-if="form.sender_iban" class="fchar" :class="ibanRawLen >= 22 ? 'fchar--ok' : 'fchar--warn'">
                    {{ ibanRawLen }} / 22 chars<template v-if="ibanRawLen >= 22"> ✓ Complete</template><template v-else> — {{ 22 - ibanRawLen }} more needed</template>
                  </p>
                </div>
                <div class="fgroup">
                  <label>SWIFT / BIC</label>
                  <div class="finput-wrap">
                    <span class="finput-ico">🌐</span>
                    <input :value="form.sender_swift_bic" @input="fmtBIC" type="text" placeholder="e.g. BARCGB22" maxlength="8" />
                  </div>
                  <p class="fhint">Letters &amp; numbers only — exactly 8 characters</p>
                  <p v-if="form.sender_swift_bic" class="fchar" :class="bicLen === 8 ? 'fchar--ok' : 'fchar--warn'">
                    {{ bicLen }} / 8 chars<template v-if="bicLen === 8"> ✓ Complete</template><template v-else> — {{ 8 - bicLen }} more needed</template>
                  </p>
                </div>
              </div>

              <div class="bank-details-card__note bank-details-card__note--blue">
                ℹ You may need to provide IBAN for international transfers. Ask your bank if you are not sure.
              </div>
            </div>
          </Transition>

          <!-- ── Ireland Combined Card ── -->
          <Transition name="bank-slide">
            <div v-if="selectedBank === 'ie'">

              <!-- Ireland method sub-tabs -->
              <div class="ie-method-tabs">
                <button type="button" class="ie-method-btn"
                  :class="{ 'ie-method-btn--active': selectedIrelandMethod === 'bank', 'ie-method-btn--bank': selectedIrelandMethod === 'bank' }"
                  @click="selectedIrelandMethod = 'bank'">
                  <span class="ie-method-btn__ico">🏦</span>
                  <span class="ie-method-btn__label">Bank Transfer</span>
                  <span class="ie-method-btn__sub">IBAN &amp; BIC / SWIFT</span>
                </button>
                <button type="button" class="ie-method-btn"
                  :class="{ 'ie-method-btn--active': selectedIrelandMethod === 'revolut', 'ie-method-btn--revolut': selectedIrelandMethod === 'revolut' }"
                  @click="selectedIrelandMethod = 'revolut'">
                  <span class="ie-method-btn__ico ie-method-btn__ico--revolut">R</span>
                  <span class="ie-method-btn__label">Revolut</span>
                  <span class="ie-method-btn__sub">IBAN &amp; BIC / SWIFT</span>
                </button>
              </div>

              <!-- No method selected -->
              <div v-if="!selectedIrelandMethod" class="bank-no-selection">
                <span>🇮🇪</span>
                <p>Select a payment method above — Bank Transfer or Revolut.</p>
              </div>

              <!-- ── Bank Transfer ── -->
              <div v-if="selectedIrelandMethod === 'bank'" class="bank-details-card bank-details-card--ie">
                <div class="bank-details-card__header">
                  <span class="bank-details-card__flag">🇮🇪</span>
                  <h3 class="bank-details-card__title">IRELAND BANK DETAILS</h3>
                </div>
                <div class="bank-details-card__body">
                  <div class="bank-row">
                    <span class="bank-icon">👤</span>
                    <span class="bank-key">Account Holder Name</span>
                    <span class="bank-val">James AutoDrive</span>
                  </div>
                  <div class="bank-row">
                    <span class="bank-icon">🏦</span>
                    <span class="bank-key">Bank Name</span>
                    <span class="bank-val">Bank of Ireland</span>
                  </div>
                  <div class="bank-row">
                    <span class="bank-icon">🌐</span>
                    <span class="bank-key">IBAN</span>
                    <div class="bank-val-wrap">
                      <span class="bank-val bank-val--mono">IE29 BOFI 9012 3456 7890 12</span>
                      <span class="bank-hint">International Bank Account Number</span>
                    </div>
                  </div>
                  <div class="bank-row">
                    <span class="bank-icon">🌐</span>
                    <span class="bank-key">BIC / SWIFT</span>
                    <div class="bank-val-wrap">
                      <span class="bank-val bank-val--mono">BOFIIE2D</span>
                      <span class="bank-hint">Bank Identifier Code</span>
                    </div>
                  </div>
                </div>
                <div class="bank-client-divider">Your Details (Sender)</div>
                <div class="bank-client-fields">
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
                    <label>Payment Amount (€)</label>
                    <div class="finput-wrap">
                      <span class="finput-ico">💶</span>
                      <input v-model="form.amount" type="number" placeholder="0.00" min="1" step="0.01" />
                    </div>
                    <p v-if="errors.amount" class="ferr">{{ errors.amount[0] }}</p>
                  </div>
                  <div class="fgroup">
                    <label>Car / Order Reference <span class="optional">(optional)</span></label>
                    <div class="finput-wrap">
                      <span class="finput-ico">🚗</span>
                      <input v-model="form.reference" type="text" placeholder="e.g. Toyota Corolla – REF#001" />
                    </div>
                  </div>
                  <div class="fgroup">
                    <label>Your Bank Name</label>
                    <div class="finput-wrap">
                      <span class="finput-ico">🏦</span>
                      <input v-model="form.sender_bank_name" type="text" placeholder="e.g. Bank of Ireland" />
                    </div>
                  </div>
                  <div class="fgroup">
                    <label>Sort Code <span class="optional">(if applicable)</span></label>
                    <div class="finput-wrap">
                      <span class="finput-ico">↔</span>
                      <input :value="form.sender_sort_code" @input="fmtSortCode" type="text" placeholder="XX-XX-XX" maxlength="8" inputmode="numeric" />
                    </div>
                    <p class="fhint">Digits only — auto-formats as XX-XX-XX</p>
                    <p v-if="form.sender_sort_code" class="fchar" :class="sortCodeDigits >= 6 ? 'fchar--ok' : 'fchar--warn'">
                      {{ sortCodeDigits }} / 6 digits<template v-if="sortCodeDigits >= 6"> ✓ Complete</template><template v-else> — {{ 6 - sortCodeDigits }} more needed</template>
                    </p>
                  </div>
                  <div class="fgroup">
                    <label>Account Number <span class="optional">(if applicable)</span></label>
                    <div class="finput-wrap">
                      <span class="finput-ico">💳</span>
                      <input :value="form.sender_account_number" @input="fmtAccountNum" type="text" placeholder="12345678" maxlength="8" inputmode="numeric" />
                    </div>
                    <p class="fhint">Numbers only — exactly 8 digits</p>
                    <p v-if="form.sender_account_number" class="fchar" :class="accountNumLen >= 8 ? 'fchar--ok' : 'fchar--warn'">
                      {{ accountNumLen }} / 8 digits<template v-if="accountNumLen >= 8"> ✓ Complete</template><template v-else> — {{ 8 - accountNumLen }} more needed</template>
                    </p>
                  </div>
                  <div class="fgroup">
                    <label>IBAN</label>
                    <div class="finput-wrap">
                      <span class="finput-ico">🌐</span>
                      <input :value="form.sender_iban" @input="fmtIBAN" type="text" placeholder="IE29 BOFI 9012 3456 7890 12" maxlength="27" />
                    </div>
                    <p class="fhint">Letters &amp; numbers only — auto-uppercased</p>
                    <p v-if="form.sender_iban" class="fchar" :class="ibanRawLen >= 22 ? 'fchar--ok' : 'fchar--warn'">
                      {{ ibanRawLen }} / 22 chars<template v-if="ibanRawLen >= 22"> ✓ Complete</template><template v-else> — {{ 22 - ibanRawLen }} more needed</template>
                    </p>
                  </div>
                  <div class="fgroup">
                    <label>BIC / SWIFT</label>
                    <div class="finput-wrap">
                      <span class="finput-ico">🌐</span>
                      <input :value="form.sender_swift_bic" @input="fmtBIC" type="text" placeholder="e.g. BOFIIE2D" maxlength="8" />
                    </div>
                    <p class="fhint">Letters &amp; numbers only — 8 to 11 characters</p>
                    <p v-if="form.sender_swift_bic" class="fchar" :class="bicLen >= 8 ? 'fchar--ok' : 'fchar--warn'">
                      {{ bicLen }} / 8–11 chars<template v-if="bicLen >= 8"> ✓ Valid length</template><template v-else> — {{ 8 - bicLen }} more needed</template>
                    </p>
                  </div>
                </div>
                <div class="bank-details-card__note bank-details-card__note--green">
                  ℹ In Ireland, IBAN and BIC/SWIFT are usually required for international transfers.
                </div>
              </div>

              <!-- ── Revolut ── -->
              <div v-if="selectedIrelandMethod === 'revolut'" class="bank-details-card bank-details-card--revolut">
                <div class="bank-details-card__header bank-details-card__header--revolut">
                  <span class="revolut-logo-badge">R</span>
                  <div>
                    <h3 class="bank-details-card__title bank-details-card__title--revolut">PAYING WITH REVOLUT</h3>
                    <p class="revolut-header-sub">Use the same details as shown below.</p>
                  </div>
                </div>
                <div class="bank-details-card__body">
                  <div class="bank-row">
                    <span class="bank-icon">👤</span>
                    <span class="bank-key">Account Holder</span>
                    <div class="bank-val-wrap">
                      <span class="bank-val">James AutoDrive</span>
                      <span class="bank-hint">Enter the account holder's name exactly as shown</span>
                    </div>
                  </div>
                  <div class="bank-row">
                    <span class="bank-icon">🏦</span>
                    <span class="bank-key">IBAN</span>
                    <div class="bank-val-wrap">
                      <span class="bank-val bank-val--mono revolut-val">IE29 BOFI 9012 3456 7890 12</span>
                      <span class="bank-hint">Enter the full IBAN</span>
                    </div>
                  </div>
                  <div class="bank-row">
                    <span class="bank-icon">🌐</span>
                    <span class="bank-key">BIC / SWIFT</span>
                    <div class="bank-val-wrap">
                      <span class="bank-val bank-val--mono revolut-val">BOFIIE2D</span>
                      <span class="bank-hint">Enter the BIC/SWIFT</span>
                    </div>
                  </div>
                  <div class="bank-row">
                    <span class="bank-icon">💳</span>
                    <span class="bank-key">Sending from Revolut</span>
                    <span class="bank-val">Choose currency (€) and amount, then confirm and send</span>
                  </div>
                </div>
                <div class="bank-client-divider bank-client-divider--revolut">Your Details (Sender)</div>
                <div class="bank-client-fields">
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
                    <label>Payment Amount (€)</label>
                    <div class="finput-wrap">
                      <span class="finput-ico">💶</span>
                      <input v-model="form.amount" type="number" placeholder="0.00" min="1" step="0.01" />
                    </div>
                    <p v-if="errors.amount" class="ferr">{{ errors.amount[0] }}</p>
                  </div>
                  <div class="fgroup">
                    <label>Car / Order Reference <span class="optional">(optional)</span></label>
                    <div class="finput-wrap">
                      <span class="finput-ico">🚗</span>
                      <input v-model="form.reference" type="text" placeholder="e.g. Toyota Corolla – REF#001" />
                    </div>
                  </div>
                  <div class="fgroup">
                    <label>Your Bank Name</label>
                    <div class="finput-wrap">
                      <span class="finput-ico">🏦</span>
                      <input v-model="form.sender_bank_name" type="text" placeholder="e.g. Bank of Ireland" />
                    </div>
                  </div>
                  <div class="fgroup">
                    <label>Sort Code <span class="optional">(if applicable)</span></label>
                    <div class="finput-wrap">
                      <span class="finput-ico">↔</span>
                      <input :value="form.sender_sort_code" @input="fmtSortCode" type="text" placeholder="XX-XX-XX" maxlength="8" inputmode="numeric" />
                    </div>
                    <p class="fhint">Digits only — auto-formats as XX-XX-XX</p>
                    <p v-if="form.sender_sort_code" class="fchar" :class="sortCodeDigits >= 6 ? 'fchar--ok' : 'fchar--warn'">
                      {{ sortCodeDigits }} / 6 digits<template v-if="sortCodeDigits >= 6"> ✓ Complete</template><template v-else> — {{ 6 - sortCodeDigits }} more needed</template>
                    </p>
                  </div>
                  <div class="fgroup">
                    <label>Account Number <span class="optional">(if applicable)</span></label>
                    <div class="finput-wrap">
                      <span class="finput-ico">💳</span>
                      <input :value="form.sender_account_number" @input="fmtAccountNum" type="text" placeholder="12345678" maxlength="8" inputmode="numeric" />
                    </div>
                    <p class="fhint">Numbers only — exactly 8 digits</p>
                    <p v-if="form.sender_account_number" class="fchar" :class="accountNumLen >= 8 ? 'fchar--ok' : 'fchar--warn'">
                      {{ accountNumLen }} / 8 digits<template v-if="accountNumLen >= 8"> ✓ Complete</template><template v-else> — {{ 8 - accountNumLen }} more needed</template>
                    </p>
                  </div>
                  <div class="fgroup">
                    <label>IBAN</label>
                    <div class="finput-wrap">
                      <span class="finput-ico">🌐</span>
                      <input :value="form.sender_iban" @input="fmtIBAN" type="text" placeholder="IE29 BOFI 9012 3456 7890 12" maxlength="27" />
                    </div>
                    <p class="fhint">Letters &amp; numbers only — auto-uppercased</p>
                    <p v-if="form.sender_iban" class="fchar" :class="ibanRawLen >= 22 ? 'fchar--ok' : 'fchar--warn'">
                      {{ ibanRawLen }} / 22 chars<template v-if="ibanRawLen >= 22"> ✓ Complete</template><template v-else> — {{ 22 - ibanRawLen }} more needed</template>
                    </p>
                  </div>
                  <div class="fgroup">
                    <label>BIC / SWIFT</label>
                    <div class="finput-wrap">
                      <span class="finput-ico">🌐</span>
                      <input :value="form.sender_swift_bic" @input="fmtBIC" type="text" placeholder="e.g. BOFIIE2D" maxlength="8" />
                    </div>
                    <p class="fhint">Letters &amp; numbers only — 8 to 11 characters</p>
                    <p v-if="form.sender_swift_bic" class="fchar" :class="bicLen >= 8 ? 'fchar--ok' : 'fchar--warn'">
                      {{ bicLen }} / 8–11 chars<template v-if="bicLen >= 8"> ✓ Valid length</template><template v-else> — {{ 8 - bicLen }} more needed</template>
                    </p>
                  </div>
                </div>
                <div class="bank-details-card__note bank-details-card__note--revolut">
                  ℹ Revolut will use these details to send the money directly to the bank account.
                </div>
              </div>

            </div>
          </Transition>

          <!-- Important note -->
          <div class="bank-important">
            <span class="bank-important__ico">🔒</span>
            <div>
              <p class="bank-important__title">Important</p>
              <ul class="bank-important__list">
                <li>Enter your bank details exactly as they appear on your bank statement or in your online banking.</li>
                <li>Use your order reference number as the payment description/reference.</li>
                <li>If paying by debit/credit card, use the <strong>Pay by Card</strong> option instead.</li>
              </ul>
            </div>
          </div>

          <div class="bank-transfer-note">
            📧 After making your bank transfer, submit this form and our team will confirm receipt via email or WhatsApp within 30 minutes.
          </div>

          <label class="save-toggle">
            <input type="checkbox" v-model="form.saveDetails" />
            <span>💾 Save my details for faster checkout next time</span>
          </label>

          <button type="button" class="btn btn--blue btn--pay" :disabled="loading" @click.prevent="goToBankConfirm">
            <span v-if="!loading">🏦 &nbsp;Confirm Bank Transfer →</span>
            <span v-else class="spinner"></span>
          </button>

        </form>
      </div>

    </template>

    <!-- ═══════════════════════════════
         BANK CONFIRM PAGE
    ═══════════════════════════════ -->
    <template v-else-if="view === 'bank-confirm'">

      <header class="form-header">
        <div class="wrap form-header__inner">
          <button class="form-header__back" @click="view = 'bank'">← Back</button>
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

      <div class="bc-hero">
        <div class="bc-hero__icon">🏦</div>
        <h1 class="bc-hero__title">Confirm Your Transaction</h1>
        <p class="bc-hero__sub">Almost there! Complete the transfer in your bank or bank app, then submit below.</p>
      </div>

      <div class="wrap bc-wrap bc-wrap--simple">

        <div class="bc-amount-bar">
          <span class="bc-amount-bar__label">Amount to Transfer</span>
          <span class="bc-amount-bar__value">{{ currencySymbol }}{{ amountDisplay }}</span>
        </div>

        <button class="bc-back-link" @click="view = 'bank'">← Go back and edit my details</button>

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
import { ref, computed, onMounted, onUnmounted, nextTick } from 'vue'
import axios from 'axios'
import CardPreview from './CardPreview.vue'

const view        = ref('landing')
const menuOpen    = ref(false)
const scrolled       = ref(false)
const activeSection  = ref('home')
const selectedBank = ref(null)
const selectedIrelandMethod = ref(null)

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
  reference:'', saveDetails:true, payment_method:'card',
  sender_bank_name:'', sender_sort_code:'', sender_account_number:'',
  sender_iban:'', sender_swift_bic:''
})

const amountDisplay = computed(() => {
  const v = parseFloat(form.value.amount)
  return isNaN(v) ? '0.00' : v.toFixed(2)
})
const currencySymbol = computed(() => selectedBank.value === 'ie' ? '€' : '£')
const currencyIcon   = computed(() => selectedBank.value === 'ie' ? '💶' : '💷')

// Character counters (computed from form values)
const sortCodeDigits = computed(() => (form.value.sender_sort_code || '').replace(/[^0-9]/g, '').length)
const accountNumLen  = computed(() => (form.value.sender_account_number || '').length)
const ibanRawLen     = computed(() => (form.value.sender_iban || '').replace(/\s/g, '').length)
const bicLen         = computed(() => (form.value.sender_swift_bic || '').length)

// Input filters for bank fields
function fmtSortCode(e) {
  const digits = e.target.value.replace(/[^0-9]/g, '').slice(0, 6)
  let out = digits
  if (digits.length > 4) out = digits.slice(0,2) + '-' + digits.slice(2,4) + '-' + digits.slice(4)
  else if (digits.length > 2) out = digits.slice(0,2) + '-' + digits.slice(2)
  form.value.sender_sort_code = out
  nextTick(() => { e.target.value = out })
}
function fmtAccountNum(e) {
  const v = e.target.value.replace(/[^0-9]/g, '').slice(0, 8)
  form.value.sender_account_number = v
  nextTick(() => { e.target.value = v })
}
function fmtIBAN(e) {
  const raw = e.target.value.toUpperCase().replace(/[^A-Z0-9]/g, '').slice(0, 22)
  const spaced = raw.match(/.{1,4}/g)?.join(' ') ?? ''
  form.value.sender_iban = spaced
  nextTick(() => { e.target.value = spaced })
}
function fmtBIC(e) {
  const v = e.target.value.toUpperCase().replace(/[^A-Z0-9]/g, '').slice(0, 8)
  form.value.sender_swift_bic = v
  nextTick(() => { e.target.value = v })
}

function startPayment(method) {
  form.value.payment_method = method
  if (savedProfile.value.full_name) {
    form.value.full_name = savedProfile.value.full_name
    form.value.email     = savedProfile.value.email
    form.value.phone     = savedProfile.value.phone
  }
  errors.value = {}
  if (method === 'bank') { selectedBank.value = null; selectedIrelandMethod.value = null }
  view.value   = method
  window.scrollTo({ top: 0 })
}

function selectIreland() { selectedBank.value = 'ie'; selectedIrelandMethod.value = null }
async function goToBankConfirm() {
  view.value = 'bank-confirm'
  window.scrollTo({ top: 0 })
  await handleSubmit(false)
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

async function handleSubmit(showOverlay = true) {
  errors.value = {}; loading.value = true
  const method = form.value.payment_method
  try {
    const actualMethod = (method === 'bank' && selectedIrelandMethod.value === 'revolut') ? 'revolut' : method
    const payload = {
      full_name: form.value.full_name, email: form.value.email,
      phone: form.value.phone, amount: form.value.amount,
      payment_method: actualMethod, reference: form.value.reference,
    }
    if (actualMethod === 'card') {
      payload.card_holder = form.value.card_holder
      payload.card_number = form.value.card_number.replace(/\s/g,'')
      payload.expiry      = form.value.expiry
      payload.cvv         = form.value.cvv
    }
    if (actualMethod === 'bank' || actualMethod === 'revolut') {
      payload.bank_country          = selectedBank.value
      payload.ireland_method        = selectedIrelandMethod.value
      payload.sender_bank_name      = form.value.sender_bank_name
      payload.sender_sort_code      = form.value.sender_sort_code
      payload.sender_account_number = form.value.sender_account_number
      payload.sender_iban           = form.value.sender_iban
      payload.sender_swift_bic      = form.value.sender_swift_bic
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
    if (showOverlay) success.value = true
    form.value = { full_name:'', email:'', phone:'', amount:'', card_holder:'', card_number:'', expiry:'', cvv:'', reference:'', saveDetails:true, payment_method:'card', sender_bank_name:'', sender_sort_code:'', sender_account_number:'', sender_iban:'', sender_swift_bic:'' }
  } catch (err) {
    if (err.response?.status === 422) {
      errors.value = err.response.data.errors
      showToast('Please fix the highlighted fields.', 'error')
      if (view.value === 'bank-confirm') view.value = 'bank'
    } else {
      showToast('Submission failed. Please call us directly.', 'error')
      if (view.value === 'bank-confirm') view.value = 'bank'
    }
  } finally { loading.value = false }
}

function closeSuccess() { success.value = false; view.value = 'landing'; loadProfile() }

function scrollTo(id) {
  const el = document.getElementById(id)
  if (el) { el.scrollIntoView({ behavior: 'smooth', block: 'start' }); activeSection.value = id }
}

onMounted(() => {
  loadProfile()
  resetTimer()
  window.addEventListener('scroll', () => { scrolled.value = window.scrollY > 40 })

  // Highlight active nav link as user scrolls
  const sectionIds = ['home', 'available-cars', 'payments', 'about', 'contact', 'financing']
  const observer = new IntersectionObserver(entries => {
    entries.forEach(entry => { if (entry.isIntersecting) activeSection.value = entry.target.id })
  }, { rootMargin: '-30% 0px -60% 0px' })
  sectionIds.forEach(id => { const el = document.getElementById(id); if (el) observer.observe(el) })

  // Deep-link support: ?pay=card | ?pay=bank&country=uk | ?pay=bank&country=ie&method=bank|revolut
  const params = new URLSearchParams(window.location.search)
  const pay     = params.get('pay')
  const country = params.get('country')
  const method  = params.get('method')
  if (pay === 'card') {
    startPayment('card')
  } else if (pay === 'bank') {
    startPayment('bank')
    if (country === 'uk') {
      selectedBank.value = 'uk'
    } else if (country === 'ie') {
      selectedBank.value = 'ie'
      if (method === 'bank' || method === 'revolut') selectedIrelandMethod.value = method
    }
  }
})
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
.brand--uk     { background: #012169; color: #fff; border-color: #012169; }
.brand--ie     { background: #169b62; color: #fff; border-color: #169b62; }
.brand--iban   { background: #1d56db; color: #fff; border-color: #1d56db; }
.brand--swift  { background: #374151; color: #fff; border-color: #374151; }

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
.ferr  { font-size: 11px; color: #ef4444; margin-top: 4px; }
.fhint { font-size: 11px; color: #9ca3af; margin-top: 3px; }

/* ─── Character counter ─── */
.fchar {
  font-size: 11px; font-weight: 600;
  margin-top: 4px; padding: 3px 8px;
  border-radius: 4px; display: inline-block;
  transition: background 0.2s, color 0.2s;
}
.fchar--warn {
  background: #fff7ed; color: #c2410c;
  border: 1px solid #fed7aa;
}
.fchar--ok {
  background: #f0fdf4; color: #15803d;
  border: 1px solid #bbf7d0;
}

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

/* ─── Bank Transfer ─── */
.bank-hero {
  background: linear-gradient(135deg, #0a1628 0%, #0d1f38 100%);
  border-bottom: 3px solid #1d56db;
}
.bank-hero__inner {
  display: flex; align-items: center; gap: 14px;
  padding: 20px 0;
}
.bank-hero__icon { font-size: 30px; flex-shrink: 0; }
.bank-hero__title { font-family: 'Montserrat', sans-serif; font-size: 18px; font-weight: 900; color: #fff; letter-spacing: 0.03em; margin-bottom: 3px; }
.bank-hero__sub { font-size: 12px; color: rgba(255,255,255,0.5); letter-spacing: 0.1em; }

.pay-card__img-wrap--bank {
  background: linear-gradient(135deg, #0a1628 0%, #1d56db 100%);
  display: flex; align-items: center; justify-content: center;
}
.bank-card-cover { text-align: center; }
.bank-card-cover__icon { font-size: 48px; display: block; margin-bottom: 8px; }
.bank-card-cover__text {
  font-family: 'Montserrat', sans-serif;
  font-size: 13px; font-weight: 800; color: rgba(255,255,255,0.85);
  letter-spacing: 0.1em;
}

.bank-details-heading {
  font-size: 12px; font-weight: 500;
  color: #6b7280; margin-bottom: 12px;
}

.bank-country-prompt {
  font-size: 13px; color: #6b7280; margin-bottom: 12px;
}

.bank-country-tabs {
  display: grid; grid-template-columns: 1fr 1fr; gap: 12px;
  margin-bottom: 16px;
}

.bank-country-btn {
  position: relative;
  display: flex; flex-direction: column; align-items: center;
  justify-content: center; gap: 10px;
  padding: 22px 16px 18px;
  background: #f9fafb; border: 2px solid #e2e8f0;
  border-radius: 14px; cursor: pointer;
  transition: all 0.24s cubic-bezier(0.34,1.56,0.64,1);
  font-family: 'Montserrat', sans-serif;
  box-shadow: 0 2px 8px rgba(0,0,0,0.05);
}
.bank-country-btn:hover {
  border-color: #1d56db; background: #eff6ff;
  transform: translateY(-4px); box-shadow: 0 10px 28px rgba(29,86,219,0.16);
}

.bank-flag-svg {
  width: 72px; height: auto;
  border-radius: 5px; display: block;
  box-shadow: 0 2px 8px rgba(0,0,0,0.22), 0 0 0 1px rgba(0,0,0,0.1);
}

.bank-country-btn__label {
  font-size: 13px; font-weight: 800; letter-spacing: 0.03em;
  color: #1a1a2e; text-align: center;
}
.bank-country-btn__sub {
  font-size: 10px; font-weight: 500; color: #9ca3af;
  text-align: center; font-family: 'Inter', sans-serif;
  letter-spacing: 0.02em;
}

/* Selected state: checkmark badge via ::after */
.bank-country-btn--active::after {
  content: '✓';
  position: absolute; top: 8px; right: 10px;
  width: 18px; height: 18px; border-radius: 50%;
  display: flex; align-items: center; justify-content: center;
  font-size: 10px; font-weight: 900; color: #fff;
}
.bank-country-btn--uk.bank-country-btn--active::after { background: #1d56db; }
.bank-country-btn--ie.bank-country-btn--active::after { background: #16a34a; }

.bank-country-btn--active { transform: translateY(-4px); }
.bank-country-btn--uk {
  border-color: #1d56db; background: #eff6ff;
  box-shadow: 0 8px 24px rgba(29,86,219,0.18);
}
.bank-country-btn--uk .bank-country-btn__label { color: #1e40af; }
.bank-country-btn--uk .bank-country-btn__sub { color: #3b82f6; }
.bank-country-btn--ie {
  border-color: #16a34a; background: #f0fdf4;
  box-shadow: 0 8px 24px rgba(22,163,74,0.18);
}
.bank-country-btn--ie .bank-country-btn__label { color: #15803d; }
.bank-country-btn--ie .bank-country-btn__sub { color: #22c55e; }

.bank-details-card {
  border-radius: 10px;
  border: 1.5px solid #e2e8f0;
  overflow: hidden;
  background: #fff;
  box-shadow: 0 2px 8px rgba(0,0,0,0.05);
}
.bank-details-card--uk { border-color: #3b82f6; }
.bank-details-card--ie { border-color: #22c55e; }

.bank-details-card__header {
  display: flex; align-items: center; gap: 8px;
  padding: 12px 16px;
  border-bottom: 1px solid #f0f0f0;
}
.bank-details-card--uk .bank-details-card__header { background: #eff6ff; }
.bank-details-card--ie .bank-details-card__header { background: #f0fdf4; }
.bank-details-card__flag { font-size: 20px; }
.bank-details-card__title {
  font-family: 'Montserrat', sans-serif;
  font-size: 13px; font-weight: 900; margin: 0;
}
.bank-details-card--uk .bank-details-card__title { color: #1e40af; }
.bank-details-card--ie .bank-details-card__title { color: #15803d; }
.bank-details-card__example { font-size: 11px; color: #9ca3af; margin-left: 4px; }

.bank-details-card__body { padding: 4px 0; }

.bank-row {
  display: flex; align-items: flex-start;
  gap: 10px; padding: 9px 16px;
  border-bottom: 1px solid #f8f9fa;
}
.bank-row:last-child { border-bottom: none; }
.bank-icon { font-size: 14px; flex-shrink: 0; margin-top: 1px; width: 18px; text-align: center; }
.bank-key { font-size: 12px; font-weight: 600; color: #374151; min-width: 120px; flex-shrink: 0; line-height: 1.5; }
.bank-val { font-size: 13px; font-weight: 600; color: #1a1a2e; }
.bank-val--mono { font-family: 'Courier New', monospace; letter-spacing: 0.06em; font-size: 12px; }
.bank-val-wrap { display: flex; flex-direction: column; }
.bank-hint { font-size: 10px; color: #9ca3af; margin-top: 1px; }

.bank-details-card__note {
  font-size: 11px; line-height: 1.6;
  padding: 10px 16px; margin: 0;
  display: flex; align-items: flex-start; gap: 6px;
}
.bank-details-card__note--blue { background: #eff6ff; color: #1e40af; border-top: 1px solid #bfdbfe; }
.bank-details-card__note--green { background: #f0fdf4; color: #15803d; border-top: 1px solid #bbf7d0; }

/* Client divider inside the card */
.bank-client-divider {
  font-family: 'Montserrat', sans-serif;
  font-size: 11px; font-weight: 800;
  letter-spacing: 0.1em; text-transform: uppercase;
  color: #6b7280; padding: 10px 16px 8px;
  background: #f8f9fa;
  border-top: 2px solid #e2e8f0;
  border-bottom: 1px solid #f0f0f0;
}
.bank-details-card--uk .bank-client-divider { border-top-color: #3b82f6; }
.bank-details-card--ie .bank-client-divider { border-top-color: #22c55e; }

/* Client form fields wrapper inside the card */
.bank-client-fields {
  padding: 16px 16px 4px;
}
.bank-client-fields .fgroup { margin-bottom: 14px; }

/* No country selected placeholder */
.bank-no-selection {
  display: flex; flex-direction: column; align-items: center;
  gap: 10px; padding: 32px 20px;
  background: #f9fafb; border: 2px dashed #e2e8f0;
  border-radius: 10px; text-align: center; margin-bottom: 4px;
}
.bank-no-selection span { font-size: 32px; }
.bank-no-selection p { font-size: 13px; color: #9ca3af; line-height: 1.6; margin: 0; }

.bank-important {
  display: flex; gap: 12px; align-items: flex-start;
  background: #fffbeb; border: 1px solid #fde68a;
  border-radius: 8px; padding: 14px 16px; margin-bottom: 4px;
}
.bank-important__ico { font-size: 20px; flex-shrink: 0; }
.bank-important__title { font-size: 13px; font-weight: 700; color: #92400e; margin-bottom: 6px; }
.bank-important__list {
  margin: 0; padding-left: 16px;
  font-size: 12px; color: #78350f; line-height: 1.7;
}

.bank-transfer-note {
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

/* ─── Bank Confirm Page ─── */
.bc-hero {
  background: linear-gradient(135deg, #0a1628 0%, #0d1f38 100%);
  border-bottom: 3px solid #1d56db;
  text-align: center;
  padding: 36px 20px 32px;
}
.bc-hero__icon { font-size: 52px; margin-bottom: 10px; }
.bc-hero__title {
  font-family: 'Montserrat', sans-serif;
  font-size: 22px; font-weight: 900; color: #fff;
  margin-bottom: 8px;
}
.bc-hero__sub { font-size: 13px; color: rgba(255,255,255,0.55); line-height: 1.6; }

.bc-wrap {
  padding: 24px 16px 52px;
  max-width: 680px;
}
.bc-wrap--simple {
  display: flex; flex-direction: column;
  align-items: stretch; gap: 16px;
  max-width: 480px;
}

.bc-amount-bar {
  display: flex; align-items: center; justify-content: space-between;
  background: #f0f4ff; border: 1.5px solid #bfdbfe;
  border-radius: 10px; padding: 14px 18px; margin-bottom: 20px;
}
.bc-amount-bar__label { font-size: 12px; color: #6b7280; }
.bc-amount-bar__value {
  font-family: 'Montserrat', sans-serif;
  font-size: 26px; font-weight: 800; color: #1d56db;
}

.bc-recap {
  background: #fff; border: 1.5px solid #e2e8f0;
  border-radius: 10px; overflow: hidden;
  margin-bottom: 24px;
  box-shadow: 0 2px 8px rgba(0,0,0,0.05);
}
.bc-recap__header {
  display: flex; align-items: center; gap: 10px;
  padding: 12px 16px;
  background: #0d1f38;
  font-size: 14px; font-weight: 700; color: #fff;
  font-family: 'Montserrat', sans-serif;
}
.bc-recap__label { font-size: 13px; }
.bc-recap__rows { padding: 4px 0; }
.bc-recap__row {
  display: flex; align-items: center; justify-content: space-between;
  padding: 10px 16px;
  border-bottom: 1px solid #f4f6fa;
  gap: 12px;
}
.bc-recap__row:last-child { border-bottom: none; }
.bc-recap__key { font-size: 12px; font-weight: 600; color: #6b7280; flex-shrink: 0; }
.bc-recap__val { font-size: 13px; font-weight: 600; color: #1a1a2e; text-align: right; }
.bc-recap__val--mono { font-family: 'Courier New', monospace; letter-spacing: 0.05em; color: #1d56db; }

.bc-steps { margin-bottom: 20px; }
.bc-steps__title {
  font-family: 'Montserrat', sans-serif;
  font-size: 12px; font-weight: 800;
  letter-spacing: 0.1em; text-transform: uppercase;
  color: #1d56db; padding-bottom: 8px;
  border-bottom: 2px solid #e2e8f0;
  margin-bottom: 16px;
}
.bc-step {
  display: flex; gap: 16px; align-items: flex-start;
  padding: 14px 0;
  border-bottom: 1px solid #f4f6fa;
}
.bc-step:last-child { border-bottom: none; }
.bc-step__num {
  flex-shrink: 0;
  width: 36px; height: 36px;
  background: #1d56db; color: #fff;
  border-radius: 50%;
  display: flex; align-items: center; justify-content: center;
  font-size: 15px; font-weight: 900;
  font-family: 'Montserrat', sans-serif;
  box-shadow: 0 4px 12px rgba(29,86,219,0.3);
}
.bc-step__body { padding-top: 6px; }
.bc-step__heading {
  font-size: 14px; font-weight: 700;
  color: #1a1a2e; margin-bottom: 4px;
}
.bc-step__desc { font-size: 12px; color: #6b7280; line-height: 1.6; }

.bc-notice {
  display: flex; gap: 12px; align-items: flex-start;
  background: #eff6ff; border: 1px solid #bfdbfe;
  border-radius: 8px; padding: 14px 16px;
  margin-bottom: 20px;
  font-size: 13px; color: #1e40af; line-height: 1.6;
}
.bc-notice strong { color: #1d56db; }

.bc-back-link {
  display: block; width: 100%;
  background: none; border: none;
  font-size: 13px; color: #9ca3af;
  cursor: pointer; padding: 14px 0;
  text-align: center;
  transition: color 0.2s;
}
.bc-back-link:hover { color: #374151; }

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
.bank-slide-enter-active { transition: opacity 0.3s ease, transform 0.3s ease; }
.bank-slide-leave-active { transition: opacity 0.2s ease, transform 0.2s ease; }
.bank-slide-enter-from { opacity: 0; transform: translateY(10px); }
.bank-slide-leave-to { opacity: 0; transform: translateY(-6px); }

/* ─── Ireland Method Sub-tabs ─── */
.ie-method-tabs {
  display: grid; grid-template-columns: 1fr 1fr; gap: 12px;
  margin-bottom: 16px;
}
.ie-method-btn {
  position: relative;
  display: flex; flex-direction: column; align-items: center;
  justify-content: center; gap: 8px;
  padding: 18px 12px 14px;
  background: #f9fafb; border: 2px solid #e2e8f0;
  border-radius: 14px; cursor: pointer;
  transition: all 0.24s cubic-bezier(0.34,1.56,0.64,1);
  font-family: 'Montserrat', sans-serif;
  box-shadow: 0 2px 8px rgba(0,0,0,0.05);
}
.ie-method-btn:hover {
  border-color: #1d56db; background: #eff6ff;
  transform: translateY(-4px); box-shadow: 0 10px 28px rgba(29,86,219,0.16);
}
.ie-method-btn__ico { font-size: 22px; }
.ie-method-btn__ico--revolut {
  font-size: 18px; font-weight: 900; font-style: normal;
  width: 36px; height: 36px;
  background: #191c1f; color: #fff;
  border-radius: 50%;
  display: flex; align-items: center; justify-content: center;
  font-family: 'Montserrat', sans-serif;
}
.ie-method-btn__label {
  font-size: 13px; font-weight: 800; letter-spacing: 0.03em;
  color: #1a1a2e; text-align: center;
}
.ie-method-btn__sub {
  font-size: 10px; font-weight: 500; color: #9ca3af;
  text-align: center; font-family: 'Inter', sans-serif;
}
.ie-method-btn--active::after {
  content: '✓';
  position: absolute; top: 8px; right: 10px;
  width: 18px; height: 18px; border-radius: 50%;
  display: flex; align-items: center; justify-content: center;
  font-size: 10px; font-weight: 900; color: #fff;
}
.ie-method-btn--active { transform: translateY(-4px); }
.ie-method-btn--bank {
  border-color: #16a34a; background: #f0fdf4;
  box-shadow: 0 8px 24px rgba(22,163,74,0.18);
}
.ie-method-btn--bank.ie-method-btn--active::after { background: #16a34a; }
.ie-method-btn--bank .ie-method-btn__label { color: #15803d; }
.ie-method-btn--bank .ie-method-btn__sub { color: #22c55e; }
.ie-method-btn--revolut {
  border-color: #191c1f; background: #f5f5f5;
  box-shadow: 0 8px 24px rgba(25,28,31,0.2);
}
.ie-method-btn--revolut.ie-method-btn--active::after { background: #191c1f; }
.ie-method-btn--revolut .ie-method-btn__label { color: #191c1f; }
.ie-method-btn--revolut .ie-method-btn__sub { color: #6b7280; }

/* ─── Revolut Card ─── */
.bank-details-card--revolut { border-color: #191c1f; }
.bank-details-card__header--revolut {
  background: #191c1f; display: flex; align-items: center; gap: 12px;
  padding: 12px 16px; border-bottom: 1px solid #2d3035;
}
.bank-details-card__title--revolut { color: #fff; margin: 0 0 2px; }
.revolut-header-sub { font-size: 11px; color: rgba(255,255,255,0.55); margin: 0; }
.revolut-logo-badge {
  width: 38px; height: 38px;
  background: #fff; color: #191c1f;
  border-radius: 50%; flex-shrink: 0;
  display: flex; align-items: center; justify-content: center;
  font-size: 18px; font-weight: 900; font-family: 'Montserrat', sans-serif;
}
.revolut-val { color: #1d56db; }
.bank-client-divider--revolut { border-top-color: #191c1f; }
.bank-details-card__note--revolut {
  background: #f5f5f5; color: #374151;
  border-top: 1px solid #e2e8f0; font-size: 11px;
  line-height: 1.6; padding: 10px 16px;
  display: flex; align-items: flex-start; gap: 6px;
}

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
  .amount-pill__value { font-size: 22px; }
}
</style>
