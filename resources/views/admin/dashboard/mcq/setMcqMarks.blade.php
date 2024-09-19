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
</style>
    <!-- Main Content -->
    <main
      :class="[$store.app.sidebar && $store.app.menu=='vertical'?'w-full xl:ltr:ml-[280px] xl:rtl:mr-[280px] xl:w-[calc(100%-280px)]':'w-full',$store.app.sidebar && $store.app.menu=='hovered'?'w-full xl:ltr:ml-[80px] xl:w-[calc(100%-80px)] xl:rtl:mr-[80px]':'w-full', $store.app.menu == 'horizontal' && 'xl:!pt-[118px]', $store.app.contrast=='high'?'bg-neutral-0 dark:bg-neutral-904':'bg-neutral-20 dark:bg-neutral-903']"
      class="w-full text-neutral-700 min-h-screen dark:text-neutral-20 pt-[60px] md:pt-[66px] duration-300"
    >
    <form id="form">
      <input type="hidden" id="url" value="/admin/set-marks">
      <input type="hidden" id="method" value="POST">
      <input type="hidden" id="btnName" value="Submit">
      {{@csrf_field()}}

    
      <div :class="[$store.app.menu=='horizontal' ? 'max-w-[1704px] mx-auto xxl:px-0 xxl:pt-8':'',$store.app.stretch?'xxxl:max-w-[92%] mx-auto':'']" class="p-3 md:p-4 xxl:p-6">
        <div class="white-box">
          <h4 class="bb-dashed-n30">Set Pass   Marks</h4>
          <div class="grid grid-cols-12 gap-4 xxl:gap-6">
           
            <div class="col-span-12 lg:col-span-10">
              <div class="n20-box">
                <div class="grid grid-cols-2 gap-4 xxl:gap-6 my-6">
                    <div class="col-span-2">
                        <div class="" class="">
                            {{-- <label for="" class="text-sm">Select Policy</label> --}}
                         <select name="policy" id="" class="w-full s-text bg-transparent py-2.5 xl:py-3.5 selectForm1" required onchange="showNoOfQuestion(this.value)">
                            <option value="">Choose privacy policy</option>
                           @foreach ($policy as $item)
                            <option value="{{$item->policy_id}}">{{$item->policy_title}}</option>
                           @endforeach
                         </select>
                        </div>
                      </div>
                   <div style="display: flex; gap:20px;">
                       <div  class="col-span-2" style="width: 50%">
                    <div class="relative flex items-center gap-4 rounded-xl border border-neutral-40 w-full px-4 dark:border-neutral-500 lg:px-12">
                      <label for="name" class="absolute -top-2 bg-neutral-20 px-2 text-xs dark:bg-neutral-903">Total Question </label>
                      <input type="number" name="pass_marrk" id="question_no" placeholder="Total Question" class="w-full s-text bg-transparent py-2.5 xl:py-3.5" disabled />
                    </div>
                  </div>
                  <div class="col-span-2" style="width: 50%"  >
                    <div class="relative flex items-center gap-4 rounded-xl border border-neutral-40 w-full px-4 dark:border-neutral-500 lg:px-12">
                      <label for="name" class="absolute -top-2 bg-neutral-20 px-2 text-xs dark:bg-neutral-903">Passing Marks </label>
                      <input type="number" name="pass_marrk" id="pass_marrk" placeholder="Correct answer to pass" class="w-full s-text bg-transparent py-2.5 xl:py-3.5" required min="1"  />
                    </div>
                  </div>
                   </div>
      
                </div>
                <div class="flex gap-4 xxl:gap-6">
                  <button class="btn-primary" id="btn">Submit</button>
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
  function showNoOfQuestion (id)
  {
    $.ajax({
     url:"/admin/fetch-no-of-question",
     method:"GET",
     data:{id:id},
     dataType:"JSON",
    //  processData:false,
    //  contentType:false,
     success:function(data){
  $('#question_no').val(data.question_no);
  $('#pass_marrk').attr('max',data.question_no);
     },error:function(){
      swal({
         title:"Technical Issue !",
         icon:"error"
      });
     }
    });
  }
</script>