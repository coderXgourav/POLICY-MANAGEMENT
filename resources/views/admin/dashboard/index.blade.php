@include('admin.dashboard.header')




    <!-- Main Content -->
    <main
      :class="[$store.app.sidebar && $store.app.menu=='vertical'?'w-full xl:ltr:ml-[280px] xl:rtl:mr-[280px] xl:w-[calc(100%-280px)]':'w-full',$store.app.sidebar && $store.app.menu=='hovered'?'w-full xl:ltr:ml-[80px] xl:w-[calc(100%-80px)] xl:rtl:mr-[80px]':'w-full', $store.app.menu == 'horizontal' && 'xl:!pt-[118px]', $store.app.contrast=='high'?'bg-neutral-0 dark:bg-neutral-904':'bg-neutral-20 dark:bg-neutral-903']"
      class="w-full text-neutral-700 min-h-screen dark:text-neutral-20 pt-[60px] md:pt-[66px] duration-300">
      <div
        :class="[$store.app.menu=='horizontal' ? 'max-w-[1704px] mx-auto xxl:px-0 xxl:pt-8':'',$store.app.stretch?'xxxl:max-w-[92%] mx-auto':'']"
        class="p-3 md:p-4 xxl:p-6">
        <div x-data="chart" class="grid grid-cols-12 gap-4 xxl:gap-6">
          <!-- statistics -->
          <div class="col-span-12 grid grid-cols-12 gap-4 lg:gap-6">
            <div class="col-span-12 sm:col-span-6 xxxl:col-span-4">
              <div class="white-box">
                <p
                  class="m-text mb-4 pb-4 border-b border-dashed border-primary-75 font-medium">Total
                   Employee</p>
                <div class="flex justify-between gap-1">
                  <div>
                    <h4 class="mb-3">{{$total_employee}}</h4>
                    <div class="flex items-center gap-3">
                      <div class="flex items-center gap-2">
                        <span
                          class="flex items-center justify-center size-6 rounded-full bg-primary-50 dark:bg-neutral-903 text-primary-300"><i
                            class="las la-arrow-up"></i></span><span
                          class="m-text font-medium"><a href="{{url('/admin/view-employee')}}">View Employee</a></span>
                      </div>
                     
                    </div>
                  </div>
                  <div class="product-chart"></div>
                </div>
              </div>
            </div>
            <div class="col-span-12 sm:col-span-6 xxxl:col-span-4">
              <div class="white-box">
                <p
                  class="m-text mb-4 pb-4 border-b border-dashed border-primary-75 font-medium">Total Policy </p>
                <div class="flex justify-between gap-1">
                  <div>
                    <h4 class="mb-3">{{$total_policy}}</h4>
                    <div class="flex items-center gap-3">
                      <div class="flex items-center gap-2">
                        <span
                          class="flex items-center justify-center size-6 rounded-full bg-primary-50 dark:bg-neutral-903 text-primary-300"><i
                            class="las la-arrow-up"></i></span><span
                          class="m-text font-medium"><a href="{{url('/admin/view-policy')}}">View Policy</a></span>
                      </div>
                 
                    </div>
                  </div>
                  <div class="product-chart"></div>
                </div>
              </div>
            </div>
            <div class="col-span-12 sm:col-span-6 xxxl:col-span-4">
              <div class="white-box">
                <p
                  class="m-text mb-4 pb-4 border-b border-dashed border-primary-75 font-medium">Total Assigned Policy </p>
                <div class="flex justify-between gap-1">
                  <div>
                    <h4 class="mb-3">{{$total_assign}}</h4>
                    <div class="flex items-center gap-3">
                      <div class="flex items-center gap-2">
                        <span
                          class="flex items-center justify-center size-6 rounded-full bg-primary-50 dark:bg-neutral-903 text-primary-300"><i
                            class="las la-arrow-up"></i></span><span
                          class="m-text font-medium"><a href="{{url('/admin/view-assign-policy')}}">View Assign Policy</a></span>
                      </div>
                    
                    </div>
                  </div>
                  <div class="product-chart"></div>
                </div>
              </div>
            </div>
            <div class="col-span-12 sm:col-span-6 xxxl:col-span-4">
              <div class="white-box">
                <p
                  class="m-text mb-4 pb-4 border-b border-dashed border-primary-75 font-medium">
                   Employee Show Policy  </p>
                <div class="flex justify-between gap-1">
                  <div>
                    <h4 class="mb-3">{{$done_policy}}</h4>
                    <div class="flex items-center gap-3">
                      <div class="flex items-center gap-2">
                        <span
                          class="flex items-center justify-center size-6 rounded-full bg-primary-50 dark:bg-neutral-903 text-primary-300"><i
                            class="las la-arrow-up"></i></span><span
                          class="m-text font-medium"><a href="{{url('/admin/policy-visibility')}}">View Reports</a></span>
                      </div>
                    
                    </div>
                  </div>
                  <div class="product-chart"></div>
                </div>
              </div>
            </div>
           
          </div>
          <!-- Yearly Sales -->

        </div>
      </div>
    </main>

    <!-- Footer -->
  @include('admin.dashboard.footer')