<footer
:class="[$store.app.sidebar && $store.app.menu=='vertical'?'w-full xl:ltr:ml-[280px] xl:rtl:mr-[280px] xl:w-[calc(100%-280px)]':'w-full',$store.app.sidebar && $store.app.menu=='hovered'?'w-full xl:ltr:ml-[80px] xl:w-[calc(100%-80px)] xl:rtl:mr-[80px]':'w-full']"
class="footer bg-neutral-0 dark:bg-neutral-904 text-neutral-700 dark:text-neutral-20">
<div :class="$store.app.menu=='horizontal' ? 'max-w-[1704px] mx-auto':''"
  class="flex flex-col items-center justify-center gap-3 px-4 py-5 lg:flex-row lg:justify-between xxl:px-8 xxl:py-6">
  <p class="text-sm max-md:w-full max-md:text-center">
    Copyright @ <span id="current-year"></span>
    <a class="text-primary-300 font-medium" href="https://kyptronix.us">
      Kyptronix LLP </a>
    . All Rights Reserved
  </p>

  <ul
    class="flex gap-3 text-sm max-lg:w-full max-lg:justify-center lg:gap-4">
    <li>
      <a href="#" class="footer-link">Help Center</a>
    </li>
    <li>
      <a href="#" class="footer-link">Privacy Policy</a>
    </li>
  </ul>
</div>
</footer>

<!-- js libraries and custom scripts -->
<script src="{{url('assets/js/libs/quill.js')}}"></script>
<script src="{{url('assets/js/libs/dropzone.min.js')}}"></script>

<script src="{{url('assets/js/libs/apexcharts.min.js')}}"></script>
<script src="{{url('assets/js/libs/swiper-bundle.min.js')}}"></script>
<script src="{{url('assets/js/libs/alpine.collapse.js')}}"></script>
<script src="{{url('assets/js/libs/alpine.persist.js')}}"></script>
<script defer src="{{url('assets/js/libs/alpine.min.js')}}"></script>
<script src="{{url('assets/js/libs/nice-select2.js')}}"></script>
<script src="{{url('assets/js/charts.js')}}"></script>
<script src="{{url('assets/js/main.js')}}"></script>

<script src="{{url('/projectJs/jquery.js')}}"></script>
<script src="{{url('/projectJs/form_validation.js')}}"></script>
<script src="{{url('/projectJs/sweetalert.js')}}"></script>
<script src="{{url('/projectJs/form.js')}}"></script>



{{-- ADMIN FOOTER  --}}



</body>

<!-- Mirrored from softivuspro.com/html/dashhub/app.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 12 Jun 2024 07:16:32 GMT -->
</html>
