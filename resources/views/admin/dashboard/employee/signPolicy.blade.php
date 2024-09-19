@include('admin.dashboard.header')
<style>
  
  .tag-container {
            display: flex;
            flex-wrap: wrap;
            gap: 5px;
            margin-bottom: 10px;
        }
        .tag {
            background-color: #e0e0e0;
            padding: 5px 10px;
            color: black;
            border-radius: 3px;
            display: flex;
            align-items: center;
        }
        .tag-remove {
            margin-left: 5px;
            cursor: pointer;
            color: #888;
        }
        select, button {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
        }
    
     
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
<input type="hidden" id="url" value="/admin/assign-policy">
<input type="hidden" id="method" value="POST">
<input type="hidden" id="btnName" value="Assign Policy">
    {{@csrf_field()}}
      <div :class="[$store.app.menu=='horizontal' ? 'max-w-[1704px] mx-auto xxl:px-0 xxl:pt-8':'',$store.app.stretch?'xxxl:max-w-[92%] mx-auto':'']" class="p-3 md:p-4 xxl:p-6">
        <div class="white-box">
          <h4 class="bb-dashed-n30">Assign Policy to Employee</h4>
          <div class="grid grid-cols-12 gap-4 xxl:gap-6">
           
            <div class="col-span-12 lg:col-span-10">
              <div class="n20-box">
                <div class="grid grid-cols-2 gap-4 xxl:gap-6 my-6">
                  <div class="col-span-2">
                      <div class="" class="">
                    
                        <p class="l-text font-small mb-1 input-text">Choose Employee Department </p>
                       <select name="department" class="w-full s-text bg-transparent py-2.5 xl:py-3.5 selectForm1" required onchange="fetchDepartmentEmployee(this.value)">
                          <option value="">Choose Department</option>
                        @foreach ($department as $item)
                          <option  value="{{$item->department_id}}">{{$item->department_name}}</option>
                        @endforeach
                       </select>
                      </div>
                    </div>  
              </div>
                <div class="grid grid-cols-2 gap-4 xxl:gap-6 my-6">
                  <div class="col-span-2">
                    <div class="" class="">
                    <p class="l-text font-small mb-1 input-text">Select Employee to send policy </p>

                     {{-- <select  id="" class="w-full s-text bg-transparent py-2.5 xl:py-3.5 selectForm1" required>
                        <option value="">Select Employee</option>
                      <div id="employee"></div>
                     </select> --}}

                     <select name="employee" id="departmentSelect" class="w-full s-text bg-transparent py-2.5 xl:py-3.5 selectForm1" required>
                      <!-- Options will be dynamically added here -->
                      <option value="">Select Employee</option>
                     
                    </select>

                    </div>
                  </div>
                  <div class="col-span-2">
                    <div>
                        <p class="l-text font-small mb-1 input-text">Choose Policy </p>
                        <div class="tag-container" id="tagContainer"></div>
                        <select id="tagSelect" name="policy" class="tag-container w-full s-text bg-transparent py-2.5 xl:py-3.5 selectForm1">
                            <option value="">Choose privacy policy</option>
                            @foreach ($policy as $item)
                                <option value="{{$item->policy_id}}" data-policy-title="{{$item->policy_title}}">{{$item->policy_title}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                  
                </div>
                <div class="flex gap-4 xxl:gap-6">
                  <button class="btn-primary" id="btn">Assign Policy</button>
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
const tagSelect = document.getElementById('tagSelect');
const tagContainer = document.getElementById('tagContainer');
const selectedTags = new Set();

tagSelect.addEventListener('change', function() {
    const selectedOption = this.options[this.selectedIndex];
    const policyId = this.value;
    const policyTitle = selectedOption.getAttribute('data-policy-title');

    if (policyId && !selectedTags.has(policyId)) {
        addTag(policyId, policyTitle);
        selectedTags.add(policyId);
        this.value = '';
    }
});

function addTag(policyId, policyTitle) {
    const tagElement = document.createElement('div');
    tagElement.className = 'tag';
    tagElement.innerHTML = `
        ${policyTitle}
        <span class="tag-remove" onclick="removeTag('${policyId}', this)">×</span>
        <input type="hidden" name="policy_ids[]" value="${policyId}">
    `;
    tagContainer.appendChild(tagElement);
}

function removeTag(policyId, element) {
    selectedTags.delete(policyId);
    element.parentElement.remove();
}

function submitForm() {
    const policyIds = Array.from(selectedTags);
    if (policyIds.length === 0) {
        alert('Please select at least one policy before submitting.');
        return false;
    }
    
    alert('Submitting policies with IDs: ' + policyIds.join(', '));
    // Here you would typically send the data to a server
    // For demonstration, we're just showing an alert
    
    return false; // Prevent actual form submission for this example
}

</script>

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
      $('#departmentSelect').empty();
     data.forEach(item => {

     let employee_id = item.employee_id;
     let employee_name = item.employee_name;
     let employee_email = item.employee_email;
     let employee_number = item.employee_number;
     let optionElement = $('<option>').attr('value', employee_id).text(employee_name+", Email- "+ employee_email+", Phone Number- "+ employee_number);
      
     // Append the option element to the select dropdown using jQuery
     $('#departmentSelect').append(optionElement);
     });
     },error:function(){
      swal({
         title:"Technical Issue !",
         icon:"error"
      });
     }
    });
  }
</script>