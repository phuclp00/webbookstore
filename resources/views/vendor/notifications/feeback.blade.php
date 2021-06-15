@if(session()->has('infor_warning') )
<script>
    $.dialog({
       title: 'Opps!',
       type: 'red',
       content: {!! json_encode(session()->get('infor_warning')) !!},
   });
</script>
@elseif(session()->has('infor_success'))
<script>
    $.dialog({
    title: 'Great!',
    type: 'green',
    content: {!! json_encode(session()->get('infor_success')) !!},
});
</script>
@elseif(session()->has('infor_mess'))
<script>
    $.dialog({
    title: 'Messenge!',
    type: 'purple',
    content: {!! json_encode(session()->get('infor_mess')) !!},
});
</script>
@endif