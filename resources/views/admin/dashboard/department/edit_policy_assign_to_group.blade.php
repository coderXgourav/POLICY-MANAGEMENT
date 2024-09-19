{{-- @php
    echo "<pre>";
    print_r($data);
    die();
@endphp --}}

@include('admin.dashboard.header')
<style>
    .selectForm{
    outline: none;
    border-radius: 8px;
    padding-left: 8px;
    }
    .selectForm option{
      color: black;
    }

    .selectForm1{
    padding-left: 8px;
    border: 1px solid gray;
    outline: none;
    border-radius: 8px;
    }
    .selectForm1 option{
      color: black;
    }

    .outlineNone{
        outline: none;
    }
    .input-text{
      font-size: 14px;
    }
</style>
    <!-- Main Content -->
    <main
      :class="[$store.app.sidebar && $store.app.menu=='vertical'?'w-full xl:ltr:ml-[280px] xl:rtl:mr-[280px] xl:w-[calc(100%-280px)]':'w-full',$store.app.sidebar && $store.app.menu=='hovered'?'w-full xl:ltr:ml-[80px] xl:w-[calc(100%-80px)] xl:rtl:mr-[80px]':'w-full', $store.app.menu == 'horizontal' && 'xl:!pt-[118px]', $store.app.contrast=='high'?'bg-neutral-0 dark:bg-neutral-904':'bg-neutral-20 dark:bg-neutral-903']"
      class="w-full text-neutral-700 min-h-screen dark:text-neutral-20 pt-[60px] md:pt-[66px] duration-300"
    >
    <form id="form">
<input type="hidden" id="url" value="/admin/update-assign-policy-to-group">
<input type="hidden" id="method" value="POST">
<input type="hidden" name="id" value="{{$data->policy_assign_to_group_id}}">
<input type="hidden" id="btnName" value="Update Policy">
    {{@csrf_field()}}
      <div :class="[$store.app.menu=='horizontal' ? 'max-w-[1704px] mx-auto xxl:px-0 xxl:pt-8':'',$store.app.stretch?'xxxl:max-w-[92%] mx-auto':'']" class="p-3 md:p-4 xxl:p-6">
        <div class="white-box">
          <h4 class="bb-dashed-n30">Edit Assign Policy to Department</h4>
          <div class="grid grid-cols-12 gap-4 xxl:gap-6">
           
            <div class="col-span-12 lg:col-span-10">
              <div class="n20-box">
                <div class="grid grid-cols-2 gap-4 xxl:gap-6 my-6">
                  <div class="col-span-2">
                      <div class="" class="">
                        <p class="l-text font-small mb-1 input-text">Select Department </p>
                       <select name="department" class="w-full s-text bg-transparent py-2.5 xl:py-3.5 selectForm1" required onchange="fetchDepartmentEmployee(this.value)">
                          <option value="">Choose Department</option>
                        @foreach ($department as $item)
                          <option  @if($data->main_department_id==$item->department_id)selected @endif  value="{{$item->department_id}}">{{$item->department_name}}</option>
                        @endforeach
                       </select>
                      </div>
                    </div>  
              </div>
              <div class="grid grid-cols-2 gap-4 xxl:gap-6 my-6">
                <div class="col-span-2">
                    <div class="" class="">
                      <p class="l-text font-small mb-1 input-text">Select Policy </p>
                     <select name="policy" class="w-full s-text bg-transparent py-2.5 xl:py-3.5 selectForm1" required onchange="fetchDepartmentEmployee(this.value)" required>
                        <option value="">Choose Policy</option>
                      @foreach ($policy as $item)
                        <option   @if($data->main_policy_id==$item->policy_id)selected @endif  value="{{$item->policy_id}}">{{$item->policy_title}}</option>
                      @endforeach
                     </select>
                    </div>
                  </div>  
            </div>
                <div class="flex gap-4 xxl:gap-6">
                  <button class="btn-primary" id="btn">Update Policy</button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </form>
    </main>
@include('admin.dashboard.footer')

<script>
  function fetchDepartmentEmployee (id)
  {
    $.ajax({
     url:"/admin/fetch-employee",
     method:"GET",
     data:{id:id},
     dataType:"JSON",
    //  processData:false,
    //  contentType:false,
     success:function(data){
      console.log(data);

      $('#employee').html(data[0]);
 
     },error:function(){
      swal({
         title:"Technical Issue !",
         icon:"error"
      });
     }
    });
  }
</script>