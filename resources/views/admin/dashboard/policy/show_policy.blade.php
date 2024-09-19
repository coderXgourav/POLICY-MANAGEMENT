@include('admin.dashboard.header')
    <!-- Main Content -->
    <main
      :class="[$store.app.sidebar && $store.app.menu=='vertical'?'w-full xl:ltr:ml-[280px] xl:rtl:mr-[280px] xl:w-[calc(100%-280px)]':'w-full',$store.app.sidebar && $store.app.menu=='hovered'?'w-full xl:ltr:ml-[80px] xl:w-[calc(100%-80px)] xl:rtl:mr-[80px]':'w-full', $store.app.menu == 'horizontal' && 'xl:!pt-[118px]', $store.app.contrast=='high'?'bg-neutral-0 dark:bg-neutral-904':'bg-neutral-20 dark:bg-neutral-903']"
      class="w-full text-neutral-700 min-h-screen dark:text-neutral-20 pt-[60px] md:pt-[66px] duration-300">
      <div
        :class="[$store.app.menu=='horizontal' ? 'max-w-[1704px] mx-auto xxl:px-0 xxl:pt-8':'',$store.app.stretch?'xxxl:max-w-[92%] mx-auto':'']"
        class="p-3 md:p-4 xxl:p-6">
        <div x-data="{activeTab:'list'}" class="white-box">
          <div class="flex justify-between items-center bb-dashed-n30">
            <h4>Policy View</h4>
            <a href="{{url('/admin/view-policy')}}"><button class="btn-primary-outlined">
               Policy List</button></a>
          </div>
        
          {{-- <img src="{{url('/policy_files')}}/{{$policy->policy_file}}" alt=""> --}}
          <iframe src="{{url('/policy_files')}}/{{$policy->policy_file}}" style="width: 100%;
    height: 1000px;"></iframe>
        </div>
      </div>
    </main>

  @include('admin.dashboard.footer')