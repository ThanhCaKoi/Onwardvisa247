document.addEventListener("DOMContentLoaded", () => {
  // --- 1. DATA ---
  const airports = [
    { code: "JFK", city: "New York", name: "John F. Kennedy Intl" },
    { code: "LHR", city: "London", name: "Heathrow Airport" },
    { code: "DXB", city: "Dubai", name: "Dubai Intl" },
    { code: "HKG", city: "Hong Kong", name: "Hong Kong Intl" },
    { code: "SIN", city: "Singapore", name: "Changi Airport" },
    { code: "BKK", city: "Bangkok", name: "Suvarnabhumi Airport" },
    { code: "CDG", city: "Paris", name: "Charles de Gaulle" },
    { code: "HND", city: "Tokyo", name: "Haneda Airport" },
    { code: "SYD", city: "Sydney", name: "Kingsford Smith" },
    { code: "FRA", city: "Frankfurt", name: "Frankfurt Airport" },
    { code: "AMS", city: "Amsterdam", name: "Schiphol" },
    { code: "IST", city: "Istanbul", name: "Istanbul Airport" },
    { code: "SGN", city: "Ho Chi Minh City", name: "Tan Son Nhat Intl" },
    { code: "HAN", city: "Hanoi", name: "Noi Bai Intl" },
    { code: "KUL", city: "Kuala Lumpur", name: "Kuala Lumpur Intl" },
    { code: "ICN", city: "Seoul", name: "Incheon Intl" },
    { code: "LAX", city: "Los Angeles", name: "Los Angeles Intl" },
    { code: "SFO", city: "San Francisco", name: "San Francisco Intl" },
    { code: "YYZ", city: "Toronto", name: "Pearson Intl" },
    { code: "BCN", city: "Barcelona", name: "El Prat" },
  ];

  // --- 2. ELEMENT SELECTORS ---
  const originInput = document.getElementById("origin");
  const destInput = document.getElementById("destination");
  const departureDateInput = document.getElementById("departure-date");
  const returnDateInput = document.getElementById("return-date");
  const searchBtn = document.getElementById("search-btn");
  const searchForm = document.getElementById("flight-search-form");
  const tripTypeRadios = document.getElementsByName("trip-type");
  const returnDateWrapper = document.getElementById("return-date-wrapper");
  const paxTrigger = document.getElementById("pax-trigger");
  const paxDropdown = document.getElementById("pax-dropdown");
  const paxDisplay = document.getElementById("pax-display-text");

  // --- 3. CORE LOGIC FUNCTIONS ---

  // Validation: Enable/Disable Search Button
  const checkFormValidity = () => {
    const origin = originInput?.value.trim();
    const dest = destInput?.value.trim();
    const date = departureDateInput?.value.trim();
    const tripType = document.querySelector(
      'input[name="trip-type"]:checked',
    )?.value;
    const returnDateValue = returnDateInput?.value.trim() || "";

    let isValid = origin && dest && date;
    if (tripType === "roundtrip" && !returnDateValue) isValid = false;

    if (searchBtn) {
      searchBtn.disabled = !isValid;
      searchBtn.style.opacity = isValid ? "1" : "0.5";
      searchBtn.style.cursor = isValid ? "pointer" : "not-allowed";
    }
  };

  // Autocomplete Logic
  function autocomplete(inp, arr) {
    let currentFocus;
    inp.addEventListener("input", function (e) {
      let a,
        b,
        i,
        val = this.value;
      closeAllLists();
      if (!val) {
        checkFormValidity();
        return false;
      }
      currentFocus = -1;
      a = document.createElement("DIV");
      a.setAttribute("id", this.id + "autocomplete-list");
      a.setAttribute("class", "autocomplete-list");
      this.parentNode.appendChild(a);

      let count = 0;
      for (i = 0; i < arr.length; i++) {
        if (
          arr[i].city.substr(0, val.length).toUpperCase() ==
            val.toUpperCase() ||
          arr[i].code.substr(0, val.length).toUpperCase() ==
            val.toUpperCase() ||
          arr[i].name.toUpperCase().indexOf(val.toUpperCase()) > -1
        ) {
          if (count > 8) break;
          b = document.createElement("DIV");
          b.className = "autocomplete-item";
          b.innerHTML = `<span>${arr[i].city} (${arr[i].name})</span><span class='code-badge'>${arr[i].code}</span>`;
          b.innerHTML += `<input type='hidden' value='${arr[i].city} (${arr[i].code})'>`;
          b.addEventListener("click", function (e) {
            inp.value = this.getElementsByTagName("input")[0].value;
            closeAllLists();
            checkFormValidity();
          });
          a.appendChild(b);
          count++;
        }
      }
    });

    inp.addEventListener("keydown", function (e) {
      let x = document.getElementById(this.id + "autocomplete-list");
      if (x) x = x.getElementsByTagName("div");
      if (e.keyCode == 40) {
        currentFocus++;
        addActive(x);
      } else if (e.keyCode == 38) {
        currentFocus--;
        addActive(x);
      } else if (e.keyCode == 13) {
        e.preventDefault();
        if (currentFocus > -1 && x) x[currentFocus].click();
      }
    });

    function addActive(x) {
      if (!x) return false;
      removeActive(x);
      if (currentFocus >= x.length) currentFocus = 0;
      if (currentFocus < 0) currentFocus = x.length - 1;
      x[currentFocus].classList.add("active");
    }
    function removeActive(x) {
      for (let i = 0; i < x.length; i++) x[i].classList.remove("active");
    }
    function closeAllLists(elmnt) {
      let x = document.getElementsByClassName("autocomplete-list");
      for (let i = 0; i < x.length; i++) {
        if (elmnt != x[i] && elmnt != inp) x[i].parentNode.removeChild(x[i]);
      }
    }
    document.addEventListener("click", function (e) {
      closeAllLists(e.target);
    });
  }

  // Passenger Display Update
  const updatePaxDisplay = () => {
    const a = document.getElementById("adults").value || 1;
    const c = document.getElementById("children").value || 0;
    const i = document.getElementById("infants").value || 0;
    if (paxDisplay)
      paxDisplay.innerText = `${a} Adult, ${c} Child, ${i} Infant`;
  };

  // Step Switcher
  const showStep = (stepName) => {
    const steps = ["search", "results", "booking"];
    steps.forEach((s) => {
      const el = document.getElementById(s + "-step");
      if (el) el.style.display = "none";
    });
    const target = document.getElementById(stepName + "-step");
    if (target) target.style.display = "block";
    // window.scrollTo({ top: 0, behavior: "smooth" }); // Removed to prevent jumping
  };
  window.showStep = showStep;

  // Price Calculation
  window.updateTotalPrice = (valValue) => {
    let base = 14.0;
    const a = parseInt(document.getElementById("adults").value) || 0;
    const c = parseInt(document.getElementById("children").value) || 0;
    const i = parseInt(document.getElementById("infants").value) || 0;
    const totalPax = a + c + i;

    let extra = 0;
    if (valValue === "7d") extra = 7;
    if (valValue === "14d") extra = 10;

    const total = (base + extra) * totalPax;
    const priceEl = document.getElementById("final-price");
    if (priceEl) priceEl.innerText = "$" + total.toFixed(2);
  };

  // Select Flight (Consolidated)
  window.selectFlight = (flightNum, airline, from, to, date) => {
    // Scroll to top first - REMOVED
    // window.scrollTo({ top: 0, behavior: "smooth" });

    // Update Step 3 Headers
    const sFlight = document.getElementById("summary-flight-selection");
    if (sFlight)
      sFlight.innerText = `${airline} (${flightNum}) - ${from} to ${to}`;

    // Get Counts
    const adults = parseInt(document.getElementById("adults")?.value) || 1;
    const children = parseInt(document.getElementById("children")?.value) || 0;
    const infants = parseInt(document.getElementById("infants")?.value) || 0;

    // Update Summaries
    let paxString = `${adults} Adult(s)`;
    if (children > 0) paxString += `, ${children} Child`;
    if (infants > 0) paxString += `, ${infants} Infant`;

    const sPaxBooking = document.getElementById("summary-pax-booking");
    if (sPaxBooking) sPaxBooking.innerText = paxString;
    const sPaxLegacy = document.getElementById("pax-summary");
    if (sPaxLegacy) sPaxLegacy.innerText = paxString;

    // --- GENERATE DYNAMIC PASSENGER FIELDS ---
    const container = document.getElementById("passengers-container");
    if (container) {
      container.innerHTML = ""; // Clear existing
      let paxIndex = 1;

      // Helper to create row
      const createRow = (type, label, options) => {
        const row = document.createElement("div");
        row.className = "passenger-row";
        row.style.marginBottom = "10px"; // Reduced margin
        row.style.paddingBottom = "15px";
        row.style.borderBottom = "1px solid #e2e8f0"; // Lighter border

        const labelEl = document.createElement("h4");
        labelEl.innerText = `${paxIndex}. ${label}`;
        labelEl.style.fontSize = "0.9rem";
        labelEl.style.color = "#3b66a5";
        labelEl.style.marginBottom = "8px";
        labelEl.style.fontWeight = "700";

        const grid = document.createElement("div");
        grid.className = "form-group-row name-row";
        grid.style.display = "flex";
        grid.style.flexWrap = "nowrap"; // Force single row
        grid.style.alignItems = "center";
        grid.style.gap = "8px"; // Tighter gap

        // Title Select
        const col1 = document.createElement("div");
        col1.style.flex = "0 0 100px"; // Narrower title
        col1.style.minWidth = "100px";
        const select = document.createElement("select");
        select.className = "form-control";
        select.style.width = "100%";
        select.style.padding = "8px"; // Compact padding
        select.style.height = "42px"; // Compact height
        select.style.border = "1px solid #cbd5e1";
        select.style.borderRadius = "6px";
        select.style.fontSize = "0.9rem";

        options.forEach((opt) => {
          const o = document.createElement("option");
          o.value = opt;
          o.innerText = opt;
          select.appendChild(o);
        });
        col1.appendChild(select);

        // First Name
        const col2 = document.createElement("div");
        col2.style.flex = "1";
        const input1 = document.createElement("input");
        input1.type = "text";
        input1.placeholder = "First name *";
        input1.required = true;
        input1.style.width = "100%";
        input1.style.height = "42px"; // Compact height
        input1.style.border = "1px solid #cbd5e1";
        input1.style.borderRadius = "6px";
        input1.style.padding = "0 10px";
        input1.style.fontSize = "0.9rem";
        col2.appendChild(input1);

        // Last Name
        const col3 = document.createElement("div");
        col3.style.flex = "1";
        const input2 = document.createElement("input");
        input2.type = "text";
        input2.placeholder = "Last name *";
        input2.required = true;
        input2.style.width = "100%";
        input2.style.height = "42px"; // Compact height
        input2.style.border = "1px solid #cbd5e1";
        input2.style.borderRadius = "6px";
        input2.style.padding = "0 10px";
        input2.style.fontSize = "0.9rem";
        col3.appendChild(input2);

        grid.appendChild(col1);
        grid.appendChild(col2);
        grid.appendChild(col3);

        row.appendChild(labelEl);
        row.appendChild(grid);
        container.appendChild(row);
        paxIndex++;
      };

      // Adults
      for (let k = 0; k < adults; k++) {
        createRow("adult", "Mr", ["Mr", "Ms", "Mrs"]);
      }
      // Children
      for (let k = 0; k < children; k++) {
        createRow("child", "Mstr (2-11 years)", [
          "Mstr (2-11 years)",
          "Miss (2-11 years)",
        ]);
      }
      // Infants
      for (let k = 0; k < infants; k++) {
        createRow("infant", "Mstr (Under 2 years)", [
          "Mstr (Under 2 years)",
          "Miss (Under 2 years)",
        ]);
      }
    }

    // Price Update
    window.updateTotalPrice("instant");

    // Change Step
    showStep("booking");
  };

  // --- 4. EVENT INITIALIZATION ---

  // Autocomplete
  if (originInput) autocomplete(originInput, airports);
  if (destInput) autocomplete(destInput, airports);

  // Form Interactions
  if (tripTypeRadios) {
    tripTypeRadios.forEach((radio) => {
      radio.addEventListener("change", (e) => {
        if (returnDateWrapper)
          returnDateWrapper.style.display =
            e.target.value === "roundtrip" ? "block" : "none";
        checkFormValidity();
      });
    });
  }

  [originInput, destInput, departureDateInput, returnDateInput].forEach(
    (el) => {
      if (el) el.addEventListener("input", checkFormValidity);
    },
  );

  // Passenger Dropdown
  window.togglePaxDropdown = () => {
    if (!paxDropdown) return;
    paxDropdown.style.display =
      paxDropdown.style.display === "block" ? "none" : "block";
  };
  if (paxTrigger)
    paxTrigger.addEventListener("click", (e) => {
      e.stopPropagation();
      window.togglePaxDropdown();
    });
  ["adults", "children", "infants"].forEach((id) => {
    const el = document.getElementById(id);
    if (el) {
      el.addEventListener("input", updatePaxDisplay);
      el.addEventListener("change", updatePaxDisplay);
    }
  });

  document.addEventListener("click", (e) => {
    if (paxDropdown && paxDropdown.style.display === "block") {
      if (!paxDropdown.contains(e.target) && !paxTrigger.contains(e.target))
        paxDropdown.style.display = "none";
    }
  });

  // Search Submission
  if (searchForm) {
    searchForm.addEventListener("submit", (e) => {
      e.preventDefault();
      const origin = originInput.value.trim();
      const dest = destInput.value.trim();
      const date = departureDateInput.value;
      const tripType = document.querySelector(
        'input[name="trip-type"]:checked',
      )?.value;
      const returnDate = returnDateInput?.value;
      const paxText = paxDisplay?.innerText || "1 Adult";

      // Summary Update
      const sRoute = document.getElementById("summary-route");
      const sDates = document.getElementById("summary-dates");
      const sPax = document.getElementById("summary-pax");
      if (sRoute) sRoute.innerText = `${origin} to ${dest}`;
      if (sDates)
        sDates.innerText =
          tripType === "roundtrip"
            ? `${date} - ${returnDate}`
            : `Departure: ${date}`;
      if (sPax) sPax.innerText = paxText;

      showStep("results");
      const resList = document.getElementById("flight-results-list");
      if (resList)
        resList.innerHTML =
          '<div style="text-align:center; padding:40px;"><i class="fas fa-spinner fa-spin fa-3x" style="color:#3b66a5"></i><p>Searching flights...</p></div>';

      // Real API Call
      if (typeof bot_vars !== "undefined") {
        const formData = new FormData();
        formData.append("action", "bot_search_flights");
        formData.append("origin", origin);
        formData.append("destination", dest);
        formData.append("date", date);

        fetch(bot_vars.ajax_url, {
          method: "POST",
          body: formData,
        })
          .then((r) => r.json())
          .then((res) => {
            console.log("Full Flight API Response:", res); // <-- Check Console
            if (res.success) {
              // Render results
              displayAmadeusFlights(res.data, origin, dest, date);
            } else {
              const resList = document.getElementById("flight-results-list");
              if (resList)
                resList.innerHTML = `<div style="text-align:center; padding:40px; color:red;"><i class="fas fa-exclamation-triangle fa-2x"></i><p>No flights found.</p><p style="font-size:0.9rem; color:#666;">${res.data.message || "Please try different dates."}</p><button class="btn btn-secondary" onclick="showStep('search')" style="margin-top:15px;">Back to Search</button></div>`;
            }
          })
          .catch((e) => {
            console.error(e);
            const resList = document.getElementById("flight-results-list");
            if (resList)
              resList.innerHTML = `<div style="text-align:center; padding:40px; color:red;"><p>Connection Error.</p></div>`;
          });
      } else {
        // Fallback
        console.error("bot_vars is not defined. API call cannot proceed.");
        const resList = document.getElementById("flight-results-list");
        if (resList)
          resList.innerHTML = `<div style="text-align:center; padding:40px; color:red;"><p>Configuration Error.</p></div>`;
      }
    });
  }

  // Mock Results Generator (Removed - Using Real API)

  // Payment Logic
  // ... pills ...
  const validityPills = document.querySelectorAll(".validity-pill");
  validityPills.forEach((pill) => {
    pill.addEventListener("click", () => {
      validityPills.forEach((p) => {
        p.classList.remove("active");
        p.querySelector("input").checked = false;
      });
      pill.classList.add("active");
      const input = pill.querySelector("input");
      input.checked = true;
      window.updateTotalPrice(input.value);
    });
  });

  const paymentTabs = document.querySelectorAll(".payment-tab");
  paymentTabs.forEach((tab) => {
    tab.addEventListener("click", () => {
      paymentTabs.forEach((t) => t.classList.remove("active"));
      tab.classList.add("active");
      const method = tab.getAttribute("data-method");
      const stripeFields = document.getElementById("stripe-fields");
      const payButton = document.getElementById("pay-button");
      if (document.getElementById("selected-payment-method"))
        document.getElementById("selected-payment-method").value = method;
      if (method === "paypal") {
        if (stripeFields) stripeFields.style.display = "none";
        if (payButton) {
          payButton.innerHTML = '<i class="fab fa-paypal"></i> Pay with PayPal';
          payButton.style.backgroundColor = "#003087";
        }
      } else {
        if (stripeFields) stripeFields.style.display = "block";
        if (payButton) {
          payButton.innerHTML = "Pay & Book Ticket";
          payButton.style.backgroundColor = "#3b66a5";
        }
      }
    });
  });

  const payBtn = document.getElementById("pay-button");
  if (payBtn) {
    payBtn.addEventListener("click", () => {
      // 1. GATHER DATA
      const method =
        document.getElementById("selected-payment-method")?.value || "stripe";
      const email = document.getElementById("email")?.value;

      // Get Flight Info
      const flightInfo =
        document.getElementById("summary-flight-selection")?.innerText ||
        "Unknown Flight";
      const price =
        document.getElementById("final-price")?.innerText || "$14.00";

      // Get First Passenger Details (Lead Pax)
      // Since fields are dynamic, we query the first row
      const firstPaxTitle =
        document.querySelector(".passenger-row select")?.value || "";
      const firstPaxFirst = document.querySelector(
        '.passenger-row input[placeholder="First name *"]',
      )?.value;
      const firstPaxLast = document.querySelector(
        '.passenger-row input[placeholder="Last name *"]',
      )?.value;

      // 2. VALIDATION
      if (!email || !firstPaxFirst || !firstPaxLast) {
        alert("Please fill in email and at least the first passenger's name.");
        return;
      }

      // 3. UI LOCK
      const originalText = payBtn.innerHTML;
      payBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Processing...';
      payBtn.disabled = true;

      // 4. AJAX CALL TO WORDPRESS
      if (typeof bot_vars !== "undefined") {
        const formData = new FormData();
        formData.append("action", "bot_process_checkout");
        formData.append("email", email);
        formData.append("first_name", firstPaxFirst);
        formData.append("last_name", firstPaxLast);
        formData.append("title", firstPaxTitle);
        formData.append("flight_summary", flightInfo);
        formData.append("amount", price);
        formData.append("payment_method", method);

        fetch(bot_vars.ajax_url, {
          method: "POST",
          body: formData,
        })
          .then((r) => r.json())
          .then((res) => {
            if (res.success) {
              console.log("Order Created:", res.data);

              // 5. SIMULATE PAYMENT SUCCESS
              setTimeout(() => {
                alert(
                  "Order #" +
                    res.data.order_id +
                    " Created Successfully!\nCheck 'Ticket Orders' in Admin.",
                );
                payBtn.innerHTML = "Success!";
                payBtn.disabled = false;
                // Optional: Redirect to a thank you page
                // window.location.href = "/thank-you";
              }, 1500);
            } else {
              alert("Error: " + res.data.message);
              payBtn.disabled = false;
              payBtn.innerHTML = originalText;
            }
          })
          .catch((e) => {
            console.error(e);
            alert("Server connection failed.");
            payBtn.disabled = false;
            payBtn.innerHTML = originalText;
          });
      } else {
        // Fallback (e.g. static html testing)
        setTimeout(() => {
          alert("Success! (Static Mode - No DB Save)");
          payBtn.innerHTML = "Pay & Book Ticket";
          payBtn.disabled = false;
        }, 2000);
      }
    });
  }

  // --- Prevent Past Dates ---
  // --- Initialize Flatpickr (Custom Date Picker) ---
  // Ensure Flatpickr is loaded
  if (typeof flatpickr !== "undefined") {
    const commonConfig = {
      minDate: "today",
      dateFormat: "Y-m-d",
      disableMobile: "true", // Force custom UI for consistent design
      onChange: function (selectedDates, dateStr, instance) {
        checkFormValidity();
      },
    };

    flatpickr("#departure-date", commonConfig);
    flatpickr("#return-date", commonConfig);
    flatpickr("#receipt-date", commonConfig);
  } else {
    // Fallback if Flatpickr fails to load
    const today = new Date().toISOString().split("T")[0];
    ["departure-date", "return-date", "receipt-date"].forEach((id) => {
      const el = document.getElementById(id);
      if (el) el.setAttribute("min", today);
    });
  }

  // --- Booking Options Toggles ---
  const toggleSection = (chkId, divId) => {
    const chk = document.getElementById(chkId);
    const div = document.getElementById(divId);
    if (chk && div) {
      chk.addEventListener("change", () => {
        div.style.display = chk.checked ? "block" : "none";
      });
    }
  };
  toggleSection("receive-later-chk", "receive-later-container");
  toggleSection("add-notes-chk", "add-notes-container");
  toggleSection("promo-code-chk", "promo-code-container");

  // --- FAQ Accordion ---
  const faqItems = document.querySelectorAll(".faq-item");
  faqItems.forEach((item) => {
    const question = item.querySelector(".faq-question");
    if (question) {
      question.addEventListener("click", () => {
        const isActive = item.classList.contains("active");
        // Optional: Close others
        faqItems.forEach((i) => i.classList.remove("active"));
        // Toggle current
        if (!isActive) item.classList.add("active");
      });
    }
  });

  // Amadeus Results Handler
  window.toggleFlightDetails = function (id) {
    const el = document.getElementById("details-" + id);
    const btn = document.getElementById("btn-details-" + id);
    if (el.style.display === "none") {
      el.style.display = "block";
      btn.innerText = "Hide Details";
    } else {
      el.style.display = "none";
      btn.innerText = "View Details";
    }
  };

  const displayAmadeusFlights = (apiResponse, fromRaw, toRaw, dateRaw) => {
    const resList = document.getElementById("flight-results-list");
    if (!apiResponse || !apiResponse.data || apiResponse.data.length === 0) {
      resList.innerHTML = `<div style="text-align:center; padding:40px;"><p>No flights found for this route/date.</p><button class="btn btn-secondary" onclick="showStep('search')">Try Again</button></div>`;
      return;
    }

    const flights = apiResponse.data;
    const dictionaries = apiResponse.dictionaries || {};
    const carriers = dictionaries.carriers || {};
    const aircraftNames = dictionaries.aircraft || {};

    let html = `
    <style>
      .flight-card-main {
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 20px;
      }
      .fc-logo-col {
        margin-bottom: 10px;
      }
      .fc-route-col {
        width: 100%;
        max-width: 500px;
      }
      .fc-price-col {
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 15px;
      }
      .fc-price-row {
          display: flex; 
          align-items: center; 
          gap: 15px;
      }
      
      /* Desktop / Wide View */
      @media (min-width: 900px) {
        .flight-card-main {
          flex-direction: row;
          align-items: center;
          justify-content: space-between;
          text-align: left;
        }
        .fc-logo-col {
          flex: 0 0 150px; 
          margin-bottom: 0;
          display: flex;
          justify-content: flex-start;
        }
        .fc-logo-col img {
            max-width: 100%;
            height: auto;
            max-height: 80px; 
        }
        .fc-route-col {
          flex: 1; 
          padding: 0 40px;
        }
        .fc-price-col {
          flex: 0 0 200px; 
          align-items: flex-end; 
        }
        .fc-price-row {
            flex-direction: column;
            gap: 2px;
            align-items: flex-end;
        }
      }
    </style>
    `;

    // Limit to first 10
    flights.slice(0, 10).forEach((flight, index) => {
      // Itineraries
      const itinerary = flight.itineraries[0]; // Outbound
      const segments = itinerary.segments;
      const firstSegment = segments[0];
      const lastSegment = segments[segments.length - 1];

      // Airline
      const carrierCode = firstSegment.carrierCode;
      const airlineName = carriers[carrierCode] || carrierCode;
      const flightNumber = carrierCode + firstSegment.number;
      // Logo URL using a common CDN for airline logos
      const logoUrl = `https://pics.avs.io/200/200/${carrierCode}.png`;

      // Times
      const departureDate = firstSegment.departure.at.split("T")[0];
      const departureTime = firstSegment.departure.at
        .split("T")[1]
        .substring(0, 5); // HH:MM

      const arrivalDate = lastSegment.arrival.at.split("T")[0];
      const arrivalTime = lastSegment.arrival.at.split("T")[1].substring(0, 5); // HH:MM

      // Route Codes
      const originCode = firstSegment.departure.iataCode;
      const destCode = lastSegment.arrival.iataCode;

      // Duration
      const duration = itinerary.duration
        .replace("PT", "")
        .replace("H", "h")
        .replace("M", "m") // e.g. 8h20
        .toLowerCase();

      // Details
      const aircraftCode = firstSegment.aircraft.code;
      const aircraftName = aircraftNames[aircraftCode] || aircraftCode;
      const cabinClass =
        flight.travelerPricings[0].fareDetailsBySegment[0].class || "Y"; // Default to Y if missing

      // Escape quotes for onclick
      const safeAirline = airlineName.replace(/'/g, "\\'");

      // Random fake high price
      const fakePrice = (Math.random() * (2000 - 500) + 500).toFixed(2);

      const uniqueId = index;

      html += `
        <div class="flight-card" style="background:#fff; border-radius:15px; box-shadow:0 6px 20px rgba(0,0,0,0.06); padding:30px; margin-bottom:25px; border:1px solid #f0f0f0;">
            
            <!-- Main Content Flex Wrapper -->
            <div class="flight-card-main">
                
                <!-- Logo -->
                <div class="fc-logo-col">
                    <img src="${logoUrl}" alt="${carrierCode}" style="height:70px; object-fit:contain;"> 
                </div>

                <!-- Middle: Route Info -->
                <div class="fc-route-col">
                    <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:15px;">
                        <div style="text-align:center;">
                            <div style="font-size:0.85rem; color:#666; margin-bottom:4px;">${departureDate}</div>
                            <div style="font-size:1.4rem; font-weight:700; color:#1a2b3c;">${departureTime}</div>
                            <div style="font-size:1.3rem; font-weight:800; color:#003087; margin-top:2px;">${originCode}</div>
                        </div>

                        <div style="color:#666; font-size:1.5rem; padding:0 20px;">&rarr;</div>

                        <div style="text-align:center;">
                            <div style="font-size:0.85rem; color:#666; margin-bottom:4px;">${arrivalDate}</div>
                            <div style="font-size:1.4rem; font-weight:700; color:#1a2b3c;">${arrivalTime}</div>
                            <div style="font-size:1.3rem; font-weight:800; color:#003087; margin-top:2px;">${destCode}</div>
                        </div>
                    </div>
                    
                    <div style="display:flex; justify-content:center; gap:20px; color:#666; font-size:0.95rem;">
                         <span><i class="far fa-calendar-alt"></i> ${departureDate}</span>
                         <span>-</span>
                         <span><i class="far fa-clock"></i> ${duration}</span>
                    </div>
                </div>

                <!-- Right: Price & Button -->
                <div class="fc-price-col">
                    <div class="fc-price-row">
                        <div style="text-decoration:line-through; color:#999; font-size:0.9rem;">$${fakePrice}</div>
                        <div style="font-size:1.6rem; font-weight:800; color:#444;">$14.00</div>
                    </div>
                    <button 
                        onclick="selectFlight('${flightNumber}', '${safeAirline}', '${originCode}', '${destCode}', '${departureDate}')"
                        style="background:#e45d46; color:white; border:none; padding:10px 40px; border-radius:8px; font-weight:700; font-size:1.1rem; cursor:pointer; box-shadow:0 4px 6px rgba(228, 93, 70, 0.2); white-space:nowrap;"
                    >
                        Select &rarr;
                    </button>
                </div>
            
            </div>

            <!-- Details Toggle -->
            <div style="text-align:center; margin-top:20px;">
                <div id="btn-details-${uniqueId}" onclick="toggleFlightDetails(${uniqueId})" style="font-size:0.9rem; color:#3b66a5; cursor:pointer; display:inline-block; padding:5px;">View Details</div>
            </div>

            <!-- Hidden Details Section -->
            <div id="details-${uniqueId}" style="display:none; border-top:1px solid #eee; padding-top:15px; margin-top:10px; text-align:center; animation: fadeIn 0.3s;">
                <h5 style="font-weight:700; margin-bottom:10px; font-size:1rem; color:#333;">Departure Information</h5>
                <div style="font-size:0.9rem; color:#555; line-height:1.6;">
                    <div style="margin-bottom:5px;">
                        <span style="font-weight:600;">Flight:</span> ${carrierCode}${firstSegment.number} 
                        <span style="margin:0 8px;">|</span>
                        <span style="font-weight:600;">Class:</span> ${cabinClass} 
                        <span style="margin:0 8px;">|</span>
                        <span style="font-weight:600;">Aircraft:</span> ${aircraftName}
                    </div>
                     <div>
                        ${dictionaries.locations?.[originCode]?.cityCode || originCode} (${originCode}) &rarr; ${dictionaries.locations?.[destCode]?.cityCode || destCode} (${destCode})
                    </div>
                </div>
            </div>

        </div>`;
    });

    resList.innerHTML = html;
  };

  // Init button state
  checkFormValidity();
});
