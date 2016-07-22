</div>
</body>
<script type="text/javascript" src="bower_components/jquery/dist/jquery.js"></script>
<script type="text/javascript" src="bower_components/bootstrap/dist/js/bootstrap.js"></script>
<script>

$(document).ready(function(){
    $('.sideToggle').on('click', function(){
        $('.side_nav').toggleClass('close');
        $('.wrap').toggleClass('tools');
    });
    
    
    
    $(".UpVote").on('click', function(){
        
        $value = this.value;
        console.log($value);
        $.get( "upVote.php?id="+$value, function( data ) { });
        
    });
    
    
});

</script>



</html> 