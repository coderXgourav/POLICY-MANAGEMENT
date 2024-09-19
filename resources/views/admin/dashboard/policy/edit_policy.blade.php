@include('admin.dashboard.header')

    <!-- Main Content -->
    <main
      :class="[$store.app.sidebar && $store.app.menu=='vertical'?'w-full xl:ltr:ml-[280px] xl:rtl:mr-[280px] xl:w-[calc(100%-280px)]':'w-full',$store.app.sidebar && $store.app.menu=='hovered'?'w-full xl:ltr:ml-[80px] xl:w-[calc(100%-80px)] xl:rtl:mr-[80px]':'w-full', $store.app.menu == 'horizontal' && 'xl:!pt-[118px]', $store.app.contrast=='high'?'bg-neutral-0 dark:bg-neutral-904':'bg-neutral-20 dark:bg-neutral-903']"
      class="w-full text-neutral-700 min-h-screen dark:text-neutral-20 pt-[60px] md:pt-[66px] duration-300"
    >
      <div :class="[$store.app.menu=='horizontal' ? 'max-w-[1704px] mx-auto xxl:px-0 xxl:pt-8':'',$store.app.stretch?'xxxl:max-w-[92%] mx-auto':'']" class="p-3 md:p-4 xxl:p-6">
        <div class="white-box">
          <h4 class="bb-dashed-n30">Update Policy</h4>
          <div class="flex flex-col gap-4 xxl:gap-6">
            <form  id="form" class="single-file">
              <input type="hidden" id="url" value="/admin/update-policy">
              <input type="hidden" name="id" value="{{$policy->policy_id}}">
              <input type="hidden" id="method" value="POST">
              <input type="hidden" id="btnName" value="Update Policy">
              {{@csrf_field()}}
            <div>
              <div class="form-input mb-4 xl:mb-6">
                <input type="text" name="policy_title" id="post_name" placeholder="Policy Title" required value="{{$policy->policy_title}}" />
                <label for="post_name">Policy Title</label>
              </div>
              <p class="l-text font-medium mb-4">Policy File</p>
              <input type="file" name="policy_file"  style="    width: 100%;
    border: 1px solid #434956;
    padding: 15px;
    border-radius: 12px;">
    <p style="padding-left: 10px; margin-top:10px;">If no new file is selected, the previous file remains displayed.






    </p>
                {{-- <div class="flex flex-col items-center text-center clickable-single cursor-pointer n20-box lg:p-10 xl:p-[60px]">
                  <img src="{{url('assets/images/single-file.png')}}" class="mb-6 lg:mb-10" alt="" />
                  <h5 class="font-semibold mb-4">Drop or Select file</h5>
                  <p>Drop files here or click <span class="text-primary-300">Browse</span> through your machine</p>
                </div> --}}
              </div> 
              
              <br>
            <div class="col-span-2 flex gap-4">
              <button type="submit" id="btn" class="btn-primary">Update Policy </button>
            </div>
          </form>

          </div>
        </div>
      </div>
    </main>

   @include('admin.dashboard.footer')
   