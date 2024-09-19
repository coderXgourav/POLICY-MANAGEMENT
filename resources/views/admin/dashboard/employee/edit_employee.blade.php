@include('admin.dashboard.header')
<style>
    .selectForm{
        width: 100%;
    border: 1px solid #434956;
    background: transparent;
    outline: none;
    border-radius: 11px;
    height: 50px;
    padding-left: 15px;
    }

    .selectForm option{
        color: black;
    }

</style>
    <!-- Main Content -->
    <main
      :class="[$store.app.sidebar && $store.app.menu=='vertical'?'w-full xl:ltr:ml-[280px] xl:rtl:mr-[280px] xl:w-[calc(100%-280px)]':'w-full',$store.app.sidebar && $store.app.menu=='hovered'?'w-full xl:ltr:ml-[80px] xl:w-[calc(100%-80px)] xl:rtl:mr-[80px]':'w-full', $store.app.menu == 'horizontal' && 'xl:!pt-[118px]', $store.app.contrast=='high'?'bg-neutral-0 dark:bg-neutral-904':'bg-neutral-20 dark:bg-neutral-903']"
      class="w-full text-neutral-700 min-h-screen dark:text-neutral-20 pt-[60px] md:pt-[66px] duration-300"
    >
    <form id="form">
      <input type="hidden" id="url" value="/admin/edit-employee">
      <input type="hidden" id="method" value="POST">
      <input type="hidden" id="btnName" value="Update Employee">
      <input type="hidden" name="id" value="{{$employee->employee_id}}">
      {{@csrf_field()}}
    
      <div :class="[$store.app.menu=='horizontal' ? 'max-w-[1704px] mx-auto xxl:px-0 xxl:pt-8':'',$store.app.stretch?'xxxl:max-w-[92%] mx-auto':'']" class="p-3 md:p-4 xxl:p-6">
        <div class="white-box">
          <h4 class="bb-dashed-n30">Add a new employee</h4>
          <div class="grid grid-cols-12 gap-4 xxl:gap-6">
           
            <div class="col-span-12 lg:col-span-10">
              <div class="n20-box">
                <div class="grid grid-cols-2 gap-4 xxl:gap-6 my-6">
                  <div class="col-span-2 md:col-span-1">
                    <div class="relative flex items-center gap-4 rounded-xl border border-neutral-40 w-full px-4 dark:border-neutral-500 lg:px-6">
                      <label for="name" class="absolute -top-2 bg-neutral-20 px-2 text-xs dark:bg-neutral-903">Full Name</label>
                      <input type="text" name="name" id="name" placeholder="Enter Name..." class="w-full s-text bg-transparent py-2.5 xl:py-3.5" required value="{{$employee->employee_name}}"/>
                    </div>
                  </div>
                  <div class="col-span-2 md:col-span-1">
                    <div class="relative flex items-center gap-4 rounded-xl border border-neutral-40 w-full px-4 dark:border-neutral-500 lg:px-6">
                      <label for="email" class="absolute -top-2 bg-neutral-20 px-2 text-xs dark:bg-neutral-903">Your Email</label>
                      <input type="email"name="email"  id="email" placeholder="Enter Email..." class="w-full s-text bg-transparent py-2.5 xl:py-3.5" required value="{{$employee->employee_email}}"/>
                    </div>
                  </div>
                  <div class="col-span-2 md:col-span-1">
                    <div class="relative flex items-center gap-4 rounded-xl border border-neutral-40 w-full px-4 dark:border-neutral-500 lg:px-6">
                      <label for="number"  class="absolute -top-2 bg-neutral-20 px-2 text-xs dark:bg-neutral-903">Your Number</label>
                      <input type="number" name="number" id="number" placeholder="Enter Number..." class="w-full s-text bg-transparent py-2.5 xl:py-3.5" required value="{{$employee->employee_number}}" />
                    </div>
                  </div>
            
                  <div class="col-span-2 md:col-span-1">
                    <div class="relative flex items-center gap-4 rounded-xl border border-neutral-40 w-full px-4 dark:border-neutral-500 lg:px-6">
                      <label for="city" class="absolute -top-2 bg-neutral-20 px-2 text-xs dark:bg-neutral-903">Password</label>
                      <input type="password" name="password" id="password"  placeholder=" Password..." class="w-full s-text bg-transparent py-2.5 xl:py-3.5" required value="{{$employee->employee_password}}" />
                    </div>
                  </div>
                  
                  <div class="col-span-2 md:col-span-1">
                    <div class="relative flex items-center gap-4 rounded-xl border border-neutral-40 w-full px-4 dark:border-neutral-500 lg:px-6">
                      <label for="zip" class="absolute -top-2 bg-neutral-20 px-2 text-xs dark:bg-neutral-903">Confirm Password</label>
                      <input type="password" id="confirm_password" name="confirm_password" placeholder="Confirm Password..." class="w-full s-text bg-transparent py-2.5 xl:py-3.5" required value="{{$employee->employee_password}}" />
                    </div>
                  </div>
                  <div class="col-span-2">
                    <div class="" class="">
                     <select name="empType" id="" class="selectForm" required>
                        <option value="">Employee Department</option>
                        @foreach($departments as $item)
                        <option @if($employee->department_id == $item->department_id) selected @endif value="{{$item->department_id}}">{{$item->department_name}} </option>
                        @endforeach
                     </select>
                    </div>
                  </div>
                  
                
               
      
                </div>
                <div class="flex gap-4 xxl:gap-6">
                  <button class="btn-primary" id="btn">Update Employee</button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </form>
    </main>
@include('admin.dashboard.footer')