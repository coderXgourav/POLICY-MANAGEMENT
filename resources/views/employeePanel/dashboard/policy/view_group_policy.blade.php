@include('employeePanel.dashboard.header')
    <!-- Main Content -->
    <main
      :class="[$store.app.sidebar && $store.app.menu=='vertical'?'w-full xl:ltr:ml-[280px] xl:rtl:mr-[280px] xl:w-[calc(100%-280px)]':'w-full',$store.app.sidebar && $store.app.menu=='hovered'?'w-full xl:ltr:ml-[80px] xl:w-[calc(100%-80px)] xl:rtl:mr-[80px]':'w-full', $store.app.menu == 'horizontal' && 'xl:!pt-[118px]', $store.app.contrast=='high'?'bg-neutral-0 dark:bg-neutral-904':'bg-neutral-20 dark:bg-neutral-903']"
      class="w-full text-neutral-700 min-h-screen dark:text-neutral-20 pt-[60px] md:pt-[66px] duration-300">
      <div
        :class="[$store.app.menu=='horizontal' ? 'max-w-[1704px] mx-auto xxl:px-0 xxl:pt-8':'',$store.app.stretch?'xxxl:max-w-[92%] mx-auto':'']"
        class="p-3 md:p-4 xxl:p-6">
        <div class="white-box">
          <div class="flex justify-between items-center bb-dashed-n30">
            <h4>Privacy Policy Lists</h4>
          </div>

          <div
            class="flex justify-between flex-wrap gap-5 items-center bb-dashed-n30">
            <form
              class="max-w-[337px] rounded-full bg-neutral-20 dark:bg-neutral-903 border border-neutral-40 dark:border-neutral-500 p-1 flex">
              <input type="text" class="px-4 py-2 w-full bg-transparent"
                placeholder="Search..." />
              <button
                class="size-10 shrink-0 rounded-full bg-primary-300 text-neutral-0 flex items-center justify-center">
                <i class="las la-search text-2xl"></i>
              </button>
            </form>
      
          </div>

          <div x-data="customizer">
      
            <div>
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
                        :class="dense? 'py-2': 'py-3 lg:py-5'">Policy Title</th>
                        <th class="px-6 duration-300"
                        :class="dense? 'py-2': 'py-3 lg:py-5'">Assigned Date</th>
                        <th class="px-6 duration-300"
                        :class="dense? 'py-2': 'py-3 lg:py-5'">View Polilcy</th>
                        <th class="px-6 duration-300"
                        :class="dense? 'py-2': 'py-3 lg:py-5'">Policy Status</th>
                    </tr>
                  </thead>
                  <tbody>
                    {{-- <template x-for="file in items"> --}}
                      @php
                          $no =1;
                      @endphp
                  
                      @foreach($policy as $value)
                      <tr
                      class="border-b border-neutral-30 duration-300 hover:bg-neutral-20 dark:border-neutral-500 dark:hover:bg-neutral-903"
                      :class="file.checked?'!bg-primary-300/10':'bg-neutral-0 dark:bg-neutral-904'">
                      <td class="px-6 w-[72px]"
                        :class="dense? 'py-1.5': 'py-3'">
                        <label for="">{{$no++}}</label>
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
                        <span class="m-text" >{{ date('d-M-Y', strtotime($value->created_at)) }}</span>
                      </td>
                      <td class="px-6" :class="dense? 'py-1.5': 'py-3'">
                       <a href="{{url('/employee/view-policy')}}/{{$value->main_policy_id}}"><button class="btn btn-warning">View Policy</button></a>
                      </td>
                      <td class="px-6" :class="dense? 'py-1.5': 'py-3'">
                        <button id="btn{{$value->main_policy_id}}" class="btn " class="btn-warning" onclick="CheckStatus({{$value->main_policy_id}})">Exam Status</button>
                        </td>
                    </tr>
                      @endforeach
                    {{-- </template> --}}
                  </tbody>
                </table>
                <div class="" style="color: black;">
                  {{$policy->links()}}
                 </div>
              </div>
            </div>

          
     
          </div>
        </div>
      </div>
    </main>

  @include('employeePanel.dashboard.footer')
  <script>

    function CheckStatus(id){
      $.ajax({
        url:"/employee/check-status",
        method:"GET",
        data:{id:id},
        dataType:"JSON",
        beforeSend:function(){
         $('#btn'+id).html('Please Wait')
        },
        success:function(data){
         $('#btn'+id).html(data.title);
         if(data.status){
          $('#btn'+id).css('background','green');
         }else{
          $('#btn'+id).css('background','red');
         }
        }
      });
    
    }
      </script>