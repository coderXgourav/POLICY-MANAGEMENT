@include('employeePanel.dashboard.header')
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
          </div>
          <div class=" bb-dashed-n30" style="display: flex; align-items:center; gap:15px;">
            <div>
                <h6 class="text-success">I have carefully reviewed the {{$policy->policy_title}} privacy policy and accept all its terms and conditions.</h6>

                @if($mcq_test>0)
               <p style="margin-top: 15px; color:#63c763;">Please compleate the test and get Policy Paper.</p>
                @else 
               <p style="margin-top: 15px; color:#63c763;">Click Get policy paper to download policy paper</p>
                @endif
            </div>
            <div>
                @if($mcq_test==1)
                <a href="{{url('/employee/policy-test')}}/{{$policy->policy_id}}"><button class="btn-primary">Start Test</button></a>

                @elseif($mcq_test==0)
                <a href="{{url('/employee/get-policy')}}/{{$policy->policy_id}}"><button class="btn-primary">Get Policy Paper</button></a>
                @else  
                 <a href="{{url('/employee/get-certificate')}}/{{$policy->policy_id}}"><button class="btn-primary">Get Policy Paper</button></a>

                @endif
            </div>
          </div>
          {{-- <img src="{{url('/policy_files')}}/{{$policy->policy_file}}" alt=""> --}}
          <iframe src="{{url('/policy_files')}}/{{$policy->policy_file}}" style="width: 100%;
    height: 500px;"></iframe>
        </div>
      </div>
    </main>
  @include('employeePanel.dashboard.footer')