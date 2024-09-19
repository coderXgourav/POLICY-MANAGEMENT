

@include('employeePanel.dashboard.header')

<link rel="stylesheet" href="{{url('assets/signature/signature1.css')}}">
<link rel="stylesheet" href="{{url('assets/signature/signature.css')}}">

<style>
  .error{
    color: red;
  }
    .kbw-signature { 
      width: 400px; 
      height: 200px;
    }
    #sig canvas{
        /* width: 100% !important; */
        height: 200px;
    }
</style>

    <!-- Main Content -->
    <main
      :class="[$store.app.sidebar && $store.app.menu=='vertical'?'w-full xl:ltr:ml-[280px] xl:rtl:mr-[280px] xl:w-[calc(100%-280px)]':'w-full',$store.app.sidebar && $store.app.menu=='hovered'?'w-full xl:ltr:ml-[80px] xl:w-[calc(100%-80px)] xl:rtl:mr-[80px]':'w-full', $store.app.menu == 'horizontal' && 'xl:!pt-[118px]', $store.app.contrast=='high'?'bg-neutral-0 dark:bg-neutral-904':'bg-neutral-20 dark:bg-neutral-903']"
      class="w-full text-neutral-700 min-h-screen dark:text-neutral-20 pt-[60px] md:pt-[66px] duration-300">
      <div
        :class="[$store.app.menu=='horizontal' ? 'max-w-[1704px] mx-auto xxl:px-0 xxl:pt-8':'',$store.app.stretch?'xxxl:max-w-[92%] mx-auto':'']"
        class="p-3 md:p-4 xxl:p-6">
        <div x-data="{activeTab:'list'}" class="white-box">
          <div class="flex justify-between items-center bb-dashed-n30">
            <h4>Download Policy Certificate</h4>
          </div>
         
         
        <form id="uploadSignature">
<input type="hidden" name="policy_id" value="{{$policy->policy_id}}">
          <h6 class="text-success" for="checkbox">

            <input type="checkbox" name="check"  required/>  I acknowledge that I have received and reviewed the {{$policy->policy_title}} . I understand the contents of the policy and agree to comply with its requirements and guidelines.
              
             </h6>
             <div class=" bb-dashed-n30" style="display: flex; align-items:center; gap:15px;">
            </div>
          <input type="hidden" id="url" value="/employee/submit-signature">
          <input type="hidden" id="method" value="POST">
          <input type="hidden" id="btnName" value="Save">
          <input type="hidden" name="policy_id" id="" value="{{$policy->policy_id}}">
          {{@csrf_field()}}
          @csrf
          <div class="col-md-12">
              <label class="" for="">Signature</label> <br>
              <br/>
              <div id="sig"></div>
              <br/>
              <textarea id="signature64" name="signed" style="display:none;"></textarea>
          </div>
          <br/>
          <button id="clear" class="btn btn-danger btn-sm">Clear Signature</button>

          <button id="btn" class="btn btn-primary">Save</button> 
      </form>
          {{-- <iframe src="{{url('/policy_files')}}/{{$policy->policy_file}}" style="width: 100%;
    height: 1000px;"></iframe> --}}
    <div>
      <br>
      <form action="{{url('/employee/certificate')}}" method="GET">
        <input type="hidden" name="policy_id" id="policy" value="">
        <button style="display:none;" type="submit" id="download" class="btn-primary" >Download Certificate</button>
      </form>
  </div>
        </div>

      </div>
    </main>

  @include('employeePanel.dashboard.footer')
  
<script src="{{url('assets/signature/sig1.js')}}"></script>
<script src="{{url('assets/signature/sig2.js')}}"></script>
<script src="{{url('assets/signature/sig3.js')}}"></script>

    <script type="text/javascript">
    var sig = $('#sig').signature({syncField: '#signature64', syncFormat: 'PNG'});
    $('#sig').val(sig);
    $('#clear').click(function(e) {
        e.preventDefault();
        sig.signature('clear');
        $("#signature64").val('');
    });
  </script>