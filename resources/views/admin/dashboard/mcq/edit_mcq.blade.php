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
<input type="hidden" id="url" value="/admin/update-mcq">
<input type="hidden" id="method" value="POST">
<input type="hidden" name="id" value="{{$mcq->mcq_id}}">
<input type="hidden" id="btnName" value="Update Question">
    {{@csrf_field()}}
      <div :class="[$store.app.menu=='horizontal' ? 'max-w-[1704px] mx-auto xxl:px-0 xxl:pt-8':'',$store.app.stretch?'xxxl:max-w-[92%] mx-auto':'']" class="p-3 md:p-4 xxl:p-6">
        <div class="white-box">
          <h4 class="bb-dashed-n30">Update Question</h4>
          <div class="grid grid-cols-12 gap-4 xxl:gap-6">
           
            <div class="col-span-12 lg:col-span-10">
              <div class="n20-box">
                <div class="grid grid-cols-2 gap-4 xxl:gap-6 my-6">
                    <div class="col-span-2">
                        <div class="" class="">
                         <select name="policy" id="" class="w-full s-text bg-transparent py-2.5 xl:py-3.5 selectForm1" required>
                            <option value="">Choose privacy policy</option>
                          @foreach ($policy as $item)
                            <option @if($mcq->main_policy_id==$item->policy_id)selected @endif value="{{$item->policy_id}}">{{$item->policy_title}}</option>
                          @endforeach
                         </select>
                        </div>
                      </div>
                      <div class="col-span-2">
                    <div class="relative flex items-center gap-4 rounded-xl border border-neutral-40 w-full px-4 dark:border-neutral-500 lg:px-12">
                      <label for="name" class="absolute -top-2 bg-neutral-20 px-2 text-xs dark:bg-neutral-903">Question</label>
                      <input type="text" name="question" id="name" placeholder="Type Question Here..." value="{{$mcq->question}}" class="w-full s-text bg-transparent py-2.5 xl:py-3.5" required />
                    </div>
                  </div>
                  <div class="col-span-2 md:col-span-1">
                    <div class="relative flex items-center gap-4 rounded-xl border border-neutral-40 w-full px-4 dark:border-neutral-500 lg:px-6">
                      <label for="email" class="absolute -top-2 bg-neutral-20 px-2 text-xs dark:bg-neutral-903"> Option A</label>
                      <input type="text"name="option_a"  id="text" placeholder="Option A answer..." value="{{$mcq->option_a}}" class="w-full s-text bg-transparent py-2.5 xl:py-3.5" required />
                    </div>
                  </div>
                  <div class="col-span-2 md:col-span-1">
                    <div class="relative flex items-center gap-4 rounded-xl border border-neutral-40 w-full px-4 dark:border-neutral-500 lg:px-6">
                      <label for="number"  class="absolute -top-2 bg-neutral-20 px-2 text-xs dark:bg-neutral-903">Option B</label>
                      <input type="text" name="option_b" id="number" placeholder="Option B answer..." value="{{$mcq->option_b}}" class="w-full s-text bg-transparent py-2.5 xl:py-3.5" required/>
                    </div>
                  </div>
                  <div class="col-span-2 md:col-span-1">
                    <div class="relative flex items-center gap-4 rounded-xl border border-neutral-40 w-full px-4 dark:border-neutral-500 lg:px-6">
                      <label for="state" class="absolute -top-2 bg-neutral-20 px-2 text-xs dark:bg-neutral-903">Option C</label>
                      <input type="text" name="option_c" id="state" placeholder="Option C answer..." value="{{$mcq->option_c}}" class="w-full s-text bg-transparent py-2.5 xl:py-3.5" required />
                    </div>
                  </div>
                  <div class="col-span-2 md:col-span-1">
                    <div class="relative flex items-center gap-4 rounded-xl border border-neutral-40 w-full px-4 dark:border-neutral-500 lg:px-6">
                      <label for="city" class="absolute -top-2 bg-neutral-20 px-2 text-xs dark:bg-neutral-903">Option D</label>
                      <input type="text" name="option_d" id="city" placeholder="Option D answer..." value="{{$mcq->option_d}}" class="w-full s-text bg-transparent py-2.5 xl:py-3.5" required/>
                    </div>
                  </div>
                  
                  <div class="col-span-2 md:col-span-1">
                    <div class="relative flex items-center gap-4 rounded-xl border border-neutral-40 w-full px-4 dark:border-neutral-500 lg:px-6">
                      <label for="zip" class="absolute -top-2 bg-neutral-20 px-2 text-xs dark:bg-neutral-903">Choose Correct Answer</label>
                    <select name="ans_option" id="" class="w-full s-text bg-transparent py-2.5 xl:py-3.5 selectForm" required>
                        <option value="">Choose Correct Answer</option>
                        <option value="A" @if($mcq->ans==$mcq->option_a) selected @endif>Option A</option>
                        <option value="B" @if($mcq->ans==$mcq->option_b) selected @endif>Option B</option>
                        <option value="C" @if($mcq->ans==$mcq->option_c) selected @endif>Option C</option>
                        <option value="D" @if($mcq->ans==$mcq->option_d) selected @endif>Option D</option>
                    </select>
                    </div>
                  </div>
                 
                  
                
               
      
                </div>
                <div class="flex gap-4 xxl:gap-6">
                  <button class="btn-primary" id="btn">Update Question</button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </form>
    </main>
@include('admin.dashboard.footer')