function ajaxForm(formItems) {
   
  var form = new FormData();
  formItems.forEach(formItem => {
    form.append(formItem[0],formItem[1]);
  });
 
  return form;
}



/**
 * 
 * @param {*} url route
 * @param {*} method POST or GET 
 * @param {*} functionsOnSuccess Array of functions that should be called after ajax
 * @param {*} form for POST request
 */
function ajax(url, method, form,exampleVariable) {
  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  })

  if (typeof form === 'undefined') {
    form = new FormData;
  }
  $.ajax({
    url: url,
    type: method,
    async: true,
    data: form,
    processData: false,
    contentType: false,
    dataType: 'json',
    error: function(xhr, textStatus, error) {
      $("#skelton").addClass('d-none');
    },
    success: function(response) {
     if(response.status == 'success')
     {
         $("#skelton").addClass('d-none');

         
     }
    }
  });
}

//for post requests only
function exampleUseOfAjaxFunction(exampleVariable) {
  $("#skelton").removeClass('d-none');
  console.log( $(exampleVariable[2]).parent().parent().parent().html());
  $(exampleVariable[2]).parent().parent().parent().hide();
  var form = ajaxForm([
    ['exampleVariable', exampleVariable],
  ]);
  
    ajax('ajax-post', 'POST', form,exampleVariable[2]);
  
}

//i have not work for get request and load more due to shortage of time =====================================
 //ajax('/connection/' + exampleVariable, 'GET', functionsOnSuccess);

