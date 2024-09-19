@include('admin.dashboard.header')
    <!-- Main Content -->
    <main
      :class="[$store.app.sidebar && $store.app.menu=='vertical'?'w-full xl:ltr:ml-[280px] xl:rtl:mr-[280px] xl:w-[calc(100%-280px)]':'w-full',$store.app.sidebar && $store.app.menu=='hovered'?'w-full xl:ltr:ml-[80px] xl:w-[calc(100%-80px)] xl:rtl:mr-[80px]':'w-full', $store.app.menu == 'horizontal' && 'xl:!pt-[118px]', $store.app.contrast=='high'?'bg-neutral-0 dark:bg-neutral-904':'bg-neutral-20 dark:bg-neutral-903']"
      class="w-full text-neutral-700 min-h-screen dark:text-neutral-20 pt-[60px] md:pt-[66px] duration-300">
      <div
        :class="[$store.app.menu=='horizontal' ? 'max-w-[1704px] mx-auto xxl:px-0 xxl:pt-8':'',$store.app.stretch?'xxxl:max-w-[92%] mx-auto':'']"
        class="p-3 md:p-4 xxl:p-6">
        <div x-data="{activeTab:'list'}" class="white-box">
          <div x-data="customizer">
      
            <div x-show="activeTab=='list'">
              <div
                x-data="{dense: false, items: [
                {
                  id:1,
                  title:'Docs',
                  type:'folder',
                  size:'Lorem ipsum',
                  date:'17 Feb 2024',
                  time:'12:30 PM',
                  shared:['./{{url('assets/images/avatar/avatar-1.png')}}','./{{url('assets/images/avatar/avatar-3.png')}}','./{{url('assets/images/avatar/avatar-4.png')}}'],
                  checked:false
                },
                
              ],     handleSelect(e){
          const {name,checked} = e.target
          if(name=='select-all'){
            this.items= this.items.map(file => ({...file,checked:checked}))
          }  
          this.isAllChecked()       
        },
        isAllChecked(){
          return this.items.every(item => item.checked==true)
        } } "
                class="overflow-x-auto">
                <table class="w-full whitespace-nowrap">
                  <thead class="text-left">
                    <tr class="bg-neutral-20 dark:bg-neutral-903">
                      <th class="px-6 w-[72px] duration-300"
                        :class="dense? 'py-2': 'py-3 lg:py-5'">
                        <label for="checkbox2" class="option">
                         No
                        </label>
                      </th>
                      <th class="px-6 duration-300"
                        :class="dense? 'py-2': 'py-3 lg:py-5'">Employee Name</th>
                      <th class="px-6 duration-300"
                        :class="dense? 'py-2': 'py-3 lg:py-5'">Department</th>
                        <th class="px-6 duration-300"
                        :class="dense? 'py-2': 'py-3 lg:py-5'">Policy Title</th>
                        <th class="px-6 duration-300"
                        :class="dense? 'py-2': 'py-3 lg:py-5'">Status</th>
                    </tr>
                  </thead>
                  <tbody>
                    {{-- <template x-for="file in items"> --}}
                      @php
                          $no =1;
                      @endphp
                      @if(count($policy)>0)
                      @foreach($policy as $value)
                      <tr
                      class="border-b border-neutral-30 duration-300 hover:bg-neutral-20 dark:border-neutral-500 dark:hover:bg-neutral-903"
                      :class="file.checked?'!bg-primary-300/10':'bg-neutral-0 dark:bg-neutral-904'">
                      <td class="px-6 w-[72px]"
                        :class="dense? 'py-1.5': 'py-3'">
                        <label for="">{{$no++}}</label>
                      </td>
                      <td class="px-6" :class="dense? 'py-2': 'py-2 lg:py-3'">
                        <span>{{$value->employee_name}}</span>
                      </td>
                      <td class="px-6" :class="dense? 'py-2': 'py-2 lg:py-3'">
                        <span>{{$value->department_name}}</span>
                      </td>
                      <td class="px-6" :class="dense? 'py-1.5': 'py-3'"
                        @click="openCustomizer">
                        <div class="flex items-center gap-3">
                          <i  :class="file.icon"
                            class="text-2xl"></i>
                          <img  
                            src="{{url('assets/images/folder.png')}}" width="24"
                            height="24" alt />
                            <span>{{$value->policy_title}}</span>
                        </div>
                      </td>
                     
                     
                      <td class="px-6" :class="dense? 'py-1.5': 'py-3'">
                      @if($value->status==0)
                      <button class="btn btn-warning">Policy Not View </button>
                      @elseif($value->status==1)
                      <button class="btn btn-warning">Policy Read </button>
                      @else 
                      <button class="btn btn-success">Successfull</button>

                      @endif
                      </td>
                     
         
                    </tr>
                      @endforeach
      @else 
      <tr>
        <td colspan="4"> Empty Policy Files.</td>
      </tr>
                      @endif 
                  

                    {{-- </template> --}}
                  </tbody>
                </table>
                <div style="color:black">
                  {{$policy->links()}}
                 </div>
              </div>
            </div>

          
     
          </div>
        </div>
      </div>
    </main>

  @include('admin.dashboard.footer')