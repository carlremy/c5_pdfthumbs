//window.console && console.log("It's working.");

var PDFThumbnail = function(fID){
	return {
		fID : fID,
		refresh : function(){
			$.get(CCM_DISPATCHER_FILENAME + '/tools/packages/pdfthumbs/generate', {fID:this.fID}, function(r,s,x){
				console.log(r,s,x);
			});	
		}
	}
}

$(document).ready(function(){
	$('#btn-refresh-thumbnail').on('click', function(e){
		e.preventDefault();
		var p = new PDFThumbnail( $('#ccm-b-file-fm-value').val() );
		p.refresh()	
	});
});