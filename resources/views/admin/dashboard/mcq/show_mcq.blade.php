@include('admin.dashboard.header')
<style>
    .selectForm{
    outline: none;
    border-radius: 8px;
    padding-left: 8px;
    }
    .question_palate{
      background: #1d1e24;
    padding: 20px;
    border-radius: 9px;
    }
    .primary{
      font-size: 14px !important;
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
    <form action="" method="GET">

    
      <div :class="[$store.app.menu=='horizontal' ? 'max-w-[1704px] mx-auto xxl:px-0 xxl:pt-8':'',$store.app.stretch?'xxxl:max-w-[92%] mx-auto':'']" class="p-3 md:p-4 xxl:p-6">
        <div class="white-box">
          <h4 class="bb-dashed-n30">Multiple-Choice Questions</h4>
          <div class="grid grid-cols-12 gap-4 xxl:gap-6">
           
            <div class="col-span-12 lg:col-span-10">
              <div class="n20-box">
                <div class="grid grid-cols-2 gap-4 xxl:gap-6 my-6">
                  @php
                      $no = 1;
                  @endphp
                  @foreach ($question as $item)
                  <div class="col-span-2 question_palate" style="color:white;" id="{{$item->mcq_id}}">
                    <p class="l-text font-medium mb-4" style="color: white;"> {{$no++}}. {{$item->question}} ? </p>
                  
                    <ul class="flex flex-wrap gap-4">
                      <li>
                        <div >
                          <label class="primary" for="0">(A) {{$item->option_a}}</label>
                        </div>
                      </li>
                        <li>
                        <div >
                          <label class="primary" for="1">(B) {{$item->option_b}}</label>
                        </div>
                      </li>
                      <li>
                        <div >
                          <label class="primary" for="2">(C) {{$item->option_c}}</label>
                        </div>
                      </li>
                      <li>
                        <div >
                          <label class="primary" for="3"> (D) {{$item->option_d}}</label>
                        </div>
                      </li>
                     
                    </ul>
                      <div style="margin-top:12px;">
                      <a class="btn btn-success" href="{{url('/admin/edit-mcq')}}/{{$item->mcq_id}}"> 
                        Edit
                      </a>
                      

                       <button type="button" class="btn btn-warning"  onclick="DeleteAndUpdate('/admin/delete-mcq',{{$item->mcq_id}},{{$policy_id}})">Delete</button>
                      </div>
                      </div>
                  @endforeach
                 
                </div>
                
              
              </div>
            </div>
          </div>
        </div>
      </div>
    </form>
    </main>
@include('admin.dashboard.footer')