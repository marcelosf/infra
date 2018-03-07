$(document).ready(function () {

  loadBuildOptions();


  $('#home-search').click(function () {

    $('#modal').modal('close');

  });


  $('#search-submit').click(function () {

    $('#home-form').submit();

    $('#modal').modal('close');

  });


  $('#build').change(function () {

    loadSelectOptions('#build', '#floor', 'floor');

  });


  $('#floor').change(function () {

    loadSelectOptions('#floor', '#room', 'local')

  });

});

//Make a packet.

function loadSelectOptions (search, target, requestParameter) {

  requestSearch();

  let searchValue = $(search).val();

  $.get('local?search=' + search + ':' + searchValue, function (data) {

    $(target).html('<option></option>');

    for(let i = 0, len = data.data.length; i < len; i++) {

        $(target).append('<option value="' + data.data[i][requestParameter] + '">' + data.data[i][requestParameter] + '</option>');

    }

    $('select').material_select();

  });

}
//-----------------------------------
function loadBuildOptions () {

  $.get('local', function (data) {

    console.log(data);

    for(let i = 0, len = data.data.length; i < len; i++) {

      $('#build').append('<option value="' + data.data[i].build + '">' + data.data[i].build + '</option>');

    }

    $('#build').material_select();

  });

}