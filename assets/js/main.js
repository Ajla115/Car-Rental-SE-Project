
(function() {
  "use strict";


// main.js


//: and time managment in the detail car page
document.addEventListener('DOMContentLoaded', function () {
  const timeInput1 = document.getElementById('customTimeInput');
  const timeInput2 = document.getElementById('customTimeInput2');

  timeInput1.addEventListener('input', function (event) {
    handleTimeInput(event.target);
  });

  timeInput2.addEventListener('input', function (event) {
    handleTimeInput(event.target);
  });

  function handleTimeInput(input) {
    const inputValue = input.value.replace(/[^0-9]/g, ''); // Remove non-numeric characters
    let formattedValue = '';

    if (inputValue.length >= 3) {
      const hours = inputValue.slice(0, 2);
      const minutes = inputValue.slice(2, 4);

      formattedValue = `${hours}:${minutes}`;

      // Restrict hours and minutes to valid ranges
      if (parseInt(hours) > 23) {
        formattedValue = '23:';
      }

      if (parseInt(minutes) > 59) {
        formattedValue = `${hours}:59`;
      }
    } else {
      formattedValue = inputValue;
    }

    input.value = formattedValue;
  }
});

//slash adding automatically in the date input in the detail car page
document.addEventListener('DOMContentLoaded', function () {
  const dateInput1 = document.getElementById('customDateInput');
  const dateInput2 = document.getElementById('customDateInput2');

  dateInput1.addEventListener('input', function (event) {
    handleDateInput(event.target);
  });

  dateInput2.addEventListener('input', function (event) {
    handleDateInput(event.target);
  });

  function handleDateInput(input) {
    const inputLength = input.value.length;
    let inputValue = input.value.replace(/[^0-9]/g, ''); // Remove non-numeric characters

    if (inputLength > 2 && inputLength < 5) {
      inputValue = `${inputValue.slice(0, 2)}/${inputValue.slice(2)}`;
    } else if (inputLength >= 5) {
      inputValue = `${inputValue.slice(0, 2)}/${inputValue.slice(2, 4)}/${inputValue.slice(4, 8)}`;
    }

    input.value = inputValue;
  }
});

document.addEventListener('DOMContentLoaded', function () {
  const timeInput1 = document.getElementById('customTimeInput');
  if (timeInput1) {
    timeInput1.addEventListener('input', function (event) {
      handleTimeInput(event.target);
    });
  } else {
    console.error("Element with ID 'customTimeInput' not found");
  }
  // Similarly for other elements...
});


document.addEventListener('DOMContentLoaded', function() {
  var inputElementCard = document.querySelector('.hatchbackPaymentInfoCardContainer, .WagonPaymentInfoCardContainer, .SedanPaymentInfoCardContainer, .MinivanPaymentInfoCardContainer, .SUVPaymentInfoCardContainer,.ElectricPaymentInfoCardContainer input' );

  inputElementCard.addEventListener('input', function(event) {
    var inputValue = event.target.value;
    inputValue = inputValue.replace(/\s/g, ''); // Remove existing spaces

    if (inputValue.length > 0) {
      inputValue = inputValue.match(/.{1,4}/g).join(' '); // Add spacing every 4 characters
      //breakit into groups of 1 to 4 characters, creating an array of those groups, and then joining the array elements with a space.
    }

    event.target.value = inputValue.slice(0, 20); // Limit input to 20 characters
  });

  var inputElementExpDate = document.querySelector('.hatchbackPaymentExpDateCardContainer, .WagonPaymentExpDateCardContainer, .SedanPaymentExpDateCardContainer, .MinivanPaymentExpDateCardContainer, .SUVPaymentExpDateCardContainer,.ElectricPaymentExpDateCardContainer input');

  inputElementExpDate.addEventListener('input', function(event) {
    var inputValue = event.target.value;

    // Remove non-digit characters
    inputValue = inputValue.replace(/\D/g, '');

    // Insert slash after two digits
    if (inputValue.length > 2) {
      inputValue = inputValue.replace(/^(\d{2})(\d{2})$/, '$1/$2');
    }

    event.target.value = inputValue.slice(0, 5); // Limit input to 5 characters
  });
});



  /**
   * Easy selector helper function
   */
  const select = (el, all = false) => {
    el = el.trim()
    if (all) {
      return [...document.querySelectorAll(el)]
    } else {
      return document.querySelector(el)
    }
  }

  /**
   * Easy event listener function
   */
  const on = (type, el, listener, all = false) => {
    let selectEl = select(el, all)
    if (selectEl) {
      if (all) {
        selectEl.forEach(e => e.addEventListener(type, listener))
      } else {
        selectEl.addEventListener(type, listener)
      }
    }
  }

  /**
   * Easy on scroll event listener 
   */
  const onscroll = (el, listener) => {
    el.addEventListener('scroll', listener)
  }

  /**
   * Navbar links active state on scroll
   */
  let navbarlinks = select('#navbar .scrollto', true)
  const navbarlinksActive = () => {
    let position = window.scrollY + 200
    navbarlinks.forEach(navbarlink => {
      if (!navbarlink.hash) return
      let section = select(navbarlink.hash)
      if (!section) return
      if (position >= section.offsetTop && position <= (section.offsetTop + section.offsetHeight)) {
        navbarlink.classList.add('active')
      } else {
        navbarlink.classList.remove('active')
      }
    })
  }
  window.addEventListener('load', navbarlinksActive)
  onscroll(document, navbarlinksActive)

  /**
   * Scrolls to an element with header offset
   */
  const scrollto = (el) => {
    let header = select('#header')
    let offset = header.offsetHeight

    let elementPos = select(el).offsetTop
    window.scrollTo({
      top: elementPos - offset,
      behavior: 'smooth'
    })
  }

  /**
   * Toggle .header-scrolled class to #header when page is scrolled
   */
  let selectHeader = select('#header')
  if (selectHeader) {
    const headerScrolled = () => {
      if (window.scrollY > 100) {
        selectHeader.classList.add('header-scrolled')
      } else {
        selectHeader.classList.remove('header-scrolled')
      }
    }
    window.addEventListener('load', headerScrolled)
    onscroll(document, headerScrolled)
  }

  /**
   * Back to top button
   */
  let backtotop = select('.back-to-top')
  if (backtotop) {
    const toggleBacktotop = () => {
      if (window.scrollY > 100) {
        backtotop.classList.add('active')
      } else {
        backtotop.classList.remove('active')
      }
    }
    window.addEventListener('load', toggleBacktotop)
    onscroll(document, toggleBacktotop)
  }

  /**
   * Mobile nav toggle
   */
  on('click', '.mobile-nav-toggle', function(e) {
    select('#navbar').classList.toggle('navbar-mobile')
    this.classList.toggle('bi-list')
    this.classList.toggle('bi-x')
  })

  /**
   * Mobile nav dropdowns activate
   */
  on('click', '.navbar .dropdown > a', function(e) {
    if (select('#navbar').classList.contains('navbar-mobile')) {
      e.preventDefault()
      this.nextElementSibling.classList.toggle('dropdown-active')
    }
  }, true)

  /**
   * Scrool with ofset on links with a class name .scrollto
   */
  on('click', '.scrollto', function(e) {
    if (select(this.hash)) {
      e.preventDefault()

      let navbar = select('#navbar')
      if (navbar.classList.contains('navbar-mobile')) {
        navbar.classList.remove('navbar-mobile')
        let navbarToggle = select('.mobile-nav-toggle')
        navbarToggle.classList.toggle('bi-list')
        navbarToggle.classList.toggle('bi-x')
      }
      scrollto(this.hash)
    }
  }, true)

  /**
   * Scroll with ofset on page load with hash links in the url
   */
  window.addEventListener('load', () => {
    if (window.location.hash) {
      if (select(window.location.hash)) {
        scrollto(window.location.hash)
      }
    }
  });

  /**
   * Preloader
   */
  let preloader = select('#preloader');
  if (preloader) {
    window.addEventListener('load', () => {
      preloader.remove()
    });
  }

  /**
   * Clients Slider
   */
  new Swiper('.clients-slider', {
    speed: 400,
    loop: true,
    autoplay: {
      delay: 5000,
      disableOnInteraction: false
    },
    slidesPerView: 'auto',
    pagination: {
      el: '.swiper-pagination',
      type: 'bullets',
      clickable: true
    },
    breakpoints: {
      320: {
        slidesPerView: 2,
        spaceBetween: 40
      },
      480: {
        slidesPerView: 3,
        spaceBetween: 60
      },
      640: {
        slidesPerView: 4,
        spaceBetween: 80
      },
      992: {
        slidesPerView: 6,
        spaceBetween: 120
      }
    }
  });



  /**
   * Porfolio isotope and filter
   */
  window.addEventListener('load', () => {
    let portfolioContainer = select('.portfolio-container');
    if (portfolioContainer) {
      let portfolioIsotope = new Isotope(portfolioContainer, {
        itemSelector: '.portfolio-item'
      });

      let portfolioFilters = select('#portfolio-flters li', true);

      on('click', '#portfolio-flters li', function(e) {
        e.preventDefault();
        portfolioFilters.forEach(function(el) {
          el.classList.remove('filter-active');
        });
        this.classList.add('filter-active');

        portfolioIsotope.arrange({
          filter: this.getAttribute('data-filter')
        });
        portfolioIsotope.on('arrangeComplete', function() {
          AOS.refresh()
        });
      }, true);
    }

  });

 

  /**
   * Testimonials slider
   */
  new Swiper('.testimonials-slider', {
    speed: 600,
    loop: true,
    autoplay: {
      delay: 5000,
      disableOnInteraction: false
    },
    slidesPerView: 'auto',
    pagination: {
      el: '.swiper-pagination',
      type: 'bullets',
      clickable: true
    }
  });

  /**
   * Animation on scroll
   */
  window.addEventListener('load', () => {
    AOS.init({
      duration: 1000,
      easing: "ease-in-out",
      once: true,
      mirror: false
    });
  });

  /**
   * Initiate Pure Counter 
   */
  new PureCounter();

})()



document.addEventListener('DOMContentLoaded', function () {
  const timeInput1 = document.getElementById('customTimeInput');
  if (timeInput1) {
    timeInput1.addEventListener('input', function (event) {
      handleTimeInput(event.target);
    });
  } else {
    console.error("Element with ID 'customTimeInput' not found");
  }
  // Similarly for other elements...
});

document.addEventListener('DOMContentLoaded', function() {
  var mySwiper = new Swiper('.car-swiper-container', {
    slidesPerView: 'auto',
    spaceBetween: 20,
    grabCursor: true,
    pagination: {
      el: '.car-swiper-pagination',
      clickable: true,
    },
    navigation: {
      nextEl: '.car-swiper-button-next',
      prevEl: '.car-swiper-button-prev',
    },
  });
});

 // Initialize Toastr
 /*toastr.options = {
  "closeButton": false,
  "debug": false,
  "newestOnTop": false,
  "progressBar": false,
  "positionClass": "toast-top-right",
  "preventDuplicates": false,
  "onclick": null,
  "showDuration": "300",
  "hideDuration": "1000",
  "timeOut": "500",
  "extendedTimeOut": "1000",
  "showEasing": "swing",
  "hideEasing": "linear",
  "showMethod": "fadeIn",
  "hideMethod": "fadeOut",
  "onHidden": function() { window.location.href = 'index.html'; }
}*/

