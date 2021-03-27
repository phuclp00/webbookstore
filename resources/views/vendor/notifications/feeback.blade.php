@if(session()->has('infor_warning') )
<script>
    $.dialog({
       title: 'Opps!',
       type: 'red',
       content: "{{session()->get('infor_warning')}}",
   });
   </script>
@elseif(session()->has('infor_success'))
<script>
 $.dialog({
    title: 'Great!',
    type: 'green',
    content: "{{session()->get('infor_success')}}",
});
</script>
@endif