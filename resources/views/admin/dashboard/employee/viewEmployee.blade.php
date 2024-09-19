 @include('admin.dashboard.header')
    <!-- Main Content -->
    <main
      :class="[$store.app.sidebar && $store.app.menu=='vertical'?'w-full xl:ltr:ml-[280px] xl:rtl:mr-[280px] xl:w-[calc(100%-280px)]':'w-full',$store.app.sidebar && $store.app.menu=='hovered'?'w-full xl:ltr:ml-[80px] xl:w-[calc(100%-80px)] xl:rtl:mr-[80px]':'w-full', $store.app.menu == 'horizontal' && 'xl:!pt-[118px]', $store.app.contrast=='high'?'bg-neutral-0 dark:bg-neutral-904':'bg-neutral-20 dark:bg-neutral-903']"
      class="w-full text-neutral-700 min-h-screen dark:text-neutral-20 pt-[60px] md:pt-[66px] duration-300">
      <div
        :class="[$store.app.menu=='horizontal' ? 'max-w-[1704px] mx-auto xxl:px-0 xxl:pt-8':'',$store.app.stretch?'xxxl:max-w-[92%] mx-auto':'']"
        class="p-3 md:p-4 xxl:p-6">
        <div
          x-data="{activeTab:'all', users: [
          { id: 1,  checked:false, name: 'Dianne Russell', email: 'dianne@example.com', phone: '(603)-555-0125',status: 'active', image: './assets/images/users/user-sm-1.png' },
        
        ],  
        filteredUsers: [],      
        filterUserByStatus(status){
          if(status =='all'){            
           this.filteredUsers= this.users
          } else{
            this.filteredUsers= this.users.filter(user => user.status === status)
          }         
        },
        handleSelect(e){
          const {name,checked} = e.target
          if(name=='select-all'){
            this.filteredUsers= this.filteredUsers.map(user => ({...user,checked:checked}))
          }  
          this.isAllChecked()       
        },
        isAllChecked(){
          return this.filteredUsers.every(item => item.checked==true)
        }
        
        }"
          x-init="filteredUsers=users,isAllChecked()"
          class="white-box">
          <div
            class="flex flex-wrap gap-4 justify-between items-center bb-dashed-n30">
            <h4>Employee List</h4>
            <div class="flex flex-wrap items-center gap-4">
              <form
                class="max-w-[425px] rounded-full bg-neutral-20 dark:bg-neutral-903 border border-neutral-40 dark:border-neutral-500 p-1 items-center flex">
                <input type="text"
                  class="px-4 py-1 text-sm w-full bg-transparent"
                  placeholder="Search..." />
                <button
                  class="size-8 shrink-0 rounded-full bg-primary-300 text-neutral-0 flex items-center justify-center">
                  <i class="las la-search text-xl"></i>
                </button>
              </form>
              <a href="{{url('/admin/add-employee')}}" class="btn-primary-outlined"> <i
                  class="las la-plus-circle text-sm"></i> New User</a>
            
            </div>
          </div>
       
          <div x-show="activeTab !='all'"
            class="flex flex-wrap justify-between items-center gap-3 mb-4 xl:mb-6">
            <p><span x-text="filteredUsers.length"></span> results found</p>
            <div class="flex items-center gap-4">
              <span>Status: </span>
              <div class="chip soft-default">
                <span class="icon">
                  <i class="las la-layer-group"></i>
                </span>
                <span x-text="activeTab"></span>
                <span class="icon cursor-pointer"
                  @click="activeTab='all',filterUserByStatus('all')">
                  <i class="las la-times"></i>
                </span>
              </div>
              <button
                class="flex items-center gap-2 text-error-300 font-semibold text-sm"
                @click="activeTab='all',filterUserByStatus('all')">
                <i class="las la-trash text-base"></i>
                Clear
              </button>
            </div>
          </div>
          <div x-data="{dense: false}"
            class="checkboxes-container overflow-x-auto">
            <table class="w-full whitespace-nowrap">
              <thead class="text-left">
                <tr class="bg-neutral-20 dark:bg-neutral-903">
            
                  <th class="px-6 duration-300"
                    :class="dense? 'py-2': 'py-5'">Name</th>
                  <th class="px-6 duration-300"
                    :class="dense? 'py-2': 'py-5'">Phone Number</th>
                  <th class="px-6 duration-300"
                    :class="dense? 'py-2': 'py-5'">Email</th>
                    <th class="px-6 duration-300"
                    :class="dense? 'py-2': 'py-5'">Emp. Department</th>
                  <th class="px-6 duration-300"
                    :class="dense? 'py-2': 'py-5'">Action</th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
                {{-- <template x-for="user in filteredUsers"> --}}
                  @if(count($employees)>0)
                  @foreach($employees as $value)
                  <tr
                  class="border-b border-neutral-30 hover:bg-neutral-20 dark:hover:bg-neutral-903 duration-300 dark:border-neutral-500"
                  :class="user.checked?'bg-neutral-20 dark:bg-neutral-903':'bg-neutral-0 dark:bg-neutral-904'" id="{{$value->employee_id}}">
                
                  <td class="px-6" :class="dense? 'py-2': 'py-2 lg:py-3'">
                    <div class="flex items-center gap-3">
                      <div>
                        <p class="m-text mb-1 font-medium">{{$value->employee_name}}</p>
                      </div>
                    </div>
                  </td>
                  <td class="px-6" :class="dense? 'py-2': 'py-2 lg:py-3'">
                    <span>{{$value->employee_number}}</span>
                  </td>
                  <td class="px-6" :class="dense? 'py-2': 'py-2 lg:py-3'">
                    <span>{{$value->employee_email}}</span>
                  </td>
                  <td class="px-6" :class="dense? 'py-2': 'py-2 lg:py-3'">
                    <span>{{$value->department_name}}</span>
                  </td>
                  <td class="px-6" :class="dense? 'py-2': 'py-2 lg:py-3'">
                    <a href="{{url('/admin/edit-employee')}}/{{$value->employee_id}}" class="btn btn-primary">Update</a>
                  <button type="button" class="btn btn-warning" onclick="Delete('/admin/delete-employee',{{$value->employee_id}})">Delete</button>
                  </td>
                </tr>
                  @endforeach
                 
                  @else
                  <tr>

                    <td colspan="5" style="color:red; text-align:center">Employee data not found</td>
                  </tr>
                  @endif
             
                {{-- </template> --}}
              </tbody>
            
            </table>
            {{$employees->links()}}
            <div
              class="mt-6 flex items-center gap-5 justify-center flex-col md:flex-row md:justify-between whitespace-nowrap">
              <label for="switch" class="switch flex items-center">
          
              </label>
     
            </div>
          </div>
        </div>
      </div>
    </main>

    <!-- Footer -->
    @include('admin.dashboard.footer')
