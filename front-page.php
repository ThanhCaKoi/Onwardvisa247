<?php get_header(); ?>
<!-- Flatpickr Datepicker (Premium UI) -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<style>
    /* Custom Flatpickr Theme to match #3b66a5 */
    .flatpickr-calendar {
        border-radius: 12px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.15);
        border: none;
        font-family: inherit;
    }
    .flatpickr-day.selected, .flatpickr-day.startRange, .flatpickr-day.endRange, .flatpickr-day.selected.inRange, .flatpickr-day.startRange.inRange, .flatpickr-day.endRange.inRange, .flatpickr-day:hover, .flatpickr-day:focus {
        background: #3b66a5 !important;
        border-color: #3b66a5 !important;
    }
    .flatpickr-months .flatpickr-month {
        color: #3b66a5;
        fill: #3b66a5;
    }
    .flatpickr-current-month .flatpickr-monthDropdown-months {
        font-weight: 700;
    }
    .flatpickr-weekdays {
        background: #f8f9fa;
    }
    .flatpickr-weekday {
        color: #333;
        font-weight: 600;
    }
</style>

    <!-- Hero Section -->
    <header id="hero" class="hero">
        <div class="container hero-container">
            <!-- JSON-LD Structured Data for SEO -->
            <script type="application/ld+json">
            {
              "@context": "https://schema.org",
              "@type": "Product",
              "name": "Onward Ticket Reservation",
              "description": "Verifiable flight reservation for visa applications and proof of onward travel.",
              "brand": {
                "@type": "Brand",
                "name": "OnWardVisa247"
              },
              "offers": {
                "@type": "Offer",
                "url": "<?php echo home_url(); ?>",
                "priceCurrency": "USD",
                "price": "14.00",
                "availability": "https://schema.org/InStock"
              },
              "aggregateRating": {
                "@type": "AggregateRating",
                "ratingValue": "4.9",
                "reviewCount": "1250"
              }
            }
            </script>

            <div class="hero-content">
                <span class="badge">The #1 Choice for Digital Nomads</span>
                <h1>Get a Verifiable Onward Ticket for <span class="highlight">Visa Applications</span> & Airport Check-in</h1>
                <p class="hero-subtitle">Valid flight reservations for just <strong>$14</strong>. Delivered to your inbox in minutes. 100% Real PNR. Verifiable on Airline Websites.</p>
                
                <ul class="hero-features">
                    <li><i class="fas fa-wallet"></i> No cancellation fees</li>
                    <li><i class="fas fa-passport"></i> Works for Digital Nomad Visas</li>
                    <li><i class="fas fa-file-pdf"></i> Instant Download</li>
                </ul>

                <!-- Ticket Visual Widget (Moved Up) -->
                <div class="ticket-visual" style="margin-top: 30px;margin-top: 60px; box-shadow: 0 15px 40px rgba(0,0,0,0.2);">
                    <div class="ticket-left">
                        <div class="barcode-strip"></div>
                        <div class="ticket-content">
                            <div class="ticket-header-row">
                                <span>JOHN DOE</span>
                                <span>F3954</span>
                                <span>07 APR 2019</span>
                                <span>7A</span>
                            </div>
                            <div class="ticket-main-route">
                                <span class="city">NEW YORK</span>
                                <i class="fas fa-plane"></i>
                                <span class="city">HONG KONG</span>
                            </div>
                            <div class="ticket-info-row">
                                <div class="ticket-data-col">
                                    <span class="ticket-label">GATE</span>
                                    <span class="ticket-value">D 12</span>
                                </div>
                                <div class="ticket-data-col" style="text-align: right;">
                                    <span class="ticket-label">BOARDING TIME</span>
                                    <span class="ticket-value">07:30</span>
                                </div>
                            </div>
                            <div class="ticket-footer-note">GATE CLOSES 40 MINUTES BEFORE DEPARTURE</div>
                        </div>
                    </div>
                    <div class="ticket-right">
                            <div class="barcode-top"></div>
                            <div class="ticket-right-row">
                                <div class="ticket-label">NAME OF PASSENGER</div>
                                <div class="ticket-value" style="font-size: 1rem;">JOHN DOE</div>
                            </div>
                            <div class="ticket-right-row">
                                <div class="ticket-label">FLIGHT</div>
                                <div class="ticket-value">F3954</div>
                            </div>
                            <div class="ticket-right-row">
                                <div class="ticket-label">GATE</div>
                                <div class="ticket-value">D 12</div>
                            </div>
                            <div class="ticket-right-row" style="margin-top: auto;">
                                <div class="ticket-value" style="font-size: 0.9rem;">NEW YORK &rarr; HKG</div>
                            </div>
                    </div>
                </div>
            </div>
            
            <!-- Multi-Step Booking Container -->
            <div class="booking-container-wrapper">
                
                <!-- STEP 1: SEARCH FORM -->
                <div class="hero-form-card" id="search-step">
                   

                     <div class="form-header">
                        <h3><i class="fas fa-plane"></i> Find Onward Flights</h3>
                        <p>Search millions of routes for your visa application</p>
                    </div>
                    <!-- End Ticket Visual Widget -->
                    <form class="booking-form" id="flight-search-form">
                        <div class="form-section-top" style="display: flex; gap: 20px; margin-bottom: 20px; align-items: flex-end;">
                            <!-- 1. Trip Type -->
                            <div class="trip-type-wrapper" style="flex: 1;">
                                <label class="section-label" style="display:block; margin-bottom:10px; font-weight:700; color:#3b66a5;">Choose Your Route</label>
                                <div class="radio-group-horizontal" style="display:flex; width:100%; height: 48px; border: 2px solid #3b66a5; border-radius: 12px; overflow: hidden; padding: 0;">
                                    <label class="radio-item" style="flex: 1; display: flex; align-items: center; justify-content: center; margin: 0; cursor: pointer; border-right: 1px solid #3b66a5; background: #fff; transition: background 0.2s;">
                                        <input type="radio" name="trip-type" value="oneway" checked style="margin-right: 8px;"> 
                                        <span>One-way</span>
                                    </label>
                                    <label class="radio-item" style="flex: 1; display: flex; align-items: center; justify-content: center; margin: 0; cursor: pointer; background: #fff; transition: background 0.2s;">
                                        <input type="radio" name="trip-type" value="roundtrip" style="margin-right: 8px;"> 
                                        <span>Round Trip</span>
                                    </label>
                                </div>
                            </div>

                            <!-- 2. Passengers -->
                            <div class="passengers-wrapper" style="flex: 1;">
                                <label class="section-label" style="display:block; margin-bottom:10px; font-weight:700; color:#3b66a5;">Passengers No</label>
                                <div id="pax-trigger" class="pax-trigger-box" style="width: 100%; height: 48px; border: 2px solid #3b66a5; border-radius: 12px; padding: 0 20px; display: flex; align-items: center; justify-content: space-between; background: #fff; cursor: pointer;">
                                    <span id="pax-display-text" style="font-weight: 500;">1 Adult, 0 Child, 0 Infant</span>
                                    <i class="fas fa-chevron-down" style="color: #3b66a5;"></i>
                                </div>
                                <div id="pax-dropdown" class="pax-dropdown-content" style="display: none; position: absolute; background: #fff; border: 1px solid #ddd; border-radius: 12px; padding: 20px; box-shadow: 0 10px 30px rgba(0,0,0,0.1); z-index: 100; min-width: 300px; margin-top: 10px;">
                                    <div class="pax-control-row" style="display: flex; justify-content: space-between; margin-bottom: 15px; align-items: center;">
                                        <span>Adults (12+)</span>
                                        <input type="number" id="adults" value="1" min="1" max="9" style="width: 50px; text-align: center; border: 1px solid #ddd; border-radius: 4px; padding: 5px;">
                                    </div>
                                    <div class="pax-control-row" style="display: flex; justify-content: space-between; margin-bottom: 15px; align-items: center;">
                                        <span>Child (2-11)</span>
                                        <input type="number" id="children" value="0" min="0" max="9" style="width: 50px; text-align: center; border: 1px solid #ddd; border-radius: 4px; padding: 5px;">
                                    </div>
                                    <div class="pax-control-row" style="display: flex; justify-content: space-between; margin-bottom: 15px; align-items: center;">
                                        <span>Infant (<2)</span>
                                        <input type="number" id="infants" value="0" min="0" max="9" style="width: 50px; text-align: center; border: 1px solid #ddd; border-radius: 4px; padding: 5px;">
                                    </div>
                                    <div class="pax-done-btn" onclick="togglePaxDropdown()" style="text-align: right; color: #3b66a5; font-weight: bold; cursor: pointer;">Done</div>
                                </div>
                            </div>
                        </div>

                        <!-- 3. Route (From / To) -->
                        <div class="inputs-row-unified" style="display: flex; gap: 20px; margin-bottom: 20px;">
                            <!-- From -->
                            <div class="input-col" style="flex: 1;">
                                <label style="font-weight:700; color:#3b66a5; margin-bottom:8px; display:block;">From</label>
                                <div class="input-with-icon" style="position:relative;">
                                    <i class="fas fa-plane-departure" style="position: absolute; left: 15px; top: 50%; transform: translateY(-50%); color: #3b66a5;"></i>
                                    <input type="text" id="origin" placeholder="Search airport or city" style="width: 100%; height: 48px; padding-left: 45px; border: 2px solid #3b66a5; border-radius: 12px; font-weight: 500;">
                                </div>
                            </div>
                            <!-- To -->
                            <div class="input-col" style="flex: 1;">
                                <label style="font-weight:700; color:#3b66a5; margin-bottom:8px; display:block;">To</label>
                                <div class="input-with-icon" style="position:relative;">
                                    <i class="fas fa-plane-arrival" style="position: absolute; left: 15px; top: 50%; transform: translateY(-50%); color: #3b66a5;"></i>
                                    <input type="text" id="destination" placeholder="Search airport or city" style="width: 100%; height: 48px; padding-left: 45px; border: 2px solid #3b66a5; border-radius: 12px; font-weight: 500;">
                                </div>
                            </div>
                        </div>

                        <!-- 4. Dates -->
                        <div class="form-group" style="margin-bottom: 30px;">
                             <!-- Wrap Departure and Return in a flex container for side-by-side or block for separate? Image shows Departure Date full width. But if Round Trip, Return appears. Let's make a container that handles both. -->
                             <div class="date-row" style="display: flex; gap: 20px;">
                                <div class="input-col" style="flex: 1;">
                                    <label style="font-weight:700; color:#3b66a5; margin-bottom:8px; display:block;">Departure Date</label>
                                    <div class="input-with-icon" style="position:relative;">
                                        <i class="far fa-calendar-alt" style="position: absolute; left: 15px; top: 50%; transform: translateY(-50%); color: #3b66a5;"></i>
                                        <input type="date" id="departure-date" onclick="this.showPicker()" style="width: 100%; height: 48px; padding-left: 45px; border: 2px solid #3b66a5; border-radius: 12px; font-weight: 500; background: #fff;">
                                    </div>
                                </div>
                                <div class="input-col" id="return-date-wrapper" style="display:none; flex: 1;">
                                    <label style="font-weight:700; color:#3b66a5; margin-bottom:8px; display:block;">Return Date</label>
                                    <div class="input-with-icon" style="position:relative;">
                                        <i class="far fa-calendar-alt" style="position: absolute; left: 15px; top: 50%; transform: translateY(-50%); color: #3b66a5;"></i>
                                        <input type="date" id="return-date" onclick="this.showPicker()" style="width: 100%; height: 48px; padding-left: 45px; border: 2px solid #3b66a5; border-radius: 12px; font-weight: 500; background: #fff;">
                                    </div>
                                </div>
                             </div>
                        </div>

                        <button type="submit" class="btn btn-primary btn-block btn-lg" id="search-btn" disabled title="Please fill in all fields">
                            <i class="fas fa-search"></i> Search Flights
                        </button>
                    </form>
                </div>

                <!-- STEP 2: FLIGHT RESULTS (Hidden) -->
                <div class="hero-form-card" id="results-step" style="display: none; width: 100%;">
                    <div class="form-header">
                        <h3>Select Your Flight</h3>
                    </div>
                    
                    <!-- Selection Summary -->
                    <div class="selection-summary-bar">
                        <div class="summary-item">
                            <i class="fas fa-map-marker-alt"></i>
                            <span id="summary-route">Origin to Destination</span>
                        </div>
                        <div class="summary-item">
                            <i class="far fa-calendar-alt"></i>
                            <span id="summary-dates">Date</span>
                        </div>
                        <div class="summary-item">
                            <i class="fas fa-user"></i>
                            <span id="summary-pax">1 Passenger</span>
                        </div>
                        <button class="edit-search-btn" onclick="showStep('search')">Edit</button>
                    </div>

                    <div id="flight-results-list" class="flight-list">
                        <!-- Results will be injected here via JS -->
                        <div class="loading-spinner">
                            <i class="fas fa-spinner fa-spin"></i> Searching best routes...
                        </div>
                    </div>
                    <button class="btn btn-secondary back-btn" onclick="showStep('search')">Back to Search</button>
                </div>

                <!-- STEP 3: BOOKING DETAILS (Hidden - Matches Screenshot) -->
                <div class="hero-form-card" id="booking-step" style="display: none; width: 100%;">
                    <div class="form-header" style="position: relative;">
                        <!-- Back Button -->
                        <button type="button" class="btn-back-text" onclick="showStep('results')" style="position: absolute; left: 0; top: 5px; background: none; border: none; color: #666; cursor: pointer;">
                            <i class="fas fa-arrow-left"></i> Back
                        </button>
                        
                        <h3>Passenger Details</h3>
                    </div>

                    <!-- Selection Summary -->
                    <div class="selection-summary-bar">
                        <div class="summary-item">
                            <i class="fas fa-plane"></i>
                            <span id="summary-flight-selection">Loading flight...</span>
                        </div>
                        <div class="summary-item">
                            <i class="fas fa-user-friends"></i>
                            <span id="summary-pax-booking">1 Passenger</span>
                        </div>
                        <button class="edit-search-btn" onclick="showStep('results')">Change Flight</button>
                    </div>

                    <form class="booking-form" id="final-booking-form">
                        
                        <!-- Dynamic Passenger Fields -->
                        <div id="passengers-container"></div>

                        <!-- Email -->
                        <div class="form-group">
                            <label>Your Email* (Our tickets will be sent to this Email) <span class="required">(Required)</span></label>
                            <div class="input-with-icon">
                                <i class="far fa-envelope"></i>
                                <input type="email" id="email" placeholder="Your email" required>
                            </div>
                        </div>

                        <!-- 1. Receive Later Checkbox (Moved Here) -->
                            <!-- Conditional Container for Receive Later (Placed below Email) -->
                            <div id="receive-later-container" style="display: none; margin-top: 10px; margin-bottom: 20px; padding-left: 0;">
                                <div class="form-group-row" style="display: flex; gap: 15px; margin-bottom: 10px;">
                                    <div style="flex: 1;">
                                        <label style="font-size: 0.85rem; font-weight: 700; color: #3b66a5; margin-bottom: 5px; display: block;">Receipt Date * <span style="color:red; font-size: 0.8rem;">(Required)</span></label>
                                        <div class="input-with-icon">
                                            <i class="far fa-calendar-alt"></i>
                                            <input type="date" id="receipt-date" class="form-control" style="width: 100%;">
                                        </div>
                                    </div>
                                    <div style="flex: 1;">
                                        <label style="font-size: 0.85rem; font-weight: 700; color: #3b66a5; margin-bottom: 5px; display: block;">Receipt Time</label>
                                        <div style="display: flex; gap: 10px; align-items: center;">
                                            <div class="input-with-icon" style="flex: 1;">
                                                <i class="far fa-clock"></i>
                                                <input type="number" placeholder="HH" min="0" max="23" class="form-control" style="width: 100%;">
                                            </div>
                                            <span style="font-weight: bold;">:</span>
                                            <div class="input-with-icon" style="flex: 1;">
                                                <!-- No icon or same icon for MM -->
                                                <input type="number" placeholder="MM" min="0" max="59" class="form-control" style="width: 100%; text-align: center;">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label style="font-size: 0.85rem; font-weight: 700; color: #3b66a5; margin-bottom: 5px; display: block;">Timezone</label>
                                    <div class="input-with-icon">
                                        <i class="fas fa-globe"></i>
                                        <input type="text" value="(GMT) Western Europe Time, London, Lisbon, Casablanca" readonly class="form-control" style="width: 100%; background: #f9f9f9; font-size: 0.85rem;">
                                    </div>
                                </div>
                            </div>

                        <!-- Ticket Valid Options -->
                        <div class="form-group">
                            <label>Ticket Valid</label>
                            <div class="validity-options">
                                <label class="validity-pill active">
                                    <input type="radio" name="validity" value="48h" checked>
                                    48 hours
                                </label>
                                <label class="validity-pill">
                                    <input type="radio" name="validity" value="7d">
                                    7 days (+$7)
                                </label>
                                <label class="validity-pill">
                                    <input type="radio" name="validity" value="14d">
                                    14 days (+$10)
                                </label>
                            </div>
                        </div>

                        <!-- Checkbox Group with Conditional Fields (Remaining) -->
                        <div class="checkbox-group" style="margin-top: 15px;">
                            
                            <!-- 1. Receive Later (Moved Back) -->
                            <div class="checkbox-item" style="margin-bottom: 8px;">
                                <label style="display: flex; align-items: center; gap: 10px; cursor: pointer; font-weight: 600; color: #475569;">
                                    <input type="checkbox" id="receive-later-chk"> 
                                    I want to receive my ticket later (+$1.00 - No delays, served 24/7)
                                </label>
                            </div>

                            <!-- 2. Add Notes -->
                            <div class="checkbox-item" style="margin-bottom: 8px;">
                                <label style="display: flex; align-items: center; gap: 10px; cursor: pointer; font-weight: 600; color: #475569;">
                                    <input type="checkbox" id="add-notes-chk"> 
                                    Add notes to order
                                </label>
                                <!-- Conditional Container -->
                               
                            </div>

                            <!-- 3. Promotion Code -->
                            <div class="checkbox-item" style="margin-bottom: 8px;">
                                <label style="display: flex; align-items: center; gap: 10px; cursor: pointer; font-weight: 600; color: #475569;">
                                    <input type="checkbox" id="promo-code-chk"> 
                                    Promotion Code
                                </label>
                                <div id="add-notes-container" style="display: none; margin-top: 10px; padding-left: 25px;">
                                    <label style="font-size: 0.9rem; font-weight: 700; color: #3b66a5; margin-bottom: 5px; display: block;">Note</label>
                                    <textarea id="order-note" placeholder="Enter your note" class="form-control" style="width: 100%; height: 80px; padding: 10px; border: 2px solid #3b66a5; border-radius: 12px; font-family: inherit; font-size: 0.95rem;"></textarea>
                                </div>
                                <!-- Conditional Container -->
                                <div id="promo-code-container" style="display: none; margin-top: 10px; padding-left: 25px;">
                                    <label style="font-size: 0.9rem; font-weight: 700; color: #3b66a5; margin-bottom: 5px; display: block;">Coupon</label>
                                    <div style="display: flex; gap: 10px; align-items: center;">
                                        <input type="text" id="coupon-code" class="form-control" placeholder="Enter coupon code" style="flex: 1; height: 50px; border: 2px solid #3b66a5; border-radius: 12px; padding-left: 15px; font-size: 1rem;">
                                        <button type="button" style="height: 50px; background: #3b66a5; color: #fff; border: none; padding: 0 30px; font-weight: 700; border-radius: 12px; cursor: pointer; font-size: 1rem; transition: background 0.2s;">Apply</button>
                                    </div>
                                    <small style="color: #e53e3e; display: none; margin-top: 5px;" id="coupon-error">Invalid coupon.</small>
                                </div>
                            </div>
                        </div>

                        <!-- Payment Method Tabs -->
                        <div class="payment-section">
                            <label>Choose payment method</label>
                            <div class="payment-tabs">
                                <div class="payment-tab active" data-method="stripe">Credit card(Stripe)</div>
                                <div class="payment-tab" data-method="paypal">Paypal</div>
                            </div>
                            <input type="hidden" id="selected-payment-method" value="stripe">
                        </div>

                        <!-- Card Details (Stripe Mock) -->
                        <div id="stripe-fields" class="payment-fields">
                            <label>Credit Card</label>
                            <div class="form-group">
                                <label>Card Details</label>
                                <div class="input-with-icon">
                                    <i class="far fa-credit-card"></i>
                                    <input type="text" placeholder="Card number">
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Cardholder Name</label>
                                <input type="text" class="form-control" style="width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 6px;">
                            </div>
                            <p class="secure-notice">We never store your credit card information.</p>
                        </div>

                        <!-- Total & Submit -->
                        <div class="total-bar">
                            <span>Total Price:</span>
                            <span class="total-price" id="final-price">$14.00</span>
                        </div>

                        <button type="button" id="pay-button" class="btn btn-primary btn-block btn-lg" style="background-color: #3b5998;">
                            Pay & Book Ticket
                        </button>
                    </form>
                </div>

            </div>
        </div>
    </header>

    <!-- Features / Trust Section -->
    <section class="features">
        <div class="container">
            <div class="features-grid">
                <div class="feature-card">
                    <div class="feature-icon">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/feature_verifiable.png" alt="100% Verifiable Icon">
                    </div>
                    <h3>100% Verifiable</h3>
                    <p>Real PNR codes verifiable on major airline websites (AirFrance, Lufthansa, etc).</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/feature_instant.png" alt="Instant Delivery Icon">
                    </div>
                    <h3>Instant Delivery</h3>
                    <p>Receive your perfectly formatted PDF ticket immediately after payment.</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/feature_secure.png" alt="Secure & Safe Icon">
                    </div>
                    <h3>Secure & Safe</h3>
                    <p>We value your privacy. Payments processed securely via PayPal.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- How It Works -->
    <section id="how-it-works" class="how-it-works">
        <div class="container">
            <div class="section-header">
                <h2>How to Get Your Onward Ticket in 3 Steps</h2>
                <p>Simplicity is key. It shouldn't feel like booking a flight.</p>
            </div>
            <div class="steps-grid">
                <div class="step-item">
                    <div class="step-number">1</div>
                    <h4>Enter Details</h4>
                    <p>Select your route and enter passenger names. No passport number required.</p>
                </div>
                <div class="step-item">
                    <div class="step-number">2</div>
                    <h4>Secure Payment</h4>
                    <p>Pay the flat $14 fee securely via PayPal or Credit Card. No hidden charges.</p>
                </div>
                <div class="step-item">
                    <div class="step-number">3</div>
                    <h4>Fly Stress-Free</h4>
                    <p>Download your ticket instantly. Show it at immigration and travel with peace of mind.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Why Use Us (SEO Content) -->
    <!-- Comparison Section (Why Choose Us) -->
    <section id="why-use-us" class="comparison-section" style="padding: 80px 0; background: #fff;">
        <div class="container">
            <div class="section-header">
                <h2>Why Choose OnWardVisa247?</h2>
                <p>See how we stack up against other options.</p>
            </div>
            <div class="comparison-table-wrapper" style="overflow-x: auto;">
                <table class="comparison-table" style="width: 100%; border-collapse: collapse; border-radius: 12px; overflow: hidden; box-shadow: 0 10px 30px rgba(0,0,0,0.05);">
                    <thead>
                        <tr style="background: #f8f9fa;">
                            <th style="padding: 20px; text-align: left; color: #555;">Feature</th>
                            <th style="padding: 20px; background: #e6f0ff; color: #0073e6; font-size: 1.1rem;">OnWardVisa247</th>
                            <th style="padding: 20px; color: #555;">Buying Full Ticket</th>
                            <th style="padding: 20px; color: #555;">Photoshopped / Fake</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td style="padding: 15px 20px; border-bottom: 1px solid #eee; font-weight: 600;">Verifiable PNR</td>
                            <td style="padding: 15px 20px; border-bottom: 1px solid #d0e3ff; background: #f0f7ff; color: #2ecc71; font-weight: bold;"><i class="fas fa-check-circle"></i> Yes, 100% Real</td>
                            <td style="padding: 15px 20px; border-bottom: 1px solid #eee;">Yes</td>
                            <td style="padding: 15px 20px; border-bottom: 1px solid #eee; color: #e74c3c;"><i class="fas fa-times-circle"></i> No (High Risk)</td>
                        </tr>
                        <tr>
                            <td style="padding: 15px 20px; border-bottom: 1px solid #eee; font-weight: 600;">Cost</td>
                            <td style="padding: 15px 20px; border-bottom: 1px solid #d0e3ff; background: #f0f7ff; font-weight: bold; color: #0073e6;">$14 (Fixed)</td>
                            <td style="padding: 15px 20px; border-bottom: 1px solid #eee;">$500 - $1500+</td>
                            <td style="padding: 15px 20px; border-bottom: 1px solid #eee;">$0 - $50</td>
                        </tr>
                        <tr>
                            <td style="padding: 15px 20px; border-bottom: 1px solid #eee; font-weight: 600;">Automatic Cancellation</td>
                            <td style="padding: 15px 20px; border-bottom: 1px solid #d0e3ff; background: #f0f7ff;"><i class="fas fa-check"></i> Yes (We handle it)</td>
                            <td style="padding: 15px 20px; border-bottom: 1px solid #eee;">No (You must remember)</td>
                            <td style="padding: 15px 20px; border-bottom: 1px solid #eee;">N/A</td>
                        </tr>
                        <tr>
                            <td style="padding: 15px 20px; border-bottom: 1px solid #eee; font-weight: 600;">Delivery Speed</td>
                            <td style="padding: 15px 20px; border-bottom: 1px solid #d0e3ff; background: #f0f7ff;"><i class="fas fa-bolt"></i> Instant / Minutes</td>
                            <td style="padding: 15px 20px; border-bottom: 1px solid #eee;">Instant</td>
                            <td style="padding: 15px 20px; border-bottom: 1px solid #eee;">Varies</td>
                        </tr>
                        <tr>
                            <td style="padding: 15px 20px; border-bottom: 1px solid #eee; font-weight: 600;">Risk of Visa Rejection</td>
                            <td style="padding: 15px 20px; border-bottom: 1px solid #d0e3ff; background: #f0f7ff; color: #2ecc71;">Zero Risk</td>
                            <td style="padding: 15px 20px; border-bottom: 1px solid #eee;">Zero Risk</td>
                            <td style="padding: 15px 20px; border-bottom: 1px solid #eee; color: #e74c3c;"><strong>Extreme Risk</strong> (Illegal)</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </section>

    <!-- SEO Content (Proof of Travel) -->
    <section id="proof-of-travel" class="seo-content">
        <div class="container split-layout">
            <div class="text-content">
                <h2>Do You Really Need Proof of Onward Travel?</h2>
                <p>Traveling on a one-way ticket? You might face issues at the airport check-in desk or immigration control. Many countries require <strong>proof of onward travel</strong>—a return flight ticket to prove you won't overstay your visa.</p>
                <p>Don't risk being denied boarding or spending hundreds on a full-price flexible ticket you'll have to cancel later.</p>
                <br>
                <h3>OnWardVisa247 provides a solution for:</h3>
                <ul class="check-list">
                    <li><strong>Digital Nomads</strong> who don't know their next destination.</li>
                    <li><strong>Backpackers</strong> traveling overland or on open-ended trips.</li>
                    <li><strong>Visa Applicants</strong> who need a flight itinerary for their application.</li>
                </ul>
                <br>
                <p>We rent you a real flight reservation valid for 48 hours or more. It comes with a verifiable PNR code that looks exactly like a standard flight confirmation.</p>
            </div>
            <div class="image-content">
                <div class="img-wrapper">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/seo_travel_illustration.png" alt="Travel Documents Illustration">
                </div>
            </div>
        </div>
    </section>

    <!-- Latest Articles / Blog Preview -->
    <section id="latest-guides" class="blog-preview-section" style="padding: 80px 0; background: #f8fbff;">
        <div class="container">
            <div class="section-header" style="text-align: center; margin-bottom: 50px;">
                <span style="text-transform: uppercase; color: #888; letter-spacing: 2px; font-size: 0.9rem; font-weight: 600;">tips for travelers</span>
                <h2 style="font-size: 2.5rem; margin-top: 10px;">Our traveling blog.</h2>
                <p style="max-width: 700px; margin: 20px auto 0; color: #666; line-height: 1.6;">Explore the world through our travel blog. Here, you'll find guides to top destinations, tips for hassle-free travel, and insights on making the most of your journey. Travel smart, travel easy with Fast Onward Ticket!</p>
            </div>
            
            <div class="blog-grid" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 30px;">
                <?php 
                // 1. Query for Blog Posts
                $blog_query = new WP_Query(array(
                    'post_type'      => 'post',
                    'posts_per_page' => 6,
                    'post_status'    => 'publish',
                    'orderby'        => 'date',
                    'order'          => 'DESC'
                ));

                if ( $blog_query->have_posts() ) : 
                    while ( $blog_query->have_posts() ) : $blog_query->the_post(); 
                    ?>
                    <!-- Dynamic Post Card - Fully Clickable -->
                    <a href="<?php the_permalink(); ?>" class="blog-card" style="text-decoration: none; color: inherit; display: block; transition: transform 0.3s, box-shadow 0.3s;">
                        <div class="blog-img" style="height: 200px; position: relative; overflow: hidden;">
                            <?php if(has_post_thumbnail()): ?>
                                <?php the_post_thumbnail('medium_large', array('style' => 'width:100%; height:100%; object-fit:cover;')); ?>
                            <?php else: ?>
                                 <!-- Fallback if no featured image is set -->
                                 <img src="https://images.unsplash.com/photo-1476514525535-07fb3b4ae5f1?q=80&w=2070&auto=format&fit=crop" alt="Travel" style="width:100%; height:100%; object-fit:cover;">
                                 <div style="position:absolute; top:0; left:0; width:100%; height:100%; background:rgba(0,0,0,0.1); display:flex; align-items:center; justify-content:center;">
                                     <i class="fas fa-image fa-2x" style="color:white; opacity: 0.5;"></i>
                                 </div>
                            <?php endif; ?>
                        </div>
                        <div class="blog-content" style="padding: 25px;">
                            <span class="blog-date" style="display:block; font-size:0.85rem; color:#888; margin-bottom:10px;"><?php echo get_the_date('F j, Y'); ?></span>
                            <h3 class="blog-title" style="font-size: 1.1rem; margin-bottom: 12px; font-weight: 700; color: #1e293b;"><?php the_title(); ?></h3>
                            <div class="blog-excerpt" style="font-size: 0.9rem; color: #666; line-height: 1.5; overflow: hidden; display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical;">
                                <?php echo wp_trim_words(get_the_excerpt(), 20, '...'); ?>
                            </div>
                        </div>
                    </a>
                <?php endwhile; wp_reset_postdata(); else : ?>
                    
                    <!-- Hardcoded Fallback if No Posts Exist (6 items) -->
                    <?php 
                    $fallbacks = array(
                        array(
                            'title' => 'Top 10 Visa-Free Countries for Digital Nomads in 2024',
                            'date'  => 'March 15, 2024',
                            'img'   => 'https://images.unsplash.com/photo-1527631746610-bca00a040d60?q=80&w=2070&auto=format&fit=crop'
                        ),
                        array(
                            'title' => 'How to Proof Onward Travel Without Buying a Full Ticket',
                            'date'  => 'March 10, 2024',
                            'img'   => 'https://images.unsplash.com/photo-1436491865332-7a615321cea7?q=80&w=2074&auto=format&fit=crop'
                        ),
                        array(
                            'title' => 'The Ultimate Guide to Digital Nomad Visas in Europe',
                            'date'  => 'March 05, 2024',
                            'img'   => 'https://images.unsplash.com/photo-1499678329028-101435549a4e?q=80&w=2070&auto=format&fit=crop'
                        ),
                        array(
                            'title' => '5 Common Mistakes When Applying for a Schengen Visa',
                            'date'  => 'February 28, 2024',
                            'img'   => 'https://images.unsplash.com/photo-1517400508447-f8dd518b86db?q=80&w=2070&auto=format&fit=crop'
                        ),
                         array(
                            'title' => 'Why Airlines Ask for a Return Ticket (And What to Do)',
                            'date'  => 'February 20, 2024',
                            'img'   => 'https://images.unsplash.com/photo-1569154941061-e231b4725ef1?q=80&w=2070&auto=format&fit=crop'
                        ),
                        array(
                            'title' => 'Travel Light: Essential Gear for Long-Term Backpackers',
                            'date'  => 'February 15, 2024',
                            'img'   => 'https://images.unsplash.com/photo-1501555088652-021faa106b9b?q=80&w=2073&auto=format&fit=crop'
                        ),
                    );
                    ?>
                    
                    <?php foreach($fallbacks as $f): ?>
                    <a href="<?php echo esc_url($blog_url); ?>" class="blog-card" style="text-decoration: none; color: inherit; display: block; transition: transform 0.3s, box-shadow 0.3s;">
                        <div class="blog-img" style="height: 200px; position: relative; overflow: hidden;">
                            <img src="<?php echo $f['img']; ?>" alt="Travel" style="width:100%; height:100%; object-fit:cover;">
                            <div style="position:absolute; top:0; left:0; width:100%; height:100%; background:rgba(0,0,0,0.1);"></div>
                        </div>
                        <div class="blog-content" style="padding: 25px;">
                            <span class="blog-date" style="color: #888; font-size: 0.85rem; display: block; margin-bottom: 10px;"><?php echo $f['date']; ?></span>
                            <h3 class="blog-title" style="font-size: 1.1rem; margin-bottom: 12px; font-weight: 700; color: #1e293b;"><?php echo $f['title']; ?></h3>
                            <div class="blog-excerpt" style="font-size: 0.9rem; color: #666; line-height: 1.5;">Explore the requirements and tips for your next trip to this destination. Stay prepared and travel with confidence.</div>
                        </div>
                    </a>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
            
            <div style="text-align: center; margin-top: 40px;">
                <?php 
                $blog_page_id = get_option('page_for_posts');
                $blog_url = $blog_page_id ? get_permalink($blog_page_id) : home_url('/blog/');
                ?>
                <a href="<?php echo esc_url($blog_url); ?>" class="read-all-posts-btn">Read all Posts <i class="fas fa-arrow-right"></i></a>
            </div>
        </div>
    </section>

    <!-- Testimonials -->
    <section class="testimonials">
        <div class="container">
            <div class="section-header">
                <h2>Trusted by Travelers Worldwide</h2>
            </div>
            <!-- Video Testimonials Section (New) -->
            <div class="video-testimonials-grid">
                <!-- Video 1 -->
                <div class="video-card">
                    <video controls playsinline>
                        <source src="<?php echo get_template_directory_uri(); ?>/assets/videos/testimonial-2.mp4" type="video/mp4">
                        Your browser does not support the video tag.
                    </video>
                </div>
                <!-- Video 2 -->
                <div class="video-card">
                    <video controls playsinline>
                        <source src="<?php echo get_template_directory_uri(); ?>/assets/videos/testimonial-1.mp4" type="video/mp4">
                        Your browser does not support the video tag.
                    </video>
                </div>
                <!-- Video 3 -->
                <div class="video-card">
                    <video controls playsinline>
                        <source src="<?php echo get_template_directory_uri(); ?>/assets/videos/testimonial-3.mp4" type="video/mp4">
                        Your browser does not support the video tag.
                    </video>
                </div>
            </div>

            <div class="testimonial-grid">
                <div class="content-card testimonial">
                    <p>"Saved my trip! The airline wouldn't let me check in without a return flight. I bought this at the counter, got the PDF in 2 minutes. Highly recommend!"</p>
                    <div class="user">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/avatar_sarah.png" alt="Sarah J." class="avatar-img">
                        <div class="info">
                            <h5>Sarah J.</h5>
                            <span>Digital Nomad</span>
                        </div>
                    </div>
                </div>
                <div class="content-card testimonial">
                    <p>"Perfect for my Schengen visa application. The consulate needed a flight itinerary, but I didn't want to pay for a flight yet. This worked perfectly."</p>
                    <div class="user">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/avatar_carlos.png" alt="Carlos M." class="avatar-img">
                        <div class="info">
                            <h5>Carlos M.</h5>
                            <span>Traveler</span>
                        </div>
                    </div>
                </div>
                <div class="content-card testimonial">
                    <p>"Legit service. I entered the PNR on the airline's website and it was there. Valid for well over 48 hours which gave me plenty of time."</p>
                    <div class="user">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/avatar_hiroshi.png" alt="Hiroshi T." class="avatar-img">
                        <div class="info">
                            <h5>Hiroshi T.</h5>
                            <span>Backpacker</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- FAQ -->
    <section id="faq" class="faq-section">
        <div class="container">
            <div class="section-header">
                <h2>Frequently Asked Questions</h2>
            </div>
            <div class="faq-list">
                <div class="faq-item">
                    <div class="faq-question">
                        <span>Is this a fake ticket?</span>
                        <i class="fas fa-chevron-down"></i>
                    </div>
                    <div class="faq-answer">
                        <p><strong>Absolutely not.</strong> We provide <strong style="color:#3b66a5;">100% genuine and verifiable flight reservations</strong>. Every ticket comes with a unique <strong>PNR (Passenger Name Record)</strong> that you can verify directly on the airline's website or through independent travel aggregators like CheckMyTrip. We do not use Photoshop or fake templates; we make real bookings with real airlines.</p>
                    </div>
                </div>
                <div class="faq-item">
                    <div class="faq-question">
                        <span>How long is the ticket valid?</span>
                        <i class="fas fa-chevron-down"></i>
                    </div>
                    <div class="faq-answer">
                        <p>Your confirmed flight reservation is valid for <strong>at least 48 hours</strong>, and often up to 14 days depending on the airline's policy. We guarantee the validity for 48 hours from the time of delivery, which is perfectly sufficient for visa applications and immigration checks. If you need a longer validity (e.g., for a visa interview weeks away), we recommend using our <em>"Receive Later"</em> feature to schedule the delivery exactly when you need it.</p>
                    </div>
                </div>
                <div class="faq-item">
                    <div class="faq-question">
                        <span>Do I need to cancel the ticket?</span>
                        <i class="fas fa-chevron-down"></i>
                    </div>
                    <div class="faq-answer">
                        <p><strong>No, you don't need to do anything.</strong> We automatically handle the cancellation of the flight reservation for you before it expires. You can simply present the ticket for your travel needs and then discard it. There are no cancellation fees or hidden charges for you to worry about.</p>
                    </div>
                </div>
                <div class="faq-item">
                    <div class="faq-question">
                        <span>Can I actually fly with this ticket?</span>
                        <i class="fas fa-chevron-down"></i>
                    </div>
                    <div class="faq-answer">
                        <p><strong>No, you cannot fly with this ticket.</strong> This service provides a <strong>flight reservation</strong> for proof of onward travel (visa applications, immigration requirements), not a fully paid flight ticket for travel. The reservation serves as proof that you have a planned itinerary, but it is not valid for boarding the aircraft.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <!-- Contact Form Section -->
    <section id="contact-form-section" class="contact-section">
        <div class="container contact-container">
            <div class="contact-header">
                <h2>Please tell us how we can help you</h2>
            </div>
            
            <form class="contact-form" action="#" method="post">
                <p class="form-instruction">Fields marked with an <span class="required">*</span> are required</p>
                
                <div class="form-row">
                    <div class="form-group">
                        <label for="contact-name">Your Name <span class="required">*</span></label>
                        <input type="text" id="contact-name" name="contact-name" class="form-control-gray" required>
                    </div>
                    <div class="form-group">
                        <label for="contact-email">Your Email <span class="required">*</span></label>
                        <input type="email" id="contact-email" name="contact-email" class="form-control-gray" required>
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="contact-message">Your Message <span class="required">*</span></label>
                    <textarea id="contact-message" name="contact-message" rows="6" class="form-control-gray" required></textarea>
                </div>
                
                <div class="checkbox-item" style="margin-bottom: 2rem;">
                    <label style="display: flex; align-items: center; gap: 10px; cursor: pointer; color: #555;">
                        <input type="checkbox" id="save-info"> 
                        Save my name, email, and website in this browser for the next time I comment.
                    </label>
                </div>
                
                <div class="submit-wrapper" style="text-align: center;">
                    <button type="submit" class="btn btn-primary submit-btn">Submit</button>
                </div>
            </form>
        </div>
    </section>

<?php get_footer(); ?>
