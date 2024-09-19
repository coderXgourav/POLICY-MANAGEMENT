;(function () {
  const $themeConfig = {
    theme: 'light', // light, dark
    menu: 'vertical', // vertical, collapsible-vertical, horizontal
    dir: 'ltr', // rtl, ltr
    primaryColor: '0 167 111',
    contrast: 'low',
    stretch: false,
    darkMode: false
  }
  function getUrlParams() {
    const params = {}
    const queryString = window.location.search.substring(1)
    const urlParams = new URLSearchParams(queryString)

    for (const [key, value] of urlParams.entries()) {
      params[key] = value
    }
    return params
  }

  // Get URL parameters
  const urlParams = getUrlParams()
  if (urlParams?.menu) {
    $themeConfig.menu = urlParams?.menu
  }
  if (urlParams?.darkMode) {
    $themeConfig.darkMode = urlParams?.darkMode
  }
  if (urlParams?.dir) {
    $themeConfig.dir = urlParams?.dir
  }

  window.addEventListener('load', function () {
    // set theme
    const storedColor = localStorage.getItem('primaryColor')
    if (storedColor) {
      document.documentElement.style.setProperty('--primary-color', storedColor)
    }
    // screen loader
    const screen_loader = document.getElementsByClassName('screen_loader')
    if (screen_loader?.length) {
      screen_loader[0].classList.add('animate__fadeOut')
      setTimeout(() => {
        document.body.removeChild(screen_loader[0])
      }, 500)
    }

    // set rtl layout
    Alpine.store('app').setRTLLayout()
  })
  document.addEventListener('alpine:init', () => {
    Alpine.data('main', (value) => ({}))
    Alpine.store('app', {
      theme: Alpine.$persist($themeConfig.theme),
      currentColor: localStorage.getItem('primaryColor') || '0 167 111',
      stretch: Alpine.$persist($themeConfig.stretch),
      menu: urlParams?.menu || Alpine.$persist($themeConfig.menu),
      dir: urlParams?.dir || Alpine.$persist($themeConfig.dir),
      isDarkMode: urlParams?.darkMode || Alpine.$persist($themeConfig.darkMode),
      contrast: Alpine.$persist($themeConfig.contrast),
      toggleStretch() {
        this.stretch = !this.stretch
      },
      toggleContrast(val) {
        this.contrast = val
      },
      toggleTheme(val) {
        if (!val) {
          val = this.theme || $themeConfig.theme // light|dark|system
        }

        this.theme = val

        if (this.theme == 'light') {
          this.isDarkMode = false
        } else if (this.theme == 'dark') {
          this.isDarkMode = true
        }
      },
      toggleMenu(val) {
        if (!val) {
          val = this.menu || $themeConfig.menu // vertical, collapsible-vertical, horizontal
        }
        this.menu = val
      },
      sidebar: window.innerWidth >= 1200,
      toggleSidebar() {
        this.sidebar = !this.sidebar
      },
      toggleRTL(val) {
        if (!val) {
          val = this.dir || $themeConfig.dir // rtl, ltr
        }

        this.dir = val
        this.setRTLLayout()
      },
      setRTLLayout() {
        document.querySelector('html').setAttribute('dir', this.dir || $themeConfig.dir)
      },
      changeColor(color) {
        document.documentElement.style.setProperty('--primary-color', color)
        localStorage.setItem('primaryColor', color)
        this.currentColor = color
      },
      resetTheme() {
        this.toggleTheme('light')
        this.toggleMenu('vertical')
        this.toggleRTL('ltr')
        this.changeColor('0 167 111')
      },
      handleResize() {
        this.sidebar = window.innerWidth >= 1200
      },
      closeSidebarOnOutsideClick() {
        if (window.innerWidth < 1200) {
          this.sidebar = false
        }
      },
      init() {
        this.handleResize()
        window.addEventListener('resize', this.handleResize.bind(this))
        document.documentElement.style.setProperty('--primary-color', this.currentColor)
        localStorage.setItem('primaryColor', this.currentColor)
      }
    })
    Alpine.data('customizer', () => ({
      customizerIsOpen: false,
      toggleCustomizer() {
        this.customizerIsOpen = !this.customizerIsOpen
      },
      openCustomizer() {
        this.customizerIsOpen = true
      },
      closeCustomizer() {
        this.customizerIsOpen = false
      }
    }))
    Alpine.data('dropdown', () => ({
      isOpen: false,
      toggle() {
        this.isOpen = !this.isOpen
      },
      close() {
        this.isOpen = false
      }
    }))
    Alpine.data('modal', () => ({
      isOpen: false,
      toggle() {
        this.isOpen = !this.isOpen
      },
      closeModal() {
        this.isOpen = false
        document.body.style.overflow = 'auto'
        document.body.classList.remove('xl:pr-[17px]')
      },
      openModal() {
        this.isOpen = true
        document.body.style.overflow = 'hidden'
        document.body.classList.add('xl:pr-[17px]')
      }
    }))

    Alpine.data('pagination', () => ({
      currentPage: 1,
      totalPages: 10,
      get pageNumbers() {
        let pagination = [],
          i = 1

        while (i <= this.totalPages) {
          if (
            i <= (this.currentPage > 3 ? 1 : 4) || //the first three pages
            i >= this.totalPages || //the last three pages
            (i >= this.currentPage - 1 && i <= this.currentPage + 1)
          ) {
            //the currentPage, the page before and after
            pagination.push(i)
            i++
          } else {
            //any other page should be represented by ...
            pagination.push('...')
            //jump to the next page to be linked in the navigation
            i = i < this.currentPage ? this.currentPage - 1 : this.totalPages
          }
        }
        return pagination
      },

      showEllipsis(page) {
        return page !== '...'
      },

      changePage(page) {
        if (page === '...') return
        this.currentPage = page
      },
      goToLastPage() {
        this.currentPage = this.totalPages
      }
    }))

    Alpine.data('calendar', () => ({
      currentDate: new Date(),
      currentMonth: new Date().getMonth(),
      currentYear: new Date().getFullYear(),
      selectedDate: new Date(),
      weekDays: ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'],
      monthNames: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
      year: new Date().getFullYear(),
      month: new Date().getMonth() + 1,
      years: Array.from({ length: 100 }, (_, i) => new Date().getFullYear() - 50 + i),
      selectedTime: null,
      currentTime: new Date(),
      hours: Array.from({ length: 24 }, (_, i) => i),
      minutes: Array.from({ length: 60 }, (_, i) => (i < 10 ? `0${i}` : i)),

      // Time-related methods
      selectTime(time) {
        this.selectedTime = time
      },

      getFormattedTime(time) {
        const hours = time.getHours()
        const minutes = time.getMinutes()
        const ampm = hours >= 12 ? 'PM' : 'AM'
        const formattedHours = hours % 12 === 0 ? 12 : hours % 12
        const formattedMinutes = minutes < 10 ? `0${minutes}` : minutes
        return `${formattedHours}:${formattedMinutes} ${ampm}`
      },

      get daysInMonth() {
        const days = []
        const date = new Date(this.currentYear, this.currentMonth, 1)
        const lastDay = new Date(this.currentYear, this.currentMonth + 1, 0).getDate()
        const firstDayOfMonth = date.getDay() // Get the day of the week for the first day of the month (0 = Sunday, 1 = Monday, ..., 6 = Saturday)

        // Add empty cells for the days before the first day of the month
        for (let i = 0; i < firstDayOfMonth; i++) {
          days.push({ date: null, isCurrentMonth: false, isToday: false })
        }

        for (let i = 1; i <= lastDay; i++) {
          const day = new Date(this.currentYear, this.currentMonth, i)
          days.push({
            date: day,
            isCurrentMonth: day.getMonth() === this.currentMonth,
            isToday: day.toDateString() === new Date().toDateString()
          })
        }

        return days
      },

      prevMonth() {
        if (this.currentMonth === 0) {
          this.currentMonth = 11
          this.currentYear--
        } else {
          this.currentMonth--
        }
      },

      nextMonth() {
        if (this.currentMonth === 11) {
          this.currentMonth = 0
          this.currentYear++
        } else {
          this.currentMonth++
        }
      },

      selectDate(date) {
        this.selectedDate = date
      },
      getCurrentDayName() {
        return this.weekDays[new Date().getDay()]
      },
      goToDate() {
        this.currentYear = this.year
        this.currentMonth = this.month - 1
      },

      goToYear() {
        this.currentYear = this.year
      }
    }))

    if (document.getElementById('tooltip-one')) {
      tippy('#tooltip-one', {
        content: 'This is tooltip',
        touch: true,
        arrow: false
      })
      tippy('#tooltip-two', {
        content: 'Add',
        touch: true,
        arrow: false
      })
      tippy('#tooltip-three', {
        content: 'Delete',
        touch: true,
        arrow: false
      })
      tippy('#tooltip-four', {
        content: 'Add',
        touch: true,
        arrow: false
      })
      tippy('#tooltip-five', {
        content: 'Info',
        touch: true,
        arrow: false
      })
      tippy('#tooltip-six', {
        content: 'Add',
        touch: true
      })
      tippy('#tooltip-seven', {
        content: 'Fusce vulputate eleifend sapien. Curabitur at lacus ac velit ornare lobortis.',
        touch: true,
        placement: 'bottom',
        arrow: false,
        maxWidth: 300
      })
      tippy('#tooltip-eight', {
        content: 'Fusce vulputate eleifend sapien. Curabitur at lacus ac velit ornare lobortis. Fusce vulputate eleifend sapien. Curabitur at lacus ac velit ornare lobortis ',
        touch: true,
        placement: 'bottom',
        arrow: false,
        maxWidth: 500
      })
      tippy('#tooltip-nine', {
        content: 'Fusce vulputate eleifend sapien. Curabitur at lacus ac velit ornare lobortis.',
        touch: true,
        placement: 'bottom',
        arrow: false,
        maxWidth: 300
      })
      tippy('#tooltip-grow', {
        content: 'Grow',
        touch: true,
        animateFill: false,
        animation: 'perspective'
      })
      tippy('#tooltip-fade', {
        content: 'Fade',
        touch: true,
        animation: 'fade',
        duration: 800
      })
      tippy('#tooltip-zoom', {
        content: 'Shift Away',
        touch: true,
        animation: 'scale'
      })
      tippy('#tooltip-top-start', {
        content: 'Top Start',
        touch: true,
        animation: 'scale',
        placement: 'top-start'
      })
      tippy('#tooltip-top', {
        content: 'Top',
        touch: true,
        animation: 'scale',
        placement: 'top'
      })
      tippy('#tooltip-top-end', {
        content: 'Top End',
        touch: true,
        animation: 'scale',
        placement: 'top-end'
      })
      tippy('#tooltip-left-start', {
        content: 'Left Start',
        touch: true,
        animation: 'scale',
        placement: 'left-start'
      })
      tippy('#tooltip-left', {
        content: 'Left',
        touch: true,
        animation: 'scale',
        placement: 'left'
      })
      tippy('#tooltip-left-end', {
        content: 'Left End',
        touch: true,
        animation: 'scale',
        placement: 'left-end'
      })
      tippy('#tooltip-right-start', {
        content: 'Right Start',
        touch: true,
        animation: 'scale',
        placement: 'right-start'
      })
      tippy('#tooltip-right', {
        content: 'Right',
        touch: true,
        animation: 'scale',
        placement: 'right'
      })
      tippy('#tooltip-right-end', {
        content: 'Right End',
        touch: true,
        animation: 'scale',
        placement: 'right-end'
      })
      tippy('#tooltip-bottom-start', {
        content: 'Bottom Start',
        touch: true,
        animation: 'scale',
        placement: 'bottom-start'
      })
      tippy('#tooltip-bottom', {
        content: 'Bottom',
        touch: true,
        animation: 'scale',
        placement: 'bottom'
      })
      tippy('#tooltip-bottom-end', {
        content: 'Bottom End',
        touch: true,
        animation: 'scale',
        placement: 'bottom-end'
      })
    }

    // payment tooltip
    if (document.getElementById('tooltip-pricing')) {
      tippy('#tooltip-pricing', {
        content: 'Price Included VAT, 1 year free',
        touch: true,
        arrow: false
      })
    }
  })

  function toggleFullscreen() {
    const fullscreenBtnText = document.getElementById('fullscreen-btn-text')
    const fullscreenIcon = document.querySelector('.full-screen-icon')
    if (!document.fullscreenElement) {
      fullscreenBtnText.innerText = 'Exit Fullscreen'
      fullscreenIcon.classList.add('la-compress')
      fullscreenIcon.classList.remove('la-expand')
      // If no element is in fullscreen, make the document fullscreen
      if (document.documentElement.requestFullscreen) {
        document.documentElement.requestFullscreen()
      } else if (document.documentElement.mozRequestFullScreen) {
        /* Firefox */
        document.documentElement.mozRequestFullScreen()
      } else if (document.documentElement.webkitRequestFullscreen) {
        /* Chrome, Safari and Opera */
        document.documentElement.webkitRequestFullscreen()
      } else if (document.documentElement.msRequestFullscreen) {
        /* IE/Edge */
        document.documentElement.msRequestFullscreen()
      }
    } else {
      fullscreenBtnText.innerText = 'Fullscreen'
      fullscreenIcon.classList.remove('la-compress')
      fullscreenIcon.classList.add('la-expand')
      // Exit fullscreen
      if (document.exitFullscreen) {
        document.exitFullscreen()
      } else if (document.mozCancelFullScreen) {
        /* Firefox */
        document.mozCancelFullScreen()
      } else if (document.webkitExitFullscreen) {
        /* Chrome, Safari and Opera */
        document.webkitExitFullscreen()
      } else if (document.msExitFullscreen) {
        /* IE/Edge */
        document.msExitFullscreen()
      }
    }
  }
  const fullScreenBtn = document.getElementById('fullscreenButton')
  fullScreenBtn && fullScreenBtn.addEventListener('click', toggleFullscreen)

  if (document.querySelector('.nc-select')) {
    const selects = document.querySelectorAll('.nc-select')
    selects.forEach((el) => {
      NiceSelect.bind(el)
    })
  }
  if (document.getElementById('daterange')) {
    flatpickr('#daterange', {
      mode: 'range',
      dateFormat: 'Y-m-d'
    })
  }

  if (document.getElementById('filedate')) {
    flatpickr('#filedate', {
      dateFormat: 'Y-m-d'
    })
  }
  if (document.getElementById('desktop-date')) {
    flatpickr('#desktop', {
      dateFormat: 'Y-m-d',
      placeholder: 'Select date'
    })
  }

  const scrollContainer = document.getElementById('scrollContainer')
  const scrollLeftBtn = document.getElementById('scrollLeftBtn')
  const scrollRightBtn = document.getElementById('scrollRightBtn')

  scrollLeftBtn &&
    scrollLeftBtn.addEventListener('click', () => {
      scrollContainer.scrollLeft -= 100 // Adjust the scroll amount as needed
    })

  scrollRightBtn &&
    scrollRightBtn.addEventListener('click', () => {
      scrollContainer.scrollLeft += 100 // Adjust the scroll amount as needed
    })

  // editor

  if (document.getElementById('editor-one')) {
    const quill = new Quill('#editor-one', {
      theme: 'snow',
      modules: { toolbar: '#toolbar-one' }
    })
  }
  if (document.getElementById('editor-two')) {
    const quilltwo = new Quill('#editor-two', {
      theme: 'snow',
      modules: { toolbar: '#toolbar-two' }
    })
  }
  // dropzone

  const dropzoneEl = document.getElementById('multi-file')
  if (dropzoneEl) {
    const myDropzone = new Dropzone('#multi-file', {
      autoProcessQueue: false,
      accept: [],
      clickable: '.clickable-multi',
      previewTemplate: `<div class="dz-preview dz-file-preview flex justify-between items-center p-2 my-2 rounded-lg border border-neutral-30 dark:border-r-neutral-500">
      <div class="dz-details flex justify-between items-center gap-5">
      <div class="size-12 text-2xl flex justify-center items-center rounded-md text-neutral-0 bg-primary-300">
      <i data-dz-thumbnail />
      </div>
              <div>
                  <div class="dz-filename not-italic"><span data-dz-name></span></div>
                  <div class="dz-size not-italic" data-dz-size></div>
              </div>
      </div>    
      <button class="hover:bg-neutral-30 size-7 mr-3 rounded-full duration-300 flex items-center justify-center" data-dz-remove>
      <i class="las la-times text-lg"></i>
      </button>                               
    </div>`,
      init: function () {
        this.on('addedfile', function (file) {
          const iconElement = file.previewElement.querySelector('[data-dz-thumbnail]')
          if (iconElement) {
            const fileType = file.type.split('https://softivuspro.com/')[1] // Get the file extension
            switch (fileType) {
              case 'pdf':
                iconElement.classList.add('las', 'la-file-pdf') // Add PDF icon class
                break
              case 'x-zip-compressed':
                iconElement.classList.add('las', 'la-file-archive') // Add PDF icon class
                break
              case 'png':
              case 'jpg':
              case 'svg+xml':
              case 'jpeg':
                iconElement.classList.add('las', 'la-file-image') // Add image icon class
                break
              // Add more cases for other file types as needed
              default:
                iconElement.classList.add('las', 'la-file') // Add default file icon class
                break
            }
          }
        })
      }
    })

    // single dropzone
    const singleDropzone = new Dropzone('#single-file', {
      autoProcessQueue: false,
      clickable: '.clickable-single',
      maxFiles: 1,
      previewTemplate: `
            <div class="dz-preview dz-file-preview flex relative justify-center py-5 bg-neutral-20 h-[300px] dark:bg-neutral-903 items-center p-3 rounded-lg border border-neutral-30 dark:border-r-neutral-500 ">
            <div class="flex flex-col items-center">
            <img class="h-[180px] rounded-full" data-dz-thumbnail />  
            <div class="text-center">
            <div class="dz-filename not-italic"><span data-dz-name></span></div>
            <div class="dz-size not-italic" data-dz-size></div>
        </div>
            </div>
              <button class="text-xl size-7 absolute top-5 right-5 rounded-full flex items-center justify-center bg-neutral-40 dark:bg-neutral-100" data-dz-remove>
                <i class="las la-times"></i>
              </button>
            </div>
        `
    })
    singleDropzone.on('addedfile', function (file) {
      document.querySelector('.clickable-single').classList.add('hidden')
      if (this.files.length > 1) {
        this.removeFile(this.files[0]) // Remove extra files
      }
    })
    singleDropzone.on('removedfile', function (file) {
      document.querySelector('.clickable-single').classList.remove('hidden')
      if (this.files.length > 1) {
        this.removeFile(this.files[0]) // Remove extra files
      }
    })
  }
  if (document.getElementById('avatar-upload')) {
    const avatarDropzone = new Dropzone('#avatar-upload', {
      autoProcessQueue: false,
      clickable: '.clickable-avatar',
      maxFiles: 1,
      previewTemplate: `
            <div class="dz-preview dz-file-preview flex relative justify-center bg-neutral-20 dark:bg-neutral-903 items-center p-2 rounded-full">           
            <div
            class="size-40 rounded-full flex items-center justify-center cursor-pointer  clickable-avatar  bg-neutral-20 dark:bg-neutral-903 border-4 border-neutral-0 dark:border-neutral-904">
            
            <img class="size-40 rounded-full" data-dz-thumbnail />            
            </div>
            </div>
        `
    })
    avatarDropzone.on('addedfile', function (file) {
      document.querySelector('.clickable-avatar').classList.add('hidden')
      if (this.files.length > 1) {
        this.removeFile(this.files[0]) // Remove extra files
      }
    })
    avatarDropzone.on('removedfile', function (file) {
      document.querySelector('.clickable-avatar').classList.remove('hidden')
      if (this.files.length > 1) {
        this.removeFile(this.files[0]) // Remove extra files
      }
    })
  }

  const singleDropzones = document.querySelectorAll('.single-file')
  if (singleDropzones.length) {
    singleDropzones.forEach((dropzone) => {
      const singleDropzone = new Dropzone('.single-file', {
        autoProcessQueue: false,
        clickable: '.clickable-single',
        maxFiles: 1,
        previewTemplate: `
              <div class="dz-preview dz-file-preview flex relative justify-center py-5 bg-neutral-20 h-[300px] dark:bg-neutral-903 items-center p-3 rounded-lg border border-neutral-30 dark:border-r-neutral-500 ">
              <div class="flex flex-col items-center">
              <img class="h-[180px] rounded-full" data-dz-thumbnail />  
              <div class="text-center">
              <div class="dz-filename not-italic"><span data-dz-name></span></div>
              <div class="dz-size not-italic" data-dz-size></div>
          </div>
              </div>
                <button class="text-xl size-7 absolute top-5 right-5 rounded-full flex items-center justify-center bg-neutral-40 dark:bg-neutral-100" data-dz-remove>
                  <i class="las la-times"></i>
                </button>
              </div>
          `
      })
      singleDropzone.on('addedfile', function (file) {
        document.querySelector('.clickable-single').classList.add('hidden')
        if (this.files.length > 1) {
          this.removeFile(this.files[0]) // Remove extra files
        }
      })
      singleDropzone.on('removedfile', function (file) {
        document.querySelector('.clickable-single').classList.remove('hidden')
        if (this.files.length > 1) {
          this.removeFile(this.files[0]) // Remove extra files
        }
      })
    })
  }
  // product edit
  const productImgUploadEl = document.querySelector('#product-img-upload')
  if (productImgUploadEl) {
    const myDropzone = new Dropzone('#product-img-upload', {
      autoProcessQueue: false,
      accept: [],
      clickable: '.clickable-multi',
      previewsContainer: '.img-previews',
      previewTemplate: `<div class="size-20 relative items-center rounded-lg border border-neutral-30 dark:border-r-neutral-500 mt-4">
          <div class="dz-preview dz-file-preview">
          <img class="size-20 rounded-lg object-contain object-center" width="80" height="80" data-dz-thumbnail /> 
          <button class="bg-error-50 border border-error-300 absolute top-1 right-1 size-4 rounded-full duration-300 flex items-center justify-center" data-dz-remove>
          <i class="las la-times text-sm text-error-300"></i>
          </button> 
      </div>                    
  </div>`,
      init: function () {
        this.on('addedfile', function (file) {})
      }
    })
    const removeBtn = document.querySelector('removeAllFile').addEventListener('click', () => {
      myDropzone.removeAllFiles()
    })
  }

  // swiper slide
  const swiperSlides = document.querySelector('.basic-one')
  if (swiperSlides) {
    function updSwiperNumericPagination(pagination) {
      this.el.querySelector(pagination).innerHTML = '<span class="count">' + (this.realIndex + 1) + '</span>/<span class="total">' + this.slides.length + '</span>'
    }

    const basicOneSwiper = new Swiper('.basic-one', {
      slidesPerView: 1,
      loop: true,
      autoplay: true,
      navigation: {
        nextEl: '.basic-one-next',
        prevEl: '.basic-one-prev'
      },
      on: {
        // Secondary pagination is update after initialization and after slide change
        init: function updSwiperNumericPagination() {
          this.el.querySelector('.basic-one-pagination').innerHTML = '<span class="count">' + (this.realIndex + 1) + '</span>/<span class="total">' + this.slides.length + '</span>'
        },
        slideChange: function updSwiperNumericPagination() {
          this.el.querySelector('.basic-one-pagination').innerHTML = '<span class="count">' + (this.realIndex + 1) + '</span>/<span class="total">' + this.slides.length + '</span>'
        }
      }
    })
    // slide 2
    const basicTwoSwiper = new Swiper('.basic-two', {
      slidesPerView: 1,
      loop: true,
      autoplay: true,
      navigation: {
        nextEl: '.basic-two-next',
        prevEl: '.basic-two-prev'
      },
      on: {
        // Secondary pagination is update after initialization and after slide change
        init: function updSwiperNumericPagination() {
          this.el.querySelector('.basic-two-pagination').innerHTML = '<span class="count">' + (this.realIndex + 1) + '</span>/<span class="total">' + this.slides.length + '</span>'
        },
        slideChange: function updSwiperNumericPagination() {
          this.el.querySelector('.basic-two-pagination').innerHTML = '<span class="count">' + (this.realIndex + 1) + '</span>/<span class="total">' + this.slides.length + '</span>'
        }
      }
    })

    // slide 3
    const basicThreeSwiper = new Swiper('.basic-three', {
      slidesPerView: 1,
      loop: true,
      autoplay: true,
      navigation: {
        nextEl: '.basic-three-next',
        prevEl: '.basic-three-prev'
      },
      pagination: {
        el: '.basic-three-pagination',
        clickable: true
      }
    })

    // slide 4
    const basicFourSwiper = new Swiper('.basic-four', {
      slidesPerView: 1,
      loop: true,
      autoplay: true,
      navigation: {
        nextEl: '.basic-four-next',
        prevEl: '.basic-four-prev'
      },
      pagination: {
        el: '.basic-four-pagination',
        clickable: true
      }
    })
    // thumb swiper
    const swiper = new Swiper('.thumbswiper2', {
      spaceBetween: 10,
      slidesPerView: 4,
      freeMode: true,
      watchSlidesProgress: true
    })
    const swiper2 = new Swiper('.thumbswiper1', {
      spaceBetween: 10,
      navigation: {
        nextEl: '.thumb-next',
        prevEl: '.thumb-prev'
      },
      thumbs: {
        swiper: swiper
      },
      on: {
        // Secondary pagination is update after initialization and after slide change
        init: function updSwiperNumericPagination() {
          this.el.querySelector('.thumb-pagination').innerHTML = '<span class="count">' + (this.realIndex + 1) + '</span>/<span class="total">' + this.slides.length + '</span>'
        },
        slideChange: function updSwiperNumericPagination() {
          this.el.querySelector('.thumb-pagination').innerHTML = '<span class="count">' + (this.realIndex + 1) + '</span>/<span class="total">' + this.slides.length + '</span>'
        }
      }
    })

    // centermode swiper
    const centerModeCarousel = new Swiper('.center-mode-carousel', {
      slidesPerView: 1,
      loop: true,
      autoplay: true,
      navigation: {
        nextEl: '.center-mode-next',
        prevEl: '.center-mode-prev'
      },
      centeredSlides: true,
      breakpoints: {
        460: {
          slidesPerView: 1.4,
          spaceBetween: 20
        },
        640: {
          slidesPerView: 1.8,
          spaceBetween: 20
        },
        768: {
          slidesPerView: 2.2,
          spaceBetween: 24
        },
        1024: {
          slidesPerView: 3.5,
          spaceBetween: 24
        },
        1400: {
          slidesPerView: 4.2,
          spaceBetween: 24
        }
      }
    })

    const animationCarousel = new Swiper('.animation-carousel', {
      navigation: {
        nextEl: '.animation-carousel-next',
        prevEl: '.animation-carousel-prev'
      },
      loop: true,
      autoplay: true,
      on: {
        // Secondary pagination is update after initialization and after slide change
        init: function updSwiperNumericPagination() {
          this.el.querySelector('.animation-carousel-pagination').innerHTML = '<span class="count">' + (this.realIndex + 1) + '</span>/<span class="total">' + this.slides.length + '</span>'
        },
        slideChange: function updSwiperNumericPagination() {
          this.el.querySelector('.animation-carousel-pagination').innerHTML = '<span class="count">' + (this.realIndex + 1) + '</span>/<span class="total">' + this.slides.length + '</span>'
        }
      }
    })
  }

  if (document.querySelector('.more-categories')) {
    const moreCatSwiper = new Swiper('.more-categories', {
      slidesPerView: 'auto',
      loop: true,
      autoplay: true,
      navigation: {
        nextEl: '.cat-next',
        prevEl: '.cat-prev'
      },
      pagination: {
        el: '.cat-pagination',
        clickable: true
      },
      breakpoints: {
        640: {
          slidesPerView: 2,
          spaceBetween: 12
        },
        768: {
          slidesPerView: 4,
          spaceBetween: 15
        },
        1024: {
          slidesPerView: 5,
          spaceBetween: 20
        },
        1200: {
          slidesPerView: 8,
          spaceBetween: 24
        }
      }
    })
  }

  if (document.querySelector('.product-slider')) {
    const productSwiper = new Swiper('.product-slider', {
      slidesPerView: 1,
      loop: true,
      autoplay: true,
      pagination: {
        el: '.product-pagination',
        clickable: true
      }
    })
  }

  if (document.querySelector('.team-slider')) {
    const teamSlider = new Swiper('.team-slider', {
      slidesPerView: 'auto',
      loop: true,
      autoplay: {
        delay: 3500
      },
      navigation: {
        nextEl: '.team-next',
        prevEl: '.team-prev'
      },
      breakpoints: {
        640: {
          slidesPerView: 2,
          spaceBetween: 12
        },
        992: {
          slidesPerView: 3,
          spaceBetween: 20
        },
        1200: {
          slidesPerView: 4,
          spaceBetween: 24
        }
      }
    })
  }

  // post slider
  if (document.querySelector('.blog-slider')) {
    const blogSlider = new Swiper('.blog-slider', {
      slidesPerView: 'auto',
      loop: true,
      autoplay: {
        delay: 3500
      },
      navigation: {
        nextEl: '.blog-next',
        prevEl: '.blog-prev'
      },
      pagination: {
        el: '.blog-pagination',
        clickable: true
      },
      breakpoints: {
        640: {
          slidesPerView: 2,
          spaceBetween: 12
        },
        992: {
          slidesPerView: 3,
          spaceBetween: 20
        },
        1200: {
          slidesPerView: 4,
          spaceBetween: 24
        }
      }
    })
  }

  if (document.querySelector('.testimonial-swiper')) {
    const teamSlider = new Swiper('.testimonial-swiper', {
      slidesPerView: 1,
      loop: true,
      autoplay: {
        delay: 3800
      },
      navigation: {
        nextEl: '.testi-next',
        prevEl: '.testi-prev'
      },
      pagination: {
        el: '.testimonial-pagination',
        clickable: true
      },
      effect: 'coverflow',
      grabCursor: true,
      centeredSlides: true,
      coverflowEffect: {
        rotate: 0,
        stretch: 80,
        depth: 200,
        modifier: 1,
        slideShadows: false
      },
      breakpoints: {
        300: {
          slidesPerView: 1.2
        },
        450: {
          slidesPerView: 1.4
        },
        550: {
          slidesPerView: 1.7
        },
        768: {
          slidesPerView: 2
        }
      }
    })
  }

  if (document.querySelector('.productThumbswiper1')) {
    const swiper = new Swiper('.productThumbswiper2', {
      spaceBetween: 10,
      slidesPerView: 4,
      freeMode: true,
      watchSlidesProgress: true
    })
    const swiper2 = new Swiper('.productThumbswiper1', {
      spaceBetween: 10,
      navigation: {
        nextEl: '.thumb-next',
        prevEl: '.thumb-prev'
      },
      thumbs: {
        swiper: swiper
      },
      on: {
        // Secondary pagination is update after initialization and after slide change
        init: function updSwiperNumericPagination() {
          this.el.querySelector('.thumb-pagination').innerHTML = '<span class="count">' + (this.realIndex + 1) + '</span>/<span class="total">' + this.slides.length + '</span>'
        },
        slideChange: function updSwiperNumericPagination() {
          this.el.querySelector('.thumb-pagination').innerHTML = '<span class="count">' + (this.realIndex + 1) + '</span>/<span class="total">' + this.slides.length + '</span>'
        }
      }
    })
  }

  // card swiper
  if (document.querySelector('.cardSlider')) {
    const cardSlider = new Swiper('.cardSlider', {
      slidesPerView: 1,
      loop: true,
      autoplay: {
        delay: 4000
      },
      pagination: {
        el: '.card-pagination',
        clickable: true
      }
    })
  }
  if (document.querySelector('.cardUser')) {
    const cardUserSlider = new Swiper('.cardUser', {
      slidesPerView: 5,
      loop: true,
      centeredSlides: true,
      spaceBetween: 20,
      autoplay: {
        delay: 4000
      },
      navigation: {
        nextEl: '.card-user-next',
        prevEl: '.card-user-prev'
      },
      on: {
        click() {
          cardUserSlider.slideTo(this.clickedIndex)
        }
      }
    })
  }

  // newest booking slider
  if (document.querySelector('.bookingSlider')) {
    const bookingSlider = new Swiper('.bookingSlider', {
      slidesPerView: 'auto',
      loop: true,
      centeredSlides: true,
      spaceBetween: 20,
      autoplay: {
        delay: 3500
      },
      pagination: {
        el: '.booking-pagination',
        clickable: true
      },
      navigation: {
        nextEl: '.booking-next',
        prevEl: '.booking-prev'
      },
      breakpoints: {
        768: {
          slidesPerView: 2,
          spaceBetween: 12
        },
        1600: {
          slidesPerView: 3,
          spaceBetween: 20
        }
      }
    })
  }
  // booking review slider
  if (document.querySelector('.bookingReviewSwiper')) {
    const bookingReviewSwiper = new Swiper('.bookingReviewSwiper', {
      slidesPerView: 1,
      loop: true,
      centeredSlides: true,
      spaceBetween: 20,
      autoplay: {
        delay: 4500
      },
      pagination: {
        el: '.booking-review-pagination',
        clickable: true
      },
      navigation: {
        nextEl: '.booking-review-next',
        prevEl: '.booking-review-prev'
      }
    })
  }

  // tour swiper
  const tourSlides = document.querySelectorAll('.tourSwiper')
  if (tourSlides.length) {
    tourSlides.forEach((tourSlide) => {
      const basicOneSwiper = new Swiper(tourSlide, {
        slidesPerView: 1,
        loop: true,
        navigation: {
          nextEl: '.tour-next',
          prevEl: '.tour-prev'
        },
        on: {
          // Secondary pagination is update after initialization and after slide change
          init: function updSwiperNumericPagination() {
            this.el.querySelector('.tour-pagination').innerHTML = '<span class="count">' + (this.realIndex + 1) + '</span>/<span class="total">' + this.slides.length + '</span>'
          },
          slideChange: function updSwiperNumericPagination() {
            this.el.querySelector('.tour-pagination').innerHTML = '<span class="count">' + (this.realIndex + 1) + '</span>/<span class="total">' + this.slides.length + '</span>'
          }
        }
      })
    })
  }

  // showcase slider
  // newest booking slider
  if (document.querySelector('.showcaseSlider')) {
    const bookingSlider = new Swiper('.showcaseSlider', {
      slidesPerView: 'auto',
      loop: true,
      centeredSlides: true,
      spaceBetween: 20,
      autoplay: {
        delay: 5000
      },
      navigation: {
        nextEl: '.showcase-next',
        prevEl: '.showcase-prev'
      },
      breakpoints: {
        768: {
          slidesPerView: 1.8,
          spaceBetween: 24
        }
      },
      on: {
        // Secondary pagination is update after initialization and after slide change
        init: function updSwiperNumericPagination() {
          this.el.querySelector('.showcase-pagination').innerHTML = '<span class="count">' + (this.realIndex + 1) + '</span>/<span class="total">' + this.slides.length + '</span>'
        },
        slideChange: function updSwiperNumericPagination() {
          this.el.querySelector('.showcase-pagination').innerHTML = '<span class="count">' + (this.realIndex + 1) + '</span>/<span class="total">' + this.slides.length + '</span>'
        }
      }
    })
  }

  // tom select
  if (document.querySelector('.multiple-select')) {
    new TomSelect('#select-tags', {
      plugins: ['remove_button'],
      create: true,
      onItemAdd: function () {
        this.setTextboxValue('')
        this.refreshOptions()
      },
      render: {
        option: function (data, escape) {
          return '<div class="flex"><span>' + escape(data.value) + '</span><span class="ms-auto text-muted">' + escape(data.date) + '</span></div>'
        },
        item: function (data, escape) {
          return '<div>' + escape(data.value) + '</div>'
        }
      }
    })
  }

  if (document.querySelector('#tom-single')) {
    new TomSelect('#tom-single', {
      onItemAdd: function () {
        this.setTextboxValue('')
        this.refreshOptions()
      },
      render: {
        option: function (data, escape) {
          return '<div class="flex"><span>' + escape(data.value) + '</span><span class="ms-auto text-muted">' + escape(data.date) + '</span></div>'
        },
        item: function (data, escape) {
          return '<div>' + escape(data.value) + '</div>'
        }
      }
    })
  }
  if (document.querySelector('#tom-single-one')) {
    new TomSelect('#tom-single-one', {
      onItemAdd: function () {
        this.setTextboxValue('')
        this.refreshOptions()
      },
      render: {
        option: function (data, escape) {
          return '<div class="flex"><span>' + escape(data.value) + '</span><span class="ms-auto text-muted">' + escape(data.date) + '</span></div>'
        },
        item: function (data, escape) {
          return '<div>' + escape(data.value) + '</div>'
        }
      }
    })
  }
  // walktour

  const walktour = document.getElementById('walktour')
  if (walktour) {
    const tg = new tourguide.TourGuideClient({
      progressBar: '#00A76F',
      exitOnEscape: true,
      exitOnClickOutside: false,
      closeButton: true,
      showStepDots: false,
      showStepProgress: false
    })

    tg.addSteps([
      {
        title: 'Step 01',
        content: `<p class="mb-3">Awesome, you're officially registered.</p><p class="mb-3">Here's a tour of our application to get you started.</p><p class="text-xs opacity-50">Use the arrow keys or click next to continue.</p>`,
        target: '#walkHero'
      },
      {
        title: 'Step 02',
        content: `<div class="mb-3">
          <p class="mb-6">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
          <img src="./assets/images/carousel/thumb-4.png" class="rounded-xl w-full max-w-sm" alt="" />
        </div>`,
        target: '#walkProducts'
      },
      {
        title: 'Step 03',
        content: `<div class="mb-3">
          <p class="mb-6">Weekly magic on your inbox</p>
          <div class="form-input">
                    <input type="email" id="email" class="dark:!text-neutral-0" placeholder="Enter Email" />
                    <label for="email" class="dark:!text-neutral-0">Enter Email</label>
                  </div>
        </div>
        </div>`,
        target: '#walkTotalBalance'
      },
      {
        title: 'Step 04',
        content: `  <div>
        <p class="mb-6">Lorem ipsum dolor sit amet consectetur. Sed porttitor neque</p>
        <div class="p-3 sm:p-4 md:p-6 rounded-xl border border-neutral-30 dark:border-neutral-500 flex flex-col divide-y divide-neutral-30 dark:divide-neutral-500">
          <div class="flex justify-between items-center pb-4">
            <div class="flex items-center gap-2 text-neutral-700 dark:text-neutral-20">
              <i class="las la-wifi text-2xl"></i>
              <span class="m-text">Wi-Fi</span>
            </div>
            <label for="switch14" class="switch flex justify-center">
              <input id="switch14" type="checkbox" checked />
              <span class="inner primary"></span>
            </label>
          </div>
          <div class="flex justify-between items-center py-4">
            <div class="flex items-center gap-2 text-neutral-700 dark:text-neutral-20">
              <i class="lab la-bluetooth-b text-2xl"></i>
              <span class="m-text">Bluetooth</span>
            </div>
            <label for="switch1" class="switch flex justify-center">
              <input id="switch1" type="checkbox" />
              <span class="inner primary"></span>
            </label>
          </div>
          <div class="flex justify-between items-center py-4">
            <div class="flex items-center gap-2 text-neutral-700 dark:text-neutral-20">
              <i class="las la-headphones-alt text-2xl"></i>
              <span class="m-text">Airbuds</span>
            </div>
            <label for="switch2" class="switch flex justify-center">
              <input id="switch2" type="checkbox" checked />
              <span class="inner primary"></span>
            </label>
          </div>
          <div class="flex justify-between items-center pt-4">
            <div class="flex items-center gap-2 text-neutral-700 dark:text-neutral-20">
              <i class="las la-stopwatch text-2xl"></i>
              <span class="m-text">Alarm</span>
            </div>
            <label for="switch3" class="switch flex justify-center">
              <input id="switch3" type="checkbox" />
              <span class="inner primary"></span>
            </label>
          </div>
        </div>
      </div>`,
        target: '#walkYearlySales'
      },
      {
        title: 'Step 05',
        content: `<div class="mb-3">
          <p class="m-text mb-6">Lorem ipsum dolor sit amet consectetur. Sed porttitor neque</p>
          <div class="grid grid-cols-3 gap-4">
          <div class="col-span-1">
            <img src="./assets/images/carousel/basic-1.png" class="rounded-md w-" alt="" />
          </div>
          <div class="col-span-1">
            <img src="./assets/images/carousel/basic-2.png" class="rounded-md w-" alt="" />
          </div>
          <div class="col-span-1">
            <img src="./assets/images/carousel/basic-3.png" class="rounded-md w-" alt="" />
          </div>
          <div class="col-span-1">
            <img src="./assets/images/carousel/basic-4.png" class="rounded-md w-" alt="" />
          </div>
          <div class="col-span-1">
            <img src="./assets/images/carousel/basic-2.png" class="rounded-md w-" alt="" />
          </div>
          <div class="col-span-1">
            <img src="./assets/images/carousel/basic-1.png" class="rounded-md w-" alt="" />
          </div>
        </div>
        </div>`,
        target: '#walkLatestProducts',
        order: 99999999 // Enforce this as the final step
      }
    ])
    tg.start()
  }

  // otp input
  const otp_inputs = document.querySelectorAll('.otp__digit')
  if (otp_inputs) {
    const mykey = '0123456789'.split('')
    otp_inputs.forEach((_) => {
      _.addEventListener('keyup', handle_next_input)
    })
    function handle_next_input(event) {
      let current = event.target
      let index = parseInt(current.classList[1].split('__')[2])
      current.value = event.key

      if (event.keyCode == 8 && index > 1) {
        current.previousElementSibling.focus()
      }
      if (index < 6 && mykey.indexOf('' + event.key + '') != -1) {
        var next = current.nextElementSibling
        next.focus()
      }
    }
  }

  // set active menu dashboard
  const menu_items = document.querySelectorAll('.menu-link')
  if (menu_items.length > 0) {
    menu_items.forEach((link) => {
      const currentUrl = window.location.href
      // Get the href attribute of the submenu link
      const href = link.getAttribute('href')
      const cleanHref = href.replace(/^\.\.\//, '')
      // Check if the current URL matches the submenu link's href

      const url = new URL(currentUrl.html)
      const filename = url.pathname.split('https://softivuspro.com/').pop()

      if (filename == cleanHref) {
        // Add the 'active' class to the parent menu-btn
        link.classList.add('bg-primary-50', 'text-primary-300')
      }
    })
  }

  const menus = document.querySelectorAll('.menu')
  if (menus.length > 0) {
    menus.forEach((link) => {
      const currentUrl = window.location.href
      // Get the href attribute of the submenu link
      const href = link.getAttribute('href')
      const cleanHref = href.replace(/^\.\.\//, '')
      // Check if the current URL matches the submenu link's href

      const url = new URL(currentUrl.html)
      const filename = url.pathname.split('https://softivuspro.com/').pop()

      if (filename == cleanHref) {
        // Add the 'active' class to the parent menu-btn
        link.classList.add('!text-primary-300')
      }
    })
  }

  const innerMenus = document.querySelectorAll('.menu-inner')
  if (innerMenus.length > 0) {
    innerMenus.forEach((link) => {
      const currentUrl = window.location.href
      // Get the href attribute of the submenu link
      const href = link.getAttribute('href')
      const cleanHref = href.replace(/^\.\.\//, '')
      // Check if the current URL matches the submenu link's href

      const url = new URL(currentUrl.html)
      const filename = url.pathname.split('https://softivuspro.com/').pop()

      if (filename == cleanHref) {
        link.classList.add('text-primary-300')
        link.parentElement.parentElement.parentElement.parentElement.parentElement.previousElementSibling.classList.add('text-primary-300')
        // Add the 'active' class to the parent menu-btn
      }
    })
  }

  // set active menu horizontal
  const menu_items_horizontal = document.querySelectorAll('.menu-horizontal')
  if (menu_items_horizontal.length > 0) {
    menu_items_horizontal.forEach((link) => {
      const currentUrl = window.location.href
      // Get the href attribute of the submenu link
      const href = link.getAttribute('href')
      const cleanHref = href.replace(/^\.\.\//, '')

      const url = new URL(currentUrl.html)
      const filename = url.pathname.split('https://softivuspro.com/').pop()

      // Check if the current URL matches the submenu link's href
      if (filename == cleanHref) {
        // Add the 'active' class to the parent menu-btn
        link.classList.add('text-primary-300')
      }
    })
  }

  // set active submenu horizontal
  const submenuHorizontal = document.querySelectorAll('.submenu-horizontal')
  if (submenuHorizontal.length > 0) {
    submenuHorizontal.forEach((link) => {
      const currentUrl = window.location.href
      // Get the href attribute of the submenu link
      const href = link.getAttribute('href')
      const cleanHref = href.replace(/^\.\.\//, '')

      const url = new URL(currentUrl.html)
      const filename = url.pathname.split('https://softivuspro.com/').pop()
      // Check if the current URL matches the submenu link's href
      if (filename == cleanHref) {
        link.parentElement.parentElement.previousElementSibling.classList.add('text-primary-300')
        link.classList.add('text-primary-300')
      }
    })
  }
  // show current year
  const currentYearEl = document.getElementById('current-year')
  if (currentYearEl) {
    currentYearEl.innerText = new Date().getFullYear()
  }

  // show mddatepicker

  if (document.getElementById('mdtimepicker')) {
    mdtimepicker('#mdtimepicker', 'setValue', '3:00 PM')
  }
  if (document.getElementById('time12')) {
    mdtimepicker('#time12')
  }
  if (document.getElementById('time24')) {
    mdtimepicker('#time24', { is24hour: true })
  }
})()

// form validation with pristine
const validateForm = function () {
  return {
    form: undefined,
    pristine: undefined,
    init() {
      this.form = document.getElementById('signup-form')
      this.pristine = new Pristine(this.form, {
        errorTextClass: 'mt-2 text-sm text-error-300',
        errorClass: 'has-error',
        errorTextParent: 'form-group',
        successClass: 'has-success'
      })
    },
    onSubmit() {
      var valid = this.pristine.validate()
      if (valid === false) {
        console.log(this.pristine.getErrors())
      } else {
        console.log(this.form)
      }
    }
  }
}
const fileUpload = document.getElementById('file-upload')
if (fileUpload) {
  const singleDropzone = new Dropzone('#file-upload', {
    autoProcessQueue: false,
    clickable: '.clickable-file',
    maxFiles: 1,
    url: '#',
    previewTemplate: `
          <div class="dz-preview dz-file-preview flex relative justify-center bg-neutral-20 h-[300px] dark:bg-neutral-903 items-center p-3 rounded-lg border border-neutral-30 dark:border-r-neutral-500 ">
          <div class="flex flex-col items-center">
          <img class="h-[180px]" data-dz-thumbnail />  
          <div class="text-center">
          <div class="dz-filename not-italic"><span data-dz-name></span></div>
          <div class="dz-size not-italic" data-dz-size></div>
      </div>
          </div>
            <button class="text-xl size-7 absolute top-5 right-5 rounded-full flex items-center justify-center bg-neutral-40 dark:bg-neutral-100" data-dz-remove>
              <i class="las la-times"></i>
            </button>
          </div>
      `
  })
  singleDropzone.on('addedfile', function (file) {
    document.querySelector('.clickable-file').classList.add('hidden')
    if (this.files.length > 1) {
      this.removeFile(this.files[0]) // Remove extra files
    }
  })
  singleDropzone.on('removedfile', function (file) {
    document.querySelector('.clickable-file').classList.remove('hidden')
    if (this.files.length > 1) {
      this.removeFile(this.files[0]) // Remove extra files
    }
  })
}

const gallery = document.getElementById('gallery')
if (gallery) {
  const lightbox = GLightbox({
    touchNavigation: true,
    loop: true
  })
}

const videoLightbox = document.querySelector('.glightbox2')
if (videoLightbox) {
  const lightbox = GLightbox({ selector: '.glightbox2' })
}

const images = [
  {
    id: 1,
    img: './assets/images/gallery/gallery-1.png'
  },
  {
    id: 2,
    img: './assets/images/gallery/gallery-2.png'
  },
  {
    id: 3,
    img: './assets/images/gallery/gallery-3.png'
  }
]
