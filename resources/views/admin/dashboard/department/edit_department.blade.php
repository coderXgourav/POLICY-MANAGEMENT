@include('admin.dashboard.header')

    <!-- Main Content -->
    <main
      :class="[$store.app.sidebar && $store.app.menu=='vertical'?'w-full xl:ltr:ml-[280px] xl:rtl:mr-[280px] xl:w-[calc(100%-280px)]':'w-full',$store.app.sidebar && $store.app.menu=='hovered'?'w-full xl:ltr:ml-[80px] xl:w-[calc(100%-80px)] xl:rtl:mr-[80px]':'w-full', $store.app.menu == 'horizontal' && 'xl:!pt-[118px]', $store.app.contrast=='high'?'bg-neutral-0 dark:bg-neutral-904':'bg-neutral-20 dark:bg-neutral-903']"
      class="w-full text-neutral-700 min-h-screen dark:text-neutral-20 pt-[60px] md:pt-[66px] duration-300"
    >
      <div :class="[$store.app.menu=='horizontal' ? 'max-w-[1704px] mx-auto xxl:px-0 xxl:pt-8':'',$store.app.stretch?'xxxl:max-w-[92%] mx-auto':'']" class="p-3 md:p-4 xxl:p-6">
        <div class="white-box">
          <h4 class="bb-dashed-n30">Edit Department</h4>
          <div class="flex flex-col gap-4 xxl:gap-6">
            <form  id="form" class="single-file">
              <input type="hidden" id="url" value="/admin/edit-department">
              <input type="hidden" id="method" value="POST">
              <input type="hidden" id="btnName" value="Update Department">
              <input type="hidden" name="department_id" value="{{$department->department_id}}">
              {{@csrf_field()}}
            <div>
              <div class="form-input mb-4 xl:mb-6">
                <input type="text" name="department_name" value="{{$department->department_name}}" id="post_name" placeholder="Department Name" required/>
                <label for="post_name">Department Name</label>
              </div>
            
              </div> 
              
              <br>
            <div class="col-span-2 flex gap-4">
              <button type="submit" id="btn" class="btn-primary">Update Department</button>
            </div>
          </form>

          </div>
        </div>
      </div>
    </main>

   @include('admin.dashboard.footer')
   