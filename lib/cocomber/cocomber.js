$(document).ready(function uisetup(){

    /* UI links */
    $("a.ui").each(function(){

       // Remap internal links:
       var url=$(this).attr('href');
       if(
         (url !== undefined)
         && url.substring(0,1)=='#'
       ){
          this.href=$(location).attr('href').replace(/\/*$/, '/')+url.substring(1);
       };



       // Handle target:
       var target;
       var targetid=$(this).attr('target');
       if(targetid!==undefined){
          target=$('#'+targetid);
       } else {
          target=$(this).parent();
       };


       // Intercept click action:
       $(this).click(function(e){
          target.load(
             this.href,
             function(){
                target.each(uisetup);
             }
          );
          e.preventDefault();
       });


       // Handle autoexecuting links:
       if ($(this).hasClass('auto')) {
         $(this).click();
       };

    });

});

