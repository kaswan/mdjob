<?php echo $this->Form->input('search_name', array('id' => name))?>
<script>
$('#name').keypress(function(e){
    if(e.keyCode==13) {
      $(e.target).trigger('change');
      return false;
    }
  }); 
  
  $('#name').change(function(e){
    $('#incremental').load('/mdjobs/institutions/search', 'name='+encodeURIComponent($('#name').val()) );
  });
</script>