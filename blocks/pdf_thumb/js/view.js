$(document).ready(function(){
  $('a[rel="pdfthumb-lightbox"]').magnificPopup({
    type : 'image',
    tClose : 'Close (Esc)',
    image : {
      titleSrc : function(item) {
        var cID = item.el.data('cid') || '';
        return item.el.attr('title') + ' <a class="fancybox-download" href="'+CCM_DISPATCHER_FILENAME+'/download_file/force/'+item.el.data('fid')+'/'+ cID +'">Download PDF</a>';
      }
    }
  });
});


/*
$('a[rel="fancybox-pdf"]').fancybox({
    helpers:  {
    title : {
        type : 'inside'
    },
    overlay : {
        showEarly : true
        }
    },
    title : function(){ 
        var cID = $(this).data('cid') || '';
        return $(this).attr('title') + 
            ' <a class="fancybox-download" href="'+CCM_DISPATCHER_FILENAME+'/download_file/force/'+$(this).data('fid')+'/'+ cID +'">Download PDF</a>';
        }
});
*/


