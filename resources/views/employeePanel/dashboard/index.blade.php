@include('employeePanel.dashboard.header')




    <!-- Main Content -->
    <main
      :class="[$store.app.sidebar && $store.app.menu=='vertical'?'w-full xl:ltr:ml-[280px] xl:rtl:mr-[280px] xl:w-[calc(100%-280px)]':'w-full',$store.app.sidebar && $store.app.menu=='hovered'?'w-full xl:ltr:ml-[80px] xl:w-[calc(100%-80px)] xl:rtl:mr-[80px]':'w-full', $store.app.menu == 'horizontal' && 'xl:!pt-[118px]', $store.app.contrast=='high'?'bg-neutral-0 dark:bg-neutral-904':'bg-neutral-20 dark:bg-neutral-903']"
      class="w-full text-neutral-700 min-h-screen dark:text-neutral-20 pt-[60px] md:pt-[66px] duration-300">
      <div
        :class="[$store.app.menu=='horizontal' ? 'max-w-[1704px] mx-auto xxl:px-0 xxl:pt-8':'',$store.app.stretch?'xxxl:max-w-[92%] mx-auto':'']"
        class="p-3 md:p-4 xxl:p-6">
        <div x-data="chart" class="grid grid-cols-12 gap-4 xxl:gap-6">
          <div
            class="col-span-12 md:col-span-7 xxl:col-span-8 rounded-xl overflow-hidden p-6 xxl:py-[45px] xxl:pl-14 bg-cover flex items-center flex-wrap sm:flex-nowrap bg-success-300/10 relative"
            style="background-image: url({{url('assets/images/walktour-hero-bg.png')}})">
            <div
              class="size-[192px] rounded-full opacity-30 blur-[100px] bg-warning-300 absolute -bottom-10 -right-10"></div>
            <div class="min-w-[60%]">
              <h2 class="mb-3 xxl:mb-6 leading-tight">Welcome {{$employee->employee_name}} </h2>
              <p class="mb-6 xl:mb-8">Please take a moment to review both your assigned policy and the department policy. Thank You !</p>
             
              <a href="{{url('/employee/view-policy')}}" class="btn-primary">View Assigned Policy</a>
            </div>
            <img src="{{url('assets/images/walktour-hero.png')}}" alt />
          </div>
          <!-- products slider -->

          <!-- statistics -->
    
          <!-- Yearly Sales -->

        </div>
      </div>
    </main>

    <!-- Footer -->
  @include('employeePanel.dashboard.footer')